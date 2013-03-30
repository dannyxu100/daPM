<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
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
	
	$db = new DB("da_powersys");
	$res = $db->update($sql);
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>