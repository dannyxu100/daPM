var g_cid = "";

/**上传略缩图
*/
function uploadimg(){
	var newfilename = (new Date).getTime();

	fn_uploadfile("上传文件尺寸为200x150像素。", {
        "fileTypeDesc": "图片文件",
		// "multi": true,
		"fileTypeExts": "*.gif; *.jpg; *.png",
		"formData": {
			"folder": "/uploads/caseimg",
			"name": newfilename
		}
	},function(files){
		var imgurl = "";
		for( var k in files ){
			imgurl = "/uploads/caseimg/"+ newfilename + files[k].type;
		}
		
		da("#img_case").attr("src", imgurl);
		da("#c_img").val(imgurl);
		
	});
}

/**修改案例
*/
function savecase(){
	if( !daValid.all() ){
		return;
	}
	
	g_edtContent.sync();
	g_edtRemark.sync();

	da.runDB("/sys_common/case/action/case_update_item.php",{
		dataType: "json",
		c_id: g_cid,
		c_title: da("#c_title").val(),
		c_type: da("#c_type").val(),
		c_sort: da("#c_sort").val(),
		c_abstract: da("#c_abstract").val(),
		c_img: da("#c_img").val(),
		c_remark: encodeURIComponent(da("#c_remark").val()),
		c_content: encodeURIComponent(da("#c_content").val())
		
	},function(res){
		if("FALSE"!=res){
			alert("修改成功。");
		}	
	},function(msg, code, ex){
		// debugger;
	});
	
}

/**加载案例信息
*/
function loadcase(){
	da.runDB("/sys_common/case/action/case_get_item.php",{
		dataType: "json",
		cid: g_cid
		
	},function(res){
		if("FALSE"!=res){
			for(var fld in res){
				da("#"+fld).val(res[fld]);
			}
			
			da("#img_case").dom[0].src= res.c_img?res.c_img:"/images/no_img.jpg";
			g_edtContent.html(res.c_content);
			g_edtRemark.html(res.c_remark);
		}	
	},function(msg, code, ex){
		// debugger;
	});
}

/**加载案例分类
*/
function loadcasetype(){
	var ctype = da("#c_type");
	ctype.empty();
	
	//加载系统可选项
	da.runDB("/sys_setting/item/action/item_get_list.php",{
		dataType: "json",
		// async: false,
		itcode: "case_websitetype"
		
	},function(data){
		if("FALSE"!=data){
			for(var i=0; i<data.length; i++){
				ctype.append([
					'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
				].join(''));
			}
		}	
	});
}

var g_edtContent,
	g_edtRemark;
/**加载在线编辑器
*/
function loadeditor(){
	g_edtContent = KindEditor.create('#c_content', {
		resizeType : 1,
		// filterMode : false,		//不过滤危险标签
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
			'anchor', 'link', 'unlink'
		]
	});
	
	g_edtRemark = KindEditor.create('#c_remark', {
		resizeType : 1,
		// filterMode : false,		//不过滤危险标签
		newlineTag: "br",
		allowPreviewEmoticons : false,
		fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
		allowFileManager : true,
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'emoticons', 'image', 'link', '|', 'justifyleft', 'justifycenter', 
			'justifyright', 'insertorderedlist','insertunorderedlist'
		]
	});
}

daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_cid = arrparam["cid"];
		
		loadeditor();
		loadcasetype();
		
		loadcase();
	});
});