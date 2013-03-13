<?php 
	// json_encode($arr);
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$nowdate = date("Y-m-d H:i:s");
	$wfid = $_POST["wfid"];
	$btid = $_POST["btid"];
	$dbsource = $_POST["dbsource"];
	
	
	$db = new DB("da_userform");
	$db->tran();		//启动事务

	/************************** 创建工作流 实例 ***************************************/
	$sql_wfc = "insert into da_workflow.w_workflowcase( wfc_wfid, wfc_status, wfc_startdate, wfc_context ) 
	value( :wfid, :status, :date, :context )";
	
	$param_wfc = array();
	array_push($param_wfc, array(":wfid", $wfid));
	array_push($param_wfc, array(":wfid", $wfid));
	array_push($param_wfc, array(":status", "OP"));			//工作流实例当前状态；OP：开放；CL：关闭；SU：挂起；CA：取消；
	array_push($param_wfc, array(":date", $nowdate));
	array_push($param_wfc, array(":context", ""));
	$db->paramlist($param_wfc);
	$db->insert($sql_wfc);
	
	$wfcase = $db->getone("select @@IDENTITY as wfc_id");		//获取刚添加的工作流实例id
	$place = $db->getone("select p_id from da_workflow.w_place 
	where p_type=1 and p_wfid=".$wfid."");			//获取工作流开始库所id；库所类型；1：开始库所；50：中间库所；999：结束库所
	
	
	/************************** 在工作流"开始库所"放置一个令牌 ***************************************/
	$sql_token = "insert into da_workflow.w_token( t_wfid, t_wfcid, t_pid, t_status, t_createdate, t_context ) 
	value( :wfid, :wfcid, :pid, :status, :createdate, :context )";
	
	$param_token = array();
	array_push($param_token, array(":wfid", $wfid));
	array_push($param_token, array(":wfcid", $wfcase["wfc_id"]));
	array_push($param_token, array(":pid", $place["p_id"]));
	array_push($param_token, array(":status", "FREE"));			//令牌状态；FREE：自由；LOCK：锁定；CONS：消耗；CANS：取消
	array_push($param_token, array(":createdate", $nowdate));
	array_push($param_token, array(":context", ""));
	$db->paramlist($param_token);
	$db->insert($sql_token);
	
	/************************** 创建下一步事务变迁(工作项)  实例***************************************/
	$sql_tc = "insert into da_workflow.w_trancase( tc_wfid, tc_tid, tc_wfcid, tc_type, tc_limit, 
	tc_firetaskid, tc_context, tc_status, tc_enabledate, tc_userid ) 
	
	select t_wfid, t_id, :wfcid, t_type, t_limit, 
	t_firetaskid, :context, :status, :enabledate, :userid 
	
	from da_workflow.w_transition, da_workflow.w_arc 
	where t_wfid=:wfid and t_id=a_tid and a_direction='IN' and a_pid=:pid";		//通过IN向弧，找出开始库所下一步的事务变迁(工作项)
	
	$param_tc = array();
	array_push($param_tc, array(":wfid", $wfid));
	array_push($param_tc, array(":wfcid", $wfcase["wfc_id"]));
	array_push($param_tc, array(":pid", $place["p_id"]));
	array_push($param_tc, array(":status", "EN"));					//事务变迁(工作项)状态；EN：启用；IP：处理中；CA：取消； FI：完成
	array_push($param_tc, array(":enabledate", $nowdate));
	array_push($param_tc, array(":context", ""));
	array_push($param_tc, array(":userid", ""));
	$db->paramlist($param_tc);
	$db->insert($sql_tc);
	
	/************************** 创建表单数据源 记录 ***************************************/
	$flds = array();
	$flds2 = array();
	$param_db = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "wfid":
			case "btid":
			case "dbsource":
				continue;
				
			default:
				array_push( $flds, $key );
				array_push( $flds2, ":".$key );
				
				array_push($param_db, array(":".$key, $value));
		}
		
	}
	$sql_db = "insert into ".$dbsource."(".implode(", ", $flds).") values(".implode(", ", $flds2).")";
	
	$db->paramlist($param_db);
	$res = $db->insert($sql_db);
	
	$dbitem = $db->getone("select @@IDENTITY as dbsourceid");		//获取刚添加的表单数据源 记录id
	
	/************************** 创建表单模板 实例 ***************************************/
	$sql_bc = "insert into da_bizform.b_bizcase( bc_btid, bc_wfcid, bc_dbsourceid ) 
	value(:btid, :wfcid, :dbsourceid)";
	
	$param_bc = array();
	array_push($param_bc, array(":btid", $btid));					//表单模板id
	array_push($param_bc, array(":wfcid", $wfcase["wfc_id"]));		//主表单，对应工作流实例id(如果是过程表单，就对应事务变迁实例id)
	array_push($param_bc, array(":dbsourceid", $dbitem["dbsourceid"]));		//数据源记录id
	
	$db->paramlist($param_bc);
	$res = $db->insert($sql_bc);
	
	// $log = new Log();
	// $log->write($sql);
	
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