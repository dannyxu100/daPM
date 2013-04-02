<?php 
	// json_encode($arr);
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."//action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."//action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."//action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$nowdate = date("Y-m-d H:i:s");
	$wfid = $_POST["wfid"];
	$btid = $_POST["btid"];
	$dbsource = $_POST["dbsource"];
	
	
	$db = new DB("da_userform");
	
	/************************** 创建表单数据源 记录 ***************************************/
	$flds = array();
	$param_db = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "wfid":
			case "btid":
			case "dbsource":
				continue;
				
			default:
				array_push( $flds, $key."=:".$key );
				
				array_push($param_db, array(":".$key, urldecode($value)));
		}
		
	}
	$sql_db = "update ".$dbsource." set ".implode(", ", $flds)." where ";
	
	$db->paramlist($param_db);
	$res = $db->insert($sql_db);
	
	$dbitem = $db->getone("select @@IDENTITY as dbsourceid");		//获取刚添加的表单数据源 记录id
	
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