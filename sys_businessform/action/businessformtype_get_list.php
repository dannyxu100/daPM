<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "";
	$sql = "select * from b_businessformtype ";
	if(isset($_POST["bftid"])){
		$sql .= " where bft_id = '".$_POST["bftid"]."' ";
	}
	else if(isset($_POST["bftpid"])){
		$sql .= " where bft_pid = '".$_POST["bftpid"]."' ";
	}
	$sql .= " order by bft_sort asc, bft_pid asc";
	
	$db = new DB(3);
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