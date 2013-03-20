<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_bizform");
	
	$sql = "update b_biztemplet 
	set bt_listhtml=:bt_listhtml, 
	bt_listscript=:bt_listscript 
	where bt_id='".$_POST["bt_id"]."' ";
	
	$db->param(":bt_listhtml", $_POST["bt_listhtml"]);
	$db->param(":bt_listscript", $_POST["bt_listscript"]);
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>