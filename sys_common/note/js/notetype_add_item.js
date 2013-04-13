
/**添加日志
*/
function savenotetype(){
	da.runDB("/sys_common/note/action/notetype_add_item.php",{
		dataType: "json",
		ntname: da("#nt_name").val()
		
	},function(res){
		if("FALSE"!=res){
			alert("添加成功。");
		}	
	},function(msg, code, ex){
		// debugger;
	});
	
}

daLoader("daMsg,daIframe",function(){
	da(function(){
	
	});
});