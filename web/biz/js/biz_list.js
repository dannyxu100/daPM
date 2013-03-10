var g_wfid = "",
	g_btid = "",
	g_transtatus = "",
	g_dbsource = "",
	g_dbfld = "";
	

/**创建业务
*/
function addbiz(){
	goto("/web/biz/biz_add_detail.php?btid="+ g_btid +"&wfid="+ g_wfid);
}


/**显示隐藏左栏
*/
function slideleft(){
	var tdObj = da("#left_frame"),
		btObj = da("#bt_slide");
		
	if(tdObj.is(":hidden")){
		tdObj.show();
		btObj.dom[0].className = "bt_slideleft";
	}
	else{
		tdObj.hide();
		btObj.dom[0].className = "bt_slideright";
	}
}

/**加载工具按钮
*/
function appendtools( fld, val, row, ds ){
	var arrhtml = [
		'<a href="javascript:void(0)" title="点击查看" style="display:block; float:left; width:16px; height:16px; background:url(/sys_power/images/sys_icon/search.png)"></a>',
		'<a href="javascript:void(0)" title="删除" style="display:block; float:left; width:16px; height:16px; background:url(/sys_power/images/sys_icon/delete.png)"></a>'
		];
	return arrhtml.join("");
}

/**加载表单数据
*/
function loaddata(){
	if( "" == g_dbsource || "" == g_dbfld ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}
	
	var firstfld = false;
	
	daTable({
		id: "tb_list",
		url: "/web/biz/action/workflowcase2role_get_page.php",
		data: {
			// opt: "qry",
			dataType: "json",
			wfid: g_wfid,
			status: g_transtatus,
			dbsource: g_dbsource,
			dbfld: g_dbfld
		},
		//loading: false,
		//page: false,
		pageSize: 30,
		
		field: function( fld, val, row, ds ){
			if( "order" == fld ){
				firstfld = true;
			}
			else if( firstfld ){
				firstfld = false;
				return '<a href="javascript:void(0)" title="点击查看" onclick="viewbiz(\''+ row[g_dbfld] +'\')">'+ val +'</a>';
			}
			else if("tools"==fld){
				return appendtools(fld, val, row, ds);
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

/**加载工作流对应 表单列表页模板
*/
function loadtemplet(){
	var listObj = da("#templet_list");
	listObj.empty();
	
	if( "" == g_wfid ){
		// alert("对不起，该工作流没有定义主表单。");
		return;
	}
	
	da.runDB("/web/biz/action/biztempletbyworkflow_get_item.php",{
		dataType: "json",
		wfid: g_wfid
		
	},function(data){
		if("FALSE" != data ){
			g_btid = data[0].bt_id;
			g_dbsource = data[0].bt_dbsource;
			g_dbfld = data[0].bt_dbfld;
			
			listObj.append( decodeURI(data[0].bt_listhtml) );
			da("#biz_title").text(data[0].bt_name);
			
			loaddata();				//加载列表模板完毕，再加载数据
		}
	});
}

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","未处理","/sys_power/images/sys_icon/email_open.png",{
		click:function(){
			g_transtatus = "EN";	//事务变迁为EN(启动状态)
			loaddata();
		}
	});

	daTab0.appendItem("item03","处理中","/sys_power/images/sys_icon/email_edit.png",{
		click:function(){
			g_transtatus = "IP";	//事务变迁为IP(处理中状态)
			loaddata();
		}
	});
	
	daTab0.appendItem("item04","已处理","/sys_power/images/sys_icon/email_go.png",{
		click:function(){
			g_transtatus = "FI";	//事务变迁为EN(完成状态)
			loaddata();
		}
	});
	daTab0.click("item01");
}


daLoader("daMsg,daTab,daTable,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_wfid = arrparam["wfid"];
		
		loadtab();
		loadtemplet();
	});
});
