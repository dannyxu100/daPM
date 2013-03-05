<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");

	$sql = "insert into b_biztemplet(bt_name, bt_bttid, bt_sort, bt_user, bt_date, bt_remark) values(";
	$sql .= "'".$_POST["bt_name"]."',";
	$sql .= "'".$_POST["bt_bttid"]."',";
	$sql .= "'".$_POST["bt_sort"]."',";
	$sql .= "'".$_SESSION["u_name"]."',";
	$sql .= "'".date("Y-m-d H:i:s")."',";
	$sql .= "'".$_POST["bt_remark"]."')";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(3);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>