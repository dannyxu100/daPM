<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_bizform");
	$sql = "update b_biztemplet 
	set bt_formhtml=:bt_formhtml, 
	bt_formscript=:bt_formscript 
	where bt_id='".$_POST["bt_id"]."' ";
	
	$db->param(":bt_formhtml", urldecode($_POST["bt_formhtml"]));
	$db->param(":bt_formscript", urldecode($_POST["bt_formscript"]));
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>