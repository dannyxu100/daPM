var g_hid = "";

function updatehelper(){
	// 将编辑器的HTML数据同步到textarea
	KindEditor.sync('#h_content');

	da.runDB("/sys_setting/helper/action/helper_update_item.php",{
		hid: g_hid,
		hname: da("#h_name").val(),
		hcode: da("#h_code").val(),
		hsort: da("#h_sort").val(),
		hcontent: da("#h_content").val()
	},function(res){
		if("FALSE"!=res){
			alert("修改成功");
		}
	},
	function(a,b,c){
		// debugger;
	});
}

/**加载帮助文档
*/
function loadinfo(){
	da.runDB("/sys_setting/helper/action/helper_get_item.php",{
		dataType: "json",
		hid: g_hid
		
	},function(data){debugger;
		if("FALSE" != data){
			for(var k in data){
				da("#"+k).val(data[k]);
			}
			
			g_editor.html(data["h_content"]);
		}
	},function(code,msg,ex){
		debugger;
	});
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	KindEditor.ready(function(K) {
		g_editor = K.create('#h_content', {
			extraFileUploadParams : {
				folder: "/sys_setting/helper/"
			},
			resizeType: 1,
			filterMode: false,		//不过滤危险标签
			newlineTag: "br",
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
				'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
				'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
				'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
				'anchor', 'link', 'unlink', '/',
				'da_list_fld'
			]
		});
	});
};

daLoader("daTable,daIframe,daWin,daMsg", function(){
	loadeditor();
	
	da(function(){
		//da.out("加载成功");
		var arrParam = da.urlParams();
		g_hid = arrParam["hid"];
		
		loadinfo();
	});

});