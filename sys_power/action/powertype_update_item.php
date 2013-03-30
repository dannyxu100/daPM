<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "update p_powertype ";
	$sql .= "set pt_name='".$_POST["pt_name"]."',";
	$sql .= "pt_code='".$_POST["pt_code"]."',";
	$sql .= "pt_sort='".$_POST["pt_sort"]."',";
	$sql .= "pt_remark='".$_POST["pt_remark"]."' ";
	$sql .= " where pt_id='".$_POST["pt_id"]."'";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>