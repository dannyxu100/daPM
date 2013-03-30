<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_power ";
	if(isset($_POST["ppid"])){
		$sql .= " where pp_id =:ppid ";
		$db->param(":ppid", $_POST["ppid"]);
	}
	else if(isset($_POST["pppid"])){
		$sql .= " where pp_pid =:pppid ";
		$db->param(":ppid", $_POST["pppid"]);
	}
	$sql .= " order by pp_sort asc, pp_pid asc";
	
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