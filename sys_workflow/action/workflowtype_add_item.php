<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_workflow");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into w_workflowtype(wft_pid, wft_name) values(:pid, :name)");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>