<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加通知公告</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#tabbar{padding-top:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">通知公告详细信息</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savenotice();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table class="grid" style="width:100%;">
		<tr>
			<td class="header" style="width:60px;">标 题</td>
			<td><input id="n_title" style="width:600px;" valid="anything,false" validinfo="不能为空"/></td>
		</tr>
		<tr>
			<td class="header" style="width:60px;">副标题</td>
			<td><input id="n_subhead" style="width:600px;" /></td>
		</tr>
		<tr>
			<td class="header">排 序</td>
			<td><input id="n_sort" style="width:100px;" value="999" valid="int,false" validinfo="必须是整数"/> (注: 值越小，越排前面)</td>
		</tr>
		<tr>
			<td class="header">摘 要</td>
			<td>
				<textarea id="n_abstract" name="n_abstract" style="width:600px; height:100px;" ></textarea>
				<br/>
				(注: 摘要限1000字内)
			</td>
		</tr>
		<!--
		<tr>
			<td class="header">附 件</td>
			<td>&nbsp;</td>
		</tr>
		-->
		<tr>
			<td class="header">详细内容</td>
			<td>
				<textarea id="n_content" name="n_content" style="width:600px; height:600px;" ></textarea>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/notice_add.js"></script>
