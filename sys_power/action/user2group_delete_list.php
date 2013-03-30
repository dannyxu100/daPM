<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	if(0<count($arr) && isset($_POST["pgid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			$db->delete("delete from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"].";");
			// $log->write("delete from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"].";");
		}
		
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