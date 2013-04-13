var g_ntid = "";

/**添加便签簿
*/
function addnotetype(){
	daWin({
		width: 400,
		height: 150,
		title: "添加便签簿",
		url: "/sys_common/note/notetype_add_item.php",
		after: function(){
			loadnotetype();
		}
	});
}


/**添加日志
*/
function savenote(){
	if( !daValid.all() ){
		return;
	}
	
	g_editor.sync();

	da.runDB("/sys_common/note/action/note_add_item.php",{
		dataType: "json",
		n_title: da("#n_title").val(),
		n_ntid: da("#n_ntid").val(),
		n_abstract: da("#n_abstract").val(),
		n_content: encodeURIComponent(g_editor.html())
		
	},function(res){
		if("FALSE"!=res){
			alert("添加成功。");
			loadnotetype();
		}	
	},function(msg, code, ex){
		// debugger;
	});
	
}

/**加载便签簿下拉
*/
function loadnotetype(){
	var ntype = da("#n_ntid");
	ntype.empty();
	
	da.runDB("/sys_common/note/action/notetype2user_get_list.php",{
		dataType: "json"
		
	},function(data){
		if("FALSE"!=data && 0<data.length){
			for(var i=0; i<data.length; i++){
				ntype.append('<option value="'+ data[i].nt_id +'">'+ data[i].nt_name +'</option>');
			}
		}
		else{
			ntype.append('<option value="0">我的便签</option>');
		}
	},function(msg, code, ex){
		ntype.append('<option value="0">我的便签</option>');
		// debugger;
	});
}

var g_editor;
/**加载在线编辑器
*/
function loadeditor(){
	g_editor = KindEditor.create('#n_conent', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
		allowFileManager : true,
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link']
	});
}

daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_ntid = arrparam["ntid"];
		
		loadnotetype();
		loadeditor();
	});
});