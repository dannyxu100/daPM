<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// error_reporting(-1);

	$db = new DB(2);
	$res = $db->Query("insert into w_workflowtype(wft_pid, wft_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	if($res){
		echo mysql_insert_id();
	}
	else{
		echo "FALSE";
	}
	$db->Destroy();
	//echo $db->error_message;
?>