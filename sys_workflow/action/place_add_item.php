<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "insert into w_place(p_name, p_wfid, p_type, p_sort,p_remark) values(";
	$sql .= "'".$_POST["p_name"]."',";
	$sql .= "'".$_POST["p_wfid"]."',";
	$sql .= "50,";							//过程库所类型
	$sql .= "'".$_POST["p_remark"]."',";
	$sql .= "'".$_POST["p_sort"]."')";
	
	
	$db = new DB("da_workflow");
	$res = $db->insert($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>