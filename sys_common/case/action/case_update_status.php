<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_common");
	$db->param(":status", $_POST["status"]);
	$db->param(":cid", $_POST["cid"]);
	
	$res = $db->update("update comm_case set c_status=:status where c_id=:cid");
	
	$db->close();
	// Log::out($db->geterror());

	echo $res?$res:"FALSE";
?>