<?php
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');

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
	
	function delDir($dir) {
		//先删除目录下的文件：
		if(!file_exists($dir)) return false;
		
		$dh=opendir($dir);
		while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
				$fullpath=$dir."/".$file;
				
				if(!is_dir($fullpath)) {
					unlink($fullpath);
				}
				else {
					deldir($fullpath);
				}
			}
		}

		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir)) {
			return true;
		} 
		else {
			return false;
		}
	}
	
	function getsql($host,$user,$password,$dbname){
		//这里的账号、密码、名称都是从页面传过来的
		$conn = mysql_connect($host,$user,$password);
		if( !$conn )  			//连接mysql数据库
		{
			return '数据库连接失败，请核对后再试';
		}
		if(!mysql_select_db($dbname))  //是否存在该数据库
		{
			return '不存在数据库:'.$dbname.',请核对后再试';
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
		mysql_close($conn);
		
		return $mysql;
	}
	
	function backupdb($host,$user,$password,$dbname){
		//一季度，一月，一周各备份一个
		$date = getdate();
		$month = $date['mon'];
		$quarter = ceil($month/3);		//计算当前月是第几个季度
		
		$old_quarter_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".($quarter-1)."/";
		$old_month_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".date("Y_m_d", strtotime("-1 month"))."/";
		$old_day_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".date("Y_m_d", time()-86400*7)."/";

		$new_quarter_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".$quarter."/";
		$new_month_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".date("Y_m")."/";
		$new_day_folder = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/backup_dbsql/".date("Y_m_d")."/";
		
		$new_quarter_file = $new_quarter_folder.$dbname.".sql";
		$new_month_file = $new_month_folder.$dbname.".sql";
		$new_day_file = $new_day_folder.$dbname.".sql";

		if( !file_exists( $new_quarter_file ) ){
			delDir( $old_quarter_folder);	//删除老的文件目录
			makeDir( $new_quarter_folder);	//如果新目录不存在，就创建目录
		
			$fp = fopen($new_quarter_file,'w');
			fputs($fp, getsql($host,$user,$password,$dbname));
			fclose($fp);
			// Log::out($dbname."季度数据备份成功");
		}
		if( !file_exists( $new_month_file ) ){
			delDir( $old_month_folder);		//删除老的文件目录
			makeDir( $new_month_folder);	//如果新目录不存在，就创建目录
		
			$fp = fopen($new_month_file,'w');
			fputs($fp, getsql($host,$user,$password,$dbname));
			fclose($fp);
			// Log::out($dbname."月数据备份成功");
		}
		if( !file_exists( $new_day_file ) ){
			delDir( $old_day_folder);		//删除老的文件目录
			makeDir( $new_day_folder);		//如果新目录不存在，就创建目录
		
			$fp = fopen($new_day_file,'w');
			fputs($fp, getsql($host,$user,$password,$dbname));
			fclose($fp);
			// Log::out($dbname."周数据备份成功");
		}
		
	}
	
	//备份数据库   
	$host="localhost";  
	$user="root";			//数据库账号
	$password="";			//数据库密码
	$dbnames = array(
		"da_bizform", 
		"da_common",
		"da_crm", 
		"da_powersys", 
		"da_setting", 
		"da_userform", 
		"da_workflow"
	);
	
	for($i=0; $i<count($dbnames); $i++){
		backupdb($host, $user, $password, $dbnames[$i]);
	}
?>