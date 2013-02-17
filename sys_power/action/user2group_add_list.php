<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB(1);
	if(0<count($arr) && isset($_POST["pgid"])){
		$db->Query("START TRANSACTION");
		
		$rows = 0;
		for($i=0; $i<count($arr)-1; $i++){
			if( 0 >= $db->GetNum("select * from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"])){
				$res = $db->Query("insert into p_user2group(u2g_puid, u2g_pgid) values(".$arr[$i].",".$_POST["pgid"].");");
				$rows++;
				// $log->write("insert into p_user2group(u2g_puid, u2g_pgid) values(".$arr[$i].",".$_POST["pgid"].");");
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