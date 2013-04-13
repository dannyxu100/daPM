<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>我的便签</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="title">我的便签</span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools"></div>
	</div>
	<table id="noteform" class="grid" style="display:none; width:100%; height:50px;">
		<tr >
			<td class="header" style="width:80px;">标 题</td>
			<td>
				{n_title}
			</td>
			<td class="header" style="width:80px;">便签簿</td>
			<td>
				{nt_name}
			</td>
		</tr>
		<tr >
			<td class="header" >摘 要</td>
			<td colspan="3">
				{n_abstract}
			</td>
		</tr>
		<tr >
			<td class="header" >详细内容</td>
			<td colspan="3">
				{n_conent}
			</td>
		</tr>
	</table>
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/note_detail.js"></script>

</html>
