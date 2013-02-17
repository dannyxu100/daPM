<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	
	$sql = "update w_workflow set ";
	$sql .= " wf_name='".$_POST["wf_name"]."',";
	$sql .= " wf_sort='".$_POST["wf_sort"]."',";
	$sql .= " wf_isrun='".$_POST["wf_isrun"]."',";
	$sql .= " wf_starttaskid='".$_POST["wf_starttaskid"]."',";
	$sql .= " wf_user='".$_POST["wf_user"]."',";
	$sql .= " wf_date='".$_POST["wf_date"]."',";
	$sql .= " wf_edituser='".$_SESSION["u_name"]."',";
	$sql .= " wf_editdate='".date("Y-m-d H:i:s")."',";
	$sql .= " wf_remark='".$_POST["wf_remark"]."' ";
	$sql .= " where wf_id='".$_POST["wf_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(2);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>