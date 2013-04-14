<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_common");
	$db->param(":status", $_POST["status"]);
	$db->param(":nid", $_POST["nid"]);
	
	$res = $db->update("update comm_notice set n_status=:status where n_id=:nid");
	
	$db->close();
	// Log::out($db->geterror());

	echo $res?$res:"FALSE";
?>