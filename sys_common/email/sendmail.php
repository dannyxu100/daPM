<?php
	require_once ('email_class.php');
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口

	$smtpusermail = "dannyxu100@163.com";//SMTP服务器的用户邮箱
	$smtpuser = "dannyxu100";//SMTP服务器的用户帐号
	$smtppass = "xufei7262603";//SMTP服务器的用户密码
	
	/**** 没有通讯录记录，或通信往来，会进入到垃圾箱 ****/
	
	// $smtpusermail = "723158958@qq.com";//SMTP服务器的用户邮箱
	// $smtpuser = "723158958";//SMTP服务器的用户帐号
	// $smtppass = "xufei72626030";//SMTP服务器的用户密码
	
	$smtpemailto = "1113149812@qq.com";//发送给谁
	$mailsubject = "网联天下技术部";//邮件主题
	$mailbody = "<h1>网联天下技术部项目管理系统，邮件推送测试</h1>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件

	$smtp = new Email($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = FALSE;//是否显示发送的调试信息

	$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

?>