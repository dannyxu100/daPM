<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	
	$sql = "update b_biztemplet set ";
	$sql .= " bf_name='".$_POST["bf_name"]."',";
	$sql .= " bf_sort='".$_POST["bf_sort"]."',";
	$sql .= " bf_remark='".$_POST["bf_remark"]."',";
	$sql .= " bf_edituser='".$_SESSION["u_name"]."',";
	$sql .= " bf_editdate='".date("Y-m-d H:i:s")."'";
	$sql .= " where bf_id='".$_POST["bf_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(3);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>