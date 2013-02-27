<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	
	$db = new DB("da_workflow");
	$sql = "select * from w_workflow where wf_id=:wf_id";
	$db->param(":wf_id", $_POST["wf_id"]);
	// $log = new Log();
	// $log->write($sql);
	$set = $db->getlist($sql);

	$db->close();
	//print_r($set);
	
	if(is_array($set)){
		for($i=0; $i<count($set); $i++){
			foreach ( $set[$i] as $key => $value ) {
				$set[$i][$key] = urlencode( $value );   
			}

		}
	}
	
	// $log->write($res);
	echo urldecode(json_encode($set));
?>