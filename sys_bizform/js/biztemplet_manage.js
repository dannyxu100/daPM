
var g_bttid = "",
	g_btid = "",
	g_btname = "";

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

		da.runDB("action/biztemplettype_add_item.php",{
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
	g_bttid = treeNode.id;
	
	da("#pad_config").hide();
	da("#btt_title").html(treeNode.name);

	loadformlist();
}

/**加载表单基本信息
*/
function loadinfo(){
	da.runDB("action/biztemplet_get_item.php",{
		dataType: "json",
		bt_id: g_btid
	},function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
			
			g_editorSearch.html(res[0].bt_listsearch);
			g_editorList.html(res[0].bt_listhtml);
			g_editorForm.html(res[0].bt_formhtml);
			da("#bt_listscript").val(res[0].bt_listscript);
			da("#bt_formscript").val(res[0].bt_formscript);

			loaddbsource(function(dbObj){		//加载数据源下拉
				dbObj.val(res[0].bt_dbsource);
				
				loaddbfld(function(fldObj){		//加载关联字段下拉
					fldObj.val(res[0].bt_dbfld);
				});	
			});
			
		}
	});
}

/**加载表单信息
*/
function loadform(btid, obj){
	da("#pad_config").show();
	
	var daObj = da(obj);
	g_btid = btid;
	g_btname = daObj.text();
	da(".curmenu").removeClass("curmenu");
	daObj.addClass("curmenu");
	
	loadinfo();
}

/**加载某类型下的所有表单
*/
function loadformlist(){
	da("#formlist").empty();

	da.runDB("/sys_bizform/action/biztemplet_get_list.php",{
		dataType: "json",
		bttid: g_bttid
	},function(data){
		if("FALSE" != data){
			for( var i=0; i<data.length; i++ ){
				//delegate
				da("#formlist").append('<a href="javascript:void(0)" class="bt_menu" style="float:left;" onclick="loadform('+ data[i].bt_id +', this)">'+ (i+1)+"、"+data[i].bt_name +'</a>');
			}
			
			da(da(".bt_menu").dom[0]).click();
		}
	},function(a,b,c){
		//debugger;
	});
}

/**预览表单列表页
*/
function viewlisthtml(){
	daWin({
		width: 800,
		height:600,
		url: "/sys_bizform/view_bizformlist.php?btid="+g_btid
	});
}

