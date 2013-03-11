<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_workflowtype ";
	if(isset($_POST["wftid"])){
		$sql .= " where wft_id=:wftid ";
		$db->param(":wftid", $_POST["wftid"]);
	}
	else if(isset($_POST["wftpid"])){
		$sql .= " where wft_pid=:wftpid ";
		$db->param(":wftpid", $_POST["wftpid"]);
	}
	$sql .= " order by wft_sort asc, wft_pid asc";
	
	$set = $db->getlist($sql);
	
	$db->close();
	
	// $log = new Log();
	// $log->write($sql.time());
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>