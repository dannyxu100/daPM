<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	
	$db = new DB("da_workflow");
	$sql = "select * from w_workflow where wf_id=:wf_id";
	$db->param(":wf_id", $_POST["wf_id"]);
	// $log = new Log();
	// $log->write($sql);
	$set = $db->getone($sql);

	$db->close();
	//print_r($set);
	
	// $log->write(json_encode($set));
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>