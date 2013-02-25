<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from p_menu2role ";
	$param = array();
	
	if(isset($_POST["prid"])){
		$sql .= " where m2r_prid =:prid ";
		$param = array_merge($param, array(":prid"=>$_POST["prid"]));
	}
	$sql .= " order by m2r_pmid asc, m2r_id asc";
	
	$db = new DB("da_powersys");
	$set = $db->getlist($sql, $param);
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