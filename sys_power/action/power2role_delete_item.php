<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB(1);
	$res = $db->Query("delete from p_power2role where p2r_prid=".$_POST["prid"]." and p2r_ppid=".$_POST["ppid"]);
		
	$db->Destroy();
	echo $res?$res:"FALSE";
?>