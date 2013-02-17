<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB(1);
	if(0<count($arr) && isset($_POST["prid"])){
		$db->Query("START TRANSACTION");
		
		for($i=0; $i<count($arr)-1; $i++){
			$db->Query("delete from p_user2role where u2r_puid=".$arr[$i]." and u2r_prid=".$_POST["prid"].";");
			// $log->write("delete from p_user2role where u2r_puid=".$arr[$i]." and u2r_prid=".$_POST["prid"].";");
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