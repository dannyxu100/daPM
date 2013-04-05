<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>客户转移</TITLE>
	<link rel="stylesheet" href="/css/base.css" />
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css" />
 </HEAD>
	
<BODY>
	<table style="width:100%">
		<div class="list_top_bar">
			<div class="list_top_title">客户转移操作</div>
			<div class="list_top_tools">
				<a class="item" href="javascript:void(0)" onclick="saveuser();" ><img src="/images/sys_icon/ok.png" /> 确认转移</a>
			</div>
		</div>
		<tr>
			<td style="vertical-align:top; width:200px;">
				<div style="padding:8px;">
					<label><input type="radio" name="fromtype" checked="true" value="me" onclick="loadrelationlist()" />我的客户</label>&nbsp;&nbsp;
					<label><input type="radio" name="fromtype" value="ralation" onclick="loadrelationlist()" />下属的客户</label>
				</div>
				
				<div id="userlist" style="display:none;">
					<table id="tbuser_list">
						<tbody name="head">
							<tr>
								<td style="width:20px;">序</td>
								<td style="width:50px;">名称</td>
								<td style="width:80px;">手机</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{pu_id}" >
								<td name="order">{order}</td>
								<td name="pu_name" >{pu_name}</td>
								<td name="pu_phone" >{pu_phone}</td>
							</tr>
						</tbody>
						<tbody name="foot">
							<tr>
								<td  colspan="3" name="sum_order">
									共<span id="tbuser_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
									共<span id="tbuser_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
									当前在第<span id="tbuser_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
									<span id="tbuser_list_pageinfo">&nbsp;</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</td>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">客户名单</div>
					<div class="list_top_tools">
						<input id="searchkey" style="float:left;height:20px;"/>
						<a class="item" href="javascript:void(0)" onclick="saveuser();" ><img src="/images/sys_icon/search.png" /> 查找</a>
					</div>
				</div>
				<table id="cst_list" style="width:100%;">
					<tbody name="head">
						<tr>
							<td style="width:30px;"><label><input type="checkbox" name="chkitem"  /> 序</label></td>
							<td>客户名称</td>
							<td style="width:80px;">负责人</td>
						</tr>
					</tbody>
					<tbody name="body" style="display:none">
						<tr>
							<td name="order">{order}</td>
							<td>{c_name}</td>
							<td>{c_user}</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td colspan="3">
								共<span id="cst_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
								共<span id="cst_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
								当前在第<span id="cst_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页　&nbsp; 
								<span id="cst_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td style="vertical-align:top; width:250px;">
				<div class="list_top_bar">
					<div class="list_top_title" id="org_title">转移给谁</div>
					<div class="list_top_tools" >
						<a id="bt_org" class="item" style="position:relative;" href="javascript:void(0)" >
							<img src="/images/sys_icon/search.png" /> 部门
							<ul id="org_tree" class="ztree daShadow" style="display:none; position:absolute; top:23px; right:-1px; border:1px solid #999; background:#fff;"></ul>
						</a>
					</div>
				</div>
				
				<table id="tb_list" style="width:100%;">
					<tbody name="head">
						<tr>
							<td style="width:30px;">序</td>
							<td style="width:50px;">名称</td>
							<td style="width:80px;">手机</td>
						</tr>
					</tbody>
					<tbody name="body" style="display:none">
						<tr value="{pu_id}" onclick="selectitem(this)">
							<td name="order">{order}</td>
							<td name="pu_name" >{pu_name}</td>
							<td name="pu_phone" >{pu_phone}</td>
						</tr>
					</tbody>
					<tbody name="foot">
						<tr>
							<td  colspan="3" name="sum_order">
								共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
								共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
								当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
								<span id="tb_list_pageinfo">&nbsp;</span>
							</td>
						</tr>
					</tbody>
				</table>
				
			</td>
		</tr>
	</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/cst_move.js"></script>

