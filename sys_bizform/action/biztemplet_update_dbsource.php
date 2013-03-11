<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$sql = "update b_biztemplet set ";
	$sql .= " bt_dbsource='".$_POST["dbsource"]."' ";
	$sql .= " ,bt_dbfld='".$_POST["dbfld"]."' ";
	$sql .= " where bt_id='".$_POST["bt_id"]."' ";
	
	$db = new DB("da_bizform");
	$res = $db->update($sql);
	// $log = new Log();
	// $log->write($db->geterror());

	$db->close();
	
	echo $res?$res:"FALSE";
?>