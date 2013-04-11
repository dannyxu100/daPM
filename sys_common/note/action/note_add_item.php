<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	
	$puid = fn_getcookie("puid");
	$puname = fn_getcookie("puname");
	
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
	$db->param(":c_createpuid", $puid);
	array_push( $flds, "c_createpuname" );
	array_push( $flds2, ":c_createpuname" );
	$db->param(":c_createpuname", $puname);
	array_push( $flds, "c_createdate" );
	array_push( $flds2, ":c_createdate" );
	$db->param(":c_createdate", date("Y-m-d H:i:s"));
	
	$sql = "insert into crm_customer(".implode(", ", $flds).") values(".implode(", ", $flds2).")";
	// Log::out($sql);

	$db->tran();		//启动事务
	$res = $db->insert($sql);
	$cst = $db->getone("select @@IDENTITY as c_id");
	// Log::out($db->geterror());
	
	$sql2 = "insert into crm_cst2user(c2u_cid, c2u_puid) values(:cid, :puid)";
	$param2 = array();
	array_push( $param2, array(":cid", $cst["c_id"]) );
	array_push( $param2, array(":puid", $puid) );
	
	$db->paramlist($param2);
	$res = $db->insert($sql2);
	// Log::out($sql2);
	// Log::out($db->geterror());
	
	if($db->geterror()){
		$db->back();
		$db->close();
		echo 'FALSE';
	}
	else{
		$db->commit();
		$db->close();
		echo $res;
	}
?>