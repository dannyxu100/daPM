<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>业务处理-列表页</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td id="left_frame" style="vertical-align:top; width:200px; padding:0px;"><div id="workflow_list"></div></td>
			<td style="vertical-align:middle; width:10px; padding:0px;cursor:pointer; background:#f7f7f7;" onclick="slideleft()">
				<div id="bt_slide" class="bt_slideleft"></div>
			</td>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">业务名称</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="add();" ><img src="/sys_power/images/sys_icon/add.png" /> 新建</a>
						<a class="item" href="javascript:void(0)" ><img src="/sys_power/images/sys_icon/delete.png" /> 删除</a>
					</div>
				</div>
				
				<div id="templet_list"></div>
				
			</td>
		</tr>
	</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/biz_list.js"></script>

