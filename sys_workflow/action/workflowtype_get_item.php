<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$db = new DB("da_workflow");
	$sql = "select * from w_workflowtype where wft_id=:wftid";
	$db->param(":wftid", $_POST["wft_id"]);
	// $log = new Log();
	// $log->write($sql);
	
	$set = $db->getlist($sql);
	//echo $db->error_message;
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