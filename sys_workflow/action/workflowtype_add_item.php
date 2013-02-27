<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_workflow");
	$db->param(":pid", $_POST["pid"]);
	$db->param(":name", $_POST["name"]);
	$res = $db->insert("insert into w_workflowtype(wft_pid, wft_name) values(:pid, :name)");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>