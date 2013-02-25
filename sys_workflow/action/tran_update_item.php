<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$sql = "update w_transition set ";
	$param = array();

	if( isset($_POST["tname"]) )
	{
		$sql .= " t_name=:tname ";
		$param = array_merge($param, array(":tname"=>$_POST["tname"]));
	}
	if( isset($_POST["twfid"]) )
	{
		$sql .= ", t_wfid=:twfid ";
		$param = array_merge($param, array(":twfid"=>$_POST["twfid"]));
	}
	if( isset($_POST["tsort"]) )
	{
		$sql .= ", t_sort=:tsort ";
		$param = array_merge($param, array(":tsort"=>$_POST["tsort"]));
	}
	if( isset($_POST["ttype"]) )
	{
		$sql .= ", ttype=:ttype ";
		$param = array_merge($param, array(":ttype"=>$_POST["ttype"]));
	}
	if( isset($_POST["tlimit"]) )
	{
		$sql .= ", t_limit=:tlimit ";
		$param = array_merge($param, array(":tlimit"=>$_POST["tlimit"]));
	}
	if( isset($_POST["tremark"]) )
	{
		$sql .= ", t_remark=:tremark ";
		$param = array_merge($param, array(":tremark"=>$_POST["tremark"]));
	}
	if( isset($_POST["tfiretaskid"]) )
	{
		$sql .= ", tfiretaskid=:tfiretaskid ";
		$param = array_merge($param, array(":tfiretaskid"=>$_POST["tfiretaskid"]));
	}
	if( isset($_POST["troleid"]) )
	{
		$sql .= ", t_roleid=:troleid ";
		$param = array_merge($param, array(":troleid"=>$_POST["troleid"]));
	}
	if( isset($_POST["trolename"]) )
	{
		$sql .= ", t_rolename=:trolename ";
		$param = array_merge($param, array(":trolename"=>$_POST["trolename"]));
	}
	
	$sql .= " where t_id=:tid";
	$param = array_merge($param, array(":tid"=>$_POST["tid"]));
	
	$db = new DB("da_workflow");
	$res = $db->update($sql, $param);
	// print_r($param);
	print_r($sql);
	// echo $db->geterror();

	$db->close();

	echo $res?$res:"FALSE";
?>