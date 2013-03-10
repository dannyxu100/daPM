<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "";
	$sql = "select * from b_biztemplettype ";
	if(isset($_POST["bttid"])){
		$sql .= " where btt_id = '".$_POST["bttid"]."' ";
	}
	else if(isset($_POST["bttpid"])){
		$sql .= " where btt_pid = '".$_POST["bttpid"]."' ";
	}
	$sql .= " order by btt_sort asc, btt_pid asc";
	
	$db = new DB("da_bizform");
	$set = $db->getlist($sql);
	//echo $db->error_message;
	$db->close();
	
	// $log = new Log();
	// $log->write($sql.time());
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>