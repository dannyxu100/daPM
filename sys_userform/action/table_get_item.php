<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_userform");
	$sql = "select 	
	TABLE_SCHEMA as dbname, 
	TABLE_NAME as tbname, 
	TABLE_ROWS as tbrows,
	DATA_LENGTH as tbsize,
	CREATE_TIME as tbdate,
	TABLE_COLLATION as tbcodetype,
	TABLE_COMMENT as tbremark 
	from information_schema.tables 
	where TABLE_NAME='".$_POST["tbname"]."'";

	$set = $db->getone($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		foreach ( $set as $key => $value ) {
			$set[$key] = urlencode( $value );   
		}
			
		echo urldecode(json_encode($set));
	}
	else{
		echo "FALSE";
	}
?>