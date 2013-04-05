var g_prid = "";

<!--
var setting = {
	view: {
		addHoverDom: addHoverDom,
		removeHoverDom: removeHoverDom,
		selectedMulti: false
	},
	edit: {
		enable: true,
		editNameSelectAll: true
		// showRemoveBtn: showRemoveBtn,
		// showRenameBtn: showRenameBtn
	},
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		// beforeDrag: beforeDrag,
		beforeMouseUp: clicknode,
		beforeEditName: beforeEditName,
		beforeRemove: beforeRemove,
		beforeRename: beforeRename,
		onRemove: onRemove,
		onRename: onRename
	}
};

var log, className = "dark";
// function showRemoveBtn(treeId, treeNode) {
	// return !treeNode.isFirstNode;
// }
// function showRenameBtn(treeId, treeNode) {
	// return !treeNode.isLastNode;
// }

// function beforeDrag(treeId, treeNodes) {
	// return true;
// }

function beforeEditName(treeId, treeNode) {
	className = (className === "dark" ? "":"dark");
	var zTree = $.fn.zTree.getZTreeObj("treeDemo");
	zTree.selectNode(treeNode);
	return true; //confirm("进入【" + treeNode.name + "】的编辑状态吗？");
}
function beforeRemove(treeId, treeNode) {
	className = (className === "dark" ? "":"dark");
	var zTree = $.fn.zTree.getZTreeObj("treeDemo");
	zTree.selectNode(treeNode);
	
	confirm("确认删除角色【" + treeNode.name + "】吗？",
	function(){
		da.runDB("action/role_get_list.php",{			//检查是否拥有下级部门
			prpid: treeNode.id
		},
		function(res){debugger;
			if('FALSE'==res){
				da.runDB("action/role_delete_item.php",{
				 prid: treeNode.id
				},
				function(res){
					if("FALSE"==res){
						alert("操作失败");
						loadroletree();
					}
				});
			}
			else{
				alert("对不起，【" + treeNode.name + "】拥有子项，请先删除子项。");
				loadroletree();
			}
		});
	
		return true;
	},
	function(){
		return false;
	});
}
function onRemove(e, treeId, treeNode) {

}
function beforeRename(treeId, treeNode, newName) {
	className = (className === "dark" ? "":"dark");
	if (newName.length == 0) {
		alert("节点名称不能为空.");
		var zTree = $.fn.zTree.getZTreeObj("treeDemo");
		zTree.editName(treeNode)
		// setTimeout(function(){zTree.editName(treeNode)}, 10);
		return false;
	}
	else{
		$.ajax({
			url: "action/org_update_item.php",
			type: "POST",
			data: {
			 poid: treeNode.id,
			 poname: newName
			},
			success: function(res){
				if(res=="FALSE"){
					alert("操作失败");
					loadroletree();
				}
				
			}
		});
	}
	return true;
}
function onRename(e, treeId, treeNode) {

}

function getTime() {
	var now= new Date(),
	h=now.getHours(),
	m=now.getMinutes(),
	s=now.getSeconds(),
	ms=now.getMilliseconds();
	return (h+":"+m+":"+s+ " " +ms);
}

/*点击添加节点*/
function addHoverDom(treeId, treeNode) {
	var sObj = $("#" + treeNode.tId + "_span");
	if (treeNode.editNameFlag || $("#addBtn_"+treeNode.id).length>0) return;
	var addStr = "<span class='button add' id='addBtn_" + treeNode.id
		+ "' title='add node' onfocus='this.blur();'></span>";
	sObj.after(addStr);
	
	var btn = $("#addBtn_"+treeNode.id);				//"添加按钮" click事件
	if (btn) btn.bind("click", function(){
		var zTree = $.fn.zTree.getZTreeObj("treeDemo");

		da.runDB("action/role_add_item.php",{
			prpid: treeNode.id,
			name: "新建角色"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建角色"});
			}
		});
		
		return false;
	});
};
/*移除节点*/
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.id).unbind().remove();
};

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_prid = treeNode.id;
	
	da.runDB("action/role_get_list.php",{
		dataType: "json",
		prid: treeNode.id
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});
	
	loaduserlist();
	loadgrouplist();
	loadpowertype();

}


/*加载左边角色树*/
function loadroletree(){
	 da.runDB("action/role_get_list.php",{
		dataType: "json"
	   },
	   function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].pr_id,
					pId: data[i].pr_pid,
					name: data[i].pr_name,
					open: true
				});
			}
			
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	   },
	   function(msg){
		//da.out(msg.responseText);
	   });
	   
}


