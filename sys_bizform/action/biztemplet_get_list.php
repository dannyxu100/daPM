<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from b_biztemplet ";
	if(isset($_POST["btid"])){
		$sql .= " where bt_id = '".$_POST["btid"]."' ";
	}
	else if(isset($_POST["bttid"])){
		$sql .= " where bt_bttid = '".$_POST["bttid"]."' ";
	}
	$sql .= " order by bt_sort asc, bt_id asc";
	
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