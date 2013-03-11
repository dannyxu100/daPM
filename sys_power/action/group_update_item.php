<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	//error_reporting(-1);

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
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>