/**选中或取消权限
*/
function selectmenu(obj){
	var arr = obj.id.split("_");
		pm_id = arr[1];
		
	if(obj.checked){
		da.runDB("/sys_power/action/menu2role_add_item.php",{
			prid: g_prid,
			pmid: pm_id
			
		},function(res){
			if("FALSE" == res){
				alert("设置失败");
			}else{
				alert("设置成功");
			}
		});
	}
	else{
		da.runDB("/sys_power/action/menu2role_delete_item.php",{
			prid: g_prid,
			pmid: pm_id
			
		},function(res){
			if("FALSE" == res){
				alert("设置失败");
			}else{
				alert("设置成功");
			}
		});
	}
}


/**加载角色权限
*/
function loadmenu2role(){
	da.runDB("/sys_power/action/menu2role_get_list.php",{
		dataType: "json",
		prid: g_prid
		
	},function(data){
		var chkObj;
		for(var i=0; i<data.length; i++){
			chkObj = da("#chkmenu_"+ data[i].m2r_pmid);

			chkObj.dom[0].checked = true;
			chkObj.attr("checked","true");
		}
	});
}

var setting3 = {
	view: {
		addDiyDom: addDiyDom3
	},
	data: {
		simpleData: {
			enable: true
		}
	}
};

function addDiyDom3(treeId, treeNode) {
	var aObj = $("#" + treeNode.tId + "_a");
	
	aObj.after('<label class="chk_powertype"><input type="checkbox" id="chkmenu_'+ treeNode.id +'" onclick="selectmenu(this)"/>允许</label>');
		
}

/*加载左边部门数据*/
function loadmenutree(){
	da.runDB("action/menu_get_list.php",{
		dataType: "json"
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].pm_id,
				pId: data[i].pm_pid,
				name: data[i].pm_name,
				open: true
			});
		}

		$.fn.zTree.init($("#treeMenu"), setting3, zNodes);
		loadmenu2role();
	},
	function(msg){
		//da.out(msg.responseText);
	});
	   
}
/**选中或取消权限
*/
function selectpowertype(obj){
	var arr = obj.id.split("_");
		pp_id = arr[1],
		pt_id = arr[2];
		
	if(obj.checked){
		da.runDB("/sys_power/action/power2role_add_item.php",{
			prid: g_prid,
			ppid: pp_id,
			ptid: pt_id
			
		},function(res){
			if("FALSE" == res){
				alert("设置失败");
			}else{
				alert("设置成功");
			}
		});
	}
	else{
		da.runDB("/sys_power/action/power2role_delete_item.php",{
			prid: g_prid,
			ppid: pp_id
			
		},function(res){
			if("FALSE" == res){
				alert("设置失败");
			}else{
				alert("设置成功");
			}
		});
	}
}


/**加载角色权限
*/
function loadpower2role(){
	da.runDB("/sys_power/action/power2role_get_list.php",{
		dataType: "json",
		prid: g_prid
		
	},function(data){
		var chkObj;
		for(var i=0; i<data.length; i++){
			chkObj = da("#power_"+data[i].p2r_ppid+"_"+data[i].p2r_ptid);
			
			chkObj.dom[0].checked = true;
			chkObj.attr("checked","true");
		}
	});
}

var setting2 = {
	view: {
		addDiyDom: addDiyDom
	},
	data: {
		simpleData: {
			enable: true
		}
	}
};

function addDiyDom(treeId, treeNode) {
	var aObj = $("#" + treeNode.tId + "_a");
	
	var editStr = g_html.replace(/{nodeid}/g, treeNode.id);
	aObj.after(editStr);
		
}

/**加载权限树
*/
function loadpowertree(){
	 $.ajax({
	   url: "action/power_get_list.php",
	   type: "POST",
	   dataType: "json",
	   error: function(msg){
		//da.out(msg.responseText);
	   },
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].pp_id,
					pId: data[i].pp_pid,
					name: data[i].pp_name,
					open: true
				});
			}
			
			$.fn.zTree.init($("#treePower"), setting2, zNodes);
			loadpower2role();
	   }
	 });
}

var g_html;
/**预加载并缓存 权限类型
*/
function loadpowertype(){
	da.runDB("/sys_power/action/powertype_get_list.php",{
		dataType: "json",
		
	},function(data){
		if(data && data.ds11){
			var ds = data.ds11;
			
			g_html = [];
			for(var i=0; i<ds.length; i++){
				g_html.push('<label class="chk_powertype"><input type="checkbox" id="power_{nodeid}_'+ds[i].pt_id+'" onclick="selectpowertype(this)"/>'+ ds[i].pt_name +'</label>');
			}
			g_html = g_html.join("");
			
			loadpowertree();
			loadmenutree();
		}
	});
	
}


