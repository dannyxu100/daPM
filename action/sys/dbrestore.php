<?php
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	//数据库恢复代码
	$sqlfile=fopen('20080324.sql','rb');
	$str=fread($sqlfile,filesize('20080324.sql'));
	$str=str_replace("\r","\n",$str);
	$sqlarr=explode(";\n",trim($str));
	foreach($sqlarr as $key => $values)
	{
		foreach(explode("\n",trim($values)) as $rows)
		$queryarr[$key].= $rows[0]=='#' || $rows[0].$rows[1] == '--' ? '' : $rows;
	}
	$link=mysql_connect("localhost","root","");
	mysql_select_db("mjcms",$link);
	foreach($queryarr as $values)
	{
		if(!mysql_query($values,$link))
		{
			exit();
		}
	}
	echo "<script>alert('成功');</script>";
?>