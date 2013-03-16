
var g_pgid = "";

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
	
	confirm("确认删除工作组【" + treeNode.name + "】吗？",
	function(){
		da.runDB("action/group_get_list.php",{			//检查是否拥有下级部门
			pgpid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("action/group_delete_item.php",{
					pgid: treeNode.id
				},
				function(res){
					if("FALSE"==res){
						alert("操作失败");
						loadtree();
					}
				});
			}
			else{
				alert("对不起，【" + treeNode.name + "】拥有子项，请先删除子项。");
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
					loadtree();
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

		da.runDB("action/group_add_item.php",{
			pid: treeNode.id,
			name: "新建工作组"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建工作组"});
			}
		});
		
		return false;
	});
};
/*移除节点*/
function removeHoverDom(treeId, treeNode) {
	$("#addBtn_"+treeNode.id).unbind().remove();
};
/**/
function selectAll() {
	var zTree = $.fn.zTree.getZTreeObj("treeDemo");
	zTree.setting.edit.editNameSelectAll =  $("#selectAll").attr("checked");
}

/**点击树节点事件
*/
function clicknode(treeId, treeNode){
	g_pgid = treeNode.id;

	//加载工作组基本信息
	da.runDB("action/group_get_list.php",{
		dataType: "json",
		pgid: treeNode.id
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});
	
	loaduserlist();
}

/**加载工作组下属人员信息列表
*/
function loaduserlist(){
	//加载工作组人员列表
	daTable({
		id: "tb_list",
		url: "action/user2group_get_page.php",
		data: {
			dataType: "json",
			pgid: g_pgid,
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
function updategroup(){
	$.ajax({
		url: "action/group_update_item.php",
		type: "POST",
		data: {
			pgid: da("#pg_id").val(),
			pgname: da("#pg_name").val(),
			pgsort: da("#pg_sort").val(),
			pgdate: da("#pg_date").val(),
			pgremark: da("#pg_remark").val()
		},
		success: function(res){
			if(res=="FALSE"){
				alert("对不起，修改失败。");
			}
			else{
				alert("修改成功。");
			}
			loadtree();
		}
	});
}

/**添加分组包含人员
*/
function addu2g(){
	if(!g_pgid){
		alert("请先选择中，任意工作组。");
		return;
	}

	daWin({
		width: 650,
		height: 500,
		url: "/sys_power/plugin/select_user.htm",
		back: function( data ){
			var suids = [];
			for(var k in data){
				suids.push(data[k].pu_id);
			}
			
			da.runDB("/sys_power/action/user2group_add_list.php",{
				pgid: g_pgid,
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

/**批量删除分组包含人员
*/
function deleteu2g(){
	if(!g_pgid){
		alert("请先选择中，任意工作组。");
		return;
	}
	
	var suids = [];
	da("[name=chkitem]:checked").each(function(){
		suids.push(this.value);
	});
	
	if( suids ){
		confirm("确认删除选中的人员吗？",function(){
			da.runDB("/sys_power/action/user2group_delete_list.php",{
				pgid: g_pgid,
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

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","基本信息","",{
		click:function(){
			da("#pad_list").hide();
			da("#pad_info").show();
		}
	});

	daTab0.appendItem("item02","所包含人员","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.click("item02");
}

/**加载左边部门数据
*/
function loadtree(){
	 $.ajax({
	   url: "action/group_get_list.php",
	   type: "POST",
	   dataType: "json",
	   error: function(msg){
		//da.out(msg.responseText);
	   },
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].pg_id,
					pId: data[i].pg_pid,
					name: data[i].pg_name,
					open: true
				});
			}
			
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$("#selectAll").bind("click", selectAll);
	   }
	 });
}


daLoader("daMsg,daTab,daTable,daWin", function(){
	//daUI();
	$( "#pr_date" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true
	});
	
	/*页面加载完毕*/
	$(document).ready(function(){
		loadtree();
		loadtab();
	});
});

//-->