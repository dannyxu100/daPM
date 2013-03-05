var g_tbname;

var setting = {
	data: {
		simpleData: {
			enable: true
		}
	},
	callback: {
		beforeMouseUp: clicknode
	}
};


/**创建用户自定义表单
*/
function addform(){
	daWin({
		width: 800,
		height: 600,
		url: "/sys_userform/table_add_item.htm",
		title: "创建数据表",
		back: function(){
			loadtablelist();
		}
	});
}


/**加载数据表的字段结构
*/
function loadcolumns(){
	//加载工作组人员列表
	daTable({
		id: "tb_fldlist",
		url: "/sys_userform/action/tbcolumns_get_page.php",
		data: {
			dataType: "json",
			tbname: g_tbname,
			opt: "qry"
		},
		//loading: false,
		//page: false,
		pageSize: 50,
		
		field: function( fld, val, row, ds ){
			if("COLUMN_KEY"== fld && "PRI" == val){
				return '<img src="/sys_power/images/key.png"/>';
			}
			if("EXTRA"== fld && "auto_increment" == val){
				return '<img src="/sys_power/images/tick.png"/>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();
}

function loadinfo(){
	da.runDB("/sys_userform/action/table_get_item.php",{
		dataType: 'json',
		tbname: g_tbname
	},
	function(res){
		if("FALSE"!= res){
			for(var fld in res){
				if("tbsize"==fld){			//占用空间单位转为MB;
					da("#"+fld).val((res[fld]/1024/1024).toFixed(2));
				}
				else{
					da("#"+fld).val(res[fld]);
				}
			}
			
			da("#tbtitle").text(res.tbremark);
		}
	});
}

function clicknode( treeId, treeNode ){
	g_tbname = treeNode.id;
	
	loadinfo();
	loadcolumns();
}

function loadtablelist(){
	da.runDB("/sys_userform/action/table_get_list.php",{
		dataType: 'json',
		dbnames: "('da_powersys', 'da_workflow', 'da_bizform', 'da_userform', 'PM')"
	},function(data){
		if("FALSE" != data){
			var zNodes = [], db = "";
			
			for(var i=0; i<data.length; i++){
				if( db != data[i].dbname ){		//创建数据库父节点
					db = data[i].dbname;
				
					zNodes.push({
						id: db,
						pId: 0,
						name: db,
						open: "da_userform"==db?true:false
					});
				}
			
				zNodes.push({
					id: data[i].tbname,
					pId: data[i].dbname,
					name: data[i].tbname,
					open: true
				});
			}
			
			$.fn.zTree.init($("#dbtree"), setting, zNodes);
			da(da(".bt_menu").dom[0]).click();
		}
	});
}

/**加载分页按钮
*/
function loadtab(){
	var daTab0 = daTab(da("#tabbar").dom[0],"daTab0","myname","",true);
	daTab0.appendItem("item01","基本信息","",{
		click:function(){
			da("#pad_fldlist").hide();
			da("#pad_info").show();
		}
	});

	daTab0.appendItem("item02","表结构","",{
		click:function(){
			da("#pad_info").hide();
			da("#pad_fldlist").show();
		}
	});
	
	daTab0.click("item01");
}

daLoader("daMsg,daTab,daWin,daTable", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
		loadtablelist();
		loadtab();
	});
});

//-->