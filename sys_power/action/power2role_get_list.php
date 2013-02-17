<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "";
	$sql = "select * from p_power2role ";
	if(isset($_POST["prid"])){
		$sql .= " where p2r_prid = '".$_POST["prid"]."' ";
	}
	else if(isset($_POST["ppid"])){
		$sql .= " where p2r_ppid = '".$_POST["ppid"]."' ";
	}
	$sql .= " order by p2r_ppid asc, p2r_id asc";
	
	$db = new DB(1);
	$set = $db->GetAll($sql);
	//echo $db->error_message;
	$db->Destroy();
	
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