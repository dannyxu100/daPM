<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	//error_reporting(-1);

	$sql = "update p_org set ";
	if( isset($_POST["poname"]) )
	{
		$sql .= " po_name='".$_POST["poname"]."' ";
	}
	if( isset($_POST["podate"]) )
	{
		$sql .= ", po_date='".$_POST["podate"]."' ";
	}
	if( isset($_POST["posort"]) )
	{
		$sql .= ", po_sort='".$_POST["posort"]."' ";
	}
	if( isset($_POST["poremark"]) )
	{
		$sql .= ", po_remark='".$_POST["poremark"]."' ";
	}
	$sql .= " where po_id=".$_POST["poid"];
	
	$db = new DB(1);
	$res = $db->Query($sql);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>