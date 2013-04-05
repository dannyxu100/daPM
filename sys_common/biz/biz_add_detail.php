<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>业务处理-新建页</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">业务名称</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savebiz();" ><img src="/images/sys_icon/save.png" /> 保存</a>
			<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
		</div>
	</div>
	
	<div id="templet_form" style="padding:5px;"></div>
</BODY>
</HTML>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/biz_add_detail.js"></script>

