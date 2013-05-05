
/**新建案例
*/
function addcase(){
	goto("/sys_common/case/case_add_item.php");
}

/**查看案例详细信息
*/
function updatecase( cid ){
	if( g_isctrl ){
		daWin({
			width: 700,
			height: 600,
			url: "/sys_common/case/case_update_item.php?cid="+ cid
		});
	}
	else{
		goto("/sys_common/case/case_update_item.php?cid="+ cid);
	}
}

function closecase(obj, cid){
	da.runDB("/sys_common/case/action/case_update_status.php",{
		cid: cid,
		status: "CLOSE"
		
	},function(res){
		if("FALSE" != res){
			alert("禁用成功");
			loadlist();
		}
	});
}

function opencase(obj, cid){
	da.runDB("/sys_common/case/action/case_update_status.php",{
		cid: cid,
		status: "OPEN"
		
	},function(res){
		if("FALSE" != res){
			alert("启用成功");
			loadlist();
		}
	});
}

/**加载案例列表
*/
function loadlist(){
	daTable({
		id: "case_list",
		url: "/sys_common/case/action/case_get_page.php",
		data: {
			dataType: "json"
		},
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("c_title"==fld){
				return '<a href="javascript:void(0)" onclick="updatecase('+row.c_id+')">'+val+'</a>';
			}
			else if( "c_status" ==fld){
				if( "OPEN" == row.c_status ){
					val = '<a href="javascript:void(0)" onclick="closecase(this,'+ row.c_id +')">已启用</a>';
				}
				else{
					val = '<a href="javascript:void(0)" style="color:#f00;" onclick="opencase(this,'+ row.c_id +')">已禁用</a>';
				}
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		},
		error: function(code,msg,ex){
			// debugger;
		}
	}).load();
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

daLoader("daMsg,daTable,daIframe,daWin,daTab,daKey",function(){
	da(function(){
		var arrParam = da.urlParams();
		
		listenKey();
		loadlist();
	});
});
