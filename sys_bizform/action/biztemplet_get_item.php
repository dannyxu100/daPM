<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_bizform");
	$sql = "select * from b_biztemplet where bt_id=:btid ";
	// $log = new Log();
	// $log->write($sql);
	
	$db->param(":btid", $_POST["bt_id"]);
	$set = $db->getlist($sql);
	
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
	
?>