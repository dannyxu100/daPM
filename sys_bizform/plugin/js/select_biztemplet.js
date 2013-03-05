var g_curbttid = "",
	g_ismulti = false;

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
		onMouseUp: onMouseUp
	}
};

function onMouseUp(event, treeId, treeNode) {
	g_curbttid = treeNode.id;
	loadformlist();
}

/*加载左边部门数据*/
function loadtree(){
	da.runDB("/sys_bizform/action/biztemplettype_get_list.php",{
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
		
		$.fn.zTree.init($("#formtypetree"), setting, zNodes);
	});
}


var g_ds = {};		//缓存数据

function loadformlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	if( g_curbttid ){
		data1.bttid = g_curbttid;
	}
	
	//考虑到多页选择，就不清楚缓存了。
	// g_ds = {};	//清除缓存数据
	daTable({
		id: "tb_list",
		url: "/sys_bizform/action/biztemplet_get_page.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 10,
		
		field: function( fld, val, row, ds ){
			if("checkbox" == fld){				//
				if(g_chkItems[row.bt_id]){		//判断是否被选过
					return '<input id="chkbox_'+ row.bt_id +'" type="checkbox" checked name="chklist" value="'+ row.bt_id +'"/>';
				}
				else{
					return '<input id="chkbox_'+ row.bt_id +'" type="checkbox" name="chklist" value="'+ row.bt_id +'"/>';
				}
			}
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
			if("bt_id"==fld){
				g_ds[val] = row;
			}
			// if("pu_name"==fld){
				// return '<a href="javascript:void(0)" onclick="updateuser('+row.pu_id+')">'+val+'</a>';
			// }
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();

}

var g_chkItems = {};
/**选择人员
*/
function selectitem( trObj ){
	var btid = da(trObj).attr("value"),
		chkObj = da("input[name=chklist]",trObj);

	if(chkObj.dom[0].checked){
		delete g_chkItems[btid];
		chkObj.dom[0].checked = false;
		chkObj.removeAttr("checked");
	}
	else{
		g_chkItems[btid] = g_ds[btid];
		chkObj.dom[0].checked = true;
		chkObj.attr("checked","true");
	}
	
	if(!g_ismulti){
		backitem();
	}
	
	showitem();
}

/**取消选中的人员
*/
function cancelitem( btid ){
	delete g_chkItems[btid];

	var chkObj = da("#chkbox_"+btid);
	if(0<chkObj.dom.length){
		chkObj.dom[0].checked = false;
		chkObj.removeAttr("checked");
	}
	
	showitem();
}

/**显示选中的人员
*/
function showitem(){
	var outObj = da("#out_pad"),
		strHTML = '';
		
	for( var k in g_chkItems ){
		strHTML += '<div class="item" ondblclick="cancelitem('+ g_chkItems[k].bt_id +')">'+ g_chkItems[k].bt_name +'</div>';
	}
	
	outObj.html(strHTML);
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


daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	da(function(){
		arrParams = da.urlParams();
		g_ismulti = Boolean(arrParams["ismulti"]);
		
		loadtree();
	});
});
//-->