

/**新建公海客户
*/
function addnote(){
	goto("/sys_common/note/note_add_item.php");
}

/**查看客户详细信息
*/
function viewcst(cid){
	if( g_isctrl ){
		daWin({
			width: 800,
			height: 600,
			url: "",
			back: function(){
			
			}
		});
	}
	else{
		goto("/sys_crm/viewcst.php?cid="+ cid);
	}
}


/**加载客户信息列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			// opt: "qry",
			puid: fn_getcookie("puid")
		};
	

	daTable({
		id: "cst_list",
		url: "/sys_crm/action/mycst_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("c_name"==fld){
				return '<a href="javascript:void(0)" onclick="viewcst('+row.c_id+')">'+val+'</a>';
			}
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


/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","便签分类1","/images/sys_icon/error.png",{
		click:function(){
		
		}
	});

	daTab0.appendItem("item02","便签分类2","/images/sys_icon/message.png",{
		click:function(){
		
		}
	});
	
	daTab0.appendItem("item03","便签分类3","/images/sys_icon/ok.png",{
		click:function(){
		
		}
	});
	
	daTab0.appendItem("item04","全部","/images/sys_icon/tables.png",{
		click:function(){
		
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
			g_isctrl = ctrlKey;
		},
		keyup: function(keyName, ctrlKey, altKey, shiftKey){
			g_isctrl = ctrlKey;
		}
	});
}

daLoader("daTable,daIframe,daWin,daTab,daKey",function(){
	da(function(){
		var arrParam = da.urlParams();
		
		listenKey();
		loadtab();
		loadlist();
	});
});
