<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "insert into p_user(pu_name, pu_code, pu_pwd, pu_oid, 
	pu_phone, pu_telephone, pu_address, pu_email, pu_qq, pu_remark) values(";
	$sql .= "'".$_POST["pu_name"]."',";
	$sql .= "'".$_POST["pu_code"]."',";
	$sql .= "'".md5($_POST["pu_pwd"])."',";
	$sql .= $_POST["pu_oid"].",";
	$sql .= "'".$_POST["pu_phone"]."',";
	$sql .= "'".$_POST["pu_telephone"]."',";
	$sql .= "'".$_POST["pu_address"]."',";
	$sql .= "'".$_POST["pu_email"]."',";
	$sql .= "'".$_POST["pu_qq"]."',";
	$sql .= "'".$_POST["pu_remark"]."')";
	
	$db = new DB("da_powersys");
	$res = $db->insert($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>