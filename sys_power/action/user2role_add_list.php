<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	if(0<count($arr) && isset($_POST["prid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			if( 0 >= $db->getcount("select * from p_user2role where u2r_puid=".$arr[$i]." and u2r_prid=".$_POST["prid"])){
				$res = $db->insert("insert into p_user2role(u2r_puid, u2r_prid) values(".$arr[$i].",".$_POST["prid"].");");
			}
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