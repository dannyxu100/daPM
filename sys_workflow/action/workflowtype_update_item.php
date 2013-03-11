<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);
	
	$sql = "update w_workflowtype set wft_name=:wft_name, wft_sort=:wft_sort, wft_date=:wft_date, wft_remark=:wft_remark, where wft_id=:wft_id";
	
	//$log = new Log();
	// $log->write($sql.time());
	
	$db = new DB("da_workflow");
	$db->param(":wft_id", $_POST["wft_id"]);
	$db->param(":wft_name", $_POST["wft_name"]);
	$db->param(":wft_sort", $_POST["wft_sort"]);
	$db->param(":wft_date", $_POST["wft_date"]);
	$db->param(":wft_remark", $_POST["wft_remark"]);
	
	$res = $db->update($sql);
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>