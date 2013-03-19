
var g_wftid = "",
	g_wfid = "",
	g_wfname = "";

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
		da.runDB("action/workflowtype_get_list.php",{			//检查是否拥有下级部门
			wftpid: treeNode.id
		},
		function(res){debugger;
			if('FALSE'==res){
				da.runDB("action/workflowtype_delete_item.php",{
					wftid: treeNode.id
				},
				function(res){
					debugger;
					if("FALSE"==res){
						alert("操作失败");
						loadtree();
					}
				},
				function(a,b,c){
					debugger;
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

		da.runDB("action/workflowtype_add_item.php",{
			pid: treeNode.id,
			name: "新建工作流类型"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建工作流类型"});
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
	g_wftid = treeNode.id;
	da("#wft_title").html(treeNode.name);
	
	da("#pad_config").hide();
	loadworkflowlist();
}

/**加载路由向弧列表
*/
function loadarc(){
	daTable({
		id: "tb_arclist",
		url: "/sys_workflow/action/arc_get_page.php",
		data: {
			dataType: "json",
			wfid: g_wfid,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 50,
		
		field: function( fld, val, row, ds ){
			if("a_direction"==fld ){
				return "IN"==val?'<div style="width:30px;height:15px;background:url(/images/to_right.jpg)"></div>':
				'<div style="width:30px;height:15px;background:url(/images/to_left.jpg)"></div>';
			}
			else if("a_type"==fld ){
				return "SEQ"==val?"一般顺序流类型":
				"Explicit Or Split"==val?"显示条件分支":
				"Implicit Or Split"==val?"隐式条件分支":
				"Or Join"==val?"条件汇聚":
				"And Split"==val?"并行分支":"并行汇聚";
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

/**加载事务变迁列表
*/
function loadtran(){
	daTable({
		id: "tb_tranlist",
		url: "/sys_workflow/action/tran_get_page.php",
		data: {
			dataType: "json",
			wfid: g_wfid,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 50,
		
		field: function( fld, val, row, ds ){
			if("t_type"==fld ){
				return "USER"==val?"人工操作":"AUTO"==val?"自动执行":"TIME"==val?"限时触发":"消息触发";
			}
			if("t_name"==fld){
				return '<a href="javascript:void(0)" onclick="updatetran('+ row.t_id +')">'+ row.t_name +'</a>';
			}
			else if( "t_rolename" == fld ){
				return '<a href="javascript:void(0)" onclick="selectrole('+ row.t_id +', this)">'+ (val?val:"空") +'</a>';
			}
			else if( "t_formname" == fld ){
				return '<a href="javascript:void(0)" onclick="selectform('+ row.t_id +', this)">'+ (val?val:"空") +'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
	
}
/**加载库所列表
*/
function loadplace(){
	daTable({
		id: "tb_placelist",
		url: "/sys_workflow/action/place_get_page.php",
		data: {
			dataType: "json",
			wfid: g_wfid,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 50,
		
		field: function( fld, val, row, ds ){
			if("checkbox"==fld){
				if( "1"!=row.p_type && "999"!=row.p_type ){		//起点、终点库所不能被删除
					return '<input type="checkbox" name="chkitem" value="'+ row.p_id +'" />';
				}
			}
			if("p_name"==fld){
				if( "1"!=row.p_type && "999"!=row.p_type ){		//起点、终点库所不能被删除
					return '<a href="javascript:void(0)" onclick="updateplace('+ row.p_id +')">'+ row.p_name +'</a>';
				}
			}
			else if("p_type"==fld ){
				return "1"==val?"起点库所":"999"==val?"终点库所":"过程";
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		},
		error: function(code,msg,ex){
			//debugger;
		}
	}).load();
}
/**加载工作流基本信息
*/
function loadinfo(){
	da.runDB("action/workflow_get_item.php",{
		dataType: "json",
		wf_id: g_wfid
	},function(res){
		if("FALSE"!= res){
			for(var fld in res){
				da("#"+fld).val(res[fld]);
			}
			
			da("[name=wf_isrun][value="+ res.wf_isrun +"]").attr("checked",true).dom[0].checked=true;
			g_editor.html(res.wf_remark);
		}
	});
}

/**加载工作流信息
*/
function loadworkflow(wfid, obj){
	da("#pad_config").show();
	
	var daObj = da(obj);
	g_wfid = wfid;
	g_wfname = daObj.text();
	da(".curmenu").removeClass("curmenu");
	daObj.addClass("curmenu");
	

	loadinfo();
	loadplace();
	loadtran();
	loadarc();
}

/**加载某工作流类型下的所有工作流
*/
function loadworkflowlist(){
	da("#workflowlist").empty();
		
	da.runDB("/sys_workflow/action/workflow_get_list.php",{
		dataType: "json",
		wftid: g_wftid
		
	},function(data){
		if("FALSE" != data){
			for( var i=0; i<data.length; i++ ){
				//delegate
				da("#workflowlist").append('<a href="javascript:void(0)" class="bt_menu" style="float:left;" onclick="loadworkflow('+ data[i].wf_id +', this)">'+ (i+1)+"、"+data[i].wf_name +'</a>');
			}
			
			da(da(".bt_menu").dom[0]).click();
		}
	});
}

/**为事务变迁 选择执行角色
*/
function selectrole( tid, obj ){
	daWin({
		width: 400,
		height:400,
		url: "/sys_power/plugin/select_role.htm?ismulti=true",
		back: function( data ){
			var rids = "", rnames = "";
			
			for( var k in data ){
				rids += k +",";
				rnames += data[k].pr_name +",";
			}
			
			da.runDB("/sys_workflow/action/tran2role_update_list.php",{
				rids: rids,
				rnames: rnames,
				tid: tid
			},function(res){
				if("FALSE"!=res){
					da(obj).text(rnames?rnames:"空");
				}
			});
			
		}
	});
}

/**为事务变迁 选择执行相关表单
*/
function selectform( tid, obj ){
	daWin({
		width: 600,
		height:400,
		url: "/sys_bizform/plugin/select_biztemplet.htm?ismulti=true",
		back: function( data ){
			var btids = "", btnames = "";
			
			for( var k in data ){
				btids += k +",";
				btnames += data[k].bt_name +",";
			}
			
			da.runDB("/sys_workflow/action/tran2form_update_list.php",{
				btids: btids,
				btnames: btnames,
				tid: tid
			},function(res){debugger;
				if("FALSE"!=res){
					da(obj).text(btnames?btnames:"空");
				}
			});
			
		}
	});
}

/**为工作流 选择主表单
*/
function selectmainform(){
	daWin({
		width: 600,
		height:400,
		url: "/sys_bizform/plugin/select_biztemplet.htm",
		back: function( data ){
			var btid = "", btname = "";
			
			for( var k in data ){
				btid = k;
				btname = data[k].bt_name;
			}
			
			da.runDB("/sys_workflow/action/workflow_update_btid.php",{
				btid: btid,
				btname: btname,
				wfid: g_wfid
			},function(res){
				da("#wf_btid").val(btid?btid:"");
				da("#wf_btname").val(btname?btname:"");
			});
			
		}
	});
}

/**新建工作流路由向弧
*/
function addarc(){
	if( "" == g_wfid ){
		alert("请先选择一个工作流。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: g_wfname +"> 新建路由向弧",
		url: "/sys_workflow/arc_add.php?wfid="+ g_wfid,
		after: function(){
			loadarc();
		}
	});
}
/**新建工作流事务变迁
*/
function addtran(){
	if( "" == g_wfid ){
		alert("请先选择一个工作流。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: g_wfname +"> 新建事务变迁",
		url: "/sys_workflow/tran_add.php?wfid="+ g_wfid,
		after: function(){
			loadtran();
		}
	});
}
/**新建工作流库所
*/
function addplace(){
	if( "" == g_wfid ){
		alert("请先选择一个工作流。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: g_wfname +"> 新建库所",
		url: "/sys_workflow/place_add.php?wfid="+ g_wfid,
		after: function(){
			loadplace();
		}
	});
}

/**新建工作流
*/
function addworkflow(){
	if( "" == g_wftid ){
		alert("请先点击选择，工作流类型。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: da("#wft_title").text() +"> 新建工作流",
		url: "/sys_workflow/workflow_add.php?wftid="+ g_wftid,
		after: function(){
			loadworkflowlist();
		}
	});
}

/**修改工作流事务变迁
*/
function updatetran( tid ){
	daWin({
		width: 550,
		height: 450,
		title: g_wfname +"> 修改事务变迁",
		url: "/sys_workflow/tran_update.php?wfid="+ g_wfid +"&tid="+ tid,
		after: function(){
			loadplace();
		}
	});
}

/**修改工作流库所
*/
function updateplace( pid ){
	daWin({
		width: 550,
		height: 450,
		title: g_wfname +"> 修改库所",
		url: "/sys_workflow/place_update.php?wfid="+ g_wfid +"&pid="+ pid,
		after: function(){
			loadplace();
		}
	});
}

/** 修改工作流信息
*/
function updateworkflow(){
	// 将编辑器的HTML数据同步到textarea
	KindEditor.sync('#wf_remark');
	
	da.runDB("/sys_workflow/action/workflow_update_item.php",{
		wf_id: g_wfid,
		wf_name: da("#wf_name").val(),
		wf_sort: da("#wf_sort").val(),
		wf_isrun: da("[name=wf_isrun]:checked").val(),
		wf_starttaskid: da("#wf_starttaskid").val(),
		wf_user: da("#wf_user").val(),
		wf_date: da("#wf_date").val(),
		wf_edituser: da("#wf_edituser").val(),
		wf_editdate: da("#wf_editdate").val(),
		wf_remark: da("#wf_remark").val()
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	});
}


/** 修改工作流类型信息
*/
function updateworkflowtype(){
	daWin({
		width: 550,
		height: 400,
		url: "/sys_workflow/workflowtype_update.php?wftid="+ g_wftid,
		after: function(){
			loadtree();
		}
	});
}


/*加载左边部门数据*/
function loadtree(){
	da.runDB("action/workflowtype_get_list.php",{
	   dataType: "json"
	},
	function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].wft_id,
				pId: data[i].wft_pid,
				name: data[i].wft_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
   });
}

function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","工作流基本信息","",{
		click:function(){
			da("#pad_placelist").hide();
			da("#pad_tranlist").hide();
			da("#pad_arclist").hide();
			//da("#pad_map").hide();
			da("#pad_workflow").show();
			
			loadinfo();
		}
	});

	// daTab0.appendItem("item02","流程图","",{
		// click:function(){
			// da("#pad_tranlist").hide();
			// da("#pad_arclist").hide();
			// da("#pad_workflow").hide();
			// da("#pad_placelist").hide();
			// da("#pad_map").show();
		// }
	// });
	
	daTab0.appendItem("item03","库所节点","",{
		click:function(){
			da("#pad_tranlist").hide();
			da("#pad_arclist").hide();
			da("#pad_workflow").hide();
			//da("#pad_map").hide();
			da("#pad_placelist").show();
			
			loadplace();
		}
	});
	
	daTab0.appendItem("item04","事务变迁节点","",{
		click:function(){
			da("#pad_placelist").hide();
			da("#pad_arclist").hide();
			da("#pad_workflow").hide();
			//da("#pad_map").hide();
			da("#pad_tranlist").show();
			
			loadtran();
		}
	});
	daTab0.appendItem("item05","路由向弧","",{
		click:function(){
			da("#pad_placelist").hide();
			da("#pad_tranlist").hide();
			da("#pad_workflow").hide();
			//da("#pad_map").hide();
			da("#pad_arclist").show();
			
			loadarc();
		}
	});
	daTab0.click("item01");
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	KindEditor.ready(function(K) {
		g_editor = K.create('#wf_remark', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
};

daLoader("daDate,daMsg,daTab,daTable,daWin,daButton", function(){
	//daUI();
	loadeditor();
	
	/*页面加载完毕*/
	da(function(){
		loadtree();
		loadtab();
		
		da("#pad_config").hide();
	});
});

//-->