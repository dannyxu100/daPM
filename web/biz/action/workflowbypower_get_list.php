<?php 
	
	include_once "../../../action/sessioncheck.php";
	include_once "../../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	
	$sql = "select distinct(wf_id), w_workflow.* from w_workflow,w_transition,w_tran2role 
	where t_wfid=wf_id 
	and t_id=t2r_tid 
	and t2r_prid in(".$_POST["roleids"].") 
	order by wf_sort asc, wf_id asc";

	$db = new DB("da_workflow");
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	if(is_array($set)){
		for($i=0; $i<count($set); $i++){
			foreach ( $set[$i] as $key => $value ) {
				$set[$i][$key] = urlencode( $value );   
			}
		}
		echo urldecode(json_encode($set));
	}
	else{
		echo "FALSE";
	}
?>