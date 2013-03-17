var g_htid = "";

var setting = {
	view: {
		addHoverDom: addHoverDom,
		removeHoverDom: removeHoverDom,
		selectedMulti: false
	},
	edit: {
		enable: true,
		editNameSelectAll: true
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

function beforeEditName(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treehelpertype");
	zTree.selectNode(treeNode);
	return true; //confirm("进入【" + treeNode.name + "】的编辑状态吗？");
}
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treehelpertype");
	zTree.selectNode(treeNode);
	
	confirm("确认删除分类【" + treeNode.name + "】吗？",
	function(){
		da.runDB("/sys_setting/helper/action/helpertype_get_list.php",{			//检查是否拥有下级部门
			htpid: treeNode.id
		},
		function(res){debugger;
			if('FALSE'==res){
				da.runDB("/sys_setting/helper/action/helpertype_delete_item.php",{
				 htid: treeNode.id
				},
				function(res){
					if("FALSE"==res){
						alert("操作失败");
						loadtree();
					}
				});
			}
			else{
				alert("对不起，【" + treeNode.name + "】拥有子分类，请先删除子分类。");
				loadtree();
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
	if (newName.length == 0) {
		alert("节点名称不能为空.");
		var zTree = $.fn.zTree.getZTreeObj("treehelpertype");
		zTree.editName(treeNode)
		// setTimeout(function(){zTree.editName(treeNode)}, 10);
		return false;
	}
	else{
		da.runDB("/sys_setting/helper/action/helpertype_update_item.php",{
			htid: treeNode.id,
			htname: newName
		},
		function(res){
			if("FALSE"==res){
				alert("操作失败");
				loadtree();
			}
		});
	}
	return true;
}
function onRename(e, treeId, treeNode) {

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
		var zTree = $.fn.zTree.getZTreeObj("treehelpertype");

		da.runDB("/sys_setting/helper/action/helpertype_add_item.php",{
			htpid: treeNode.id,
			name: "新建分类"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建分类"});
			}
		});
		
		return false;
	});
};
/*移除节点*/
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.id).unbind().remove();
};


/**添加可选项
*/
function addhelper(){
	if(""==g_htid){
		alert("请先选择分类。");
		return;
	}

	goto("/sys_setting/helper/helper_add.php?htid="+ g_htid);
	// daWin({
		// width: 850,
		// height: 600,
		// url: "/sys_setting/helper/helper_add.php?htid="+ g_htid,
		// title: "新添加帮助文档",
		// after: function(){
			// loadlist();
		// }
	// });
}

/**删除可选项
*/
function deletehelper(){
	if(!g_htid){
		alert("请先选择分类。");
		return;
	}
	
	var hids = [];
	da("[name=chkitem]:checked").each(function(){
		hids.push(this.value);
	});
	
	if( hids ){
		confirm("确认删除选中的文档吗？",function(){
			da.runDB("/sys_setting/helper/action/helper_delete_list.php",{
				htid: g_htid,
				hids: hids.join(",")
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

/**显示帮助文档详细信息
*/
function updatehelper(hid){
	goto("/sys_setting/helper/helper_update.php?hid="+ hid);
	// daWin({
		// width: 850,
		// height: 600,
		// url: "/sys_setting/helper/helper_update.php?hid="+ hid,
		// title: "修改帮助文档"
	// });
}

/**显示帮助文档详细信息
*/
function viewhelper(hid){
	daWin({
		width: 850,
		height: 600,
		url: "/sys_setting/helper/helper_view.php?hid="+ hid,
		title: "查看帮助文档"
	});
}

/**加载可选项列表
*/
function loadlist(){
	daTable({
		id: "tb_list",
		url: "/sys_setting/helper/action/helper_get_page.php",
		data: {
			dataType: "json",
			// opt: "qry",
			htid: g_htid
		},
		//loading: false,
		//page: false,
		pageSize: 50,
		
		field: function( fld, val, row, ds ){
			if( "h_name" == fld ){
				return '<a href="javascript:void(0)" onclick="viewhelper('+ row["h_id"] +')">'+ val +'</a>';
			}
			if( "tools" == fld ){
				return '<a href="javascript:void(0)" onclick="updatehelper('+ row["h_id"] +')">编辑</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

/**加载分类基本信息
*/
function loadinfo(){
	da.runDB("/sys_setting/helper/action/helpertype_get_item.php",{
		dataType: "json",
		htid: g_htid
	},
	function(res){
		if("FALSE"!= res){
			for(var fld in res){
				da("#"+fld).val(res[fld]);
			}
		}
	});
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_htid = treeNode.id;

	loadinfo();
	loadlist();
}

/** 修改部门信息
*/
function updatehelpertype(){
	da.runDB("/sys_setting/helper/action/helpertype_update_item.php",{
		htid: da("#ht_id").val(),
		htname: da("#ht_name").val(),
		htcode: da("#ht_code").val(),
		htsort: da("#ht_sort").val(),
		htremark: da("#ht_remark").val()
	},
	function(res){
		if(res=="FALSE"){
			alert("对不起，修改失败。");
		}
		else{
			alert("修改成功。");
		}
		loadtree();
	},
	function(code,msg,ex){
		// debugger;
	});
}

/*加载左边部门数据*/
function loadtree(){
	da.runDB("/sys_setting/helper/action/helpertype_get_list.php",{
		dataType: "json",
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].ht_id,
				pId: data[i].ht_pid,
				name: data[i].ht_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treehelpertype"), setting, zNodes);
		
	});
}

/**分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","分类基本信息","",{
		click:function(){
			da("#pad_list").hide();
			da("#pad_type").show();
		}
	});

	daTab0.appendItem("item02","文档列表","",{
		click:function(){
			da("#pad_type").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.click("item02");
}


daLoader("daMsg,daTab,daTable,daIframe,daWin", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
		loadtab();
		loadtree();
	});
});
