<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_workflow");
	$sql = "insert into w_tran2limitedit(tle_tid, tle_field) values(:tle_tid, :tle_field)";
	
	$db->param(":tle_tid", $_POST["tid"]);
	$db->param(":tle_field", $_POST["fld"]);
	$res = $db->insert($sql);
	
	$db->close();
	echo $res?$res:"FALSE";
?>