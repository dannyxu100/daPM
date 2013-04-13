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
	<table class="tablesolid" style="width:100%; margin-top:10px;">
		<tr >
			<td class="header" style="width:40px;">名 称</td>
			<td>
				<input id="nt_name" type="text" style="margin-right:10px; width:200px;"/>
				<a class="bt_menu" style="display:inline-block; padding:2px 5px;" href="javascript:void(0)" 
				onclick="savenotetype();" ><img src="/images/sys_icon/save.png" /> 保存</a>
			</td>
		</tr>
	</table>
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/notetype_add_item.js"></script>

</html>
