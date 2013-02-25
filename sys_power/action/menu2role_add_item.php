<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	$res = $db->insert("insert into p_menu2role(m2r_prid, m2r_pmid) values(:prid, :pmid)", array(
		":prid"=> $_POST["prid"],
		":pmid"=> $_POST["pmid"]
	));
	// $log->write("insert into p_power2role(p2r_prid, p2r_ppid, p2r_ptid) values(".$_POST["prid"].",".$_POST["ppid"].",'".$_POST["ptid"]."');");
	
	$db->close();
	//echo $db->error_message;
	
	echo $res?$res:"FALSE";
?>