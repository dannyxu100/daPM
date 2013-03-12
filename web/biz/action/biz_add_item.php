<?php 
	// json_encode($arr);
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$nowdate = date("Y-m-d H:i:s");
	$wfid = $_POST["wfid"];
	$btid = $_POST["btid"];
	$dbsource = $_POST["dbsource"];
	
	
	$db = new DB("da_userform");
	$db->tran();		//��������

	/************************** ���������� ʵ�� ***************************************/
	$sql_wfc = "insert into da_workflow.w_workflowcase( wfc_wfid, wfc_status, wfc_startdate, wfc_context ) 
	value( :wfid, :status, :date, :context )";
	
	$param_wfc = array();
	array_push($param_wfc, array(":wfid", $wfid));
	array_push($param_wfc, array(":wfid", $wfid));
	array_push($param_wfc, array(":status", "OP"));			//������ʵ����ǰ״̬��OP�����ţ�CL���رգ�SU������CA��ȡ����
	array_push($param_wfc, array(":date", $nowdate));
	array_push($param_wfc, array(":context", ""));
	$db->paramlist($param_wfc);
	$db->insert($sql_wfc);
	
	$wfcase = $db->getone("select @@IDENTITY as wfc_id");		//��ȡ����ӵĹ�����ʵ��id
	$place = $db->getone("select p_id from da_workflow.w_place 
	where p_type=1 and p_wfid=".$wfid."");			//��ȡ��������ʼ����id���������ͣ�1����ʼ������50���м������999����������
	
	
	/************************** �ڹ�����"��ʼ����"����һ������ ***************************************/
	$sql_token = "insert into da_workflow.w_token( t_wfid, t_wfcid, t_pid, t_status, t_createdate, t_context ) 
	value( :wfid, :wfcid, :pid, :status, :createdate, :context )";
	
	$param_token = array();
	array_push($param_token, array(":wfid", $wfid));
	array_push($param_token, array(":wfcid", $wfcase["wfc_id"]));
	array_push($param_token, array(":pid", $place["p_id"]));
	array_push($param_token, array(":status", "FREE"));			//����״̬��FREE�����ɣ�LOCK��������CONS�����ģ�CANS��ȡ��
	array_push($param_token, array(":createdate", $nowdate));
	array_push($param_token, array(":context", ""));
	$db->paramlist($param_token);
	$db->insert($sql_token);
	
	/************************** ������һ�������Ǩ(������)  ʵ��***************************************/
	$sql_tc = "insert into da_workflow.w_trancase( tc_wfid, tc_tid, tc_wfcid, tc_type, tc_limit, 
	tc_firetaskid, tc_context, tc_status, tc_enabledate, tc_userid ) 
	
	select t_wfid, t_id, :wfcid, t_type, t_limit, 
	t_firetaskid, :context, :status, :enabledate, :userid 
	
	from da_workflow.w_transition, da_workflow.w_arc 
	where t_wfid=:wfid and t_id=a_tid and a_direction='IN' and a_pid=:pid";		//ͨ��IN�򻡣��ҳ���ʼ������һ���������Ǩ(������)
	
	$param_tc = array();
	array_push($param_tc, array(":wfid", $wfid));
	array_push($param_tc, array(":wfcid", $wfcase["wfc_id"]));
	array_push($param_tc, array(":pid", $place["p_id"]));
	array_push($param_tc, array(":status", "EN"));					//�����Ǩ(������)״̬��EN�����ã�IP�������У�CA��ȡ���� FI�����
	array_push($param_tc, array(":enabledate", $nowdate));
	array_push($param_tc, array(":context", ""));
	array_push($param_tc, array(":userid", ""));
	$db->paramlist($param_tc);
	$db->insert($sql_tc);
	
	/************************** ����������Դ ��¼ ***************************************/
	$flds = array();
	$flds2 = array();
	$param_db = array();
	
	foreach($_POST as $key=>$value){
		switch( $key ){
			case "dataType":
			case "wfid":
			case "btid":
			case "dbsource":
				continue;
				
			default:
				array_push( $flds, $key );
				array_push( $flds2, ":".$key );
				
				array_push($param_db, array(":".$key, $value));
		}
		
	}
	$sql_db = "insert into ".$dbsource."(".implode(", ", $flds).") values(".implode(", ", $flds2).")";
	
	$db->paramlist($param_db);
	$res = $db->insert($sql_db);
	
	$dbitem = $db->getone("select @@IDENTITY as dbsourceid");		//��ȡ����ӵı�����Դ ��¼id
	
	/************************** ������ģ�� ʵ�� ***************************************/
	$sql_bc = "insert into da_bizform.b_bizcase( bc_btid, bc_wfcid, bc_dbsourceid ) 
	value(:btid, :wfcid, :dbsourceid)";
	
	$param_bc = array();
	array_push($param_bc, array(":btid", $btid));					//��ģ��id
	array_push($param_bc, array(":wfcid", $wfcase["wfc_id"]));		//��������Ӧ������ʵ��id(����ǹ��̱����Ͷ�Ӧ�����Ǩʵ��id)
	array_push($param_bc, array(":dbsourceid", $dbitem["dbsourceid"]));		//����Դ��¼id
	
	$db->paramlist($param_bc);
	$res = $db->insert($sql_bc);
	
	// $log = new Log();
	// $log->write($sql);
	
	if($db->geterror()){
		$db->back();
		$db->close();
		echo 'FALSE';
	}
	else{
		$db->commit();
		$db->close();
		echo $res;
	}

?>