<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	//include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_role ";
	if(isset($_POST["prid"])){
		$sql .= " where pr_id=:prid ";
		$db->param(":prid", $_POST["prid"] );
	}
	else if(isset($_POST["prpid"])){
		$sql .= " where pr_pid =:prpid ";
		$db->param(":prpid", $_POST["prpid"] );
	}
	$sql .= " order by pr_sort asc, pr_pid asc";
	
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