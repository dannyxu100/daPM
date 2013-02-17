<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// error_reporting(-1);

	$db = new DB(3);
	$res = $db->Query("insert into b_businessformtype(bft_pid, bft_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	if($res){
		echo mysql_insert_id();
	}
	else{
		echo "FALSE";
	}
	$db->Destroy();
	//echo $db->error_message;
?>