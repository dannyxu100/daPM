<?php
//error_reporting(-1);

// include_once "log.php";

class DB{
	private $m_CONNSTR = Array(
		0 => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"pm"),
		1 => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"da_powersys"),
		2 => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"da_workflow"),
		3 => Array("host"=>"localhost", "user"=>"root", "pwd"=>"", "db"=>"da_bizform")
	);
	
	private $m_host;
	private $m_db;
	private $m_user;
	private $m_pwd;
	
	private $m_pdo;
	
	public $m_error_msg;
	
	/**构造函数
	*/
	function DB($n=0){
		$this->m_host =& $this->m_CONNSTR[$n]["host"];
		$this->m_db =& $this->m_CONNSTR[$n]["db"];
		$this->m_user =& $this->m_CONNSTR[$n]["user"];
		$this->m_pwd =& $this->m_CONNSTR[$n]["pwd"];
		
		$this->init();
	}

	/**初始化并链接数据库
	*/
	private function init(){
		$this->m_pdo = new PDO(
			"mysql:host=".$this->m_host.";dbname=".$this->m_db,
			$this->m_user,
			$this->m_pwd,
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",		//设置数据库信息编码
				PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION				//启动异常信息
			)
		);
		
	}
	
	/**连接数据库
	*/
	// private function connect(){
	
	// }
	
	function close(){
		unset($this->m_CONNSTR);
		unset($this->m_host);
		unset($this->m_db);
		unset($this->m_user);
		unset($this->m_pwd);
		unset($this->m_pdo);
		unset($this->m_error_msg);
	}
	
	function CheckResource(){
		// if(!is_resource($this->link)){
		 // $this->PushError('失去数据库连接资源');
		 // return false;
		// }
		// return true;
	}

	/**设置错误信息
	*/
	private function seterror($msg){
		$this->m_error_msg = "[错误报告]";
		$this->m_error_msg.= "--(".$msg.")";
	}
	
	/**获取错误信息
	*/
	function geterror(){
		$attributes = array(
			"AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
			"ORACLE_NULLS", "PERSISTENT", "PREFETCH", "SERVER_INFO", "SERVER_VERSION",
			"TIMEOUT"
		);

		return $this->m_error_msg;
	}
	
	/**设置PDO属性值
	*/
	function setattr( $attr, $value ){
		$this->m_pdo->setAttribute($attr, $value);
	}
	
	/**获取PDO属性设置值
	*/
	function getattr( $attr ){
		return $this->m_pdo->getAttribute(constant($attr));
	}
	
	/**执行sql代码段(带参数)
	*/
	function runsqlbyparam($sql, $param){
		$statement = $this->m_pdo->prepare($sql);
		try {
			return $statement->execute( $param );	//返回true 或 false
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**执行sql代码段(无参)
	*/
	function runsql($sql){
		$num = func_num_args();
		$args = func_get_args();
		if(1 < $num){
			return $this->runsqlbyparam($args[0], $args[1]);
		}
		
		$statement = $this->m_pdo->prepare($sql);
		try {
			$statement->execute();		//返回true 或 false
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**查询数据集(带参数)
	*/
	function getlistbyparam($sql, $param){
		$statement = $this->m_pdo->prepare($sql);
		try {
			$statement->execute( $param );
			return $statement->fetchAll();		//从结构集中取出一个包含了所有行的数组
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}

	/**查询数据集(无参)
	*/
	function getlist($sql){
		$num = func_num_args();
		$args = func_get_args();
		if(1 < $num){
			return $this->getlistbyparam($args[0], $args[1]);
		}
		
		$statement = $this->m_pdo->prepare($sql);
		try {
			$statement->execute();
			return $statement->fetchAll();		//从结构集中取出一个包含了所有行的数组
			
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
		
	}
	
	/**更新数据
	*/
	function update($sql, $param){
		$statement = $this->m_pdo->prepare($sql);
			
		try {
			$statement->execute( $param );
			return $statement->rowCount();		//返回影响行数
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
	
	/**删除数据
	*/
	function delete($sql, $param){
		return $this->update($sql, $param);
	}
	
	/**插入数据
	*/
	function insert($sql, $param){
		$statement = $this->m_pdo->prepare($sql);
			
		try {
			$statement->execute( $param );
			return $this->m_pdo->lastInsertId(); //返回刚插入的一条记录的主键
		}
		catch (pdoException $e) {
			$this->seterror($e->getMessage());
			return null;
		}
	}
}
?>