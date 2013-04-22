<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	function makeDir($path) {
		//根目录物理路径
		$root = str_replace(array('/', '\\', '//', '\\\\'), DIRECTORY_SEPARATOR, rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/");

		//如果有根目录前缀，去掉网站根路径
		$path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
		$path = str_replace(array('/', '\\', '//', '\\\\'), DIRECTORY_SEPARATOR, $path);	//替换斜杠为 分斜杠
		$dirs = explode(DIRECTORY_SEPARATOR, $path); 										//通过反斜杠分隔为数组

		$relativePath = '';											//相对路径
		foreach ($dirs as $dir) {
			if ($dir) {  
				$relativePath .= $dir.DIRECTORY_SEPARATOR;  
				$realPath = $root.$relativePath;					//物理路径
				// Log::out($realPath);
				if (!file_exists($realPath) && !@mkdir($realPath, 0777)) {  
					return $realPath;  
				}  
			}  
		}  
		return true;  
	}
	
	//备份数据库   
	$host="localhost";  
	$user="root";			//$_POST['user'];		//数据库账号
	$password="";			//$_POST['password'];	//数据库密码
	$dbname="da_powersys";	//$_POST['dbname'];		//数据库名称

	//这里的账号、密码、名称都是从页面传过来的
	if(!mysql_connect($host,$user,$password))  //连接mysql数据库
	{
		echo '数据库连接失败，请核对后再试';
		exit;
	}
	if(!mysql_select_db($dbname))  //是否存在该数据库
	{
		echo '不存在数据库:'.$dbname.',请核对后再试';
		exit;
	}
	mysql_query("set names `utf8`");
	$mysql= "set charset utf8;\r\n";  
	
	$q1=mysql_query("show tables");
	while($t=mysql_fetch_array($q1)){
		$table=$t[0];
		$q2=mysql_query("show create table `$table`");
		$sql=mysql_fetch_array($q2);
		
		$mysql.="\r\nDROP TABLE IF EXISTS `$table`".";\r\n";
		$mysql.=$sql['Create Table'].";\r\n\r\n";
		$q3=mysql_query("select * from `$table`");
		
		while($data=mysql_fetch_assoc($q3)){
			$keys=array_keys($data);
			$keys=array_map('addslashes',$keys);
			$keys=join('`,`',$keys);
			$keys="`".$keys."`";
			$vals=array_values($data);
			$vals=array_map('addslashes',$vals);
			$vals=join("','",$vals);
			$vals="'".$vals."'";
			$mysql.="insert into `$table`($keys) values($vals);\r\n";
		}
	}
	
	makeDir( "/backup_dbsql/" );			//如果目录不存在，就创建目录
	$filename= rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".$dbname."[".date('Y_m_d')."].sql";  //存放路径，默认存放到项目最外层
	Log::out($filename);
	
	$fp = fopen($filename,'w');
	fputs($fp,$mysql);
	fclose($fp);
	echo "数据备份成功";
?>