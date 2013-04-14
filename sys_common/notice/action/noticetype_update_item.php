<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_common");
	
	$sql = "update comm_noticetype set ";
	
	if( isset($_POST["ntname"]) )
	{
		$sql .= " nt_name=:ntname ";
		$db->param(":ntname", $_POST["ntname"]);
	}
	if( isset($_POST["ntcode"]) )
	{
		$sql .= ", nt_code=:ntcode ";
		$db->param(":ntcode", $_POST["ntcode"]);
	}
	if( isset($_POST["ntsort"]) )
	{
		$sql .= ", nt_sort=:ntsort ";
		$db->param(":ntsort", $_POST["ntsort"]);
	}
	if( isset($_POST["ntremark"]) )
	{
		$sql .= ", nt_remark=:ntremark ";
		$db->param(":ntremark", $_POST["ntremark"]);
	}
	
	$sql .= " where nt_id=:ntid";
	$db->param(":ntid", $_POST["ntid"]);
	
	$res = $db->update($sql);
	// Log::out($db->geterror());

	$db->close();

	echo $res?$res:"FALSE";
?>