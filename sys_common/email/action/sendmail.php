<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/email_class.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	/**** 没有通讯录记录，或通信往来，会进入到垃圾箱 ****/
	/**** 发送邮件的账号，一定要开启SMTP服务 ****/
	$emails = $_POST["emails"]; 
	$title = $_POST["title"];
	$title .= "[".date("YmdHis")."]";
	
	$content = $_POST["content"];
	$content .= "[ <a href='http://zhtx.renrenbang.cn'>点击查看：http://zhtx.renrenbang.cn</a> ]";
	
	$smtpserver = "smtp.qq.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口

	$smtpusermail = "1113149812@qq.com";	//SMTP服务器的用户邮箱
	$smtpuser = "1113149812";				//SMTP服务器的用户帐号
	$smtppass = "xufei7262603";				//SMTP服务器的用户密码

	
	$smtp = new Email($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = FALSE;//是否显示发送的调试信息
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	
	$res = 0;
	$arrEmail = array_unique(explode(',', $emails));
	for($i=0; $i<count($arrEmail); $i++){
		if( "" != $arrEmail[$i] && "" != $title ){
			$smtp->sendmail($arrEmail[$i], $smtpusermail, $title, $content, $mailtype);
			$res++;
		}
	}
	
	echo $res;
?>