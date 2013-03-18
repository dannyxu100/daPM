﻿var g_poid = "",
	g_leaderid = "";

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

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_poid = treeNode.id;

	da.runDB("/sys_power/action/relation_get_leaderlist.php",{
		dataType: "json",
		poid: g_poid
	},
	function(data){debugger;
		if("FALSE"!= data){
			var objlist = da("#leaderlist");
			objlist.empty();
			for(var i=0; i<data.length; i++){
				objlist.append('<a href="javascript:void(0)" class="bt_menu" onclick="loaduserlist('+ data[i].pu_id +', this)">'+ data[i].pu_name +'</a>');
			}
		}
	},
	function(code, msg, ex){
		debugger;
	});

}


/**删除可选项
*/
function deleteuser(){
	if(!g_itid){
		alert("请先选择分类。");
		return;
	}
	
	var iids = [];
	da("[name=chkitem]:checked").each(function(){
		iids.push(this.value);
	});
	
	if( iids ){
		confirm("确认删除选中的可选项吗？", function(){
			da.runDB("/sys_setting/item/action/item_delete_list.php",{
				itid: g_itid,
				iids: iids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("删除成功");
					loadlist();
				}
			});
		});
	}
}

/**选择下级人员
*/
function adduser(){
	if(""==g_poid){
		alert("请先选择一个部门。");
		return;
	}
	if(""==g_leaderid){
		alert("请先选择一位上级。");
		return;
	}

	daWin({
		width: 650,
		height: 500,
		url: "/sys_power/plugin/select_user.htm?ismulti=true",
		back: function( res ){
			var suids = [];
			for(var k in res){
				suids.push(res[k].pu_id);
			}
			
			da.runDB("/sys_power/action/relation_add_list.php",{
				poid: g_poid,
				leaderid: g_leaderid,
				uids: suids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("添加成功");
					loaduserlist();
				}
			});
		}
	});
}

/**加载下级人员列表
*/
function loaduserlist(leaderid, obj){
	g_leaderid = leaderid;

	da(".curmenu").removeClass("curmenu");
	da(obj).addClass("curmenu");

	daTable({
		id: "tbuser_list",
		url: "/sys_power/action/relation_get_userlist.php",
		data: {
			dataType: "json",
			poid: g_poid,
			leaderid: g_leaderid
		},
		//loading: false,
		//page: false,
		pageSize: 999999,
		
		field: function( fld, val, row, ds ){
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}


/**选择上级人员
*/
function addleader(){
	if(""==g_poid){
		alert("请先选择一个部门。");
		return;
	}
	
	daWin({
		width: 650,
		height: 500,
		url: "/sys_power/plugin/select_user.htm",
		back: function( res ){
			var suids = [];
			for(var k in res){
				suids.push(res[k].pu_id);
			}
			
			var objlist = da("#leaderlist");
			objlist.append('<a href="javascript:void(0)" class="bt_menu" onclick="loaduserlist('+ res[k].pu_id +', this)">'+ res[k].pu_name +'</a>');
		}
	});
}

/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "action/org_get_list.php",
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
			
			$.fn.zTree.init($("#orgtree"), setting, zNodes);
	   }
	 });
}

/*页面加载完毕*/
$(document).ready(function(){
	loadtree();
});


daLoader("daMsg,daWin,daTable", function(){
	// daUI();
	$( "#po_date" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  onClose: function( selectedDate ) {
		$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
});

//-->