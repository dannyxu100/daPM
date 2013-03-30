<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB(1);
	$res = $db->Query("delete from p_power2role where p2r_prid=".$_POST["prid"]." and p2r_ppid=".$_POST["ppid"]);
		
	$db->Destroy();
	echo $res?$res:"FALSE";
?>