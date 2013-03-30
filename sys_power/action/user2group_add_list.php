<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	// error_reporting(-1);
	
	$arr = preg_split("/,/", $_POST["uids"]);
	
	// $log = new Log();
	$db = new DB("da_powersys");
	if(0<count($arr) && isset($_POST["pgid"])){
		$db->tran();
		
		$rows = 0;
		for($i=0; $i<count($arr); $i++){		//","分隔引起最后多一个空数据,所以-1
			if( 0 >= $db->getcount("select * from p_user2group where u2g_puid=".$arr[$i]." and u2g_pgid=".$_POST["pgid"])){
				$res = $db->insert("insert into p_user2group(u2g_puid, u2g_pgid) values(".$arr[$i].",".$_POST["pgid"].");");
				$rows++;
			}
		}
		
		if($db->geterror()){
			$db->back();
			$db->close();
			echo 'FALSE';
		}
		else{
			$db->commit();
			$db->close();
			echo $rows;
		}
	}
	else{
		echo 'FALSE';
	}
	
?>