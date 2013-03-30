<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";

	$sql = "update p_role set ";
	if( isset($_POST["prname"]) )
	{
		$sql .= " pr_name='".$_POST["prname"]."' ";
	}
	if( isset($_POST["prdate"]) )
	{
		$sql .= ", pr_date='".$_POST["prdate"]."' ";
	}
	if( isset($_POST["prsort"]) )
	{
		$sql .= ", pr_sort='".$_POST["prsort"]."' ";
	}
	if( isset($_POST["prremark"]) )
	{
		$sql .= ", pr_remark='".$_POST["prremark"]."' ";
	}
	$sql .= " where pr_id=".$_POST["prid"];
	
	$db = new DB("da_powersys");
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>