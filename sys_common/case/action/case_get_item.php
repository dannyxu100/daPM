<?php 
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_common");
	$sql = "select * from comm_case 
	where c_id=:cid ";
	
	$db->param(":cid", $_POST["cid"]);
	$set = $db->getone($sql);

	$db->close();
	
	echo json_encode($set);
?>