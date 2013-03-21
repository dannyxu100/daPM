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
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="addbiz();" ><img src="/images/sys_icon/add.png" /> 新建</a>
			<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
		</div>
	</div>
	
	<div id="tabbar" ></div>
	<div id="templet_list" style="padding:3px;"></div>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/biz_list.js"></script>

