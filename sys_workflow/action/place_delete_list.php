<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$arr = preg_split("/,/", $_POST["pids"]);
	
	$db = new DB("da_workflow");
	if(0<count($arr) && isset($_POST["wfid"])){
		$db->tran();
		
		for($i=0; $i<count($arr); $i++){
			$db->delete("delete from w_place where p_id=".$arr[$i]." and p_wfid=".$_POST["wfid"].";");
		}
		
		// Log::out($db->geterror());
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo count($arr);
		}
	}
	else{
		echo 'FALSE';
	}
?>