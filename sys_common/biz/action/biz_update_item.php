<?php 
	// json_encode($arr);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	// $nowdate = date("Y-m-d H:i:s");
	// $wfid = $_POST["wfid"];
	// $btid = $_POST["btid"];
	
	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	$dbfldid = $_POST["dbfldid"];
	
	
	$db = new DB("da_userform");
	
	$flds = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "wfid":
			case "btid":
			case "dbsource":
			case "dbfld":
			case "dbfldid":
				continue;
				
			default:
				array_push( $flds, $key."=:".$key );
				
				$db->param( ":".$key, urldecode($value) );
		}
		
	}
	$sql_db = "update ".$dbsource." set ".implode(", ", $flds)." where ".$dbfld."=:id";
	$db->param( ":id", $dbfldid );
	$res = $db->update($sql_db);
	// Log::out($db->geterror());
	
	echo $res?$res:"FALSE";
?>