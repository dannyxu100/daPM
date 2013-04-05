<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_bizform");
	$sql = "update b_biztemplet 
	set bt_form2html=:bt_form2html, 
	bt_form2script=:bt_form2script 
	where bt_id='".$_POST["bt_id"]."' ";
	
	$db->param(":bt_form2html", urldecode($_POST["bt_form2html"]));
	$db->param(":bt_form2script", urldecode($_POST["bt_form2script"]));
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>