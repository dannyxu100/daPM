<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>添加便签簿</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<table class="grid" style="width:100%; margin-top:10px;">
		<tr >
			<td id="tagtxt" class="header" style="width:80px;">新建便签簿</td>
			<td>
				<input id="nt_name" type="text" style="margin-right:10px; width:160px;"/>
				<a class="bt_menu" style="display:inline-block; padding:2px 5px;" href="javascript:void(0)" 
				onclick="savenotetype();" ><img src="/images/sys_icon/save.png" /> 保存</a>
			</td>
		</tr>
	</table>
	<table id="notetype_list" style="width:100%;">
		<tbody name="head">
			<tr>
				<td style="width:30px;">序</td>
				<td>便签簿</td>
				<td style="width:80px">&nbsp;</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr>
				<td>{order}</td>
				<td>{nt_name}</td>
				<td>{tools}</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td colspan="3">
					共<span id="notetype_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
					共<span id="notetype_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
					当前在第<span id="notetype_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页　&nbsp; 
					<span id="notetype_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
				</td>
			</tr>
		</tbody>
	</table>
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/notetype_add_item.js"></script>

</html>