/**加载工作组下属人员信息列表
*/
function loaduserlist(){
	//加载工作组人员列表
	daTable({
		id: "tb_list",
		url: "action/user2role_get_list.php",
		data: {
			dataType: "json",
			prid: g_prid,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("pu_name"==fld){
				return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

/**加载工作组下属人员信息列表
*/
function loadgrouplist(){
	//加载工作组人员列表
	daTable({
		id: "tb_grouplist",
		url: "action/group2role_get_page.php",
		data: {
			dataType: "json",
			prid: g_prid,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if("pu_name"==fld){
				return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

/** 修改部门信息
*/
function updaterole(){
	$.ajax({
		url: "action/role_update_item.php",
		type: "POST",
		data: {
			prid: da("#pr_id").val(),
			prname: da("#pr_name").val(),
			prsort: da("#pr_sort").val(),
			prdate: da("#pr_date").val(),
			prremark: da("#pr_remark").val()
		},
		success: function(res){
			if(res=="FALSE"){
				alert("对不起，修改失败。");
			}
			else{
				alert("修改成功。");
			}
			loadroletree();
		}
	});
}

/**添加分组包含人员
*/
function addu2r(){
	if(!g_prid){
		alert("请先选择中，任意角色。");
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
			
			da.runDB("/sys_power/action/user2role_add_list.php",{
				prid: g_prid,
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

/**添加角色包含工作组
*/
function addg2r(){
	if(!g_prid){
		alert("请先选择中，任意角色。");
		return;
	}

	daWin({
		width: 650,
		height: 500,
		url: "/sys_power/plugin/select_group.htm?ismulti=true",
		back: function( res ){
			var sgids = [];
			for(var k in res){
				sgids.push(res[k].pg_id);
			}
			
			da.runDB("/sys_power/action/group2role_add_list.php",{
				prid: g_prid,
				gids: sgids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("添加成功");
					loadgrouplist();
				}
			});
		}
	});
}
/**批量删除角色包含人员
*/
function deleteu2r(){
	if(!g_prid){
		alert("请先选择中，任意角色。");
		return;
	}
	
	var suids = [];
	da("[name=chkitem]:checked").each(function(){
		suids.push(this.value);
	});
	
	if( 0<suids.length ){
		confirm("确认删除选中的人员吗？",function(){
			da.runDB("/sys_power/action/user2role_delete_list.php",{
				prid: g_prid,
				uids: suids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("删除成功");
					loaduserlist();
				}
			});
		});
	}
}

/**批量删除角色包含工作组
*/
function deleteg2r(){
	if(!g_prid){
		alert("请先选择中，任意角色。");
		return;
	}
	
	var sgids = [];
	da("[name=chkitem]:checked").each(function(){
		sgids.push(this.value);
	});
	
	if( 0<sgids.length ){
		confirm("确认删除选中的人员吗？",function(){
			da.runDB("/sys_power/action/group2role_delete_list.php",{
				prid: g_prid,
				gids: sgids.join(",")
			},function(res){
				if("FALSE" == res){
					alert("对不起，操作失败。");
				}
				else{
					alert("删除成功");
					loadgrouplist();
				}
			});
		});
	}
}

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","基本信息","/images/menu_icon/form.png",{
		click:function(){
			da("#pad_list").hide();
			da("#pad_grouplist").hide();
			da("#pad_powertree").hide();
			da("#pad_menutree").hide();
			da("#pad_info").show();
		}
	});

	daTab0.appendItem("item02","包含人员","/images/menu_icon/user.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_grouplist").hide();
			da("#pad_powertree").hide();
			da("#pad_menutree").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.appendItem("item03","包含工作组","/images/menu_icon/group.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_powertree").hide();
			da("#pad_menutree").hide();
			da("#pad_grouplist").show();
		}
	});
	daTab0.appendItem("item04","角色权限","/images/menu_icon/power.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_grouplist").hide();
			da("#pad_menutree").hide();
			da("#pad_powertree").show();
		}
	});
	daTab0.appendItem("item05","角色导航菜单","/images/menu_icon/menu.png",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_grouplist").hide();
			da("#pad_powertree").hide();
			da("#pad_menutree").show();
		}
	});
	daTab0.click("item04");
}

daLoader("daDate,daMsg,daTab,daTable,daWin", function(){
	//daUI();
	/*页面加载完毕*/
	$(document).ready(function(){
		loadtab();
		loadroletree();
	});
	
	$( "#pr_date" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true
	});
});

//-->