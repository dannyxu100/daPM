<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_power");
	$res = $db->insert("insert into p_role(pr_pid, pr_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	
	$db->close();
	echo $res?$res:"FALSE";
?>