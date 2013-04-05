var g_prid = "",
	g_ismulti = false;

var setting = {
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		onMouseUp: onMouseUp,
	}
};

function onMouseUp(event, treeId, treeNode) {
	//loaduserlist( treeNode.id );
	selectitem(treeNode.id);
	
	if( !g_ismulti ){  		//单选直接返回结果
		backitem();
	}
}


var g_ds = {};		//缓存数据

/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "/sys_power/action/role_get_list.php",
	   dataType: "json",
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].pr_id,
					pId: data[i].pr_pid,
					data: data[i].pr_name,
					name: data[i].pr_name,
					open: true
				});
				
				g_ds[data[i].pr_id] = data[i];
			}
			$.fn.zTree.init($("#roletree"), setting, zNodes);
			autoframeheight();
	   }
	 });
}


var g_chkItems = {};
/**选择角色
*/
function selectitem( prid ){
	g_chkItems[prid] = g_ds[prid];
	showitem();
}

/**取消选中的角色
*/
function cancelitem( prid ){
	delete g_chkItems[prid];
	showitem();
}

/**显示选中的角色
*/
function showitem(){
	var outObj = da("#out_pad"),
		strHTML = '';
		
	for( var k in g_chkItems ){
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].pr_id +')">'+ g_chkItems[k].pr_name +'</div>';
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
function clearitem(){
	delete g_chkItems;
	g_chkItems = {};
	showitem();
}

daLoader("daMsg,daIframe", function(){
	arrParams = da.urlParams();
	g_prid = arrParams["prid"];
	g_ismulti = !!arrParams["ismulti"];
	//alert(g_prid);
	
	da(function(){
		loadtree();
	});

});
//-->