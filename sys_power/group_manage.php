<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
  <TITLE>工作组管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>
 
	<style type="text/css">
		.ztree li span.button.add {
			margin-left:2px;
			margin-right: -1px;
			background-position:-144px 0;
			vertical-align:top;
			*vertical-align:middle
		}
		
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#pg_remark{width:400px; height:120px;}
		#tabbar{padding-top:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">工作组管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="width:250px;vertical-align:top;"><ul id="treeDemo" class="ztree"></ul></td>
			<td style="vertical-align:top;">
				<div id="tabbar"></div>
				<div id="pad_info">
					<div class="list_top_bar">
						<div class="list_top_title">工作组基本信息</div>
						<div class="list_top_tools">
							<a class="item" href="javascript:void(0)" onclick="updategroup();" ><img src="/images/sys_icon/save.png" /> 保存</a>
						</div>
					</div>
					
					<table id="orgform" class="tableform" style="width:100%">
						<tr>
							<td colspan="3">名称 <input id="pg_name" type="text" style="width:400px;" value="" /></td>
						</tr>
						<tr>
							<td style="width:130px;">编号 <input id="pg_id" type="text" style="width:50px;" disabled="true" value=""/></td>
							<td style="width:130px;">排序 <input id="pg_sort" type="text" style="width:50px;" value=""/></td>
							<td>日期 <input id="pg_date" type="text" value="" /></td>
						</tr>
						<tr>
							<td colspan="3" style="vertical-align:top;">备注 <textarea id="pg_remark" ></textarea></td>
						</tr>
					</table>
				</div>
				
				<div id="pad_list">
					<div class="list_top_bar">
						<div class="list_top_title">工作组下包含的人员列表</div>
						<div class="list_top_tools">
							<a class="item" href="javascript:void(0)" onclick="addu2g();" ><img src="/images/sys_icon/add.png" /> 添加</a>
							<a class="item" href="javascript:void(0)" onclick="deleteu2g();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
						</div>
					</div>
					
					<table id="tb_list" style="width:100%;">
						<tbody name="head">
							<tr>
								<td style="text-align:center;"><input type="checkbox" /></td>
								<td style="width:20px;">序</td>
								<td style="width:50px;">名称</td>
								<td style="width:80px;">账号</td>
								<td style="width:80px;">手机</td>
								<td style="width:80px;">电话</td>
								<td>地址</td>
								<td style="width:80px;">最近登陆</td>
								<td style="width:80px;">登陆次数</td>
								<td style="width:100px;">备注</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{pu_id}">
								<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{pu_id}" /></td>
								<td name="order">{order}</td>
								<td name="pu_name" >{pu_name}</td>
								<td name="pu_code" >{pu_code}</td>
								<td name="pu_phone" >{pu_phone}</td>
								<td name="pu_telephone" >{pu_telephone}</td>
								<td name="pu_address" >{pu_address}</td>
								<td fmt="yyyy-mm-dd/p" edit="1">{pu_lastlogin}</td>
								<td name="pu_logincount" edit="1">{pu_logincount}</td>
								<td name="pu_remark" edit="1">{pu_remark}</td>
							</tr>
							<!--
							<tr>
								<td colspan="7" name="order">{order}</td>
							</tr>
							-->
						</tbody>
						<tbody name="foot">
							<tr>
								<td  colspan="10" name="sum_order">
									共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
									共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
									当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
									<span id="tb_list_pageinfo">&nbsp;</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/group_manage.js"></script>

