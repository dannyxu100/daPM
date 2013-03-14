var g_wfid = "",
	g_btid = "",
	g_transtatus = "",
	g_dbsource = "",
	g_dbfld = "";
	

/**创建业务
*/
function addbiz(){
	goto("/sys_common/biz/biz_add_detail.php?btid="+ g_btid +"&wfid="+ g_wfid);
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

/**查看业务表单详细信息
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
*/
function viewbizlog( dbfldid, bcid, wfcid ){
	if( g_isctrl ){
		daWin({
			width: 800,
			height: 500,
			url: "/sys_common/bizlog/log_manage.php?bcid="+ bcid,
			back: function(){
				
			}
		});
	}
	else{
		goto("/sys_common/bizlog/log_manage.php?wfid="+ bcid );
	}
	
}

/**查看业务表单详细信息
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
*/
function viewbiz( dbfldid, bcid, wfcid ){
	if( g_isctrl ){
		daWin({
			width: 800,
			height: 500,
			url: "/sys_common/biz/biz_update_detail.php?wfid="+ g_wfid +"&wfcid="+ wfcid +"&btid="+ g_btid +"&bcid="+ bcid 
			+"&dbsource="+ g_dbsource+"&dbfld="+ g_dbfld +"&dbfldid="+ dbfldid,
			back: function(){
				
			}
		});
	}
	else{
		goto("/sys_common/biz/biz_update_detail.php?wfid="+ g_wfid +"&wfcid="+ wfcid +"&btid="+ g_btid +"&bcid="+ bcid 
		+"&dbsource="+ g_dbsource +"&dbfld="+ g_dbfld +"&dbfldid="+ dbfldid);
	}
}


/**加载工具按钮
*/
function appendtools( fld, val, row, ds ){
	var arrhtml = [
		'<a href="javascript:void(0)" class="txt_tool" onclick="viewbiz(\''+ row[g_dbfld] +'\', '+ row["bc_id"] +', '+ row["wfc_id"] +')">接单</a>',
		'<a href="javascript:void(0)" class="txt_tool" onclick="viewbizlog(\''+ row[g_dbfld] +'\', '+ row["bc_id"] +', '+ row["wfc_id"] +')">日志</a>',
		'<a href="javascript:void(0)" class="ico_tool" title="删除" style="background:url(/sys_power/images/sys_icon/delete.png)"></a>'
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
	
	var idxfld = 0;
	
	daTable({
		id: "tb_list",
		url: "/sys_common/biz/action/workflowcase2role_get_page.php",
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
				idxfld = 0;
			}
			else if( 1 == idxfld ){
				val = '<a href="javascript:void(0)" title="点击查看详细信息" onclick="viewbiz(\''+ row[g_dbfld] +'\', '+ row["bc_id"] +', '+ row["wfc_id"] +')">'+ val +'</a>';
			}
			else if("tools"==fld){
				val = appendtools(fld, val, row, ds);
			}
			
			idxfld++;
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
	
	da.runDB("/sys_common/biz/action/biztemplet2workflow_get_item.php",{
		dataType: "json",
		wfid: g_wfid
		
	},function(data){
		if("FALSE" != data ){
			g_btid = data[0].bt_id;
			g_dbsource = data[0].bt_dbsource;
			g_dbfld = data[0].bt_dbfld;
			
			listObj.append( data[0].bt_listhtml );
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


var g_isctrl = false;
/**监听按键
*/
function listenKey(){
	daKey({
		keydown: function(keyName, ctrlKey, altKey, shiftKey){
			if( !g_isctrl ){
				g_isctrl = ctrlKey;
			}
		},
		keyup: function(keyName, ctrlKey, altKey, shiftKey){
			if( g_isctrl ){
				g_isctrl = ctrlKey;
			}
		}
	});
}

daLoader("daMsg,daKey,daTab,daTable,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_wfid = arrparam["wfid"];
		
		loadtab();
		loadtemplet();
		listenKey();
	});
});
