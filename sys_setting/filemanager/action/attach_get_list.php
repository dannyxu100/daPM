<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_setting");
	$sql = "select * from s_attachment 
	where a_type=:type 
	and a_code=:code";
	
	$sql .= " order by a_name asc";
	
	$db->param(":type", $_POST["type"]);
	$db->param(":code", $_POST["code"]);
		
	
	$set = $db->getlist($sql);
	// Log::out($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>