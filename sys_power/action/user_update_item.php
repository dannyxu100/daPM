<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "update p_user ";
	$sql .= "set pu_name='".$_POST["pu_name"]."',";
	$sql .= "pu_code='".$_POST["pu_code"]."',";
	$sql .= "pu_pwd='".$_POST["pu_pwd"]."',";
	$sql .= "pu_oid=".$_POST["pu_oid"].",";
	$sql .= "pu_phone='".$_POST["pu_phone"]."',";
	$sql .= "pu_telephone='".$_POST["pu_telephone"]."',";
	$sql .= "pu_address='".$_POST["pu_address"]."',";
	$sql .= "pu_remark='".$_POST["pu_remark"]."' ";
	$sql .= " where pu_id='".$_POST["pu_id"]."'";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>