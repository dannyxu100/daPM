<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["gids"]);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	if(0<count($arr) && isset($_POST["prid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			$db->delete("delete from p_group2role where g2r_pgid=".$arr[$i]." and g2r_prid=".$_POST["prid"].";");
			// $log->write("delete from p_group2role where g2r_pgid=".$arr[$i]." and g2r_prid=".$_POST["prid"].";");
		}
		
		if($db->geterror()){
			$db->back();
			$db->close();
			echo 'FALSE';
		}
		else{
			$db->commit();
			$db->close();
			echo count($arr);
		}
	}
	else{
		echo 'FALSE';
	}
?>