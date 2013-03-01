
/**创建用户自定义表单
*/
function addform(){
	daWin({
		width: 800,
		height: 600,
		url: "/sys_userform/table_add_item.htm",
		title: "创建数据表",
		back: function(){
			
		}
	});
}

daLoader("daMsg,daWin", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
	
	});
});

//-->