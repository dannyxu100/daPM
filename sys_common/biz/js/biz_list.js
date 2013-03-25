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
* obj: 标签对象
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function viewbizlog( obj, dbfldid, bcid, wfcid, tcid ){
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
		goto("/sys_common/bizlog/log_manage.php?bcid="+ bcid );
	}
	
}

/**查看业务表单详细信息
* obj: 标签对象
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function viewbiz( obj, dbfldid, bcid, wfcid, tcid ){
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


var g_mapstatus = {
	"EN": '<span style="color:#999; font-weight:bold;">等待..</span>',
	"IP": '<span style="color:#f93; font-weight:bold;">处理中</span>',
	"FI": '<span style="color:#090; font-weight:bold;">完成</span>',
	"CA": '<span style="color:#ccc; font-weight:bold;">取消</span>'
}

/**查看事务处理信息
* obj: 标签对象
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function viewtran( obj, dbfldid, bcid, wfcid, tcid ){
	var trObj = da(obj).parents("tr"),
		nexttrObj = trObj.next("tr[name=tranpad]"),
		wfpadObj = da("td[name=workflowinfo]", nexttrObj);

	if( 0>=nexttrObj.dom.length ){
		alert("后台没有配置，显示业务进度面板");
	}
	
	if( !nexttrObj.is(":hidden")){
		nexttrObj.hide();
		return;
	}
	else{
		nexttrObj.show();
	}
		
	wfpadObj.empty();
	
	var tranlist = da("#tb_list_tran").dom[0].cloneNode(true);
	tranlist.id = "tb_list_tran_"+wfcid;
	tranlist.setAttribute("id", "tb_list_tran_"+wfcid);
	wfpadObj.append(tranlist);
	
	daTable({
		id: tranlist.id,
		url: "/sys_common/biz/action/trancase2workflowcase_get_page.php",
		data: {
			// opt: "qry",
			dataType: "json",
			wfcid: wfcid
		},
		// loading: false,
		// page: false,
		pageSize: 99999,
		
		field: function( fld, val, row, ds ){
			if( "tc_status" == fld ){
				return g_mapstatus[val];
			}
			else if( "pu_name" == fld ){
				return (null!=val?val:"");
			}
			else if( "tc_finishdate" == fld ){
				return ("0000-00-00 00:00:00"!=val?val:"");
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			// link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function(code,msg,ex){
			debugger;
		}
	}).load(); 
	
	// da.runDB("/sys_common/biz/action/trancase2workflowcase_get_list.php",{
		// dataType: "json",
		// wfcid: wfcid
		
	// },function(data){
		// if("FALSE"!=data){
			// for(var i=0; i<data.length; i++){
				// wfpadObj.append('<div>'
				// + (i+1) +". " 
				// + data[i].t_name +"&nbsp;&nbsp;&nbsp;&nbsp;"
				// + g_mapstatus[data[i].tc_status] +"&nbsp;&nbsp;&nbsp;&nbsp;" 
				// + (null!=data[i].pu_name?data[i].pu_name:"") +"&nbsp;&nbsp;&nbsp;&nbsp;"
				// + ("0000-00-00 00:00:00"!=data[i].tc_finishdate?da.fmtDate(data[i].tc_finishdate, "yyyy-mm-dd/p"):"") 
				// +'</div>');
			// }
		// }
	// });
}

/**接单
* obj: 标签对象
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function handlebiz(obj, dbfldid, bcid, wfcid, tcid ){
	// da.focus(obj, "#item03");
	confirm("你确定要接单吗？", function(){
		da.runDB("/sys_common/biz/action/trancase_accept_item.php",{
			tcid: tcid
		},
		function( res ){
			if("FALSE" != res){
				alert("接单成功。");
				loaddata();
			}
			else{
				alert("操作失败。");
			}
		});
	});
	
}

/**分单
* obj: 标签对象
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function assignbiz( obj, dbfldid, bcid, wfcid, tcid ){
	daWin({
		width: 650,
		height: 500,
		url: "/sys_power/plugin/select_user.htm",
		back: function( data ){
			var puid, puname;
			for(var k in data){
				puid = k;
				puname = data[k].pu_name;
			}
			
			da.runDB("/sys_common/biz/action/trancase_assign_item.php",{
				tcid: tcid,
				newpuid: puid,
				newpuname: puname
				
			},function(res){debugger;
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					da(obj).text(puname);
				}
			});
		}
	});
}

/**加载工具按钮
*/
function tools( fld, val, row, ds ){
	var toolhtml = [];
	
	toolhtml.push('<a href="javascript:void(0)" class="txt_tool" onclick="viewbizlog(this,\''
	+ row[g_dbfld] +'\', '
	+ row["bc_id"] +', '
	+ row["wfc_id"] +', '
	+ row["tc_id"] +')">日志</a>');
	

	if( g_enassign ){
		toolhtml.push('<a href="javascript:void(0)" class="txt_tool" style="color:#900;" onclick="assignbiz(this,\''
		+ row[g_dbfld] +'\', '+ row["bc_id"] +', '+ row["wfc_id"] +', '+ row["tc_id"] +')">'
		+ (row["tc_puname"]?row["tc_puname"]:"未分配") +'</a>');
	}
	
	if( "EN" == row.tc_status && ("" == row.tc_puid || 0 == row.tc_puid) ){
		toolhtml.push('<a href="javascript:void(0)" class="txt_tool" style="color:#900;" onclick="handlebiz(this,\''
		+ row[g_dbfld] +'\', '+ row["bc_id"] +', '+ row["wfc_id"] +', '+ row["tc_id"] +')">接受</a>');
	}

	
	
	// toolhtml.push('<a href="javascript:void(0)" class="ico_tool" title="删除" style="background:url(/images/sys_icon/delete.png)"></a>');
	
	return toolhtml.join("");
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
			dbfld: g_dbfld,
			
			enassign: g_enassign		//是否拥有分单权限
		},
		//loading: false,
		//page: false,
		pageSize: 30,
		
		field: function( fld, val, row, ds ){
			if( "order" == fld ){
				idxfld = 0;
				val = '<label><input type="checkbox" name="chkitem" value="'+ row[g_dbfld] +'" /> ' + val +'</label>';
			}
			else if( 1 == idxfld ){
				val = '<a href="javascript:void(0)" onclick="viewbiz(this, \''
				+ row[g_dbfld] +'\', '
				+ row["bc_id"] +', '
				+ row["wfc_id"] +', '
				+ row["tc_id"] +')" >'+ val +'</a>';
				
				val += '<img style="margin-left:10px; vertical-align:middle;" src="/images/sys_icon/down.png" onclick="viewtran(this, \''
				+ row[g_dbfld] +'\', '
				+ row["bc_id"] +', '
				+ row["wfc_id"] +', '
				+ row["tc_id"] +')" />';
			}
			else if("tools"==fld){
				val = tools(fld, val, row, ds);
			}
			
			idxfld++;
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		},
		error: function(code,msg,ex){
			debugger;
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
	daTab0.appendItem("item01","全部","/images/sys_icon/tables.png",{
		click:function(){
			g_transtatus = "";		//全部事务变迁
			loaddata();
		}
	});
	
	daTab0.appendItem("item02","未处理","/images/sys_icon/email_open.png",{
		click:function(){
			g_transtatus = "EN";	//事务变迁为EN(启动状态)
			loaddata();
		}
	});

	daTab0.appendItem("item03","处理中","/images/sys_icon/email_edit.png",{
		click:function(){
			g_transtatus = "IP";	//事务变迁为IP(处理中状态)
			loaddata();
		}
	});
	
	daTab0.appendItem("item04","已处理","/images/sys_icon/email_go.png",{
		click:function(){
			g_transtatus = "FI";	//事务变迁为EN(完成状态)
			loaddata();
		}
	});
	
	daTab0.click("item02");
}


var g_ennew = false,		//允许新建
	g_enassign = false,		//允许分单
	g_endel = false;		//允许删除
/**初始化当前人员可操作权限
*/
function loadoptpower( fn ){
	da.runDB("action/workflow2role_get_optpower.php",{
		dataType: "json",
		wfid: g_wfid
	},function(data){
		if("FALSE"!= data){
			for(var i=0; i<data.length; i++){
				switch( data[i].wf2r_type ){
					case "NEW":
						if( !g_ennew ) g_ennew = true;
						break;
					case "ASSIGN":
						if( !g_enassign ) g_enassign = true;
						break;
					case "DELETE":
						if( !g_endel ) g_endel = true;
						break;
				}
			}

			var toptools = da("#toptools");

			//是否可新建
			if( g_ennew ){
				toptools.append('<a class="item" href="javascript:void(0)" onclick="addbiz();" ><img src="/images/sys_icon/add.png" /> 新建</a>');
			}
			
			//是否可删除
			if( g_endel ){
				toptools.append('<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>');
			}
			
			if(da.isFunction(fn)) fn();
		}
	},function(code,msg,ex){
		// debugger;
	});

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
		
		listenKey();
		
		loadoptpower(function(){
			loadtab();
			loadtemplet();
		});
	});
});
