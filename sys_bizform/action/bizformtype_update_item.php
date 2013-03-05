<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$sql = "update b_biztemplettype set ";
	$sql .= " bft_name='".$_POST["bft_name"]."',";
	$sql .= " bft_sort='".$_POST["bft_sort"]."',";
	$sql .= " bft_remark='".$_POST["bft_remark"]."',";
	$sql .= " bft_date='".$_POST["bft_date"]."' ";
	$sql .= " where bft_id='".$_POST["bft_id"]."' ";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db = new DB(3);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>