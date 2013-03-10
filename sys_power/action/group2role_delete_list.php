<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["gids"]);
	
	// $log = new Log();
	$db = new DB(1);
	if(0<count($arr) && isset($_POST["prid"])){
		$db->Query("START TRANSACTION");
		
		for($i=0; $i<count($arr)-1; $i++){
			$db->Query("delete from p_group2role where g2r_pgid=".$arr[$i]." and g2r_prid=".$_POST["prid"].";");
			// $log->write("delete from p_group2role where g2r_pgid=".$arr[$i]." and g2r_prid=".$_POST["prid"].";");
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