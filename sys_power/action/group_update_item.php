<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";

	$sql = "update p_group set ";
	if( isset($_POST["pgname"]) )
	{
		$sql .= " pg_name='".$_POST["pgname"]."' ";
	}
	if( isset($_POST["pgdate"]) )
	{
		$sql .= ", pg_date='".$_POST["pgdate"]."' ";
	}
	if( isset($_POST["pgsort"]) )
	{
		$sql .= ", pg_sort='".$_POST["pgsort"]."' ";
	}
	if( isset($_POST["pgremark"]) )
	{
		$sql .= ", pg_remark='".$_POST["pgremark"]."' ";
	}
	$sql .= " where pg_id=".$_POST["pgid"];
	
	$db = new DB("da_powersys");
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>