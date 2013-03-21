<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$nowdate = date("Y-m-d H:i:s");
	$wfid = $_POST["wfid"];		//工作流id
	$wfcid = $_POST["wfcid"];	//工作流实例id
	$aid = $_POST["aid"];		//当前事务变迁的OUT向弧(指向下一个库所)id
	
	$db = new DB("da_workflow");
	
	/***************** 根据向弧id找出链接的事务变迁（工作项）实例 *********************************/
	$sql_tc = "select tc_id from w_arc, w_transition, w_trancase 
	where a_id=:aid 
	and a_tid=t_id 
	and t_id=tc_tid 
	and tc_wfcid=:wfcid 
	and (tc_status='EN' or tc_status='IP') ";	//通过工作流实例wfcid缩小范围。
												//事务变迁（工作项）状态；EN：启用；IP：处理中；CA：取消； FI：完成
	
	$param_tc = array();
	array_push($param_tc, array(":wfcid", $wfcid));
	array_push($param_tc, array(":aid", $aid));
	
	$db->paramlist($param_tc);
	$set_tc = $db->getone($sql_tc);
	
	// $log = new Log();
	// $log->write($aid);
	// $log->write($wfid);
	// $log->write($wfcid);
	// $log->write($set_tc["tc_id"]);
	
	/***************** 更新事务变迁实例状态 和完成日期 ***********************************************/
	$sql_tc2 = "update w_trancase 
	set tc_status='FI', 
	tc_finishdate=:date 
	
	where tc_id=:tcid";
	
	$param_tc2 = array();
	array_push($param_tc2, array(":date", $nowdate));
	array_push($param_tc2, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_tc2);
	$res = $db->update($sql_tc2);
	
	
	////////////////// 以下部分为事务变迁 判定是否发射（触发）与执行代码 /////////////////////////////
	
	$db->tran();	//启动事务
	
	/***************** 根据当前事务变迁（工作项）实例, 找出前后库所 *********************************/
	//IN库所
	$sql_p = "select p_id from w_place, w_arc, w_trancase 
	where p_id=a_pid 
	and a_tid=tc_tid 
	and a_direction='IN' 
	and tc_id=:tcid";
	
	$param_p = array();
	array_push($param_p, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_p);
	$set_pIN = $db->getlist($sql_p);
	
	$pINids = array();				//IN库所id记录集。
	for( $i=0; $i<count($set_pIN); $i++){
		array_push( $pINids, $set_pIN[$i]["p_id"] );
	}
	$pINids = implode(',', $pINids);
	
	//OUT库所
	$sql_p2 = "select p_id from w_place, w_arc, w_trancase 
	where p_id=a_pid 
	and a_tid=tc_tid 
	and a_direction='OUT' 
	and tc_id=:tcid";
	
	$param_p2 = array();
	array_push($param_p2, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_p2);
	$set_pOUT = $db->getlist($sql_p2);
	
	/********************* 检验IN库是否都有令牌(类似于会签业务) *********************************/
	$sql_t = "select t_id from w_token 
	where t_wfcid=:wfcid 
	and t_id in (".$pINids.")";			//通过工作流实例wfcid缩小范围。
	
	$param_t = array();
	array_push($param_t, array(":wfcid", $wfcid));
	
	$db->paramlist($param_t);
	$set_t = $db->getlist($sql_t);
	
	if( count($set_pIN) != count($set_t) ){			//数量不匹配，返回事务变迁实例更新结果，取消继续执行
		echo $res?$res:"FALSE";
	}
	
	/********************* 检验通过，事务变迁可以发射，继续执行，移交库所令牌 *********************************/
	//消耗IN库令牌
	$sql_t2 = "update w_token 
	set t_status='CONS', 
	t_consumedate=:date 
	
	where t_wfcid=:wfcid 
	and t_id in (".$pINids.")";		//通过工作流实例wfcid缩小范围。
									//令牌状态；FREE：自由；LOCK：锁定；CONS：消耗；CANS：取消
	$param_t2 = array();
	array_push($param_t2, array(":date", $nowdate));
	array_push($param_t2, array(":wfcid", $wfcid));
	
	$db->paramlist($param_t2);
	$res = $db->update($sql_t2);
	
	//添加所有OUT库令牌
	for($i=0; $i<count($set_pOUT); $i++){
		$sql_t3 = "insert into w_token( t_wfid, t_wfcid, t_pid, t_status, t_createdate, t_context ) 
		value( :wfid, :wfcid, :pid, :status, :createdate, :context )";
		
		$param_t3 = array();
		array_push($param_t3, array(":wfid", $wfid));
		array_push($param_t3, array(":wfcid", $wfcid));
		array_push($param_t3, array(":pid", $set_pOUT[$i]["p_id"]));
		array_push($param_t3, array(":status", "FREE"));			//令牌状态；FREE：自由；LOCK：锁定；CONS：消耗；CANS：取消
		array_push($param_t3, array(":createdate", $nowdate));
		array_push($param_t3, array(":context", ""));
		$db->paramlist($param_t3);
		$res = $db->insert($sql_t3);
		
		
		/************************** 创建下一步事务变迁(工作项)  实例***************************************/
		$sql_tc3 = "insert into da_workflow.w_trancase( tc_wfid, tc_tid, tc_wfcid, tc_type, tc_limit, 
		tc_firetaskid, tc_context, tc_status, tc_enabledate, tc_puid ) 
		
		select t_wfid, t_id, :wfcid, t_type, t_limit, 
		t_firetaskid, :context, :status, :enabledate, :userid 
		
		from da_workflow.w_transition, da_workflow.w_arc 
		where t_wfid=:wfid and t_id=a_tid and a_direction='IN' and a_pid=:pid";		//通过IN向弧，找出开始库所下一步的事务变迁(工作项)
		
		$param_tc3 = array();
		array_push($param_tc3, array(":wfid", $wfid));
		array_push($param_tc3, array(":wfcid", $wfcid));
		array_push($param_tc3, array(":pid", $set_pOUT[$i]["p_id"]));
		array_push($param_tc3, array(":status", "EN"));				//事务变迁(工作项)状态；EN：启用；IP：处理中；CA：取消； FI：完成
		array_push($param_tc3, array(":enabledate", $nowdate));
		array_push($param_tc3, array(":context", ""));
		array_push($param_tc3, array(":userid", ""));
		$db->paramlist($param_tc3);
		$res = $db->insert($sql_tc3);
	}
	
	
	// $log = new Log();
	// $log->write($db->geterror());
	
	if($db->geterror()){
		$db->back();
		$db->close();
		echo 'FALSE';
	}
	else{
		$db->commit();
		$db->close();
		echo $res;
	}
?>