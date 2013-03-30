<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	

	$db = new DB("da_powersys");
	$db->param(":pgid", $_POST["pgid"]);
	$res = $db->delete( "delete from p_group where pg_id=:pgid");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>