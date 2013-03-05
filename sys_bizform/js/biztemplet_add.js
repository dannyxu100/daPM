
var g_bftid = "";

function saveform(){
	da.runDB("action/businessform_add_item.php",{
		bf_bftid: g_bftid,
		bf_name: da("#bf_name").val(),
		bf_sort: da("#bf_sort").val(),
		bf_remark: da("#bf_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_bftid = arrParam["bftid"];

});