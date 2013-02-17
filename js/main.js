
/**查看项目信息
*/
function createproj(){
	daWin({
		width: 700,
		height: 600,
		url: "project.php"
	});
}

/**查看项目信息
*/
function showproj( pid ){
	daWin({
		width: 600,
		height: 400,
		url: "project_view.php?pid="+pid
	});
}


/**查看详细日志信息
*/
function showlog( pid ){
	daWin({
		width: 800,
		height: 600,
		url: "logmanage.php?pid="+pid
	});
}

function clearDate(){
	document.getElementById('date_from').value='';
	document.getElementById('date_to').value='';
	document.getElementById('keyword').value='';
}

$(function() {
	$( "#date_from" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 3,
	  onClose: function( selectedDate ) {
		$( "#date_to" ).datepicker( "option", "minDate", selectedDate );
	  }
	});
	$( "#date_to" ).datepicker({
	  defaultDate: "+1w",
	  changeMonth: true,
	  numberOfMonths: 3,
	  onClose: function( selectedDate ) {
		$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
	  }
	});
});

daLoader("daWin",function(){

});

