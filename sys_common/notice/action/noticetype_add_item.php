<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_common");
	$db->param(":ntpid", $_POST["ntpid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into comm_noticetype(nt_pid, nt_name) values(:ntpid, :name)");
	
	$db->close();

	echo $res?$res:"FALSE";
?>