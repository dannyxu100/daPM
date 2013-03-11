<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	$sql = "select * from p_menu ";
	// $sql = "select * from p_menu, p_menu2role ";
	
	// $sql .= " where pm_id=m2r_pmid and m2r_prid=:prid ";			//prid为非空参数(加入角色权限过滤)
	// $param = array_merge($param, array(":prid"=>$_POST["prid"]));
	
	if(isset($_POST["pmid"])){
		$sql .= " where pm_id=:pmid ";
		$db->param(":pmid", $_POST["pmid"]);
	}
	else if(isset($_POST["pmpid"])){
		$sql .= " where pm_pid=:pmpid ";
		$db->param(":pmpid", $_POST["pmpid"]);
	}
	else if(isset($_POST["pmlevel"])){
		$sql .= " where pm_level=:pmlevel ";
		$db->param(":pmlevel", $_POST["pmlevel"]);
	}
	$sql .= " order by pm_sort asc, pm_pid asc";
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>