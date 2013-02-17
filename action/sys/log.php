<?php
/**********************************************************
 * File name: LogClass.class.php
 * Class name: ��־��¼��
 * Create date: 2008/05/14
 * Update date: 2008/09/28
 * Author: blue
 * Description: ��־��¼��
 * Example: //�趨·�����ļ���
 * $dir="a/b/".date("Y/m",time());
 * $filename=date("d",time()).".log";
 * $Log=new Log($dir,$filename);
 * $Log->write("test".time());
 * //ʹ��Ĭ��
 * $Log=new Log();
 * $Log->write("test".time());
 * //��¼��Ϣ����
 * $Log=new Log();
 * $arr=array(
 * 'type'=>'info',
 * 'info'=>'test',
 * 'time'=>date("Y-m-d H:i:s",time())
 * );
 * $Log->write($arr);
 **********************************************************/

class Log {
    private $_filepath; //�ļ�·��
    private $_filename; //��־�ļ���
    private $_filehandle; //�ļ����
    

    /**
     *����:��ʼ����¼��
     *����:�ļ���·��,Ҫд����ļ���
     *���:��
     */
    public function Log($dir="", $filename="") {
        //Ĭ��·��Ϊ��ǰ·��
        $this->_filepath = empty ( $dir ) ? $_SERVER["DOCUMENT_ROOT"]."/log" : $dir;
        
        //Ĭ��Ϊ��ʱ�䣫.log���ļ��ļ�
        $this->_filename = empty ( $filename ) ? date ( 'Y-m-d', time () ) . '.log' : $filename;
        
        //����·���ִ�
        $path = $this->_createPath ( $this->_filepath, $this->_filename );
        //�ж��Ƿ���ڸ��ļ�
        if (! $this->_isExist ( $path )) { //������
            //û��·���Ļ���Ĭ��Ϊ��ǰĿ¼
            if (! empty ( $this->_filepath )) {
                //����Ŀ¼
                if (! $this->_createDir ( $this->_filepath )) { //����Ŀ¼���ɹ��Ĵ���
                    die ( "����Ŀ¼ʧ��!" );
                }
            }
            //�����ļ�
            if (! $this->_createLogFile ( $path )) { //�����ļ����ɹ��Ĵ���
                die ( "�����ļ�ʧ��!" );
            }
        }
        
        //����·���ִ�
        $path = $this->_createPath ( $this->_filepath, $this->_filename );
        //���ļ�
        $this->_filehandle = fopen ( $path, "a+" );
    }
    
    /**
     *����:д���¼
     *����:Ҫд��ļ�¼
     *���:��
     */
    public function write($log) {
        //����������¼
        $str = "";
        if (is_array ( $log )) {
            foreach ( $log as $k => $v ) {
                $str .= $k . " : " . $v . "\n";
            }
        } else {
            $str = $log . "\n";
        }
        
        //д��־
        if (! fwrite ( $this->_filehandle, $str )) { //д��־ʧ��
            die ( "д����־ʧ��" );
        }
    }
    
    /**
     *����:�ж��ļ��Ƿ����
     *����:�ļ���·��,Ҫд����ļ���
     *���:true | false
     */
    private function _isExist($path) {
        return file_exists ( $path );
    }
    
    /**
     *����:����Ŀ¼(���ñ��˳�ǿ�Ĵ���-_-;;)
     *����:Ҫ������Ŀ¼
     *���:true | false
     */
    private function _createDir($dir) {
        return is_dir ( $dir ) or ($this->_createDir ( dirname ( $dir ) ) and mkdir ( $dir, 0777 ));
    }
    
    /**
     *����:������־�ļ�
     *����:Ҫ������Ŀ¼
     *���:true | false
     */
    private function _createLogFile($path) {
        $handle = fopen ( $path, "w" ); //�����ļ�
        fclose ( $handle );
        return $this->_isExist ( $path );
    }
    
    /**
     *����:����·��
     *����:�ļ���·��,Ҫд����ļ���
     *���:�����õ�·���ִ�
     */
    private function _createPath($dir, $filename) {
        if (empty ( $dir )) {
            return $filename;
        } else {
            return $dir . "/" . $filename;
        }
    }
    
    /**
     *����: �����������ͷ��ļ����
     *����: ��
     *���: ��
     */
    function __destruct() {
        //�ر��ļ�
        fclose ( $this->_filehandle );
    }
}

?>
