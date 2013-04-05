<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "select * from b_biztemplettype where btt_id=".$_POST["btt_id"];
	
	$db = new DB("da_bizform");
	$set = $db->getone($sql);
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
	
?>