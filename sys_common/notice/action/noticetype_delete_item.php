<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";

	$db = new DB("da_common");
	$db->param(":ntid", $_POST["ntid"]);
	$res = $db->delete( "delete from comm_noticetype where nt_id=:ntid");
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>