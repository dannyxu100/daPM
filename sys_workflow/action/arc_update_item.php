<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_workflow");
	$sql = "update w_arc 
	set a_name=:aname, 
	a_sort=:asort, 
	a_pid=:apid, 
	a_tid=:atid, 
	a_direction=:adirection, 
	a_type=:atype, 
	a_precondition=:aprecondition
	where a_id=:aid";
	
	$db->param(":aname", $_POST["aname"]);
	$db->param(":asort", $_POST["asort"]);
	$db->param(":apid", $_POST["apid"]);
	$db->param(":atid", $_POST["atid"]);
	$db->param(":adirection", $_POST["adirection"]);
	$db->param(":atype", $_POST["atype"]);
	$db->param(":aprecondition", $_POST["aprecondition"]);
	$db->param(":aid", $_POST["aid"]);
	
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>