


/**获取cookie值
*/
function fn_getcookie(name){
	var arrcookie = decodeURIComponent(da.cookie("COOKIE_FROM_DASYS")).split('|');

	for(var i=0; i<arrcookie.length; i++){
		var arr = arrcookie[i].split(':');
	
		if( name != arr[0] ) continue;
		
		return arr[1];
	}
	return "null";
	
}

/**显示帮助文档详细信息
*/
function fn_helper( code ){
	daWin({
		width: 850,
		height: 600,
		url: "/sys_setting/helper/helper_view.php?hcode="+ code,
		title: "帮助文档"
	});
	
	// window.open("/sys_helper/index.php?id="+ id +"&item="+ item, 
	// "PM系统帮助文档", 
	// 'height=600,width=800,top=0,left=0,toolbar=no,menubar=no,scrollbars=no,resizable=yes,location=no,status=no');
}

/**上传文件
*/
function fn_uploadfile( info, param, fn ){
	if(da.isFunction(param)){
		fn = param;
		param = {};
	}

	daWin({
		width: 500,
		height: 300,
		backclose: false,
		title: "上传文件",
		url: "/plugin/uploadify/index.php",
		load: function(){
			this.setinfo(info);
			this.setparam(param);
		},
		back: function(files){
			fn(files);
		}
	});
}

/**发送邮件
*/
function fn_sendemail( emails, title, content){
	da.runDB("/sys_common/email/action/sendmail.php",{
		dataType: "text",
		emails: emails,
		title: title,
		content: content
		
	},function(res){
		// debugger;
	},function(a,b,c){
		// debugger;
	});
}

