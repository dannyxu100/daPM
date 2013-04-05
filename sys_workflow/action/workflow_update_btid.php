<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_workflow");
	$sql = "update w_workflow set wf_btid=:btid, 
	wf_btname=:btname 
	where wf_id=:wfid";
	
	$db->param(":btid", $_POST["btid"]);
	$db->param(":btname", $_POST["btname"]);
	$db->param(":wfid", $_POST["wfid"]);
	
	
	$res = $db->update($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>