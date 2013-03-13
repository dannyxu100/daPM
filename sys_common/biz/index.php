<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	
	<TITLE>业务处理-列表页</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td id="left_frame" style="vertical-align:top; width:200px; padding:0px;">
				<div id="workflow_list"></div>
			</td>
			<td class="frame_slide" onclick="slideleft()">
				<div id="bt_slide" class="bt_slideleft"></div>
			</td>
			<td style="vertical-align:top;">
				<iframe id="mainframe" src="" frameborder="0" style="width:100%;" defaultHeight="600"></iframe>
				
			</td>
		</tr>
	</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/index.js"></script>

