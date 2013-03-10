<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "";
	$sql = "select * from w_workflow ";
	if(isset($_POST["wftid"])){
		$sql .= " where wf_wftid = '".$_POST["wftid"]."' ";
	}
	$sql .= " order by wf_sort asc, wf_id asc";
	
	$db = new DB("da_workflow");
	$set = $db->getlist($sql);
	//echo $db->error_message;
	$db->close();
	
	// $log = new Log();
	// $log->write(json_encode($set));
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>