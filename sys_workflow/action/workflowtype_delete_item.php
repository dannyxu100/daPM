<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";

	$db = new DB("da_workflow");
	$db->param(":wftid", $_POST["wftid"]);
	$res = $db->delete( "delete from w_workflowtype where wft_id=:wftid");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>