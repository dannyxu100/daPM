<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "update p_user ";
	$sql .= "set pu_icon='".$_POST["puicon"]."' ";
	$sql .= " where pu_id='".$_POST["puid"]."'";
	
	$db = new DB("da_powersys");
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>