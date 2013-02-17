<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	
	$sql = "insert into w_place(p_name, p_wfid, p_type, p_sort) values(";
	$sql .= "'".$_POST["p_name"]."',";
	$sql .= "'".$_POST["p_wfid"]."',";
	$sql .= "50,";							//过程库所类型
	$sql .= "'".$_POST["p_sort"]."')";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(2);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>