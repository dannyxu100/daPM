<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	$db->param(":prid", $_POST["prid"]);
	$db->param(":pmid", $_POST["pmid"]);
	$res = $db->delete("delete from p_menu2role where m2r_prid=:prid and m2r_pmid=:pmid");
		
	$db->close();
	
	echo $res?$res:"FALSE";
?>