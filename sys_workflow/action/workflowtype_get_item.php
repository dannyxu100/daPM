<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_workflow");
	$sql = "select * from w_workflowtype where wft_id=:wftid";
	$db->param(":wftid", $_POST["wft_id"]);
	// $log = new Log();
	// $log->write($sql);
	
	$set = $db->getlist($sql);
	//echo $db->error_message;
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>