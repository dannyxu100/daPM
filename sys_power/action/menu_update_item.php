<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("da_powersys");
	
	$sql = "update p_menu set ";
	
	if( isset($_POST["pmname"]) )
	{
		$sql .= " pm_name=:pmname ";
		$db->param(":pmname", $_POST["pmname"]);
	}
	if( isset($_POST["pmlevel"]) )
	{
		$sql .= ", pm_level=:pmlevel ";
		$db->param(":pmlevel", $_POST["pmlevel"]);
	}
	if( isset($_POST["pmimg"]) )
	{
		$sql .= ", pm_img=:pmimg ";
		$db->param(":pmimg", $_POST["pmimg"]);
	}
	if( isset($_POST["pmurl"]) )
	{
		$sql .= ", pm_url=:pmurl ";
		$db->param(":pmurl", $_POST["pmurl"]);
	}
	if( isset($_POST["pmsort"]) )
	{
		$sql .= ", pm_sort=:pmsort ";
		$db->param(":pmsort", $_POST["pmsort"]);
	}
	if( isset($_POST["pmremark"]) )
	{
		$sql .= ", pm_remark=:pmremark ";
		$db->param(":pmremark", $_POST["pmremark"]);
	}
	
	$sql .= " where pm_id=:pmid";
	$db->param(":pmid", $_POST["pmid"]);
	
	$res = $db->update($sql);
	// print_r($param);
	// print_r($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>