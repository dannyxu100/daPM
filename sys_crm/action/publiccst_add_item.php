<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_crm");
	
	$flds = array();
	$flds2 = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "wfid":
			case "btid":
			case "dbsource":
				continue;
				
			default:
				array_push( $flds, $key );
				array_push( $flds2, ":".$key );
				// Log::out(":".$key."----".urldecode($value));
				$db->param(":".$key, urldecode($value));
		}
		
	}
	array_push( $flds, "c_createpuid" );
	array_push( $flds2, ":c_createpuid" );
	$db->param(":c_createpuid", fn_getcookie("puid"));
	array_push( $flds, "c_createpuname" );
	array_push( $flds2, ":c_createpuname" );
	$db->param(":c_createpuname", fn_getcookie("puname"));
	array_push( $flds, "c_createdate" );
	array_push( $flds2, ":c_createdate" );
	$db->param(":c_createdate", date("Y-m-d H:i:s"));
	
	$sql = "insert into crm_customer(".implode(", ", $flds).") values(".implode(", ", $flds2).")";
	// Log::out($sql);

	$res = $db->insert($sql);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>