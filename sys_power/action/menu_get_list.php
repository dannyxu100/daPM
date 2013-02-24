<?php 
	
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from p_menu ";
	$param = array();
	
	if(isset($_POST["pmid"])){
		$sql .= " where pm_id=:pmid ";
		$param = array_merge($param, array(":pmid"=>$_POST["pmid"]));
	}
	else if(isset($_POST["pmpid"])){
		$sql .= " where pm_pid=:pmpid ";
		$param = array_merge($param, array(":pmpid"=>$_POST["pmpid"]));
	}
	else if(isset($_POST["pmlevel"])){
		$sql .= " where pm_level=:pmlevel ";
		$param = array_merge($param, array(":pmlevel"=>$_POST["pmlevel"]));
	}
	$sql .= " order by pm_sort asc, pm_pid asc";
	
	$db = new DB("da_powersys");
	$set = $db->getlist($sql, $param);
	// echo $db->geterror();
	$db->close();

	// $log = new Log();
	// $log->write($param.time());
	
	if(is_array($set) && 0<count($set)){
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