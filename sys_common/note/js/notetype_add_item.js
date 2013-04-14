
var g_ntid="";

/**添加便签簿分类名称
*/
function savenotetype(){
	if( "" != g_ntid ){		//修改名称
		da.runDB("/sys_common/note/action/notetype_update_item.php",{
			dataType: "json",
			ntid: g_ntid,
			ntname: da("#nt_name").val()
			
		},function(res){
			if("FALSE"!=res){
				alert("修改成功。");
				loadlist();
			}	
		},function(msg, code, ex){
			// debugger;
		});
		
		g_ntid = "";
		da("#tagtxt").text("新建便签簿");
		da("#nt_name").val("");
		return;
	}

	da.runDB("/sys_common/note/action/notetype_add_item.php",{
		dataType: "json",
		ntname: da("#nt_name").val()
		
	},function(res){
		if("FALSE"!=res){
			alert("添加成功。");
			loadlist();
		}	
	},function(msg, code, ex){
		// debugger;
	});
}

/**修改便签簿分类名称
*/
function updatenotetype(ntid, ntname){
	g_ntid = ntid;
	da("#tagtxt").text("修改名称");
	da("#nt_name").val(ntname);
}

/**删除便签簿分类名称
*/
function deletenotetype(ntid){
	da.runDB("/sys_common/note/action/notetype_delete_item.php",{
		dataType: "json",
		ntid: ntid
		
	},function(res){
		if("FALSE"!=res){
			alert("删除成功。");
			loadlist();
		}	
	},function(msg, code, ex){
		// debugger;
	});
}


/**加载客户信息列表
*/
function loadlist(){
	daTable({
		id: "notetype_list",
		url: "/sys_common/note/action/notetype2user_get_page.php",
		data: {
			dataType: "json"
		},
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if( "nt_name" ==fld ){
				return '<a href="javascript:void(0)" onclick="updatenotetype('+row.nt_id+', \''+ row.nt_name +'\')">'+ row.nt_name +'</a>';
			}
			else if("tools"==fld){
				return '<a href="javascript:void(0)" onclick="deletenotetype('+row.nt_id+')">删除</a>';
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

daLoader("daMsg,daIframe,daTable",function(){
	da(function(){
		loadlist();
	});
});