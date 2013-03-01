<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from b_businessform ";
	if(isset($_POST["bfid"])){
		$sql .= " where bf_id = '".$_POST["bfid"]."' ";
	}
	else if(isset($_POST["bftid"])){
		$sql .= " where bf_bftid = '".$_POST["bftid"]."' ";
	}
	$sql .= " order by bf_sort asc, bf_id asc";
	
	$db = new DB("da_bizform");
	$set = $db->getlist($sql);
	//echo $db->error_message;
	$db->close();
	
	// $log = new Log();
	// $log->write($sql.time());
	
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