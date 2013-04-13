<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$puid = fn_getcookie("puid");
	
	$db = new DB("da_common");
	
	$sql = "select * from comm_notetype where nt_puid=:puid";
	
	$db->param(":puid", $puid);
	$set = $db->getlist($sql);
	
	$db->close();
	
	// $log->write(var_export($set,true));
	if( is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>