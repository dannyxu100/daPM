<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	// error_reporting(-1);

	$arr_id = preg_split("/,/", $_POST["rids"]);
	// $arr_name = preg_split("/,/", $_POST["rnames"]);
	$wfid = $_POST["wfid"];
	$type = $_POST["type"];
	
	$db = new DB("da_workflow");

	if(0<count($arr_id) && $wfid && $type ){
		$db->tran();
		
		$db->param(":wfid", $wfid);
		$db->param(":type", $type);
		$db->delete("delete from w_workflow2role 
		where wf2r_wfid=:wfid 
		and wf2r_type=:type");
		
		for($i=0; $i<count($arr_id); $i++){
			if( "" == $arr_id[$i]) continue;
			
			$db->param(":prid", $arr_id[$i]);
			$res = $db->insert("insert into w_workflow2role(wf2r_type, wf2r_prid, wf2r_wfid) 
			values(:type, :prid, :wfid)");
		}
		
		// $log = new Log();
		// $log->write($db->geterror());
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo count($arr_id);
		}
	}
	else{
		echo 'FALSE';
	}
	$db->close();
?>