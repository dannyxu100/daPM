<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_userform");
	$res = $db->runsql( $_POST["sql"] );
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>