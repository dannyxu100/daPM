<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	//include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_org ";
	if(isset($_POST["poid"])){
		$sql .= " where po_id=:poid ";
		$db->param(":poid", $_POST["poid"]);
	}
	else if(isset($_POST["popid"])){
		$sql .= " where po_pid=:popid ";
		$db->param(":popid", $_POST["popid"]);
	}
	$sql .= " order by po_sort asc, po_pid asc";
	
	$set = $db->getlist($sql);
	
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