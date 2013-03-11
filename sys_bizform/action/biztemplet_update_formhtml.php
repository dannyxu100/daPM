<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$sql = "update b_biztemplet set ";
	$sql .= " bt_formhtml='".$_POST["bt_formhtml"]."'";
	$sql .= " where bt_id='".$_POST["bt_id"]."' ";
	
	// $log = new Log();
	// $log->write($_POST["bt_formhtml"]);
	
	$db = new DB("da_bizform");
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>