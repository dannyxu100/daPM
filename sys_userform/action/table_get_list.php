﻿<?php
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_userform");
	$sql = "select 
	TABLE_SCHEMA as dbname,
	TABLE_NAME as tbname, 
	TABLE_COMMENT as tbremark 	
	from information_schema.tables ";
	
	if(isset($_POST["dbnames"])){
		$sql .= " where table_schema in ".$_POST["dbnames"];
	}
	$set = $db->getlist($sql);
	// $log = new Log();
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