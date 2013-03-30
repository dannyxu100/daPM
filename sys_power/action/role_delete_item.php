<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";

	$sql = "delete from p_role where pr_id=".$_POST["prid"];
	
	$db = new DB("da_powersys");
	$res = $db->delete($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>