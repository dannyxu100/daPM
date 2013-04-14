var g_ntid = "";

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
	var zTree = $.fn.zTree.getZTreeObj("treenoticetype");
	zTree.selectNode(treeNode);
	return true; //confirm("进入【" + treeNode.name + "】的编辑状态吗？");
}
function beforeRemove(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj("treenoticetype");
	zTree.selectNode(treeNode);
	
	confirm("确认删除分类【" + treeNode.name + "】吗？",
	function(){
		da.runDB("/sys_common/notice/action/noticetype_get_list.php",{			//检查是否拥有下级部门
			ntpid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("/sys_common/notice/action/noticetype_delete_item.php",{
					ntid: treeNode.id
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
	className = (className === "dark" ? "":"dark");
	if (newName.length == 0) {
		alert("节点名称不能为空.");
		var zTree = $.fn.zTree.getZTreeObj("treenoticetype");
		zTree.editName(treeNode)
		// setTimeout(function(){zTree.editName(treeNode)}, 10);
		return false;
	}
	else{
		da.runDB("/sys_setting/item/action/itemtype_update_item.php",{
			itid: treeNode.id,
			itname: newName
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
		var zTree = $.fn.zTree.getZTreeObj("treenoticetype");

		da.runDB("/sys_common/notice/action/noticetype_add_item.php",{
			ntpid: treeNode.id,
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
function addnotice(){
	if(""==g_ntid){
		alert("请先选择分类。");
		return;
	}

	daWin({
		width: 800,
		height: 600,
		url: "/sys_common/notice/notice_add.php?ntid="+ g_ntid,
		title: "新建通知公告",
		after: function(){
			loadlist();
		}
	});
}

/**删除可选项
*/
function deletenotice(){
	if(!g_ntid){
		alert("请先选择分类。");
		return;
	}
	
	var iids = [];
	da("[name=chkitem]:checked").each(function(){
		iids.push(this.value);
	});
	
	if( iids ){
		confirm("确认删除选中的可选项吗？",function(){
			da.runDB("/sys_common/notice/action/notice_delete_list.php",{
				itid: g_ntid,
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

/**查看通知公告详细信息
*/
function viewnotice(nid){
	daWin({
		width: 800,
		height: 600,
		title: "通知公告详细信息",
		url: "/sys_common/notice/notice_detail.php?nid="+ nid,
		after: function(){
		
		}
	});
}

function closenotice(obj, nid){
	da.runDB("/sys_common/notice/action/notice_update_status.php",{
		nid: nid,
		status: "CLOSE"
		
	},function(res){
		if("FALSE" != res){
			alert("禁用成功");
			loadlist();
		}
	});
}

function opennotice(obj, nid){
	da.runDB("/sys_common/notice/action/notice_update_status.php",{
		nid: nid,
		status: "OPEN"
		
	},function(res){
		if("FALSE" != res){
			alert("启用成功");
			loadlist();
		}
	});
}

/**加载通知公告列表
*/
function loadlist(){
	daTable({
		id: "tb_list",
		url: "/sys_common/notice/action/notice_get_page.php",
		data: {
			dataType: "json",
			ntid: g_ntid
		},
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			if( "n_title" == fld ){
				val = '<a href="javascript:void(0)" onclick="viewnotice('
				+ row.n_id +')" title="'+ row.n_subhead +'">'+ val +'</a>';
			}
			else if( "tools" ==fld){
				if( "OPEN" == row.n_status ){
					val = '<a href="javascript:void(0)" onclick="closenotice(this,'+ row.n_id +')">已启用</a>';
				}
				else{
					val = '<a href="javascript:void(0)" style="color:#f00;" onclick="opennotice(this,'+ row.n_id +')">已禁用</a>';
				}
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
			autoframeheight();
		},
		error: function(code,msg,ex){
			debugger;
		}
	}).load();
}

/**加载分类基本信息
*/
function loadinfo(){
	da.runDB("/sys_common/notice/action/noticetype_get_item.php",{
		dataType: "json",
		ntid: g_ntid
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
	g_ntid = treeNode.id;

	loadinfo();
	loadlist();
}

/** 修改公告分类基本信息
*/
function updatenoticetype(){
	da.runDB("/sys_common/notice/action/noticetype_update_item.php",{
		ntid: da("#nt_id").val(),
		ntname: da("#nt_name").val(),
		ntcode: da("#nt_code").val(),
		ntsort: da("#nt_sort").val(),
		ntremark: da("#nt_remark").val()
	},
	function(res){
		if(res=="FALSE"){
			alert("对不起，修改失败。");
		}
		else{
			alert("修改成功。");
		}
		loadtree();
	});
}

/**加载公告分类树
*/
function loadtree(){
	da.runDB("/sys_common/notice/action/noticetype_get_list.php",{
		dataType: "json"
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].nt_id,
				pId: data[i].nt_pid,
				name: data[i].nt_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treenoticetype"), setting, zNodes);
		
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

	daTab0.appendItem("item02","公告列表","",{
		click:function(){
			da("#pad_type").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.click("item02");
}


daLoader("daMsg,daTab,daTable,daWin,daIframe", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
		loadtab();
		loadtree();
	});
});
