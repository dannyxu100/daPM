<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "insert into w_arc(a_wfid, a_name, a_sort, a_pid, a_tid, a_direction, a_type, a_precondition) values(";
	$sql .= "'".$_POST["a_wfid"]."',";
	$sql .= "'".$_POST["a_name"]."',";
	$sql .= "'".$_POST["a_sort"]."',";
	$sql .= "'".$_POST["a_pid"]."',";
	$sql .= "'".$_POST["a_tid"]."',";
	$sql .= "'".$_POST["a_direction"]."',";
	$sql .= "'".$_POST["a_type"]."',";
	$sql .= "'".$_POST["a_precondition"]."')";
	
	
	$db = new DB("da_workflow");
	$res = $db->insert($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>