<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$arr = preg_split("/,/", $_POST["hids"]);
	
	$log = new Log();
	$db = new DB("da_setting");
	if(0<count($arr) && isset($_POST["htid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			$db->delete("delete from s_helper where h_id=".$arr[$i]." and h_htid=".$_POST["htid"].";");
		}
		$log->write($arr[$i]);
		$log->write($_POST["htid"]);
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo count($arr)-1;
		}
	}
	else{
		echo 'FALSE';
	}
?>