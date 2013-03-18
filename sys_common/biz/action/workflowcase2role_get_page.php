﻿<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$puid = fn_getcookie("puid");
	$wfid = $_POST["wfid"];
	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	$status = $_POST["status"];
	
	$db = new DB("da_userform");
	
	/**************************** 根据角色 找出该工作流可参与的事务变迁（工作项） *********************************/
	$sql1 = "select t_id from da_workflow.w_transition, da_workflow.w_tran2role 
	where t_wfid=:wfid 
	and t_id=t2r_tid 
	and t2r_prid in (".fn_getcookie("roleid").")";
	$param1 = array();
	array_push($param1, array(":wfid", $wfid));
	
	$db->paramlist($param1);
	$set_tran = $db->getlist($sql1);
	
	$tids = array(0);					//事务变迁id记录集
	for( $i=0; $i<count($set_tran); $i++){
		array_push( $tids, $set_tran[$i]["t_id"] );
	}
	
	/******************* 找出下级员工puid记录集 *********************************************/
	$sql11 = "select pr_puid from da_powersys.p_relation 
	where pr_leaderid=:puid";
	$param11 = array();
	array_push($param11, array(":puid", $puid));
	
	$db->paramlist($param1);
	$set_puids = $db->getlist($sql11);
	
	$puids = array($puid);					//当前登录人员puid + 下级员工puid 数据集
	for( $i=0; $i<count($set_puids); $i++){
		array_push( $puids, $set_puids[$i]["pr_puid"] );
	}
	
	/******************* 根据 可参与事务变迁的实例找出 所对应的工作流实例id *****************/
	$sql2 = "select distinct(tc_wfcid) from da_workflow.w_trancase 
	where w_trancase.tc_wfid=:wfid 
	and w_trancase.tc_puid in (".implode(',', $puids).") 
	and w_trancase.tc_tid in (".implode(',', $tids).") ";		//事务变迁实例接单拥有者
																//且当同一用户兼容多重角色，
																//处理同一流程，不同业务时,也只取一条
	
	$param2 = array();
	if( "" != $status ){
		$sql2 .= "and w_trancase.tc_status=:status ";
		array_push($param2, array(":status", $status));
	}
	array_push($param2, array(":wfid", $wfid));
	
	$db->paramlist($param2);
	$set_tc = $db->getlist($sql2);
	
	$wfcids = array(0);					//工作流实例id记录集
	for( $i=0; $i<count($set_tc); $i++){
		array_push( $wfcids, $set_tc[$i]["tc_wfcid"] );
	}
	
	/**************************** 查询数据源记录集 *********************************/
	$sql31 = "select ".$dbsource.".*, b_bizcase.bc_id, w_workflowcase.wfc_id from ".$dbsource.", ";
	$param31 = array();
	
	$sql32 = "select count(bc_id) as Column1 from ".$dbsource.", ";
	$param32 = array();

	$sql4 = "da_bizform.b_bizcase, da_workflow.w_workflowcase 
	where ".$dbsource."." .$dbfld."=b_bizcase.bc_dbsourceid 
	and b_bizcase.bc_wfcid = w_workflowcase.wfc_id 
	and w_workflowcase.wfc_id in (".implode(',', $wfcids).")";

	$sql31 .= $sql4;
	array_push($param31, array(":wfid", $wfid));
	// $sql1 .= " order by bt_sort asc, bt_id asc ";
	
	$sql32 .= $sql4;
	array_push($param32, array(":wfid", $wfid));
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param31, array(":start", $start));
		array_push($param31, array(":end", $end));
	}
	// $log = new Log();
	// $log->write($wfid."    ".$status."     ".$sql2);
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