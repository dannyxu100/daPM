<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	//error_reporting(-1);

	$sql = "update p_menu set ";
	$param = array();
	
	if( isset($_POST["pmname"]) )
	{
		$sql .= " pm_name=:pmname ";
		$param = array_merge($param, array(":pmname"=>$_POST["pmname"]));
	}
	if( isset($_POST["pmlevel"]) )
	{
		$sql .= ", pm_level=:pmlevel ";
		$param = array_merge($param, array(":pmlevel"=>$_POST["pmlevel"]));
	}
	if( isset($_POST["pmimg"]) )
	{
		$sql .= ", pm_img=:pmimg ";
		$param = array_merge($param, array(":pmimg"=>$_POST["pmimg"]));
	}
	if( isset($_POST["pmurl"]) )
	{
		$sql .= ", pm_url=:pmurl ";
		$param = array_merge($param, array(":pmurl"=>$_POST["pmurl"]));
	}
	if( isset($_POST["pmsort"]) )
	{
		$sql .= ", pm_sort=:pmsort ";
		$param = array_merge($param, array(":pmsort"=>$_POST["pmsort"]));
	}
	if( isset($_POST["pmremark"]) )
	{
		$sql .= ", pm_remark=:pmremark ";
		$param = array_merge($param, array(":pmremark"=>$_POST["pmremark"]));
	}
	
	$sql .= " where pm_id=:pmid";
	$param = array_merge($param, array(":pmid"=>$_POST["pmid"]));
	
	$db = new DB(1);
	$res = $db->update($sql, $param);
	// print_r($param);
	// print_r($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>