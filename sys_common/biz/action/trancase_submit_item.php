<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$nowdate = date("Y-m-d H:i:s");
	$wfid = $_POST["wfid"];		//������id
	$wfcid = $_POST["wfcid"];	//������ʵ��id
	$aid = $_POST["aid"];		//��ǰ�����Ǩ��OUT��(ָ����һ������)id
	$remark = $_POST["remark"];	//�ύ��ע����
	
	$db = new DB("da_workflow");
	
	/***************** ������id�ҳ����ӵ������Ǩ�������ʵ�� *********************************/
	$sql_tc = "select tc_id from w_arc, w_transition, w_trancase 
	where a_id=:aid 
	and a_tid=t_id 
	and t_id=tc_tid 
	and tc_wfcid=:wfcid 
	and (tc_status='EN' or tc_status='IP') ";	//ͨ��������ʵ��wfcid��С��Χ��
												//�����Ǩ�������״̬��EN�����ã�IP�������У�CA��ȡ���� FI�����
	
	$param_tc = array();
	array_push($param_tc, array(":wfcid", $wfcid));
	array_push($param_tc, array(":aid", $aid));
	
	$db->paramlist($param_tc);
	$set_tc = $db->getone($sql_tc);
	
	// $log = new Log();
	// $log->write($aid);
	// $log->write($wfid);
	// $log->write($wfcid);
	// $log->write($set_tc["tc_id"]);
	
	/***************** ���������Ǩʵ��״̬ ��������� ***********************************************/
	$sql_tc2 = "update w_trancase 
	set tc_status='FI', 
	tc_puid=:puid, 
	tc_puname=:puname, 
	tc_finishdate=:date, 
	tc_remark=:remark 
	where tc_id=:tcid";
	
	$param_tc2 = array();
	array_push($param_tc2, array(":puid", fn_getcookie("puid")));
	array_push($param_tc2, array(":puname", fn_getcookie("puname")));
	array_push($param_tc2, array(":date", $nowdate));
	array_push($param_tc2, array(":remark", $remark));
	array_push($param_tc2, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_tc2);
	$res = $db->update($sql_tc2);
	
	
	////////////////// ���²���Ϊ�����Ǩ �ж��Ƿ��䣨��������ִ�д��� /////////////////////////////
	
	$db->tran();	//��������
	
	/***************** ���ݵ�ǰ�����Ǩ�������ʵ��, �ҳ�ǰ����� *********************************/
	//IN����
	$sql_p = "select p_id from w_place, w_arc, w_trancase 
	where p_id=a_pid 
	and a_tid=tc_tid 
	and a_direction='IN' 
	and tc_id=:tcid";
	
	$param_p = array();
	array_push($param_p, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_p);
	$set_pIN = $db->getlist($sql_p);
	
	$pINids = array();				//IN����id��¼����
	for( $i=0; $i<count($set_pIN); $i++){
		array_push( $pINids, $set_pIN[$i]["p_id"] );
	}
	$pINids = implode(',', $pINids);
	
	//OUT����
	$sql_p2 = "select p_id from w_place, w_arc, w_trancase 
	where p_id=a_pid 
	and a_tid=tc_tid 
	and a_direction='OUT' 
	and tc_id=:tcid";
	
	$param_p2 = array();
	array_push($param_p2, array(":tcid", $set_tc["tc_id"]));
	
	$db->paramlist($param_p2);
	$set_pOUT = $db->getlist($sql_p2);
	
	/********************* ����IN���Ƿ�������(�����ڻ�ǩҵ��) *********************************/
	$sql_t = "select t_id from w_token 
	where t_wfcid=:wfcid 
	and t_id in (".$pINids.")";			//ͨ��������ʵ��wfcid��С��Χ��
	
	$param_t = array();
	array_push($param_t, array(":wfcid", $wfcid));
	
	$db->paramlist($param_t);
	$set_t = $db->getlist($sql_t);
	
	if( count($set_pIN) != count($set_t) ){			//������ƥ�䣬���������Ǩʵ�����½����ȡ������ִ��
		echo $res?$res:"FALSE";
	}
	
	/********************* ����ͨ���������Ǩ���Է��䣬����ִ�У��ƽ��������� *********************************/
	//����IN������
	$sql_t2 = "update w_token 
	set t_status='CONS', 
	t_consumedate=:date 
	
	where t_wfcid=:wfcid 
	and t_id in (".$pINids.")";		//ͨ��������ʵ��wfcid��С��Χ��
									//����״̬��FREE�����ɣ�LOCK��������CONS�����ģ�CANS��ȡ��
	$param_t2 = array();
	array_push($param_t2, array(":date", $nowdate));
	array_push($param_t2, array(":wfcid", $wfcid));
	
	$db->paramlist($param_t2);
	$res = $db->update($sql_t2);
	
	//�������OUT������
	for($i=0; $i<count($set_pOUT); $i++){
		$sql_t3 = "insert into w_token( t_wfid, t_wfcid, t_pid, t_status, t_createdate, t_context ) 
		value( :wfid, :wfcid, :pid, :status, :createdate, :context )";
		
		$param_t3 = array();
		array_push($param_t3, array(":wfid", $wfid));
		array_push($param_t3, array(":wfcid", $wfcid));
		array_push($param_t3, array(":pid", $set_pOUT[$i]["p_id"]));
		array_push($param_t3, array(":status", "FREE"));			//����״̬��FREE�����ɣ�LOCK��������CONS�����ģ�CANS��ȡ��
		array_push($param_t3, array(":createdate", $nowdate));
		array_push($param_t3, array(":context", ""));
		$db->paramlist($param_t3);
		$res = $db->insert($sql_t3);
		
		
		/************************** ������һ�������Ǩ(������)  ʵ��***************************************/
		$sql_tc3 = "insert into da_workflow.w_trancase( tc_wfid, tc_tid, tc_wfcid, tc_type, tc_limit, 
		tc_firetaskid, tc_context, tc_status, tc_enabledate, tc_puid, tc_puname ) 
		
		select t_wfid, t_id, :wfcid, t_type, t_limit, 
		t_firetaskid, :context, :status, :enabledate, :userid, :username 
		
		from da_workflow.w_transition, da_workflow.w_arc 
		where t_wfid=:wfid and t_id=a_tid and a_direction='IN' and a_pid=:pid";		//ͨ��IN�򻡣��ҳ���ʼ������һ���������Ǩ(������)
		
		$param_tc3 = array();
		array_push($param_tc3, array(":wfid", $wfid));
		array_push($param_tc3, array(":wfcid", $wfcid));
		array_push($param_tc3, array(":pid", $set_pOUT[$i]["p_id"]));
		array_push($param_tc3, array(":status", "EN"));				//�����Ǩ(������)״̬��EN�����ã�IP�������У�CA��ȡ���� FI�����
		array_push($param_tc3, array(":enabledate", $nowdate));
		array_push($param_tc3, array(":context", ""));
		array_push($param_tc3, array(":userid", ""));
		array_push($param_tc3, array(":username", ""));
		$db->paramlist($param_tc3);
		$res = $db->insert($sql_tc3);
	}
	
	
	// $log = new Log();
	// $log->write($db->geterror());
	
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