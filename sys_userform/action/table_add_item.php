<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_userform");
	$res = $db->runsql( $_POST["sql"] );
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>