<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	
	$sql = "update b_biztemplet set ";
	$sql .= " bt_listhtml='".$_POST["bt_listhtml"]."'";
	$sql .= " where bt_id='".$_POST["bt_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB("da_bizform");
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>