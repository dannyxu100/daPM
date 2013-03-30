<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB("da_power");
	$res = $db->insert("insert into p_power2role(p2r_prid, p2r_ppid, p2r_ptid) values(".$_POST["prid"].",".$_POST["ppid"].",'".$_POST["ptid"]."');");
	// $log->write("insert into p_power2role(p2r_prid, p2r_ppid, p2r_ptid) values(".$_POST["prid"].",".$_POST["ppid"].",'".$_POST["ptid"]."');");

	$db->close();
	echo $res?$res:"FALSE";
?>