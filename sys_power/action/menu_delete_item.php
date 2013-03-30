<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("da_powersys");
	$db->param(":pmid", $_POST["pmid"]);
	$res = $db->delete( "delete from p_menu where pm_id=:pmid");
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>