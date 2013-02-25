<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	$res = $db->delete("delete from p_menu2role where m2r_prid=:prid and m2r_pmid=:pmid", array(
		":prid"=> $_POST["prid"],
		":pmid"=> $_POST["pmid"]
	));
		
	$db->close();
	
	echo $res?$res:"FALSE";
?>