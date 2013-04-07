<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$db = new DB("da_setting");
	
	$arr_name = preg_split("/\|/", $_POST["names"]);
	$arr_url = preg_split("/\|/", $_POST["urls"]);
	$puid = fn_getcookie("puid");
	$puname = fn_getcookie("puname");
	

	if(0<count($arr_name) && 0<count($arr_url) && count($arr_name)==count($arr_url) 
	&& $_POST["type"] && $_POST["code"]){
	
		for($i=0; $i<count($arr_name); $i++){		//","分隔引起最后多一个空数据,所以-1
			$param = array();
			array_push($param, array(":name", $arr_name[$i]));
			array_push($param, array(":url", $arr_url[$i]));
			array_push($param, array(":puid", $puid));
			array_push($param, array(":type", $_POST["type"]));
			array_push($param, array(":code", $_POST["code"]));
			array_push($param, array(":puid", $puid));
			array_push($param, array(":puname", $puname));
			array_push($param, array(":date", date("Y-m-d H:i:s")));
			
			$db->paramlist($param);
			$res = $db->insert("insert into s_attachment(a_type, a_code, a_name, a_url, a_puid, a_puname, a_date) 
			values(:type, :code, :name, :url, :puid, :puname, :date)");
			
			// Log::out($db->geterror());
		}
		
		echo $res?$res:"FALSE";
	}
	else{
		echo "FALSE";
	}
	$db->close();

?>