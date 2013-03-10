<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$sql = "select * from w_transition ";
	if(isset($_POST["wfid"])){
		$sql .= " where t_wfid = '".$_POST["wfid"]."' ";
	}
	$sql .= " order by t_sort asc, t_id asc";
	
	$db = new DB("da_workflow");
	$set = $db->getlist($sql);
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