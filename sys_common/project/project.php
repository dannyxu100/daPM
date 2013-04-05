<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>新增项目页面</title>
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css">

<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
<?php include_once("./action/sys/db.php");?>

<?
	date_default_timezone_set('ETC/GMT-8');
	
	if( $_POST ) 
	{ 
		error_reporting(-1);
		$db = new DB();
		
		$uid=$_SESSION['u_id'];
		$uname=$_SESSION['u_name'];
	
		$pname = $_POST["p_name"];
		$datestart = $_POST["p_date_start"];
		$dateend = $_POST["p_date_end"];
		$remark = $_POST["p_remark"];
		$users = $_POST["chkuser"];
		$lastlog = "【".$uname." 于".$datestart."新创建】-".$remark;
		
		$res=0;
		
		if( $db->Query("insert into pm_project_info(p_name,p_date_start,p_date_end,p_remark,p_lastlog,p_uid,p_uname) values('".$pname."','".$datestart."','".$dateend."','".$remark."','".$lastlog."','".$uid."','".$uname."');") )
		{
			//echo $db->error_message;
			$row = $db->GetOne("select @@IDENTITY as p_id");
			if( $row ){
				if( $db->Query("insert into pm_project_log(l_note,l_pid,l_date,l_uid,l_uname) values('".$lastlog."','".$row["p_id"]."','".$datestart."','".$uid."','".$uname."');") )
				{
					for($i=0;$i<count($users);$i++){
						if( $db->Query("insert into pm_p2user(p2u_pid,p2u_uid) values('".$row["p_id"]."','".$users[$i]."')") )
						{
							$res++;
						}
					}
				}
			}
		}
		$db->Destroy();
		if($res===count($users))
		{
			echo "<script language='javascript'>alert('新建项目成功！');</script>";
		}
		else
		{
			echo "<script language='javascript'>alert('操作失败！');</script>";
		}
		
	}
	
	// $project = $db->GetAll("select * from pm_project_info where p_id='".$pid."'");
	// $log = $db->GetAll("select * from pm_project_log where l_pid='".$pid."' order by l_date desc, l_id desc");
?>
</head>

<body>
	<div style="font-family:'黑体';padding:5px;font-size:18px">创建新项目</div>
	<form id="addform" name="addform" method="post" action="" style="padding:10px;" onsubmit="return chkdata()">
		<div>项目名称<span style="color:#f00">*</span> <input id="p_name" name="p_name" type="text" style="width:400px" /></div> <br/>
		<div>
			<div style="float:left;width:60px">负责人<span style="color:#f00">*</span> </div>
			<div style="float:left;width:400px;margin-bottom:10px;">
			<?php
				$db = new DB(1);
				$ds = $db->GetAll("select pu_id, pu_name from p_user");
				$db->Destroy();
				for($i=0;$i<count($ds);$i++)
				{
					?>
						<label style="margin-right:5px;"><input type="checkbox" name="chkuser[]" value="<?php echo $ds[$i]["pu_id"] ?>"><?php echo $ds[$i]["pu_name"] ?></label>
					<?php
				}
			?>
			</div>
		</div>
		
		<div style="clear:both;">
		启动日期<span style="color:#f00">*</span> <input id="p_date_start" name="p_date_start" type="text" style="margin-right:20px;" value="<?php echo date("Y-m-d") ?>"/>
		验收日<span style="color:#f00">*</span> <input id="p_date_end" name="p_date_end" type="text" value="" />
		</div> <br/>
		<div>备注</div>
		<div><textarea id="p_remark" name="p_remark" style="height:200px;width:100%"></textarea></div>
		<div style="text-align:center;padding-top:50px;">
			<input id="submit" name="submit" type="submit" style="width:100px; height:30px;" value="提交" onclick=""/>
			<input type="button" style="width:100px; height:30px;color:#999;" value="清空" onclick="document.addform.reset();" />
		</div>
	</form>
</body>
<script>
	function chkdata(){
		if(""===document.getElementById("p_name").value){
			alert("保存失败：项目名称不能为空！");
			return false;
		}
		
		var checked=false;
		var ids= document.getElementsByName("chkuser[]");
		for(var i=0;i<ids.length;i++){
			if(ids[i].checked){
				checked=true;
			}
		}
		if(!checked){
			alert("保存失败：必须要指派负责人!");
			return false;
		}
		return true;
	}
</script>
</html>


<script src="/js/jquery-1.8.3.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script>
	$(function() {
		$( "#p_date_start" ).datepicker({changeMonth:true});
		$( "#p_date_end" ).datepicker({changeMonth:true});
	});
</script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#p_remark', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
</script>

