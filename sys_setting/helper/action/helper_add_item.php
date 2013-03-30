<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_setting");
	$db->param(":htid", $_POST["htid"]);
	$db->param(":hname", $_POST["hname"]);
	$db->param(":hcode", $_POST["hcode"]);
	$db->param(":hsort", $_POST["hsort"]);
	$db->param(":hcontent", $_POST["hcontent"]);
	$db->param(":heditorname", $_POST["heditorname"]);
	$db->param(":heditordate", $_POST["heditordate"]);
	
	$res = $db->insert("insert into s_helper(h_htid, h_name, h_code, h_sort, h_content, h_editorname, h_editordate) 
	values(:htid, :hname, :hcode, :hsort, :hcontent, :heditorname, :heditordate)");
	
	$db->close();
	// $log = new Log();
	// $log->write($db->geterror());

	echo $res?$res:"FALSE";
?>