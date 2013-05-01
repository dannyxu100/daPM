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

/**删除业务
*/
function deletebiz(){
	var bcids = [];
	for( var bcid in g_chkItems ){
		bcids.push(bcid);
	}
	
	da.runDB("/sys_common/biz/action/biz_delete_list.php",{
		dataType: "json",
		bcids: bcids.join(",")
	},
	function(res){
		debugger;
		if("FALSE" != res){
			alert("删除成功。");
			loaddata();
		}
		else{
			alert("操作失败。");
		}
	},function(code,msg,ex){
		debugger;
	});
}

var g_chkItems = {};
/**选择中工作流实例
*/
function selectitem( chkObj ){
	var chkObj = da(chkObj),
		bcid = chkObj.attr("value");

	if(chkObj.dom[0].checked){
		g_chkItems[bcid] = true;
	}
	else{
		delete g_chkItems[bcid];
	}
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
* bcid: 业务单实例 id
*/
function viewbizlog( bcid ){
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
* dbfldid: 数据源主键 id
* bcid: 业务单实例 id
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function viewbiz( dbfldid, bcid, wfcid, tcid, tid ){
	if( g_isctrl ){
		daWin({
			width: 800,
			height: 500,
			url: "/sys_common/biz/biz_detail.php?wfid="+ g_wfid 
			+"&wfcid="+ wfcid 
			+"&tcid="+ tcid 
			+"&tid="+ tid 
			+"&btid="+ g_btid 
			+"&bcid="+ bcid 
			+"&dbfldid="+ dbfldid,
			back: function(){
				
			}
		});
	}
	else{
		goto("/sys_common/biz/biz_detail.php?wfid="+ g_wfid 
		+"&wfcid="+ wfcid 
		+"&tcid="+ tcid 
		+"&tid="+ tid 
		+"&btid="+ g_btid 
		+"&bcid="+ bcid 
		+"&dbfldid="+ dbfldid);
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
* wfcid: 工作流实例 id
* tcid: 事务变迁实例 id
*/
function viewtran( obj, wfcid, tcid ){
	var trObj = da(obj).parents("tr"),
		nexttrObj = trObj.next("tr[name=tranpad]"),
		wfpadObj = da("td[name=workflowinfo]", nexttrObj);

	if( 0>=nexttrObj.dom.length ){
		alert("后台没有配置，显示业务进度面板");
	}
	
	if( "none" != nexttrObj.css("display")){
		nexttrObj.hide();
		return;
	}
	else{
		nexttrObj.show();
	}
		
	wfpadObj.empty();
	
	var tranlist = da("#tb_list_tran").dom[0].cloneNode(true);
	tranlist.id = "tb_list_tran_"+tcid;
	tranlist.setAttribute("id", "tb_list_tran_"+tcid);
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
				//拥有分单权限，且当前事务变迁处于无人接单或处理中的状态
				if( g_enassign && ("EN"==row["tc_status"] || "IP"==row["tc_status"]) ){
					return ('<a href="javascript:void(0)" onclick="assignbiz(this, '+ row["tc_id"] +')">'
					+ (row["tc_puname"]?row["tc_puname"]:"未分配") +'</a>');
					
				}//待处理，且无人接单，且参与事务处理
				else if( "EN" == g_transtatus 
				&& ("" == row["tc_puid"] || 0 == row["tc_puid"]) 
				&& g_trans[row["tc_tid"]] ){
					return '<a href="javascript:void(0)" onclick="handlebiz('+ row["tc_id"] +')">接单</a>';
				}
				else{
					return ""!=val?val:"";
				}

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
	
}

/**接单
* tcid: 事务变迁实例 id
*/
function handlebiz( tcid ){
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
* tcid: 事务变迁实例 id
*/
function assignbiz( obj, tcid ){
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
				newpuname: puname,
				status: puname?"IP":"EN"
				
			},function(res){
				if("FALSE" != res){
					// da(obj).text(puname);
					loaddata();
				}
				else{
					alert("对不起，操作失败。");
				}
			});
		}
	});
}

/**加载工具按钮
*/
function tools( fld, val, row, ds ){
	var toolhtml = [];
	// toolhtml.push( row["t_name"] );
	// toolhtml.push( "(" );
	// toolhtml.push( '<span style="color:#999;">'+ row["tc_puname"] +'</span>' );
	// toolhtml.push( ")" );
	
	return toolhtml.join("");
}

