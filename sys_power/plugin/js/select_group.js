var g_curgid = "";

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
		onMouseUp: onMouseUp
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

var g_chkItems = {};

function onMouseUp(event, treeId, treeNode) {
	g_curgid = treeNode.id;
	loaduserlist();

	g_chkItems[g_curgid] = g_ds[g_curgid];
	showitem();
}
// function beforeRightClick(treeId, treeNode) {
	// return (!treeNode || treeNode.right != false);
// }
// function onRightClick(event, treeId, treeNode) {

// }

var g_ds = {};		//缓存数据

/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "/sys_power/action/group_get_list.php",
	   dataType: "json",
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				g_ds[data[i].pg_id] = data[i];
				
				zNodes.push({
					id: data[i].pg_id,
					pId: data[i].pg_pid,
					name: data[i].pg_name,
					open: true
				});
			}
			$.fn.zTree.init($("#grouptree"), setting, zNodes);
	   }
	 });
}

function loaduserlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	if( g_curgid ){
		data1.pgid = g_curgid;
	}
	
	//考虑到多页选择，就不清楚缓存了。
	// g_ds = {};	//清除缓存数据
	daTable({
		id: "tb_list",
		url: "/sys_power/action/user2group_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 10,
		
		field: function( fld, val, row, ds ){
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
			autoframeheight();
		}
	}).load();

}


/**取消选中的工作组
*/
function cancelitem( pgid ){
	delete g_chkItems[pgid];

	showitem();
}

/**显示选中的工作组
*/
function showitem(){
	var outObj = da("#out_pad"),
		strHTML = '';
		
	for( var k in g_chkItems ){
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].pg_id +')">'+ g_chkItems[k].pg_name +'</div>';
	}
	
	outObj.html(strHTML);
	autoframeheight();
}

/**返回选择结果
*/
function backitem(){
	back(g_chkItems);
}

/**清除
*/
function clear(){
	
}


daLoader("daTable,daWin,daIframe", function(){
	//da.out("加载成功");
	da(function(){
		//alert(1);
		loadtree();
		loaduserlist();
	});
});
//-->