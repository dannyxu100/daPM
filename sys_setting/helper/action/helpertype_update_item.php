<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("da_setting");
	
	$sql = "update s_helpertype set ";
	
	if( isset($_POST["htname"]) )
	{
		$sql .= " ht_name=:htname ";
		$db->param(":htname", $_POST["htname"]);
	}
	if( isset($_POST["htsort"]) )
	{
		$sql .= ", ht_sort=:htsort ";
		$db->param(":htsort", $_POST["htsort"]);
	}
	if( isset($_POST["htcode"]) )
	{
		$sql .= ", ht_code=:htcode ";
		$db->param(":htcode", $_POST["htcode"]);
	}
	if( isset($_POST["htremark"]) )
	{
		$sql .= ", ht_remark=:htremark ";
		$db->param(":htremark", $_POST["htremark"]);
	}
	
	$sql .= " where ht_id=:htid";
	$db->param(":htid", $_POST["htid"]);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out($db->geterror());

	$db->close();

	echo $res?$res:"FALSE";
?>