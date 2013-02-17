<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// error_reporting(-1);

	$db = new DB(1);
	$res = $db->Query("insert into p_power(pp_pid, pp_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	if($res){
		echo mysql_insert_id();
	}
	else{
		echo "FALSE";
	}
	$db->Destroy();
	//echo $db->error_message;
?>