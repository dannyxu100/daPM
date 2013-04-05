
var g_puid="",
	g_oid="";

function showorgtree(){
	da("#org_tree").slideDown(100);
}

function hideorgtree(){
	da("#org_tree").hide();
}

/**查看客户详细信息
*/
function viewcst(cid){
	daWin({
		width: 800,
		height: 600,
		url: "/sys_crm/viewcst.php?cid="+ cid
	});
}

/**加载客户列表
*/
function loadcstlist(){
	var data1 = {
		dataType: "json",
		puid: g_puid
	};
	
	daTable({
		id: "cst_list",
		url: "/sys_crm/action/mycst_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("order"==fld){
				val = '<label><input type="checkbox" name="chkitem" value="'+ row["c_id"] +'" /> '+ val +'</label>';
			}
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
			// debugger;
		}
	}).load();
}

/**选中下属项
*/
function selectsub( obj ){
	var chkObj = da(obj);
	g_puid = chkObj.val();

	loadcstlist();
}

/**加载下属列表
*/
function loadrelationlist(){
	var type = da("[name=fromtype]:checked").val();
	if( "me" == type ){
		da("#userlist").hide();
		g_puid = fn_getcookie("puid");
		loadcstlist();
	}
	else{
		da("#userlist").show();
		
		daTable({
			id: "tbuser_list",
			url: "/sys_power/action/relation_get_userpage.php",
			data: {
				dataType: "json",
				poid: fn_getcookie("poid"),
				leaderid: fn_getcookie("puid")
			},
			//loading: false,
			//page: false,
			pageSize: 20,
			
			field: function( fld, val, row, ds ){
				if("order"==fld){
					val = '<label><input type="radio" name="chkuser" value="'+ row["pu_id"] +'" onclick="selectsub(this)" /> '+ val +'</label>';
				}
				return val;
			},
			loaded: function( idx, xml, json, ds ){
				link_click("#tb_list tbody[name=details_auto] tr");
				// toExcel();
			}
		}).load();
		
		g_puid = "";
		loadcstlist();
	}	
}

var setting = {
	view: {
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		beforeMouseUp: clicknode,
	}
};
/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "/sys_power/action/org_get_list.php",
	   type: "POST",
	   dataType: "json",
	   error: function(msg){
		//da.out(msg.responseText);
	   },
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].po_id,
					pId: data[i].po_pid,
					name: data[i].po_name,
					open: true
				});
			}
			
			$.fn.zTree.init($("#org_tree"), setting, zNodes);
	   }
	 });
}

/**加载目标人员列表信息
*/
function loaduserlist(){
	var data1 = {
		dataType: "json",
		opt: "qry"
	}
	if( "" != g_oid ){
		data1["pu_oid"] = g_oid;
	}

	daTable({
		id: "tb_list",
		url: "/sys_power/action/user_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("order"==fld){
				val = '<label><input type="radio" name="chkitem" value="'+ row["c_id"] +'" /> '+ val +'</label>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			autoframeheight();
		}
	}).load();
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_oid = treeNode.id;
	da("#org_title").text(treeNode.name);
	loaduserlist();
}

daLoader("daIframe,daTable,daWin",function(){
	da(function(){
		var arrParam = da.urlParams();
		level2menu = arrParam["menu"];
		
		loadtree();
		loadrelationlist();
		loaduserlist();
		
		da("#bt_org").hover(function(){
			showorgtree();
		},function(){
			hideorgtree();
		});
	});
});
