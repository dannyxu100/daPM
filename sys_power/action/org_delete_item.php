<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	
	$db = new DB("da_powersys");
	$res = $db->delete( "delete from p_org where po_id=".$_POST["poid"] );
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>