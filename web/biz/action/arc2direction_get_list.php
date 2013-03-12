<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$wfid = $_POST["wfid"];
	$wfcid = $_POST["wfcid"];
	
	$db = new DB("da_workflow");
	/***************** 根据角色 找出该工作流可参与的事务变迁（工作项） *********************************/
	$sql1 = "select t_id from w_transition, w_tran2role 
	where t_wfid=:wfid 
	and t_id=t2r_tid 
	and t2r_prid in (".fn_getcookie("roleid").")";
	$param1 = array();
	array_push($param1, array(":wfid", $wfid));
	
	$db->paramlist($param1);
	$set_tran = $db->getlist($sql1);
	
	$tids = array();					//事务变迁id记录集。
	for( $i=0; $i<count($set_tran); $i++){
		array_push( $tids, $set_tran[$i]["t_id"] );
	}
	
	/**************** 根据可参与事务变迁处理中状态的实例 找出下一步直线库所的 可选择向弧（路由） *****************/
	$sql2 = "select w_arc.* from w_arc, w_trancase 
	where a_tid=tc_tid 
	and a_direction='OUT' 
	and tc_wfcid=:wfcid 
	and (tc_status='EN' or tc_status='IP') 
	and tc_tid in (".implode(',', $tids).")";	//通过工作流实例wfcid缩小范围。
												//向弧走向；IN：库所走向事务变迁；OUT：事务变迁走向库所。
												//事务变迁（工作项）状态；EN：启用；IP：处理中；CA：取消； FI：完成
												
	$sql2 .= " order by a_sort asc, a_id asc";
	
	$param2 = array();
	array_push($param2, array(":wfcid", $wfcid));
	
	$db->paramlist($param2);
	$set = $db->getlist($sql2);
	
	// $log = new Log();
	// $log->write($sql1);
	// $log->write($sql2);
	// $log->write($db->geterror());
	
	$db->close();
	
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>