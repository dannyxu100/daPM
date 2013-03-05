<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$db = new DB("da_bizform");
	$sql = "select * from b_biztemplet where bf_id=:bf_id ";
	// $log = new Log();
	// $log->write($sql);
	
	$db->param(":bf_id", $_POST["bf_id"]);
	$set = $db->getlist($sql);
	
	$db->close();
	
	if(is_array($set)){
		for($i=0; $i<count($set); $i++){
			foreach ( $set[$i] as $key => $value ) {
				$set[$i][$key] = urlencode( $value );   
			}
		}
		echo urldecode(json_encode($set));
	}
	else{
		echo "FALSE";
	}
	
?>