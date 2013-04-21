
var g_bttid = "";

function saveform(){
	da.runDB("action/biztemplet_add_item.php",{
		bt_bttid: g_bttid,
		bt_name: da("#bt_name").val(),
		bt_sort: da("#bt_sort").val(),
		bt_remark: da("#bt_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_bttid = arrParam["bttid"];

});