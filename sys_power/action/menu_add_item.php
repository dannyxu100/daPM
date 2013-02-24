<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$db = new DB("da_powersys");
	$res = $db->insert("insert into p_menu(pm_pid, pm_name) values(:pid, :name);",
	array(
		":pid"=>$_POST["pid"],
		":name"=>$_POST["name"]
	));
	
	$db->close();
	// $log = new Log();
	// $log->write($set.time());

	echo $res?$res:"FALSE";
?>