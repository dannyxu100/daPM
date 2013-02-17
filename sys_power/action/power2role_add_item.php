<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB(1);
	$res = $db->Query("insert into p_power2role(p2r_prid, p2r_ppid, p2r_ptid) values(".$_POST["prid"].",".$_POST["ppid"].",'".$_POST["ptid"]."');");
	// $log->write("insert into p_power2role(p2r_prid, p2r_ppid, p2r_ptid) values(".$_POST["prid"].",".$_POST["ppid"].",'".$_POST["ptid"]."');");
	if($res){
		echo mysql_insert_id();
	}
	else{
		echo "FALSE";
	}
	$db->Destroy();
	//echo $db->error_message;
?>