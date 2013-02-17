<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "";
	$sql = "select * from w_workflowtype ";
	if(isset($_POST["wftid"])){
		$sql .= " where wft_id = '".$_POST["wftid"]."' ";
	}
	else if(isset($_POST["wftpid"])){
		$sql .= " where wft_pid = '".$_POST["wftpid"]."' ";
	}
	$sql .= " order by wft_sort asc, wft_pid asc";
	
	$db = new DB(2);
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