<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_common");
	
	$sql = "delete from comm_notetype where nt_id=:ntid";
	$db->param(":ntid", $_POST["ntid"]);
	
	$res = $db->delete($sql);
	// Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>