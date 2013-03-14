
var g_itid = "";

function saveitem(){
	da.runDB("/sys_setting/item/action/item_add_item.php",{
		itid: g_itid,
		iname: da("#i_name").val(),
		ivalue: da("#i_value").val(),
		isort: da("#i_sort").val(),
		iremark: da("#i_remark").val()
	},function(res){debugger;
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_itid = arrParam["itid"];

});