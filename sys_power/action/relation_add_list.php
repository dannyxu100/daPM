<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$arr = preg_split("/,/", $_POST["uids"]);
	
	$db = new DB("da_powersys");
	if( 0<count($arr) ){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			if( 0 >= $db->getcount("select * from p_relation where pr_poid=".$_POST["poid"]." and pr_leaderid=".$_POST["leaderid"]." and pr_puid=".$arr[$i])){
				$res = $db->insert("insert into p_relation(pr_poid, pr_leaderid, pr_puid) values(".$_POST["poid"].",".$_POST["leaderid"].",".$arr[$i].");");
			}
		}
		
		// $log = new Log();
		// $log->write($db->geterror());
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