

/**新建公海客户
*/
function addpubliccst(){
	goto("/sys_crm/publiccst_add.php");
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
			opt: "qry"
		};
	

	daTable({
		id: "cst_list",
		url: "/sys_crm/action/publiccst_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("c_name"==fld){
				val ='<a href="javascript:void(0)" onclick="viewcst('+row.c_id+')">'+val+'</a>';
				val +=' <a href="javascript:void(0)" class="txt_tool" >抓取客户</a>';
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

daLoader("daTable,daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		var arrParam = da.urlParams();
		
		listenKey();
		loadlist();
	});
});
