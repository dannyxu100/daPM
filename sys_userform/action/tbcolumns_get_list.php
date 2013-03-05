<?php
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_userform");
	$sql = "select * from information_schema.COLUMNS ";
	
	if(isset($_POST["tbname"])){
		$sql .= " where TABLE_NAME=:tbname ";
		$db->param(":tbname", $_POST["tbname"]);
	}
	$sql .= " order by ORDINAL_POSITION asc, COLUMN_NAME asc";
	
	// $log = new Log();
	// $log->write($sql);
	
	$set = $db->getlist($sql);
	
	// $log->write($db->geterror());
	$db->close();
	
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