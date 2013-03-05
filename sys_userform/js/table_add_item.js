

function getflds(){
	var sqlflds = [];
	
	var fldname, fldtype, fldlength, fldisvoid, flddefault, fldremark, fldiskey, fldisauto;

// CREATE TABLE  `da_userform`.`aaa` (
// `a_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT  '111',
// `a_name` VARCHAR( 50 ) NOT NULL COMMENT  '222'
// ) ENGINE = INNODB COMMENT =  '徐飞';
	
	da("tr", "#itemlist").each(function(idx, obj){
		fldname = da(".fldname", obj).val();
		if( ""==fldname ) return;
		
		fldtype = da(".fldtype", obj).val();
		fldlength = da(".fldlength", obj).val();
		fldisvoid = da(".fldisvoid:checked", obj).val();
		fldiskey = da(".fldiskey:checked", obj).val();
		fldisauto = da(".fldisauto:checked", obj).val();
		flddefault = da(".flddefault", obj).val();
		fldremark = da(".fldremark", obj).val();
		
		var arr = [];
		arr.push(fldname +" ");
		arr.push(fldtype+ (fldlength?"("+fldlength+") ":" "));
		arr.push(1 == fldisvoid?" NULL ":" NOT NULL ");
		arr.push(1 == fldiskey?" PRIMARY KEY ":"");
		arr.push(1 == fldisauto?" AUTO_INCREMENT ":"");
		arr.push(flddefault?(" DEFAULT '"+ flddefault +"' "):"");
		arr.push(fldremark?(" COMMENT '"+ fldremark +"' "):"");

		sqlflds.push(arr.join(""));
	});
	
	return sqlflds.join(",");
}

/**组件sql语句
*/
function getsqlcode(){
	var sqlcode = "",
		tbname = da("#tbname").val(),
		tbremark = da("#tbremark").val(),
		sqlflds = getflds();
	
	if( "" == tbname ){
		alert("请添加表名。");
		return;
	}
	if( "" == sqlflds ){
		alert("请添加字段。");
		return;
	}

	sqlcode = "CREATE TABLE "+ tbname +" (";
	sqlcode += sqlflds;
	sqlcode += ") ENGINE=INNODB ";
	sqlcode += "COMMENT='"+ tbremark +"'";
	
	return sqlcode;
}

/**创建用户自定义表单
*/
function savetable(){
	var sqlcode = getsqlcode();
	
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


/**创建用户自定义表单
*/
function additem(){
	var listObj = da("#itemlist"),
		newitem = da("tr","#itemtemplet").dom[0].cloneNode(true);
		
	listObj.append(newitem);
	da(newitem).show();
	
	autoframeheight();		//自适应窗口大小
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