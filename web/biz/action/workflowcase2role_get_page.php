<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	$status = isset($_POST["status"])?$_POST["status"]:"EN";	//默认状态筛选为EN启动状态
	
	$db = new DB("da_userform");
	
	/**************************** 根据角色 找出该工作流可参与的事务变迁（工作项） *********************************/
	$sql1 = "select t_id from da_workflow.w_transition, da_workflow.w_tran2role 
	where t_wfid=:wfid 
	and t_id=t2r_tid 
	and t2r_prid in (".fn_getcookie("roleid").")";
	$param1 = array();
	array_push($param1, array(":wfid", $_POST["wfid"]));
	
	$db->paramlist($param1);
	$set_tran = $db->getlist($sql1);
	
	$tids = array(0);					//事务变迁id记录集
	for( $i=0; $i<count($set_tran); $i++){
		array_push( $tids, $set_tran[$i]["t_id"] );
	}
	
	
	/******************* 根据 可参与事务变迁的实例找出 所对应的工作流实例id *****************/
	$sql2 = "select tc_wfcid from da_workflow.w_trancase 
	where w_trancase.tc_wfid=:wfid 
	and w_trancase.tc_status=:status 
	and w_trancase.tc_tid in (".implode(',', $tids).")";
	$param2 = array();
	array_push($param2, array(":wfid", $_POST["wfid"]));
	array_push($param2, array(":status", $status));
	
	$db->paramlist($param2);
	$set_tc = $db->getlist($sql2);
	
	$wfcids = array(0);					//工作流实例id记录集
	for( $i=0; $i<count($set_tc); $i++){
		array_push( $wfcids, $set_tc[$i]["tc_wfcid"] );
	}
	
	/**************************** 查询数据源记录集 *********************************/
	$sql31 = "select ".$dbsource.".* from ".$dbsource.", ";
	$param31 = array();
	
	$sql32 = "select count(*) as Column1 from ".$dbsource.", ";
	$param32 = array();

	$sql4 = "da_bizform.b_bizcase, da_workflow.w_workflowcase 
	where ".$dbsource."." .$dbfld."=b_bizcase.bc_dbsourceid 
	and b_bizcase.bc_wfcid = w_workflowcase.wfc_id 
	and w_workflowcase.wfc_id in (".implode(',', $wfcids).")";

	$sql31 .= $sql4;
	array_push($param31, array(":wfid", $_POST["wfid"]));
	// $sql1 .= " order by bt_sort asc, bt_id asc ";
	
	$sql32 .= $sql4;
	array_push($param32, array(":wfid", $_POST["wfid"]));
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param31, array(":start", $start));
		array_push($param31, array(":end", $end));
	}
	// $log = new Log();
	// $log->write($sql31);
	// $log->write($sql32);
	
	$db->paramlist($param31);
	$set = $db->getlist($sql31);
	
	$db->paramlist($param32);
	$count = $db->getlist($sql32);
	
	// $log->write($db->geterror());
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set							//记录集
	);
	
	// $log->write(json_encode($res));
	echo json_encode($res);
?>