/** 修改表单列表页代码
*/
function updatelisthtml(){
	// 将编辑器的HTML数据同步到textarea
	g_editorSearch.sync();
	g_editorList.sync();

	da.runDB("/sys_bizform/action/biztemplet_update_listhtml.php",{
		dataType: "json",
		bt_id: g_btid,
		bt_listsearch: encodeURIComponent(da("#bt_listsearch").val()),
		bt_listhtml: encodeURIComponent(da("#bt_listhtml").val()),
		bt_listscript: encodeURIComponent(da("#bt_listscript").val())
		
	},function(data){
		// debugger;
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

/** 修改表单详细页代码
*/
function updateformhtml(){
	// 将编辑器的HTML数据同步到textarea
	g_editorForm.sync();
	
	da.runDB("/sys_bizform/action/biztemplet_update_formhtml.php",{
		dataType: "json",
		bt_id: g_btid,
		bt_formhtml: encodeURIComponent(da("#bt_formhtml").val()),
		bt_formscript: encodeURIComponent(da("#bt_formscript").val())
		
	},function(data){
		// debugger;
		if("FALSE" != data){
			alert("修改成功。");
		}
		else{
			alert("操作失败！");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

/** 修改数据源信息
*/
function updatesource(){
	da.runDB("/sys_bizform/action/biztemplet_update_dbsource.php",{
		dataType: "json",
		bt_id: g_btid,
		dbsource: da("#bt_dbsource").val(),
		dbfld: da("#bt_dbfld").val()
		
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
	da.runDB("/sys_bizform/action/biztemplet_update_item.php",{
		bt_id: g_btid,
		bt_name: da("#bt_name").val(),
		bt_sort: da("#bt_sort").val(),
		bt_remark: da("#bt_remark").val()
		
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
		url: "/sys_bizform/biztemplettype_update.php?bttid="+ g_bttid,
		after: function(){
			loadtree();
		}
	});
}

/**添加新表单
*/
function addform(){
	if( "" == g_bttid ){
		alert("请先点击选择，表单类型。");
		return;
	}

	daWin({
		width: 550,
		height: 450,
		title: da("#btt_title").text() +"> 新建表单",
		url: "/sys_bizform/biztemplet_add.php?bttid="+ g_bttid,
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

/**加载可选关联单
*/
function loadmixform(){
	var dbObj = da("#bt_mixfrom");
	dbObj.empty();
	dbObj.append('<option value="">空</option>');
	
}

/**联动加载数据源表对应的可选字段
*/
function loaddbfld(callback){
	var fldObj = da("#bt_dbfld");
	fldObj.empty();
	fldObj.append('<option value="">空</option>');
	
	da.runDB("/sys_userform/action/tbcolumns_get_list.php",{
		dataType: 'json',
		tbname: da("#bt_dbsource").val()
	},function(data){
		if("FALSE" != data){
			var key = "";
			
			for(var i=0; i<data.length; i++){
				if("PRI"==data[i].COLUMN_KEY){		//主键高亮
					fldObj.append('<option style="color:#f00;" value="'+ data[i].COLUMN_NAME +'">'+ data[i].COLUMN_NAME +'</option>');
					key = data[i].COLUMN_NAME;
				}
				else{
					fldObj.append('<option value="'+ data[i].COLUMN_NAME +'">'+ data[i].COLUMN_NAME +'</option>');
				}
			}
			
			if( "" != key ){		//有主键，默认选中主键
				fldObj.val(key);
			}
			
			callback(fldObj);
		}
	});
}

/**加载可选数据源表
*/
function loaddbsource(callback){
	var dbObj = da("#bt_dbsource");
	dbObj.empty();
	dbObj.append('<option value="">空</option>');
	
	da.runDB("/sys_userform/action/table_get_list.php",{
		dataType: 'json',
		dbnames: "da_userform"
	},function(data){
		if("FALSE" != data){
			for(var i=0; i<data.length; i++){
				dbObj.append('<option value="'+ data[i].tbname +'">'+ data[i].tbname +'</option>');
			}
			
			callback(dbObj);
		}
	});
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
			
			autoframeheight();
		}
	});

	daTab0.appendItem("item02","数据来源","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_form").hide();
			da("#pad_db").show();
			
			autoframeheight();
		}
	});
	
	daTab0.appendItem("item03","列表页","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_form").hide();
			da("#pad_db").hide();
			da("#pad_list").show();
			
			autoframeheight();
		}
	});
	
	daTab0.appendItem("item04","详细页","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_list").hide();
			da("#pad_db").hide();
			da("#pad_form").show();
			
			autoframeheight();
		}
	});
	daTab0.click("item01");
}

/**加载左边部门数据
*/
function loadtree(){
	da.runDB("action/biztemplettype_get_list.php",{
	   dataType: "json"
	   
	},function(data){
		var zNodes = [];
		for(var i=0; i<data.length; i++){
			zNodes.push({
				id: data[i].btt_id,
				pId: data[i].btt_pid,
				name: data[i].btt_name,
				open: true
			});
		}
		
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
	});
}

var g_editorSearch, g_editorList, 
	g_editorForm;
/**加载在线编辑器
*/
function loadeditor(){
	g_editorSearch = KindEditor.create('#bt_listsearch', {
		resizeType: 1,
		filterMode: false,		//不过滤危险标签
		newlineTag: "br",
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
	
	g_editorList = KindEditor.create('#bt_listhtml', {
		resizeType: 1,
		filterMode: false,		//不过滤危险标签
		newlineTag: "br",
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
	
	g_editorForm = KindEditor.create('#bt_formhtml', {
		resizeType : 1,
		filterMode : false,		//不过滤危险标签
		newlineTag: "br",
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
}

daLoader("daMsg,daTab,daTable,daIframe,daWin", function(){
	//daUI(); 
	
	/*页面加载完毕*/
	da(function(){
		$("#pr_date" ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true
		});
	
		loadtree();
		loadtab();
		loadeditor();
		
		da("#pad_config").hide();
	});
});
