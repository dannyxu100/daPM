<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);

	$sql = "update b_biztemplettype set ";
	$sql .= " btt_name='".$_POST["btt_name"]."',";
	$sql .= " btt_sort='".$_POST["btt_sort"]."',";
	$sql .= " btt_remark='".$_POST["btt_remark"]."',";
	$sql .= " btt_date='".$_POST["btt_date"]."' ";
	$sql .= " where btt_id='".$_POST["btt_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(3);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>