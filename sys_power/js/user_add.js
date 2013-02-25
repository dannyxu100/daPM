
/**选择部门
*/
function selectorg(){
	daWin({
		width: 400,
		height:400,
		url: "/sys_power/plugin/select_org.htm",
		back: function(id,name){
			da("#pu_oid").val(id);
			da("#org_name").val(name);
		}
	});
}

function saveuser(){
	da.runDB("action/user_add_item.php",{
		pu_name: da("#pu_name").val(),
		pu_code: da("#pu_code").val(),
		pu_pwd: da("#pu_pwd").val(),
		pu_oid: da("#pu_oid").val(),
		pu_phone: da("#pu_phone").val(),
		pu_telephone: da("#pu_telephone").val(),
		pu_address: da("#pu_address").val(),
		pu_remark: da("#pu_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");

});