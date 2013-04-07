<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/


// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

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

$verifyToken = md5('unique_salt'.$_POST['timestamp']);
if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$targetFolder = isset($_POST['folder'])?$_POST['folder']:'/uploads';		//保存目录，默认根目录下
	makeDir($targetFolder);						//如果目录不存在，就创建目录

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$fileType = preg_replace("/^.*\./", "", strtolower($_FILES['Filedata']['name']));
	$filename = $_POST['name']?($_POST['name'].'.'.$fileType):$_FILES['Filedata']['name'];
	
	$targetPath = trim($targetFolder, '/');
	$targetFile = rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/".$targetPath.'/'.$filename;
	// Log::out($targetFile);
	
	move_uploaded_file($tempFile, iconv("UTF-8","gb2312", $targetFile));	//swf编码问题，需要转一次编码
}
?>