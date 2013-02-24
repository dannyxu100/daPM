<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	//error_reporting(-1);

	$db = new DB("da_powersys");
	$res = $db->delete( "delete from p_menu where pm_id=:pmid", array(
		":pmid"=>$_POST["pmid"]
	));
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>