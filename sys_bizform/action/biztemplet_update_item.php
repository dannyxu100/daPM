<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	
	$sql = "update b_biztemplet set ";
	$sql .= " bt_name='".$_POST["bt_name"]."',";
	$sql .= " bt_sort='".$_POST["bt_sort"]."',";
	$sql .= " bt_remark='".$_POST["bt_remark"]."',";
	$sql .= " bt_edituser='".$_SESSION["u_name"]."',";
	$sql .= " bt_editdate='".date("Y-m-d H:i:s")."'";
	$sql .= " where bt_id='".$_POST["bt_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(3);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>