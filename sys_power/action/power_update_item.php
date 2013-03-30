<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//error_reporting(-1);

	$sql = "update p_power set ";
	if( isset($_POST["ppname"]) )
	{
		$sql .= " pp_name='".$_POST["ppname"]."' ";
	}
	if( isset($_POST["ppcode"]) )
	{
		$sql .= ", pp_code='".$_POST["ppcode"]."' ";
	}
	if( isset($_POST["ppdate"]) )
	{
		$sql .= ", pp_date='".$_POST["ppdate"]."' ";
	}
	if( isset($_POST["ppsort"]) )
	{
		$sql .= ", pp_sort='".$_POST["ppsort"]."' ";
	}
	if( isset($_POST["ppremark"]) )
	{
		$sql .= ", pp_remark='".$_POST["ppremark"]."' ";
	}
	$sql .= " where pp_id=".$_POST["ppid"];
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>