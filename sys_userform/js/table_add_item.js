
/**创建用户自定义表单
*/
function additem(){
	var listObj = da("#itemlist"),
		newitem = da("tr","#itemtemplet").dom[0].cloneNode(true);
		
	listObj.append(newitem);
	da(newitem).show();
	
	autoframeheight();		//自适应窗口大小
}

/**组件sql语句
*/
function initsqlcode(){
	var fldname, fldtype, fldlength, flddefault;
	
	da("tr", "#itemlist").each(function(idx, obj){
		fldname = da(".fldname", obj).val();
		if( ""==fldname ) return;
		
		fldtype = da(".fldtype", obj).val();
		fldlength = da(".fldlength", obj).val();
		flddefault = da(".flddefault", obj).val();
		
		alert(fldname+", "+fldtype+", "+fldlength+", "+flddefault);
		
	});

}

/**创建用户自定义表单
*/
function savetable(){
	initsqlcode();
	
	da.runDB("/sys_userform/action/table_add_item.php",{
		sql: sqlcode
		// tbname: $("#tbname").val(),
		// tbremark: $("#tbremark").val()
	},function(res){
		if("FALSE" != res){
			alert("添加表成功。");
		}
	});
}

daLoader("daMsg,daWin,daIframe", function(){
	//daUI();
	
	/*页面加载完毕*/
	da(function(){
		for(var i=0; i<5; i++){
			additem();
		}
	});
});

//-->