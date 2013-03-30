<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("da_setting");
	$db->param(":htid", $_POST["htid"]);
	$res = $db->delete( "delete from s_helpertype where ht_id=:htid");
	//echo $db->error_message;
	$db->close();
	
	echo $res?$res:"FALSE";
?>