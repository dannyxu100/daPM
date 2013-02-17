<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	//error_reporting(-1);

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
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>