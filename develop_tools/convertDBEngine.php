<?php 
	/**
	* 批量转换mysql表引擎
	*/
	error_reporting(-1);
	
	// 数据库连接配置
	$host = 'localhost';
	$username = 'root';
	$passwd = '';
	
	// 要转换的库名配置,多库转换增加配置元素即可
	$configs = array(
		"da_setting",
		"da_powersys",
		"da_workflow",
		"da_bizform",
		"da_userform",
		"da_common",
		"da_crm",
	);
	
	// 转换配置
	$convert_rule = array(
		'from' => 'myisam',
		'to' => 'innodb'
	);
	
	mysql_engine_convert();
	
	/**
	* 转换函数
	*/
	function mysql_engine_convert(){
		global $host,$username,$passwd,$configs,$convert_rule;
		
		if ( ($conn = mysql_connect($host, $username, $passwd)) !== false){
			foreach ($configs as $db_name){
				mysql_select_db($db_name) or exit('not found db: '. $db_name);
				
				$tables = mysql_query("show full tables");
				
				while ($table = mysql_fetch_row($tables)){
					if ($table[1] === 'view') continue;
					
					$sql = "show table status from {$db_name} where name='{$table[0]}' ";
					
					if ($result = mysql_query($sql)){
						$table_status = mysql_fetch_row($result);
						
						if (strtolower($table_status[1]) == strtolower($convert_rule['from'])){
							mysql_query("alter table {$table[0]} engine = {$convert_rule['to']}");
						}
					}
				}
				echo $db_name,':all tables engine is ',$convert_rule['to'],"<br/>";
			}
		} 
		else {
			echo "db error<br/>";
		}
	}
?>