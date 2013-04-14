
var g_ntid = "";

/**上传附件
*/
function uploadattach(){
	if( !g_btid || !g_bcid ){
		alert("未传入表单编号");
		return;
	}
	
	var folder = "/uploads/attach/biztemplet_"+ g_btid +"/"+ g_bcid;
	
	fn_uploadfile("可上传文件格式：txt, rar, zip, doc(docx), xls(xlsx)", {
        "fileTypeDesc": "附件文件",
		"multi": true,
		"fileTypeExts": "*.txt; *.rar; *.zip; *.doc; *.docx; *.xls; *.xlsx",
		"formData": {
			"folder": folder
		}
	},function(files){
		var arrname=[], arrurl = [];
		for( var k in files ){
			arrname.push( files[k].name );
			arrurl.push( folder +"/"+ files[k].name );
			
			delete files[k];
		}
		
		if( 0<arrname.length && 0<arrurl.length && arrname.length==arrurl.length){
			da.runDB("/sys_setting/filemanager/action/attach_add_list.php",{
				dataType: "json",
				type: "biztemplet_"+ g_btid,
				code: "bcid_"+ g_bcid,
				names: arrname.join("|"),
				urls: arrurl.join("|")
			
			},function(res){
				if("FALSE" != res){
					loadattach();
				}
				this.closeWin();
				
			},function(code,msg,ex){
				// debugger;
			});
		}
	});
	
}

/**加载附件信息附件
*/
function loadattach(){
	if( !g_btid || !g_bcid ){
		alert("未传入表单编号");
		return;
	}

	var listobj = da("#attach_list");

	da.runDB("/sys_setting/filemanager/action/attach_get_list.php",{
		dataType: "json",
		type: "biztemplet_"+ g_btid,
		code: "bcid_"+ g_bcid
	
	},function(data){
		if( "FALSE" != data){
			listobj.empty();
			
			for(var i=0; i<data.length; i++){
				listobj.append('<a class="attachitem" href="'
				+ data[i].a_url 
				+'" title="'
				+ data[i].a_puname 
				+'"><img src="/images/sys_icon/attach.png" style="vertical-align:middle" /> '
				+ data[i].a_name +'</a> ');
			}
			
			autoframeheight();
		}
	
	},function(code,msg,ex){
		// debugger;
	});
}

function savenotice(){
	if( !g_ntid ){
		alert("未传入公告分类编号");
		return;
	}
	
	if( !daValid.all()) return;
	
	g_editor.sync();
	
	da.runDB("/sys_common/notice/action/notice_add_item.php",{
		ntid: g_ntid,
		n_title: da("#n_title").val(),
		n_subhead: da("#n_subhead").val(),
		n_sort: da("#n_sort").val(),
		n_abstract: da("#n_abstract").val(),
		n_content: encodeURIComponent(da("#n_content").val())
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}
var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	g_editor = KindEditor.create('#n_content', {
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
			'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '|',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
			'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
			'anchor', 'link', 'unlink'
		]
	});
	
}

daLoader("daMsg,daTable,daWin,daValid", function(){
	da(function(){
		var arrParam = da.urlParams();
		g_ntid = arrParam["ntid"];

		loadeditor();
	});
});