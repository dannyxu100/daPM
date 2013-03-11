<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB(1);
	if(0<count($arr) && isset($_POST["pgid"])){
		$db->Query("START TRANSACTION");
		
		for($i=0; $i<count($arr)-1; $i++){
			$db->Query("delete from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"].";");
			// $log->write("delete from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"].";");
		}
		
		if($db->GetError()){
			$db->Query('ROLLBACK');
			echo 'FALSE';
		}
		else{
			$db->Query('COMMIT');
			echo count($arr)-1;
		}
	}
	else{
		echo 'FALSE';
	}
?>