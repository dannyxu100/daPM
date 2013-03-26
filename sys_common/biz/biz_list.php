<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	
	<TITLE>业务处理-列表页</TITLE>
	<link rel="stylesheet" href="/css/base.css" >
	<style>
		.itemHover td a.txt_tool{display:inline; margin-right:5px;}
		a.txt_tool{display:none;}
		
		.itemHover td a.ico_tool{display:inline-block; vertical-align:middle; width:16px; height:16px; }
		a.ico_tool{display:none;}
	</style>
	
	
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="biz_title">业务名称</span></div>
		<div class="list_top_tools" id="toptools"></div>
	</div>
	
	<div id="tabbar" ></div>
	<div id="templet_list"></div>
	
	
	<div id="templet_sublist" style="display:none;">
			<table id="tb_list_tran" style="width:600px;background-color:#fff;">
				<tbody name="head">
					<tr>
						<td style="width:30px;">
							序
						</td>
						<td style="width:100px;">
							业务步骤
						</td>
						<td style="width:50px;">
							状态
						</td>
						<td style="width:50px;">
							执行人
						</td>
						<td style="width:80px;">
							完成日期
						</td>
						<td>
							备注
						</td>
					</tr>
				</tbody>
				<tbody name="body">
					<tr>
						<td name="order">
							{order}
						</td>
						<td name="t_name">
							{t_name}
						</td>
						<td name="tc_status">
							{tc_status}
						</td>
						<td name="pu_name">
							{pu_name}
						</td>
						<td name="tc_finishdate" fmt="yyyy-mm-dd">
							{tc_finishdate}
						</td>
						<td name="tc_remark">
							{tc_remark}
						</td>
					</tr>
				</tbody>
			</table>
	</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/biz_list.js"></script>

