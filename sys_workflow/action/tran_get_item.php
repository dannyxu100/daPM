<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "select * from w_transition ";
	if(isset($_POST["tid"])){
		$sql .= " where t_id = '".$_POST["tid"]."' ";
	}
	$sql .= " order by t_sort asc, t_id asc";
	
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