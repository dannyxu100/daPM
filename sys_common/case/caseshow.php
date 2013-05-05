<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<TITLE>案例中心</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		.menupad {position:absolute; top:0px; left:0px; padding-top:30px; width:200px; height:600px; background:#999 repeat-y;}
		.menupadhover {background:url(/images/caseshow/caseshow_menubg2.png) repeat-y;}
		.menupadhover #menu_list a { color:#222;}
		#menu_list {height:540px; overflow:hidden;}
		#menu_list a {display:block; width:189px; height:20px; padding:10px; color:#f7f7f7; font-weight:bold; text-decoration:none;}
		#menu_list a:hover,
		#menu_list a.current {color:#e6df28; background:#c6170a}
		
		#bt_up {display:block; position:absolute; top:0px; left:0px; width:200px; height:30px; background:#171717 url(/images/caseshow/caseshow_directbt_up.jpg) center no-repeat; cursor:pointer;}
		#bt_down {display:block; position:absolute; bottom:0px; left:0px; width:200px; height:30px; background:#171717 url(/images/caseshow/caseshow_directbt_down.jpg) center no-repeat; cursor:pointer;}
		
		.casepad{ position:relative; margin-left:200px; height:800px;}
		#case_title{height:30px; line-height:30px; font-weight:bold; font-size:14px; color:#e6df28; text-align:center; background:#444}
	
		#case_grid {}
		#case_grid .case_item{
			display:block; float:left; 
			width:230px; height:300px; padding:5px; margin-top:10px; margin-left:10px; 
			border:0px solid #f00; 
			background:#fff;
			cursor:pointer;
			text-decoration:none;
		}
		.case_item .case_item_t{width:230px; height:10px; background:url(/images/caseshow/casebox_top.jpg)}
		.case_item .case_item_content {position:relative; width:230px; height:280px; padding:0px 15px; background:url(/images/caseshow/casebox_bg.jpg) repeat-y}
		.case_item .case_item_content img{width:200px; height:150px; border:1px solid #999;}
		.case_item .case_item_content .overlayer {display:none; position:absolute; top:1px; left:16px; width:200px; height:150px; background:url(/images/caseshow/caseplay.png)}
		.case_item .case_item_content .title {padding:5px 0px; font-weight:bold; font-size:14px; color:#a10b00}
		.case_item .case_item_content .text {padding:5px 0px; color:#999; width:200px; height:50px; overflow:hidden;}
		.case_item .case_item_b{width:230px; height:10px; background:url(/images/caseshow/casebox_bottom.jpg)}
		
		.case_item:hover{
			text-decoration:none;
		}
		.case_item:hover .case_item_t{background:url(/images/caseshow/casebox_top2.jpg)}
		.case_item:hover .case_item_content{background:url(/images/caseshow/casebox_bg2.jpg) repeat-y}
		.case_item:hover .case_item_content img{ border:1px solid #222;}
		.case_item:hover .case_item_content .overlayer {display:block;}
		.case_item:hover .case_item_content .title {color:#fff}
		.case_item:hover .case_item_content .text { color:#ccc;}
		.case_item:hover .case_item_b{background:url(/images/caseshow/casebox_bottom2.jpg)}
		
		.bt_back {display:block; width:116px; height:100px; background:url(/images/caseshow/bt_back.jpg); cursor:pointer;}
		.bt_back:hover {background-position:-116px 0px;}
	</style>
 </HEAD>
<BODY>
<div id="casetype">
	<div class="menupad">
		<a id="bt_up" href="javascript:void(0)"></a>
		<div id="menu_list">
			<div id="menu_items"></div>
		</div>
		<a id="bt_down" href="javascript:void(0)"></a>
	</div>
	
	<div class="casepad">
		<div id="case_title" >最新上线案例</div>
		<div id="case_grid">
			<div style="clear:both;"></div>
		</div>
	</div>
</div>

<div id="caseview" style="display:none; width:820px; margin:0px auto; ">
	<a class="bt_back" onclick="hidecase()"></a>
	<div id="caseform" style="padding:10px;margin-top:20px; background:#fff; border:1px solid #999;"></div>
</div>

<div id="templet_caseform" style="display:none;">
	<div style="font-size:16px; font-weight:bold; color:#444;">{c_title} ( {c_type} )</div>
	<div style="margin:20px 0px; padding:10px 0px; border-top:1px dashed #eee; border-bottom:1px dashed #eee; ">{c_abstract}</div>
	<div>{c_content}</div>
</div>

<div id="scrolltop"></div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/caseshow.js"></script>

