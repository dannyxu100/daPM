
var g_bftid = "",
	g_bfid = "",
	g_bfname = "";

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

		da.runDB("action/bizformtype_add_item.php",{
			pid: treeNode.id,
			name: "新建表单分类"
		},
		function(res){
			if("FALSE"!=res){
				zTree.addNodes(treeNode, {id:res, pId:treeNode.id, name:"新建表单分类"});
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
	g_bftid = treeNode.id;
	
	da("#pad_config").hide();
	da("#bft_title").html(treeNode.name);

	loadformlist();
}

/**加载表单基本信息
*/
function loadinfo(){
	da.runDB("action/bizform_get_item.php",{
		dataType: "json",
		bf_id: g_bfid
	},function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
			
			g_editorList.html(decodeURI(res[0].bf_listhtml));
			g_editorForm.html(decodeURI(res[0].bf_formhtml));
		}
	});
}

/**加载表单信息
*/
function loadform(bfid, obj){
	da("#pad_config").show();
	
	var daObj = da(obj);
	g_bfid = bfid;
	g_bfname = daObj.text();
	da(".curmenu").removeClass("curmenu");
	daObj.addClass("curmenu");
	
	loadinfo();
}

/**加载某类型下的所有表单
*/
function loadformlist(){
	da("#formlist").empty();

	da.runDB("/sys_bizform/action/bizform_get_list.php",{
		dataType: "json",
		bftid: g_bftid
	},function(data){
		if("FALSE" != data){
			for( var i=0; i<data.length; i++ ){
				//delegate
				da("#formlist").append('<a href="javascript:void(0)" class="bt_menu" style="float:left;" onclick="loadform('+ data[i].bf_id +', this)">'+ (i+1)+"、"+data[i].bf_name +'</a>');
			}
			
			da(da(".bt_menu").dom[0]).click();
		}
	});
}

/**预览表单列表页
*/
function viewlisthtml(){
	daWin({
		width: 800,
		height:600,
		url: "/sys_bizform/view_bizformlist.php?bfid="+g_bfid
	});
}

/** 修改表单列表页代码
*/
function updatelisthtml(){
	da("#bf_listhtml").val(g_editorList.html());

	da.runDB("/sys_bizform/action/bizform_update_listhtml.php",{
		bf_id: g_bfid,
		bf_listhtml: encodeURI(da("#bf_listhtml").val())			//编码，避免读取的时候ajax转化为json出错
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	});
}

/** 修改表单详细页代码
*/
function updateformhtml(){
	da("#bf_formhtml").val(g_editorForm.html());
	
	da.runDB("/sys_bizform/action/bizform_update_formhtml.php",{
		bf_id: g_bfid,
		bf_formhtml: encodeURI(da("#bf_formhtml").val())			//编码，避免读取的时候ajax转化为json出错
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	});
}

/** 修改表单信息
*/
function updateform(){
	da.runDB("/sys_bizform/action/bizform_update_item.php",{
		bf_id: g_bfid,
		bf_name: da("#bf_name").val(),
		bf_sort: da("#bf_sort").val(),
		bf_remark: da("#bf_remark").val()
		
	},function(data){
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	});
}

/** 修改业务单类型信息
*/
function updateformtype(){
	daWin({
		width: 550,
		height: 400,
		url: "/sys_bizform/bizformtype_update.php?bftid="+ g_bftid,
		after: function(){
			loadtree();
		}
	});
}

/**添加新表单
*/
function addform(){
	if( "" == g_bftid ){
		alert("请先点击选择，表单类型。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: da("#bft_title").text() +"> 新建表单",
		url: "/sys_bizform/bizform_add.php?bftid="+ g_bftid,
		after: function(){
			loadformlist();
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
	
	var suids = "";
	da("[name=chkitem]:checked").each(function(){
		suids += this.value +",";
	});
	
	if( suids ){
		confirm("确认删除选中的人员吗？",function(){
			da.runDB("/sys_power/action/user2group_delete_list.php",{
				pgid: g_pgid,
				uids: suids
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
			da("#pad_form").hide();
			da("#pad_db").hide();
			da("#pad_info").show();
		}
	});

	daTab0.appendItem("item02","数据来源","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_form").hide();
			da("#pad_db").show();
		}
	});
	
	daTab0.appendItem("item03","列表页","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_form").hide();
			da("#pad_db").hide();
			da("#pad_list").show();
		}
	});
	
	daTab0.appendItem("item04","详细页","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_db").hide();
			da("#pad_form").show();
		}
	});
	daTab0.click("item01");
}

/**加载左边部门数据
*/
function loadtree(){
	da.runDB("action/bizformtype_get_list.php",{
	   dataType: "json"
	   
	},function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].bft_id,
				pId: data[i].bft_pid,
				name: data[i].bft_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	});
}

var g_editorList, g_editorForm;
/**加载在线编辑器
*/
function loadeditor(){
	KindEditor.ready(function(K) {
		g_editorList = K.create('#bf_listhtml', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
				'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
				'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
				'anchor', 'link', 'unlink', '/',
				'da_list_fld'
			]
		});
		g_editorForm = K.create('#bf_formhtml', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
				'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
				'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
				'anchor', 'link', 'unlink', '|'
			]
		});
	});
}

daLoader("daUI,daDate,daMsg,daTab,daTable,daWin", function(){
	//daUI();
	
	/*页面加载完毕*/
	$(function(){
		$("#pr_date" ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true
		});
		loadeditor();
	
		loadtree();
		loadtab();
		
		da("#pad_config").hide();
	});
});

//-->