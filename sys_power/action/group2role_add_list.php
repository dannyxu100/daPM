<?php 
	// json_encode($arr);
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["gids"]);
	
	// $log = new Log();
	$db = new DB(1);
	if(0<count($arr) && isset($_POST["prid"])){
		$db->Query("START TRANSACTION");
		
		$rows = 0;
		for($i=0; $i<count($arr)-1; $i++){
			if( 0 >= $db->GetNum("select * from p_group2role where g2r_pgid=".$arr[$i]." and g2r_prid=".$_POST["prid"])){
				$res = $db->Query("insert into p_group2role(g2r_pgid, g2r_prid) values(".$arr[$i].",".$_POST["prid"].");");
				$rows++;
				// $log->write("insert into p_user2role(u2r_puid, u2r_prid) values(".$arr[$i].",".$_POST["prid"].");");
			}
		}
		
		if($db->GetError()){
			$db->Query('ROLLBACK');
			echo 'FALSE';
		}
		else{
			// $rows = $db->GetAffectRows();
			$db->Query('COMMIT');
			echo $rows;
		}
	}
	else{
		echo 'FALSE';
	}
	
	echo $db->error_message;
	$db->Destroy();
?>