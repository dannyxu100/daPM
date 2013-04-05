
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
	
	confirm("确认删除部门【" + treeNode.name + "】吗？", 
	function(){
		da.runDB("action/menu_get_list.php",{			//检查是否拥有下级部门
			pmpid: treeNode.id
		},
		function(res){
			if('FALSE'==res){
				da.runDB("action/menu_delete_item.php",{
				 pmid: treeNode.id
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

		da.runDB("action/menu_add_item.php",{
			pid: treeNode.id,
			name: "新建菜单"
		},
		function(res){debugger;
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建菜单"});
			}
		},
		function(code,msg,ex){
			debugger;
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
	da.runDB("action/menu_get_list.php",{
		dataType: "json",
		pmid: treeNode.id
	},
	function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
			
			da("#pm_img_view").attr("src",res[0].pm_img);
		}
	});

}

/** 修改部门信息
*/
function updatemenu(){
	da.runDB("action/menu_update_item.php",{
		pmid: da("#pm_id").val(),
		pmname: da("#pm_name").val(),
		pmlevel: da("#pm_level").val(),
		pmsort: da("#pm_sort").val(),
		pmurl: da("#pm_url").val(),
		pmimg: da("#pm_img").val(),
		pmremark: da("#pm_remark").val()
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

/*加载左边部门数据*/
function loadtree(){
	da.runDB("action/menu_get_list.php",{
		dataType: "json",
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
		
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		
	});
}




daLoader("daMsg,daDate,daWin", function(){
	//daUI();
	$( "#pp_date" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  onClose: function( selectedDate ) {
		$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
	
	/*页面加载完毕*/
	da(function(){
		loadtree();
	});
});

//-->