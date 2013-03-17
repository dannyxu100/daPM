
var g_htid = "";

function savehelper(){
	// 将编辑器的HTML数据同步到textarea
	KindEditor.sync('#h_content');

	da.runDB("/sys_setting/helper/action/helper_add_item.php",{
		htid: g_htid,
		hname: da("#h_name").val(),
		hcode: da("#h_code").val(),
		hsort: da("#h_sort").val(),
		hcontent: da("#h_content").val(),
		heditorname: fn_getcookie("puname"),
		heditordate: new Date().format("yyyy-mm-dd hh:nn:ss")
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	},
	function(a,b,c){
		// debugger;
	});
}


var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	KindEditor.ready(function(K) {
		g_editorList = K.create('#h_content', {
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
		g_htid = arrParam["htid"];
		
		
		da("#editorname").text(fn_getcookie("puname"));
		da("#editordate").text(new Date().format("yyyy-mm-dd"));
		
	});

});