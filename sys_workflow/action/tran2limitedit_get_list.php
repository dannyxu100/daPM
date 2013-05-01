<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_tran2limitedit 
	where tle_tid=:tle_tid";
	
	$db->param(":tle_tid",$_POST["tid"]);
	$set = $db->getlist($sql);
	
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>