<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>添加案例</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="title">案例列表</span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savecase();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="grid" style="width:100%; height:50px;">
		<tr >
			<td class="header" style="width:80px;">标 题</td>
			<td colspan="3">
				<input id="c_title" type="text" style="width:300px;" valid="anything,false" validinfo="不能为空"/>
				<select id="c_type"></select>
			</td>
		</tr>
		<tr >
			<td class="header" style="width:80px;">排 序</td>
			<td colspan="3">
				<input id="c_sort" type="text" valid="anything,false" validinfo="不能为空" value="9999"/>
				(注: 数值越小，展示越靠前)
			</td>
		</tr>
		<tr >
			<td class="header" >摘 要</td>
			<td colspan="3">
				<textarea id="c_abstract" style="width:800px;height:100px;"></textarea>
				<br/>
				(注: 摘要限1000字内)
			</td>
		</tr>
		<tr >
			<td class="header" style="width:80px;">略缩图</td>
			<td colspan="3">
				<img id="img_case" src="/images/no_img.jpg" onclick="uploadimg()" style="width:200px; height:150px; cursor:pointer;"/>
				<input id="c_img" type="hidden" />
			</td>
		</tr>
		<tr >
			<td class="header" >备 注</td>
			<td colspan="3">
				<textarea id="c_remark" name="n_content" style="width:800px;height:200px;"></textarea>
			</td>
		</tr>
		<tr >
			<td class="header" >详细内容</td>
			<td colspan="3">
				<textarea id="c_content" name="n_content" style="width:800px;height:800px;"></textarea>
			</td>
		</tr>
	</table>
</body>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/case_add_item.js"></script>

</html>
