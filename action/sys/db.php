<?php
/* ------------------------------------------------------------------------------------------------------ *
* 文件名: db.class.php                          &nbsp;                                                       *
* ------------------------------------------------------------------------------------------------------ *
* 功 能: 连接 MYSQL 数据库 然后对 MYSQL 进行各种操作                                                   *
* ------------------------------------------------------------------------------------------------------ *
* 方 法: Connect        -- 构造数据库连接进程                                                         *
*          PushError      -- 构造错误信息                                                               *
*          SelectDB       -- 可以重新定位数据库                                                         *
*          SetFetch       -- 可以重新定位数据库查询FETCH方法                                            *
*          GetNum         -- 获取 记录集/语句 所查询出来的记录条数                                      *
*          Query          -- 底层执行 SQL 语句的方法                                                    *
*          GetOne         -- 获得语句中一条的数组                                                       *
*          GetAll         -- 或者查询语句中的关联数组记录                                               *
*          InsertID       -- 获取数据库连接资源中的最后执行 insert 所产生的 AUTO_INCREMENT 值           *
*          init           -- 执行对数据库的连接并将字符集定位为 GBK                                     *
*          CheckResource -- 检查数据库连接资源是否存在 随即函数                                        *
*          GetError       -- 获取错误结果                                                               *
*          Destroy        -- 析构                                                                       *
* ------------------------------------------------------------------------------------------------------ *
* 属 性: host           -- 数据库地址                                                                 *
*          user           -- 数据库用户                                                                 *
*          pass           -- 数据库帐号密钥                                                             *
*          base           -- 数据库名称                                                                 *
*          link           -- 数据库连接资源                                                             *
*          error_message -- 错误信息临时变量                                                           *
*          fetch          -- FETCH 方法                                                                 *
*          fetch_array    -- FETCH 方法集                                                               *
* ------------------------------------------------------------------------------------------------------ *
*/
// error_reporting(-1);

/*全局变量 -- 多数据库连接字符串*/

Class DB{
	var $_cfg = Array(
			0 => Array("host"=>"localhost", "user"=>"root", "pass"=>"", "base"=>"pm"),
			1 => Array("host"=>"localhost", "user"=>"root", "pass"=>"", "base"=>"da_powersys"),
			2 => Array("host"=>"localhost", "user"=>"root", "pass"=>"", "base"=>"da_workflow"),
			3 => Array("host"=>"localhost", "user"=>"root", "pass"=>"", "base"=>"da_bizform")
		);
	
   var $host, $user, $pass, $base, $link, $error_message;
   
   var $fetch = "MYSQL_ASSOC";
   var $fetch_array = Array('MYSQL_ASSOC', 'MYSQL_NUM', 'MYSQL_BOTH');
   
   function DB($num=0){
      /* create the database ini variables */
      $this->host =& $this->_cfg[$num]["host"];
      $this->user =& $this->_cfg[$num]["user"];
      $this->pass =& $this->_cfg[$num]["pass"];
      $this->base =& $this->_cfg[$num]["base"];
	  
      /* initilize */
      $this->init();
   }
   
   function Connect(){
      /* create the connect */
      $link = @mysql_pconnect($this->host, $this->user, $this->pass);
      if($link){
         @mysql_select_db($this->base, $link);
         $this->link = $link;
         return true;
      }
      $this->PushError('不能连接数据库');
      return false;
   }
   
   function PushError($error=null, $errorno=null){
      $this->error_message = "[错误报告]";
      $this->error_message.= "ERROR[".(empty($errorno) ? mysql_errno() : intval($errorno))."]";
      $this->error_message.= "".(empty($error) ? mysql_error() : strval($error))."";
   }
   
   function SelectDB($db){
      if($this->CheckResource()){
         @mysql_select_db($db, $this->link);
         return true;
      }
      return false;
   }
   
   function SetFetch($fetch){
      if(!in_array($fetch, $this->fetch_array)){
         $this->PushError('不存在的FETCH方法','1000');
         return false;
      }
      return true;
   }
   
   function GetNum($var){
      if($this->CheckResource()){
         /* get int variable */
         if(is_resource($var)){
            $num = @mysql_num_rows($var);
         } else if(is_string($var)) {
            $num = @mysql_num_rows($this->Query($var));
         } else {
            $this->PushError('获取记录条数语句格式不对 语句['.var_dump($var).']', '1001');
            return false;
         }
         
         /* bool fi the variable */
         if(!is_int($num)){
            $this->PushError('获取记录条数不正确', '1002');
            return false;
         }
         return $num;
      }
      return false;
   }                                                                  
   
   function Query($sql){
      $res = @mysql_query($sql, $this->link);

      if(!$res){
         $this->PushError();
         return false;
      }
      return $res;
   }
   
   function GetOne($sql){
      if($this->CheckResource()){
         if(true == ($res = $this->Query($sql))){
            $row = @mysql_fetch_assoc($res);
            if(!$row){
               $this->PushError();
               return false;
            }
            return $row;
         }
         return false;
      }
      return false;
   }
   
	function GetAll($sql){
	  // mysql_set_charset('utf8'); 
		if($this->CheckResource()){
			if(true == ($res = $this->Query($sql))){
				$result = Array();
				while($row = @mysql_fetch_array($res/*, $this->fetch*/)){
				   $result[] = $row;
				}
				
				if(count($result) == 0){
				   $this->PushError();
				   return false;
				}
				return $result;
			}
			return false;
		}
		return false;
	}
   
   function InsertID(){
      if($this->CheckResource()){
         return @mysql_insert_id($this->link);
      }
      return false;
   }
   
   /**获取影响行数
   */
	function GetAffectRows(){
		return mysql_affected_rows();
	}
   
   function init(){
      $this->Connect();
	  //$this->Query('select * from pm_user');
      //$this->Query("SET NAMES utf-8");
	  //mysql_set_charset('utf8'); 
	  mysql_query("SET NAMES 'utf8'");  
   }
   
   function CheckResource(){
      if(!is_resource($this->link)){
         $this->PushError('失去数据库连接资源');
         return false;
      }
      return true;
   }
   
   function GetError(){
      return $this->error_message;
   }
   
   function Destroy(){
      if($this->CheckResource()){
         @mysql_close($this->link);
      }
	  unset($this->_cfg);
      unset($this->host);
      unset($this->user);
      unset($this->pass);
      unset($this->base);
      unset($this->link);
      unset($this->error_message);
      unset($this->fetch);
      unset($this->fetch_array);
   }
   
}
/*
* --------------------------------------------------------- *
* [版权信息]                                                *
* 程序版本: Ver1.0                                          *
* 程序版权: 作者开源于互联网           *
* 版权说明: 如果使用请著名转载,多谢高人指点                 *
* 修改说明: [请将修改后的说明附与此!谢谢!]                  *
* 修 改 人: [在这里填写修改人名称、时间、EMAIL、QQ 等信息] *
* 修改时间: [在这里填写您修改的时间]                        *
* Copyright by baijiachang.Human's Team WorkStation.        *
* --------------------------------------------------------- *
*/
?>