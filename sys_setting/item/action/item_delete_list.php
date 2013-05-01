<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$arr = preg_split("/,/", $_POST["iids"]);
	
	$db = new DB("da_setting");
	if(0<count($arr) && isset($_POST["itid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			$db->delete("delete from s_item where i_id=".$arr[$i]." and i_itid=".$_POST["itid"].";");
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