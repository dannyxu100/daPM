<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_setting");
	$sql = "select * from s_helper ";
	
	if(isset($_POST["hcode"])){
		$sql .= "where h_code=:hcode";
		$db->param(":hcode", $_POST["hcode"]);
	}
	if(isset($_POST["hid"])){
		$sql .= "where h_id=:hid";
		$db->param(":hid", $_POST["hid"]);
	}
	$sql .= " order by h_sort asc, h_id asc";
	
	
	$set = $db->getone($sql);
	Log::out($sql);
	Log::out($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>