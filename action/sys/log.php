<?php
/**********************************************************
 * File name: LogClass.class.php
 * Class name: 日志记录类
 * Create date: 2008/05/14
 * Update date: 2008/09/28
 * Author: blue
 * Description: 日志记录类
 * Example: //设定路径和文件名
 * $dir="a/b/".date("Y/m",time());
 * $filename=date("d",time()).".log";
 * $Log=new Log($dir,$filename);
 * $Log->write("test".time());
 * //使用默认
 * $Log=new Log();
 * $Log->write("test".time());
 * //记录信息数组
 * $Log=new Log();
 * $arr=array(
 * 'type'=>'info',
 * 'info'=>'test',
 * 'time'=>date("Y-m-d H:i:s",time())
 * );
 * $Log->write($arr);
 **********************************************************/

date_default_timezone_set('ETC/GMT-8');

class Log {
    private $_filepath; //文件路径
    private $_filename; //日志文件名
    private $_filehandle; //文件句柄
    

    /**
     *作用:初始化记录类
     *输入:文件的路径,要写入的文件名
     *输出:无
     */
    public function Log($dir="", $filename="") {
        //默认路径为当前路径
        $this->_filepath = empty ( $dir ) ? $_SERVER["DOCUMENT_ROOT"]."/log" : $dir;
        
        //默认为以时间＋.log的文件文件
        $this->_filename = empty ( $filename ) ? date("Y-m-d") . '.log' : $filename;
        
        //生成路径字串
        $path = $this->_createPath ( $this->_filepath, $this->_filename );
        //判断是否存在该文件
        if (! $this->_isExist ( $path )) { //不存在
            //没有路径的话，默认为当前目录
            if (! empty ( $this->_filepath )) {
                //创建目录
                if (! $this->_createDir ( $this->_filepath )) { //创建目录不成功的处理
                    die ( "创建目录失败!" );
                }
            }
            //创建文件
            if (! $this->_createLogFile ( $path )) { //创建文件不成功的处理
                die ( "创建文件失败!" );
            }
        }
        
        //生成路径字串
        $path = $this->_createPath ( $this->_filepath, $this->_filename );
        //打开文件
        $this->_filehandle = fopen ( $path, "a+" );
    }
    
    /**
     *作用:写入记录
     *输入:要写入的记录
     *输出:无
     */
    public function write($log) {
		$url = $_SERVER['PHP_SELF']; 
		$arr = explode('/',$url);
		$filename = end($arr); 
	
        //传入的数组记录
        $str = "【FROM '".$filename."' log】: ";
        if (is_array ( $log )) {
            foreach ( $log as $k => $v ) {
                $str .= $k . " : " . $v . "\n";
            }
        } else {
            $str .= $log . "\n";
        }
        
        //写日志
        if (! fwrite ( $this->_filehandle, $str )) { //写日志失败
            die ( "写入日志失败" );
        }
    }
	
    /**
     *作用:判断文件是否存在
     *输入:文件的路径,要写入的文件名
     *输出:true | false
     */
    private function _isExist($path) {
        return file_exists ( $path );
    }
    
    /**
     *作用:创建目录(引用别人超强的代码-_-;;)
     *输入:要创建的目录
     *输出:true | false
     */
    private function _createDir($dir) {
        return is_dir ( $dir ) or ($this->_createDir ( dirname ( $dir ) ) and mkdir ( $dir, 0777 ));
    }
    
    /**
     *作用:创建日志文件
     *输入:要创建的目录
     *输出:true | false
     */
    private function _createLogFile($path) {
        $handle = fopen ( $path, "w" ); //创建文件
        fclose ( $handle );
        return $this->_isExist ( $path );
    }
    
    /**
     *作用:构建路径
     *输入:文件的路径,要写入的文件名
     *输出:构建好的路径字串
     */
    private function _createPath($dir, $filename) {
        if (empty ( $dir )) {
            return $filename;
        } else {
            return $dir . "/" . $filename;
        }
    }
    
    /**
     *功能: 析构函数，释放文件句柄
     *输入: 无
     *输出: 无
     */
    function __destruct() {
        //关闭文件
        fclose ( $this->_filehandle );
    }
    
	/**write函数的简写(便于记忆)
	*/
	public static function out($log){
		$obj = new Log();
		$obj->write($log);
	}
}

?>
