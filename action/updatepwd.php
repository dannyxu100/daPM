<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$puid = fn_getcookie('puid');
	
	$oldpwd=md5($_POST['old_pwd']);
	$newpwd=md5($_POST['new_pwd']);
	
	$db = new DB("da_powersys");
	$param1 = array();
	array_push( $param1, array(":puid", $puid) );
	$db->paramlist($param1);
	$set = $db->getone("select pu_pwd from p_user where pu_id=:puid");

	if(is_array($set) && 0<count($set)){
		if( $set['pu_pwd'] !== $oldpwd ){
			echo "旧密码输入不正确。";
			return;
		}
		
		$param2 = array();
		array_push( $param2, array(":puid", $puid) );
		array_push( $param2, array(":newpwd", $newpwd) );
		$db->paramlist($param2);
		$res = $db->update("update p_user set pu_pwd=:newpwd where pu_id=:puid");
			
		// $log = new Log();
		// $log->write($db->geterror());
		// $log->write(count($set));
		$db->close();
		
		echo $res?$res:"操作失败。";
	}
	else{
		echo "请先登录系统。";
	}
	


?>