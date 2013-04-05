<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_bizform");
	$res = $db->insert("insert into b_biztemplettype(btt_pid, btt_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	
	$db->close();
	echo $res?$res:"FALSE";
?>