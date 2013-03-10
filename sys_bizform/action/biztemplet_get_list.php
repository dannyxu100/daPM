<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from b_biztemplet ";
	if(isset($_POST["btid"])){
		$sql .= " where bt_id = '".$_POST["btid"]."' ";
	}
	else if(isset($_POST["bttid"])){
		$sql .= " where bt_bttid = '".$_POST["bttid"]."' ";
	}
	$sql .= " order by bt_sort asc, bt_id asc";
	
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