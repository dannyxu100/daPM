<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_workflow");
	$sql = "update w_place 
	set p_name=:pname, 
	p_sort=:psort, 
	p_type=:ptype, 
	p_remark=:premark 
	where p_id=:pid";
	
	$db->param(":pid", $_POST["pid"]);
	$db->param(":pname", $_POST["pname"]);
	$db->param(":psort", $_POST["psort"]);
	$db->param(":ptype", $_POST["ptype"]);
	$db->param(":premark", $_POST["premark"]);
	
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>