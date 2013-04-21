var g_bcid = "";

/**添加日志
*/
function savelog(){
	var persent = da("#p_persent").val();
	
	g_editor.sync();

	da.runDB("/sys_common/bizlog/action/log_add_item.php",{
		dataType: "text",
		bcid: g_bcid,
		tagname: da("[name=chktag]:checked").val(),
		content: encodeURIComponent(da("#l_content").val())
		
	},function(emails){
		if("FALSE"!=emails){
			alert("添加成功。");
			
			/*发送个邮件提醒*/
			fn_sendemail( emails, 
				"PM日志("+ fn_getcookie("puname") +")", 
				da("#l_content").val()
			);
			
			back();
		}
		else{
			alert("操作失败。");
		}
	},function(msg, code, ex){
		//debugger;
	});
	
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

var g_editor;
function loadeditor(){
	g_editor = KindEditor.create('#l_content', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
		allowFileManager : true,
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'emoticons', 'image', 'link', '|', 'justifyleft', 'justifycenter', 
			'justifyright', 'insertorderedlist','insertunorderedlist']
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
		initform();
		loadeditor();
	});
});