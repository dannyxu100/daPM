<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_workflowtype ";
	if(isset($_POST["wftid"])){
		$sql .= " where wft_id=:wftid ";
		$db->param(":wftid", $_POST["wftid"]);
	}
	else if(isset($_POST["wftpid"])){
		$sql .= " where wft_pid=:wftpid ";
		$db->param(":wftpid", $_POST["wftpid"]);
	}
	$sql .= " order by wft_sort asc, wft_pid asc";
	
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