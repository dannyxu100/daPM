<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "insert into p_user(pu_name, pu_code, pu_pwd, pu_oid, pu_phone, pu_telephone, pu_address, pu_remark) values(";
	$sql .= "'".$_POST["pu_name"]."',";
	$sql .= "'".$_POST["pu_code"]."',";
	$sql .= "'".$_POST["pu_pwd"]."',";
	$sql .= $_POST["pu_oid"].",";
	$sql .= "'".$_POST["pu_phone"]."',";
	$sql .= "'".$_POST["pu_telephone"]."',";
	$sql .= "'".$_POST["pu_address"]."',";
	$sql .= "'".$_POST["pu_remark"]."')";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>