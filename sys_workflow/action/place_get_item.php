<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "select * from w_place ";
	if(isset($_POST["pid"])){
		$sql .= " where p_id = '".$_POST["pid"]."' ";
	}
	$sql .= " order by p_sort asc, p_id asc";
	
	$db = new DB("da_workflow");
	$set = $db->getone($sql);
	// $log = new Log();
	// $log->write($sql.time());
	
	$db->close();
	
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>