<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);

	$db = new DB("da_powersys");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into p_menu(pm_pid, pm_name) values(:pid, :name)");
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>