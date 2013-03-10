<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	//error_reporting(-1);

	$db = new DB(1);
	$res = $db->Query( "delete from p_org where po_id=".$_POST["oid"] );
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	echo $res?$res:"FALSE";
?>