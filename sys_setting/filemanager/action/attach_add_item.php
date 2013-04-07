<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_setting");
	
	$db->param(":type", $_POST["type"]);
	$db->param(":code", $_POST["code"]);
	$db->param(":name", $_POST["name"]);
	$db->param(":url", $_POST["url"]);
	$db->param(":puid", fn_getcookie("puid"));
	$db->param(":puname", fn_getcookie("puname"));
	$db->param(":date", date("Y-m-d H:i:s"));
	$res = $db->insert("insert into s_attachment(a_type, a_code, a_name, a_url, a_puid, a_puname, a_date) 
	values(:type, :code, :name, :url, :puid, :puname, :date)");
	
	$db->close();
	// $log = new Log();
	// $log->write($db->geterror());

	echo $res?$res:"FALSE";
?>