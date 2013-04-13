var g_ntid="";

/**新建公海客户
*/

/**新建我的便签
*/
function addnote(){
	goto("/sys_common/note/note_add_item.php");
}

/**查看便签详细信息
*/
function viewnote( nid ){
	if( g_isctrl ){
		daWin({
			width: 600,
			height: 400,
			url: "/sys_common/note/note_detail.php?nid="+ nid
		});
	}
	else{
		goto("/sys_common/note/note_detail.php?nid="+ nid);
	}
}


/**加载客户信息列表
*/
function loadlist(){
	var data1 = {
			dataType: "json",
			ntid: g_ntid
		};
	
	daTable({
		id: "note_list",
		url: "/sys_common/note/action/note_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("n_title"==fld){
				return '<a href="javascript:void(0)" onclick="viewnote('+row.n_id+')">'+val+'</a>';
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


/**加载便签簿分页按钮
*/
function loadtab(){
	da.runDB("/sys_common/note/action/notetype2user_get_list.php",{
		dataType: "json"
		
	},function(data){
		if("FALSE"!=data){
			g_notetypedata={};
			var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
			
			for(var i=0; i<data.length; i++){
				daTab0.appendItem("item_"+data[i].nt_id, data[i].nt_name, null, {
					click:function(){
						g_ntid = this.id.replace("item_", "");
						loadlist();
					}
				});
			}
			
			daTab0.click("item_"+data[0].nt_id);
		}	
	},function(msg, code, ex){
		// debugger;
	});

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
	});
});
