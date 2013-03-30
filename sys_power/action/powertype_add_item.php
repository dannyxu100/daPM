<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "insert into p_powertype(pt_name, pt_code, pt_sort, pt_remark) values(";
	$sql .= "'".$_POST["pt_name"]."',";
	$sql .= "'".$_POST["pt_code"]."',";
	$sql .= "'".$_POST["pt_sort"]."',";
	$sql .= "'".$_POST["pt_remark"]."')";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>