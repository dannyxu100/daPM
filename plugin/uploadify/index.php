<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>上传文件页面</title>
<link rel="stylesheet" type="text/css" href="images/uploadify.css">
</head>

<body>
	<form>
		<div id="queue"></div>
		
		<input id="file_upload" name="file_upload" type="file" multiple="true">
		<div style="padding:5px; margin-top:5px; border:1px solid #ccc; font-size:12px;">
			<li>上传文件大小，请不要超过2MB。</li>
			<li id="info" style="color:#900;"></li>
		</div>
	</form>
</body>
</html>

<script src="/js/jquery-1.8.3.js" type="text/javascript"></script>
<script src="js/jquery.uploadify.min.js" type="text/javascript"></script>

<script type="text/javascript">
	<?php $timestamp = time();?>
	
	var g_param = {
		'swf': 'uploadify.swf',
		'uploader': 'uploadify.php',
		'formData': {
			'timestamp': '<?php echo $timestamp;?>',	//数据流配对，验证时间戳
			'token': '<?php echo md5('unique_salt' . $timestamp);?>'
		},
		"buttonText": "请点击选择文件",
		"fileSizeLimit": "2MB",							//文件的极限大小(php默认上传2MB)
		"removeCompleted": false,
		// "removeTimeout": 3,
		"multi": false,
		"overrideEvents": ["onSelectError", "onDialogClose"],		//返回一个错误，选择文件的时候触发        
		'onSelectError': function (file, errorCode, errorMsg) {
			switch (errorCode) {
				case -100:
					alert("上传的文件数量已经超出系统限制的" + $('#file_upload').uploadify('settings', 'queueSizeLimit') + "个文件！");
					break;
				case -110:
					alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小！");
					break;
				case -120:
					alert("文件 [" + file.name + "] 大小异常！");
					break;
				case -130:
					alert("文件 [" + file.name + "] 类型不正确！");
					break;
			}
			return false;
		},
		'onFallback': function () {					//检测FLASH失败调用
			alert("您未安装FLASH控件，无法上传！请安装FLASH控件后再试。");
		},
		"onUploadComplete": function(file){			//队列中的每个文件上传完成时触发一次
			//
		},
		"onQueueComplete" : function(stats) {		//当队列中的所有文件全部完成上传时触发
		　　back(stats.files);
		}
	}
	
	function setinfo( info ){
		$("#info").append( info );
	}
	
	function setparam( userparam ){
		g_param = $.extend( true, {}, g_param, userparam );
		$('#file_upload').uploadify( g_param );
	}
	
	$(function(){
		// alert("页面加载完成。");
	});
</script>