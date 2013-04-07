<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>业务处理-列表页</TITLE>
	<link rel="stylesheet" href="/css/base.css">
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">业务名称</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
			<a class="item" href="javascript:void(0)" onclick="uploadattach();" ><img src="/images/sys_icon/attach.png" /> 上传附件</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="viewbizlog();" ><img src="/images/sys_icon/message.png" /> 查看日志</a>
			<a class="item" href="javascript:void(0)" onclick="submitworkflow();" ><img src="/images/sys_icon/email_go.png" /> 提交流程</a>
		</div>
	</div>
	
	<div id="attach_bar" style="padding:10px;background:#f7f7f7;">附件：<span id="attach_list"></span></div>
	<div id="templet_form" style="padding:5px;display:none;"></div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/biz_detail.js"></script>

