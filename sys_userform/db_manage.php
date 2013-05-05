<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>数据库管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css"/>
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}		
		.righttitle {height:30px; line-height:30px; padding:0px 15px;border-bottom:1px solid #f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#tbremark{width:400px; height:120px;}
		#tabbar{padding-top:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">数据库管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:220px;vertical-align:top;"><ul id="dbtree" class="ztree"></ul></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title"><a id="tbtitle" href="javascript:void(0)" onclick="" ></a></div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="addform();" ><img src="/images/sys_icon/add.png" /> 新建</a>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;" id="formlist"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="tabbar"></div>
				
				<div id="pad_info">
					<table class="tablesolid" style="width:100%">
						<tr>
							<td class="header" style="width:80px;">名称</td>
							<td style="width:160px;"><input id="tbname" style="width:120px;" disabled="true"/></td>
							<td class="header" style="width:80px;">所属数据库</td>
							<td><input type="text" id="dbname" value="0" style="width:120px;" disabled="true"/></td>
						</tr>
						<tr>
							<td class="header">占用空间</td>
							<td><input id="tbsize" disabled="true" /></td>
							<td class="header">记录数</td>
							<td><input id="tbrows" disabled="true" /></td>
						</tr>
						<tr>
							<td class="header">编码格式</td>
							<td><input id="tbcodetype" disabled="true" /></td>
							<td class="header">创建日</td>
							<td><input id="tbdate" disabled="true" /></td>
						</tr>
						<tr>
							<td class="header">备注</td>
							<td colspan="3"><textarea id="tbremark" ></textarea></td>
						</tr>
					</table>
				</div>
					

				<div id="pad_fldlist">
					<div class="list_top_bar">
						<div class="list_top_title">数据表所包含的字段信息</div>
						<div class="list_top_tools">
							<a class="item" href="javascript:void(0)" onclick="addfeild();" ><img src="/images/sys_icon/add.png" /> 添加</a>
							<a class="item" href="javascript:void(0)" onclick="deletefeild();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
						</div>
					</div>
					
					<table id="tb_fldlist" style="width:100%;">
						<tbody name="head">
							<tr>
								<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
								<td style="width:20px;">序</td>
								<td style="width:150px;">字段名</td>
								<td style="width:120px;">类型</td>
								<td style="width:50px;">可为空</td>
								<td style="width:80px;">默认值</td>
								<td style="width:80px;">长度</td>
								<td style="width:120px;">编码</td>
								<td style="width:30px;">主键</td>
								<td style="width:50px;">自增</td>
								<td>备注</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{t_id}" title="{t_remark}">
								<td style="text-align:center;"><input type="checkbox" name="chkitem_tran" value="{t_id}" /></td>
								<td name="order">{order}</td>
								<td name="COLUMN_NAME" >{COLUMN_NAME}</td>
								<td name="COLUMN_TYPE" >{COLUMN_TYPE}</td>
								<td name="IS_NULLABLE" >{IS_NULLABLE}</td>
								<td name="COLUMN_DEFAULT" >{COLUMN_DEFAULT}</td>
								<td name="CHARACTER_MAXIMUM_LENGTH" >{CHARACTER_MAXIMUM_LENGTH}</td>
								<td name="COLLATION_NAME" >{COLLATION_NAME}</td>
								<td name="COLUMN_KEY" >{COLUMN_KEY}</td>
								<td name="EXTRA" >{EXTRA}</td>
								<td name="COLUMN_COMMENT" >{COLUMN_COMMENT}</td>
							</tr>
						</tbody>
						<tbody name="foot">
							<tr>
								<td  colspan="11" name="sum_order">
									共<span id="tb_fldlist_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
									共<span id="tb_fldlist_pagecount2" style="color:#c26220">0</span>&nbsp;页，
									当前在第<span id="tb_fldlist_pageindex2" style="color:#c26220">0</span>&nbsp;页　
									<span id="tb_fldlist_pageinfo">&nbsp;</span>
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
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/db_manage.js"></script>
