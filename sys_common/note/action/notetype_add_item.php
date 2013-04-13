<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$puid = fn_getcookie("puid");
	
	$db = new DB("da_common");
	
	$sql = "insert into comm_notetype(nt_name, nt_puid) values(:ntname, :puid)";
	$db->param(":ntname", $_POST["ntname"]);
	$db->param(":puid", $puid);
	
	$res = $db->insert($sql);
	// Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>