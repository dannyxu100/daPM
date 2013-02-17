<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "update w_workflowtype ";
	$sql .= "set wft_name='".$_POST["wft_name"]."',";
	$sql .= "wft_sort='".$_POST["wft_sort"]."',";
	$sql .= "wft_date='".$_POST["wft_date"]."',";
	$sql .= "wft_remark='".$_POST["wft_remark"]."' ";
	$sql .= " where wft_id='".$_POST["wft_id"]."'";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(2);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>