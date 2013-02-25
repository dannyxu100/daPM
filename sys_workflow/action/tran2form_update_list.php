<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	include_once "../../action/sys/log.php";
	// error_reporting(-1);

	$arr_id = preg_split("/,/", $_POST["bfids"]);
	
	// $log = new Log();
	$db = new DB("da_workflow");
	if(0<count($arr_id) && isset($_POST["tid"])){
		$db->tran();
		
		$db->delete("delete from w_tran2form where t2f_tid=:tid",array(":tid"=>$_POST["tid"]));
		
		$rows = 0;
		for($i=0; $i<count($arr_id)-1; $i++){		//","分隔引起最后多一个空数据,所以-1
			$res = $db->insert("insert into w_tran2form(t2f_bfid, t2f_tid) values(:bfid, :tid)", array(
				":bfid"=>$arr_id[$i],
				":tid"=>$_POST["tid"]
			));
			$rows++;
		}
		$db->update("update w_transition set t_formname=:formname where t_id=:tid", array(
			":formname"=>$_POST["bfnames"],
			":tid"=>$_POST["tid"]
		));
		
		if($db->geterror()){
			$db->back();
			echo 'FALSE'.$db->geterror();
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