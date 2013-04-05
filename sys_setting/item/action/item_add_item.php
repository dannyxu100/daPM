<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_setting");
	$db->param(":itid", $_POST["itid"]);
	$db->param(":iname", $_POST["iname"]);
	$db->param(":ivalue", $_POST["ivalue"]);
	$db->param(":isort", $_POST["isort"]);
	$db->param(":iremark", $_POST["iremark"]);
	$res = $db->insert("insert into s_item(i_itid, i_name, i_value, i_sort, i_remark) values(:itid, :iname, :ivalue, :isort, :iremark)");
	
	$db->close();
	// Log::out($db->geterror());

	echo $res?$res:"FALSE";
?>