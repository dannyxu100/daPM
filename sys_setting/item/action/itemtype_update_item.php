<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	//error_reporting(-1);

	$db = new DB("da_setting");
	
	$sql = "update s_itemtype set ";
	
	if( isset($_POST["itname"]) )
	{
		$sql .= " it_name=:itname ";
		$db->param(":itname", $_POST["itname"]);
	}
	if( isset($_POST["itsort"]) )
	{
		$sql .= ", it_sort=:itsort ";
		$db->param(":itsort", $_POST["itsort"]);
	}
	if( isset($_POST["itremark"]) )
	{
		$sql .= ", it_remark=:itremark ";
		$db->param(":itremark", $_POST["itremark"]);
	}
	
	$sql .= " where it_id=:itid";
	$db->param(":itid", $_POST["itid"]);
	
	$res = $db->update($sql);
	// print_r($param);
	// print_r($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>