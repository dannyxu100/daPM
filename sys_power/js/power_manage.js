
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
	
	if(confirm("确认删除部门【" + treeNode.name + "】吗？")){
		da.runDB("action/org_get_list.php",{			//检查是否拥有下级部门
			popid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("action/org_delete_item.php",{
				 oid: treeNode.id
				},
				function(res){
					if("FALSE"==res){
						alert("操作失败");
						loadtree();
					}
				});
			}
			else{
				alert("对不起，【" + treeNode.name + "】拥有下属部门，请先删除下属部门。");
				loadtree();
			}
		});
	
		return true;
	}
	else{
		return false;
	}
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

		da.runDB("action/power_add_item.php",{
			pid: treeNode.id,
			name: "新建权限模块"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建权限模块"});
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
	da.runDB("action/power_get_list.php",{
		dataType: "json",
		ppid: treeNode.id
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});

}

/** 修改部门信息
*/
function updatepower(){
	$.ajax({
		url: "action/power_update_item.php",
		type: "POST",
		data: {
			ppid: da("#pp_id").val(),
			ppname: da("#pp_name").val(),
			ppcode: da("#pp_code").val(),
			ppsort: da("#pp_sort").val(),
			ppdate: da("#pp_date").val(),
			ppremark: da("#pp_remark").val()
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

/*加载左边部门数据*/
function loadtree(){
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
			
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$("#selectAll").bind("click", selectAll);
	   }
	 });
}

/*页面加载完毕*/
$(document).ready(function(){
	loadtree();
});


daLoader("daUI,daDate,daMsg", function(){
	//daUI();
	$( "#pp_date" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  onClose: function( selectedDate ) {
		$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
});

//-->