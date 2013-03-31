var g_curoid = "";

var setting = {
	view: {
		selectedMulti: false
	},
	data: {
		key: {
			title:"t"
		},
		simpleData: {
			enable: true
		}
	},
	callback: {
		// beforeMouseDown: beforeMouseDown,
		// beforeMouseUp: beforeMouseUp,
		// beforeRightClick: beforeRightClick,
		// onMouseDown: onMouseDown,
		onMouseUp: onMouseUp,
		// onRightClick: onRightClick
	}
};

// function beforeMouseDown(treeId, treeNode) {
	// return (!treeNode || treeNode.down != false);
// }
// function onMouseDown(event, treeId, treeNode) {

// }
// function beforeMouseUp(treeId, treeNode) {
	// return (!treeNode || treeNode.up != false);
// }
function onMouseUp(event, treeId, treeNode) {
	g_curoid = treeNode.id;
	loaduserlist();
}
// function beforeRightClick(treeId, treeNode) {
	// return (!treeNode || treeNode.right != false);
// }
// function onRightClick(event, treeId, treeNode) {

// }


/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "action/org_get_list.php",
	   dataType: "json",
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


function adduser(){
	if(""==g_curoid){
		alert("请先选择部门。");
		return;
	}

	daWin({
		width: 400,					//窗口宽
		height: 600,				//窗口高
		url: "/sys_power/user_add.php?oid="+ g_curoid,	//url地址
		title: "添加人员",			//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaduserlist();
		}
	});

}

function updateuser(puid){
	daWin({
		width: 400,					//窗口宽
		height: 600,				//窗口高
		url: "/sys_power/user_update.php?puid="+puid,		//url地址
		title: "修改人员信息",								//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loaduserlist();
			debugger;
		}
	});
}

function loaduserlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	if( g_curoid ){
		data1.pu_oid = g_curoid;
	}

	daTable({
		id: "tb_list",
		url: "/sys_power/action/user_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
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


/*页面加载完毕*/
$(document).ready(function(){
	loadtree();
});


daLoader("daMsg,daTable,daWin", function(){
	//da.out("加载成功");

	da(function(){
		//alert(1);
	});
});
//-->