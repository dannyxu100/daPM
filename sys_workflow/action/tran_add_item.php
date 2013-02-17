<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	
	$sql = "insert into w_transition(t_name, t_wfid, t_type, t_sort, t_firetaskid, t_limit, t_roleid, t_remark) values(";
	$sql .= "'".$_POST["t_name"]."',";
	$sql .= "'".$_POST["t_wfid"]."',";
	$sql .= "'".$_POST["t_type"]."',";
	$sql .= "'".$_POST["t_sort"]."',";
	$sql .= "'".$_POST["t_firetaskid"]."',";
	$sql .= "'".$_POST["t_limit"]."',";
	$sql .= "'".$_POST["t_roleid"]."',";
	$sql .= "'".$_POST["t_remark"]."')";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(2);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>