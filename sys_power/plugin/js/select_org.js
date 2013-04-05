var g_poid = "";

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
	back(treeNode.id,treeNode.data);
}

/*加载左边部门数据*/
function loadtree(){
	 $.ajax({
	   url: "/sys_power/action/org_get_list.php",
	   dataType: "json",
	   success: function(data){
			var zNodes = [];
			for(var i=0; i<data.length; i++){
				zNodes.push({
					id: data[i].po_id,
					pId: data[i].po_pid,
					data: data[i].po_name,
					name: data[i].po_name,
					open: true
				});
			}
			$.fn.zTree.init($("#orgtree"), setting, zNodes);
			autoframeheight();
	   }
	 });
}


daLoader("daMsg,daIframe",function(){
	arrParams = da.urlParams();
	g_poid = arrParams["poid"];
	//alert(g_poid);
	
	da(function(){
		loadtree();
	});

});
//-->