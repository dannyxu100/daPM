<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>通知公告</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="title">通知公告</span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools"></div>
	</div>
	
	<table id="noticeform" class="grid" style="display:none; width:100%;">
		<tr>
			<td colspan="2">
				<div style="text-align:center; font-size:16px; font-weight:bold;">{n_title}</div>
				<div style="text-align:center; font-size:14px; font-weight:bold;">{n_subhead}</div>
				<div style="text-align:center; color:#ccc; margin:10px;">撰稿人: {pu_name} | 日期: {n_date}</div>
			</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">摘 要</td>
			<td><div style="">{n_abstract}</div></td>
		</tr>
		<!--
		<tr>
			<td class="header">附 件</td>
			<td>&nbsp;</td>
		</tr>
		-->
		<tr>
			<td class="header">内 容</td>
			<td><div style="">{n_content}</div></td>
		</tr>
	</table>
	
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/notice_detail.js"></script>

</html>
