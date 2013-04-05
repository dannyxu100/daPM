var g_poid = "",
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
	g_leaderid = "";
	da("#userlist").hide();
	
	var objlist = da("#leaderlist");
	objlist.empty();
	
	
	da.runDB("/sys_power/action/relation_get_leaderlist.php",{
		dataType: "json",
		poid: g_poid
	},
	function(data){
		if("FALSE"!= data){
			da("#userlist").show();
			for(var i=0; i<data.length; i++){
				objlist.append('<a href="javascript:void(0)" class="bt_menu" onclick="loaduserlist('+ data[i].pu_id +', this)">'+ data[i].pu_name +'</a>');
			}
			
			da("a", "#leaderlist").dom[0].click();
		}
	},
	function(code, msg, ex){
		// debugger;
	});

}


/**删除可选项
*/
function deleteuser(){
	if(!g_poid){
		alert("请先选择部门。");
		return;
	}
	if(!g_leaderid){
		alert("请先选择上级。");
		return;
	}
	
	var puids = [];
	da("[name=chkitem]:checked").each(function(){
		puids.push(this.value);
	});
	
	if( 0<puids.length ){
		confirm("确认删除选中的下级人员吗？", function(){
			da.runDB("/sys_power/action/relation_delete_list.php",{
				poid: g_poid,
				leaderid: g_leaderid,
				puids: puids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("删除成功");
					loaduserlist(g_leaderid);
				}
			},function(code,msg,ex){
				// debugger;
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
					loaduserlist( g_leaderid );		//刷新
				}
			});
		}
	});
}

/**加载下级人员列表
*/
function loaduserlist(leaderid, obj){
	g_leaderid = leaderid;

	if(obj){
		da(".curmenu").removeClass("curmenu");
		da(obj).addClass("curmenu");
	}
	
	daTable({
		id: "tbuser_list",
		url: "/sys_power/action/relation_get_userpage.php",
		data: {
			dataType: "json",
			poid: g_poid,
			leaderid: g_leaderid
		},
		//loading: false,
		//page: false,
		pageSize: 999999,
		
		field: function( fld, val, row, ds ){
			if("order"==fld){
				val = '<label><input type="checkbox" name="chkitem" value="'+ row["pu_id"] +'" /> '+ val +'</label>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			//toExcel();
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
			
			var leaders = da("a", "#leaderlist");
			leaders.dom[leaders.dom.length-1].click();		//选中新添的leader
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