<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_setting");
	$db->param(":htpid", $_POST["htpid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into s_helpertype(ht_pid, ht_name) values(:htpid, :name)");
	
	$db->close();
	// $log = new Log();
	// $log->write($db->geterror());

	echo $res?$res:"FALSE";
?>