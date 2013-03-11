<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	date_default_timezone_set("Asia/Hong_Kong");
	
	$db = new DB("da_workflow");
	$sql = "update w_workflow set wf_name=:wf_name, 
	wf_sort=:wf_sort, 
	wf_isrun=:wf_isrun, 
	wf_starttaskid=:wf_starttaskid, 
	wf_user=:wf_user, 
	wf_date=:wf_date, 
	wf_edituser=:wf_edituser, 
	wf_editdate=:wf_editdate, 
	wf_remark=:wf_remark 
	where wf_id=:wf_id";
	
	$db->param(":wf_name", $_POST["wf_name"]);
	$db->param(":wf_sort", $_POST["wf_sort"]);
	$db->param(":wf_isrun", $_POST["wf_isrun"]);
	$db->param(":wf_starttaskid", $_POST["wf_starttaskid"]);
	$db->param(":wf_user", $_POST["wf_user"]);
	$db->param(":wf_date", $_POST["wf_date"]);
	$db->param(":wf_edituser", fn_getcookie("puname"));
	$db->param(":wf_editdate", date("Y-m-d H:i:s"));
	$db->param(":wf_remark", $_POST["wf_remark"]);
	$db->param(":wf_id", $_POST["wf_id"]);
	
	
	$res = $db->update($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>