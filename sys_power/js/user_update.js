
var puid = "";

function selectorg(){
	daWin({
		width: 400,
		height:400,
		url: "/sys_power/plugin/select_org.htm",
		back: function(id,name){
			da("#pu_oid").val(id);
			da("#po_name").val(name);
		}
	});
}

function loaduser(){
	da.runDB("action/user_get_item.php",{
		dataType: "json",
		pu_id: puid
	},function(res){
		if("FALSE"!= res){
			for(var fld in res){
				da("#"+fld).val(res[fld]);
			}
		}
	});
}

function updateuser(){
	da.runDB("action/user_update_item.php",{
		pu_id: puid,
		
		pu_name: da("#pu_name").val(),
		pu_code: da("#pu_code").val(),
		pu_pwd: da("#pu_pwd").val(),
		pu_oid: da("#pu_oid").val(),
		pu_phone: da("#pu_phone").val(),
		pu_telephone: da("#pu_telephone").val(),
		pu_address: da("#pu_address").val(),
		pu_email: da("#pu_email").val(),
		pu_qq: da("#pu_qq").val(),
		pu_remark: da("#pu_remark").val()
	},function(res){
		if(res=="FALSE"){
			alert("对不起，修改失败。");
		}
		else{
			alert("修改成功。");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	puid = arrParam["puid"];
	
	da(function(){
		loaduser();
	});
});