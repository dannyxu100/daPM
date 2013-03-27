<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$bcids = $_POST["bcids"];
	
	$db = new DB("da_userform");
	
	/**************** ���ݹ�����ʵ���ҵ�ҵ���ʵ�� *****************/
	$sql = "select * from da_bizform.b_bizcase, da_bizform.b_biztemplet, da_workflow.w_workflowcase  
	where b_bizcase.bc_wfcid=w_workflowcase.wfc_id  
	and b_bizcase.bc_btid=b_biztemplet.bt_id 
	and b_bizcase.bc_id in (".$bcids.")";
	
	$set = $db->getlist($sql);
	
	$db->tran();
	for($i=0; $i<count($set); $i++){
		//ɾ������Դ��¼
		$sql2 = "delete from ".$set[$i]["bt_dbsource"]." where ".$set[$i]["bt_dbfld"]."=:dbsourceid";
		$param = array();
		array_push($param, array(":dbsourceid", $set[$i]["bc_dbsourceid"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ��ҵ����־��¼
		$sql2 = "delete from da_bizform.b_bizlog where l_bcid=:bcid";
		$param = array();
		array_push($param, array(":bcid", $set[$i]["bc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ��ҵ����־�ظ���¼
		$sql2 = "delete from da_bizform.b_bizreply where r_bcid=:bcid";
		$param = array();
		array_push($param, array(":bcid", $set[$i]["bc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ��ҵ��ʵ��
		$sql2 = "delete from da_bizform.b_bizcase where bc_id=:bcid";
		$param = array();
		array_push($param, array(":bcid", $set[$i]["bc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ�����������Ƽ�¼
		$sql2 = "delete from da_workflow.w_token where t_wfcid=:wfcid";
		$param = array();
		array_push($param, array(":wfcid", $set[$i]["wfc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ�������Ǩʵ����¼
		$sql2 = "delete from da_workflow.w_trancase where tc_wfcid=:wfcid";
		$param = array();
		array_push($param, array(":wfcid", $set[$i]["wfc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
		
		//ɾ��������ʵ��
		$sql2 = "delete from da_workflow.w_workflowcase where wfc_id=:wfcid";
		$param = array();
		array_push($param, array(":wfcid", $set[$i]["wfc_id"]));
		$db->paramlist($param);
		$res = $db->delete($sql2);
	}
	// Log::out($db->geterror());
	if($db->geterror()){
		$db->back();
		echo 'FALSE';
	}
	else{
		// $db->back();
		$db->commit();
		echo $res;
	}

	$db->close();
?>