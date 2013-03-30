<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";

	$db = new DB("da_powersys");
	$res = $db->insert("insert into p_role(pr_pid, pr_name) values(".$_POST["prpid"].",'".$_POST["name"]."')");
	
	$db->close();
	echo $res?$res:"FALSE";
?>