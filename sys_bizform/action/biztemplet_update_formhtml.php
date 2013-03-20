<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_bizform");
	$sql = "update b_biztemplet 
	set bt_formhtml=:bt_formhtml, 
	bt_formscript=:bt_formscript 
	where bt_id='".$_POST["bt_id"]."' ";
	
	$db->param(":bt_formhtml", $_POST["bt_formhtml"]);
	$db->param(":bt_formscript", $_POST["bt_formscript"]);
	
	// $log = new Log();
	// $log->write($_POST["bt_formhtml"]);
	
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>