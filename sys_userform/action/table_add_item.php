<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// error_reporting(-1);

	$db = new DB("da_userform");
	$res = $db->insert("insert into p_group(pg_pid, pg_name) values(".$_POST["pid"].",'".$_POST["name"]."')");
	if($res){
		echo mysql_insert_id();
	}
	else{
		echo "FALSE";
	}
	$db->Destroy();
	//echo $db->error_message;
?>