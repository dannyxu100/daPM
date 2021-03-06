﻿var g_bcid = "",
	g_lid = "";

/**添加日志
*/
function savereply(){
	g_editor.sync();
	
	da.runDB("/sys_common/bizlog/action/reply_add_item.php",{
		dataType: "text",
		bcid: g_bcid,
		lid: g_lid,
		content: encodeURIComponent(da("#r_conent").val())
		
	},function(emails){
		if("FALSE"!=emails){
			alert("添加成功。");
			
			/*发送个邮件提醒*/
			fn_sendemail( emails, 
				"PM留言("+ fn_getcookie("puname") +")", 
				da("#r_conent").val()
			);
			
			back();
		}
		else{
			alert("操作失败。");
		}
	},function(msg, code, ex){
		// debugger;
	});
	
}

var g_editor;
function loadeditor(){
	g_editor = KindEditor.create('#r_conent', {
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
		g_lid = arrparam["lid"];
		
		loadeditor();
		
		da("#replyuser").text(fn_getcookie("puname"));
		da("#replydate").text(new Date().format("yyyy-mm-dd hh:nn:ss"));
	});
});