var g_key="";
/**加载表单数据
*/
function loaddata(){
	if( "" == g_dbsource || "" == g_dbfld ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}
	
	var param = {
		// opt: "qry",
		dataType: "json",
		wfid: g_wfid,
		status: g_transtatus,
		dbsource: g_dbsource,
		dbfld: g_dbfld,
		onlyread: g_onlyread,		//是否拥有查看权限
		enassign: g_enassign		//是否拥有分单权限
	}
	
	if( "undefined" != typeof sys_setparam && da.isFunction(sys_setparam) ){
		sys_setparam( param );
	}
	
	var idxfld = 0;
	daTable({
		id: "tb_list",
		url: "/sys_common/biz/action/workflowcase2role_get_page.php",
		data: param,
		//loading: false,
		//page: false,
		pageSize: 20,
		field: function( fld, val, row, ds ){
			if( "undefined" != typeof sys_fld && da.isFunction(sys_fld) ){
				val = sys_fld( fld, val, row, ds );
			}
			
			if( "order" == fld ){
				idxfld = 0;
				
				if( g_endel ){		//用于删除的复选框
					val = '<label><input type="checkbox" name="chkitem" value="'+ row["bc_id"] +'" onclick="selectitem(this)" /> ' + val +'</label>';
				}
			}
			else if( 1 == idxfld ){
				val = '<a href="javascript:void(0)" onclick="viewbiz(\''
				+ row[g_dbfld] +'\', '
				+ row["bc_id"] +', '
				+ row["wfc_id"] +', '
				+ row["tc_id"] +', '
				+ row["tc_tid"] +')" >'
				+ (g_key?val.replace(new RegExp(g_key, "g"),'<span style="color:#900">'+g_key+'</span>'):val) +'</a> ';
				
				if( "" == g_transtatus || "FI" == g_transtatus ){
					val += '<span style="color:#999">('
					+ row["t_name"] +'-'
					+ (row["tc_puname"]?row["tc_puname"]:'<span style="color:#222">未分配</span>') +')</span>';
				}
				
				val += '<img style="margin-left:10px; vertical-align:middle;" src="/images/sys_icon/down.png" onclick="viewtran(this, '+ row["wfc_id"] +', '+ row["tc_id"] +')" />';
				
				val +='<a href="javascript:void(0)" class="txt_tool" style="margin-left:10px;" onclick="viewbizlog('+ row["bc_id"] +')">日志</a>'
			}
			else if("tools"==fld){
				val = tools(fld, val, row, ds);
			}
			
			idxfld++;
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			autoframeheight();
		},
		error: function(code,msg,ex){
			debugger;
		}
	}).load();
}

/**加载自定义脚本
*/
function loadscript( jstxt ){
    var daHead = da("head");
	oScript = '<script type="text/javascript">'+jstxt+'</script>';
    daHead.append( oScript ); 
}

/**加载工作流对应 表单列表页模板
*/
function loadtemplet(){
	var searchObj = da("#templet_search"),
		listObj = da("#templet_list");
		
	searchObj.empty();
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
			
			searchObj.append( data[0].bt_listsearch );	//加载自定义列表模板
			listObj.append( data[0].bt_listhtml );		//加载自定义列表模板
			loadscript( data[0].bt_listscript );		//加载自定义脚本
			
			da("#biz_title").text(data[0].bt_name);
			
			loaddata();				//加载列表模板完毕，再加载数据
		}
	});
}


/**加载分页按钮
*/
function loadtab(){
	if( g_onlyread ){		//只读权限
		return;
	}
	
	//参与管理 或参与业务流程
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	
	daTab0.appendItem("item01","待处理","/images/sys_icon/email_open.png",{
		click:function(){
			g_transtatus = "EN";	//事务变迁为EN(启动状态)
			loaddata();
		}
	});

	daTab0.appendItem("item02","处理中","/images/sys_icon/email_edit.png",{
		click:function(){
			g_transtatus = "IP";	//事务变迁为IP(处理中状态)
			loaddata();
		}
	});
	
	daTab0.appendItem("item03","已处理","/images/sys_icon/email_go.png",{
		click:function(){
			g_transtatus = "FI";	//事务变迁为EN(完成状态)
			loaddata();
		}
	});
	
	daTab0.appendItem("item04","全部","/images/sys_icon/tables.png",{
		click:function(){
			g_transtatus = "";		//全部事务变迁
			loaddata();
		}
	});
	
	daTab0.click("item01");
}


var g_onlyread = false,		//允许查看
	g_ennew = false,		//允许新建
	g_enassign = false,		//允许分单
	g_endel = false,		//允许删除
	g_trans = {};			//参与的事务变迁
	
/**初始化当前人员可操作权限
*/
function loadoptpower( fn ){
	da.runDB("action/workflow2role_get_optpower.php",{
		dataType: "json",
		wfid: g_wfid
	},function(data){
		if("FALSE"!= data){
			if( data.tran ){
				for(var i=0; i<data.tran.length; i++){
					g_trans[data.tran[i].t_id] = true;
				}
			}
		
			for(var i=0; i<data.opt.length; i++){
				switch( data.opt[i].wf2r_type ){
					case "READ":
						if( !g_onlyread ) g_onlyread = true;
						break;
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
				toptools.append('<a class="item" href="javascript:void(0)" onclick="deletebiz();" ><img src="/images/sys_icon/delete.png" /> 删除</a>');
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
			if( "Enter" == keyName){
				searchkey();
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
