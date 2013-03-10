<?php 
	// error_reporting(-1);
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$sql = "select * from b_biztemplettype where btt_id=".$_POST["btt_id"];
	// $log = new Log();
	// $log->write($sql);
	
	$db = new DB(3);
	$set = $db->GetAll($sql);
	//echo $db->error_message;
	$db->Destroy();
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