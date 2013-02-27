<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$arr_id = preg_split("/,/", $_POST["bfids"]);
	
	$db = new DB("da_workflow");
	if(0<count($arr_id) && isset($_POST["tid"])){
		$db->tran();
		
		$db->param(":tid", $_POST["tid"]);
		$db->delete("delete from w_tran2form where t2f_tid=:tid");
		
		$rows = 0;
		for($i=0; $i<count($arr_id)-1; $i++){		//","分隔引起最后多一个空数据,所以-1
			$param1 = array();
			array_push($param1, array(":bfid", $arr_id[$i]));
			array_push($param1, array(":tid", $_POST["tid"]));
			$db->paramlist($param1);
			$res = $db->insert("insert into w_tran2form(t2f_bfid, t2f_tid) values(:bfid, :tid)");
			$rows++;
		}
		
		$param2 = array();
		array_push($param2, array(":formname", $_POST["bfnames"]));
		array_push($param2, array(":tid", $_POST["tid"]));
		$db->paramlist($param2);
		$db->update("update w_transition set t_formname=:formname where t_id=:tid");
		
		// $log = new Log();
		// $log->write($db->geterror());
		if($db->geterror()){
			$db->back();
			echo 'FALSE';
		}
		else{
			$db->commit();
			echo $rows;
		}
	}
	else{
		echo 'FALSE';
	}
	
	$db->close();
?>