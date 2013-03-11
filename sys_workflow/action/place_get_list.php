<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$sql = "select * from w_place ";
	if(isset($_POST["wfid"])){
		$sql .= " where p_wfid = '".$_POST["wfid"]."' ";
	}
	$sql .= " order by p_sort asc, p_id asc";
	
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