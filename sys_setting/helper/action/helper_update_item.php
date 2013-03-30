<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("da_setting");
	
	$sql = "update s_helper set ";
	
	if( isset($_POST["hname"]) )
	{
		$sql .= " h_name=:hname ";
		$db->param(":hname", $_POST["hname"]);
	}
	if( isset($_POST["hsort"]) )
	{
		$sql .= ", h_sort=:hsort ";
		$db->param(":hsort", $_POST["hsort"]);
	}
	if( isset($_POST["hcode"]) )
	{
		$sql .= ", h_code=:hcode ";
		$db->param(":hcode", $_POST["hcode"]);
	}
	if( isset($_POST["hcontent"]) )
	{
		$sql .= ", h_content=:hcontent ";
		$db->param(":hcontent", $_POST["hcontent"]);
	}
	
	$sql .= " where h_id=:hid";
	$db->param(":hid", $_POST["hid"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out($db->geterror());

	$db->close();

	echo $res?$res:"FALSE";
?>