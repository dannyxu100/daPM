<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("da_setting");
	$db->param(":itid", $_POST["itid"]);
	$res = $db->delete( "delete from s_itemtype where it_id=:itid");
	//echo $db->error_message;
	$db->close();
	
	echo $res?$res:"FALSE";
?>