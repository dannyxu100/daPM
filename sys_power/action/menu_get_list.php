<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	$sql = "select * from p_menu,p_menu2role 
	where pm_id=m2r_pmid 
	and m2r_prid in (".fn_getcookie("roleid").")";
	
	if(isset($_POST["pmid"])){
		$sql .= " and pm_id=:pmid ";
		$db->param(":pmid", $_POST["pmid"]);
	}
	else if(isset($_POST["pmpid"])){
		$sql .= " and pm_pid=:pmpid ";
		$db->param(":pmpid", $_POST["pmpid"]);
	}
	else if(isset($_POST["pmlevel"])){
		$sql .= " and pm_level=:pmlevel ";
		$db->param(":pmlevel", $_POST["pmlevel"]);
	}
	$sql .= " group by pm_id order by pm_sort asc, pm_pid asc";
	
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