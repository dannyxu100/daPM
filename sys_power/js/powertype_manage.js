function addpowertype(){
	daWin({
		width: 400,					//窗口宽
		height: 300,				//窗口高
		url: "/sys_power/powertype_add.php",		//url地址
		title: "添加权限类型",			//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loadlist();
		}
	});

}

function updatepowertype(ptid){
	daWin({
		width: 400,					//窗口宽
		height: 300,				//窗口高
		url: "/sys_power/powertype_update.php?ptid="+ptid,		//url地址
		title: "修改权限类型",								//caption标题
		// before: null,			//窗口内页加载前执行
		// load: null,				//窗口内页加载完毕执行
		// after: null,				//关闭窗口后执行
		after: function(data){		//窗体内页操作完毕返回数据执行
			loadlist();
		}
	});
}

function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	daTable({
		id: "tb_list",
		url: "/sys_power/action/powertype_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
			if("pt_name"==fld){
				return '<a href="javascript:void(0)" onclick="updatepowertype('+row.pt_id+')">'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();

}


daLoader("daTable,daWin", function(){
	//da.out("加载成功");

	da(function(){
		//alert(1);
		loadlist();
	});
});
//-->