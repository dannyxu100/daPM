<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>权限管理</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td id="left_frame" style="vertical-align:top; width:120px; padding:0px;"><div id="menu_list"></div></td>
			<td class="frame_slide" onclick="slideleft()">
				<div id="bt_slide" class="bt_slideleft"></div>
			</td>
			<td style="vertical-align:top;">
				<iframe id="mainframe" src="" frameborder="0" style="width:100%;height:500px;" defaultHeight="600"></iframe>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>

