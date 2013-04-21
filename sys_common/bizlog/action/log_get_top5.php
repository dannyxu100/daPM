<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	$type = $_POST["type"];
	$num = $_POST["num"];
	
	
	$db = new DB("da_bizform");
	$sql = "select b_bizlog.*, pu_name, pu_icon, b_bizcase.*, ".$dbsource.".* 
	from b_bizlog, da_powersys.p_user, da_bizform.b_bizcase, da_userform.".$dbsource." 
	where l_puid=pu_id ";
	
	if( 1==$type ){
		$sql .= "and l_puid=:puid ";
		$db->param(":puid", fn_getcookie("puid"));
	}
	
	$sql .= "and l_bcid=bc_id 
	and ".$dbfld."=bc_dbsourceid 
	order by l_date desc, l_id desc 
	limit :num, :num5";
	
	$db->param(":num", (int)$num);
	$db->param(":num5", (int)$num + 5);
	$set = $db->getlist($sql);
	// Log::out($sql);
	// Log::out($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>