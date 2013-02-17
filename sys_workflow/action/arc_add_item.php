<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$sql = "insert into w_arc(a_wfid, a_sort, a_pid, a_tid, a_direction, a_type, a_precondition) values(";
	$sql .= "'".$_POST["a_wfid"]."',";
	$sql .= "'".$_POST["a_sort"]."',";
	$sql .= "'".$_POST["a_pid"]."',";
	$sql .= "'".$_POST["a_tid"]."',";
	$sql .= "'".$_POST["a_direction"]."',";
	$sql .= "'".$_POST["a_type"]."',";
	$sql .= "'".$_POST["a_precondition"]."')";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(2);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>