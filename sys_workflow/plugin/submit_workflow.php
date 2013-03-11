<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<TITLE>业务提交面板</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title">业务提交面板</div>
		<div class="list_top_tools" style="float:left;display:none;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/sys_power/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="updatetran();" ><img src="/sys_power/images/sys_icon/save.png" /> 确认</a>
		</div>
	</div>
	
	<div style="padding:5px;">
		提交: <select id="arclist"></select>
	</div>
	<div style="padding:5px;">
		备注: <textarea id="remark" style="width:100%;height:100px;"></textarea>
	</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/submit_workflow.js"></script>

