<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_workflow");
	$sql = "update w_transition 
	set t_name=:tname, 
	t_sort=:tsort, 
	t_type=:ttype, 
	t_limit=:tlimit, 
	t_firetaskid=:tfiretaskid, 
	t_remark=:tremark 
	where t_id=:tid";
	
	$db->param(":tid", $_POST["tid"]);
	$db->param(":tname", $_POST["tname"]);
	$db->param(":tsort", $_POST["tsort"]);
	$db->param(":ttype", $_POST["ttype"]);
	$db->param(":tlimit", $_POST["tlimit"]);
	$db->param(":tfiretaskid", $_POST["tfiretaskid"]);
	$db->param(":tremark", $_POST["tremark"]);
	
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>