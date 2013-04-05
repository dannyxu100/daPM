
/**保存客户信息
*/
function savecst(){
	if( !daValid.all() ) return;
	
	// g_editors.sync();

	var data = {
		dataType: "json"
	};
	
	da("input,textarea,select", "#cst_form").each(function(idx, obj){
		data[obj.id] = encodeURIComponent(da(obj).val());
	});

	da.runDB("/sys_crm/action/publiccst_add_item.php", data,
	function(res){
		if("FALSE" != res){
			alert("添加成功。");
		}
		
	},function(code,msg,ex){
		// debugger;
	});
}

/**初始化客户信息表单
*/
function initform(){
	
	//加载客户来源可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		// async: false,
		itcode: "cst_source" 
		
	},function(data){
		if("FALSE"!=data){
			var objtags = da("#c_source");
			
			for(var i=0; i<data.length; i++){
				objtags.append([
					'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
				].join(''));
			}
		}	
	});
	
	//加载客户类型可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		// async: false,
		itcode: "cst_type" 
		
	},function(data){
		if("FALSE"!=data){
			var objtags = da("#c_type");
			
			for(var i=0; i<data.length; i++){
				objtags.append([
					'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
				].join(''));
			}
		}	
	});
	
	//加载客户等级可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		// async: false,
		itcode: "cst_level" 
		
	},function(data){
		if("FALSE"!=data){
			var objtags = da("#c_level");
			
			for(var i=0; i<data.length; i++){
				objtags.append([
					'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
				].join(''));
			}
		}	
	});
	
	//加载客户行业可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		// async: false,
		itcode: "cst_trade" 
		
	},function(data){
		if("FALSE"!=data){
			var objtags = da("#c_trade");
			
			for(var i=0; i<data.length; i++){
				objtags.append([
					'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
				].join(''));
			}
		}
	});
}

daLoader("daMsg,daValid,daIframe,daWin",function(){
	da(function(){
		var arrParam = da.urlParams();
		
		initform();
	});
});
