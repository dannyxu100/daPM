
<?include_once("action/sys/db3.php");?>
<?php
	$obj = new DB(1);

	$param = array(
		":id" => '1',
		":remark" => "徐飞"
	);
	//$arr = $obj->querylist("select * from p_user where pu_id=:id and pu_name like :name", $param);
	$arr = $obj->update("update p_user set pu_remark=:remark where pu_id=:id", $param);
	print_r($arr);
	
	echo $obj->geterror();
?>