var g_bcid = "";

/**添加日志
*/
function savelog(){
}

/**初始化控件
*/
function initform(){
	var p_persent=0,
		obj = da("#p_persent");
	
	obj.empty();
	for(var num=p_persent+5; num<105; num=num+5){
		obj.append('<option>'+ num +'</option>');
	}

	da("#loguser").text(fn_getcookie("puname"));
	da("#logdate").text(new Date().format("yyyy-mm-dd hh:nn:ss"));
	
	//加载标签可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		itcode: "bizlog_tagtype" 
		
	},function(data){
		if("FALSE"!=data){
			var objtags = da("#tags");
			for(var i=0; i<data.length; i++){
				objtags.append([
					'<label style="margin-right:5px;">',
						'<input type="radio" name="chktag" ', 0==i?'checked="true"':'' ,' value="'+ data[i].i_value +'">',
						data[i].i_name,
					'</label>'
				].join(''));
			}
		}	
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
		initform();
	});
});