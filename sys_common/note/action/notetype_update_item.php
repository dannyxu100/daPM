<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_common");
	
	$sql = "update comm_notetype set nt_name=:ntname where nt_id=:ntid";
	$db->param(":ntid", $_POST["ntid"]);
	$db->param(":ntname", $_POST["ntname"]);
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>