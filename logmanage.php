<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>日志管理页面</title>
<link rel="stylesheet" href="css/base.css">
<style>
	table td{padding:3px;}
	.no_multiple{text-overflow:ellipsis;white-space:nowrap;}
</style>
<div style="display:none;">
<?include_once("./action/sessioncheck.php");?>
<?include_once("./action/sys/db.php");?>
</div>
<?
	date_default_timezone_set('ETC/GMT-8');

	function getTag( $tagname )
	{
		switch( $tagname )
		{
			case "顺利": return "<span style='color:#039'></span>";
			case "麻烦":
			case "需要研讨": return "<span style='color:#c60'>".$tagname ."</span>";
			case "非常严重": return "<span style='color:#f00'>非常严重</span>";
		}
	}
	
	$pid = $_GET["pid"];
	error_reporting(-1);
	
	$db = new DB();
	$project = $db->GetAll("select p_name,p_persent,u_name from pm_project_info,pm_p2user,pm_user where p_id=p2u_pid and p2u_uid=u_id and p_id='".$pid."'");
	$pname = $project[0]["p_name"];
	$puser = "";
	for($i=0;$i<count($project);$i++){
		$puser .= $project[$i]["u_name"]." ";
	}
	
	//echo $db->error_message;
	$log = $db->GetAll("select * from pm_project_log, pm_tag where l_pid='".$pid."' and l_tagid=t_id order by l_date desc, l_id desc");
	$tag = $db->GetAll("select * from pm_tag where t_tid='1'");
	$db->Destroy();
?>
</head>
<script>
	function showInsert(){
		document.getElementById("insertPad").style.display = "";
		document.getElementById("listPad").style.display = "none";
	}
	
	function showList(){
		document.getElementById("insertPad").style.display = "none";
		document.getElementById("listPad").style.display = "";
	}
</script>
<body>
	<div id="listPad">
	<div style="padding:5px;"><span style="font-family:'黑体';font-size:22px;"><?php echo $pname ?></span><input type="button" style="margin-left:20px;padding:5px;" onclick="showInsert();" value="新增日志"/></div>
	<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;<?php echo $puser ?></div>
	<table style="margin:10px auto; width:100%; height:50px;border-top:1px solid #999">
		<tr style="color:#444; background:#f9f9f9;">
			<td class="no_multiple" style="width:20px; height:30px;border-bottom:1px solid #ccc;">序</td>
			<td class="no_multiple" style="width:80px; height:30px;border-bottom:1px solid #ccc;">日期</td>
			<td class="no_multiple" style="width:60px; height:30px;border-bottom:1px solid #ccc;">人员</td>
			<td class="no_multiple" style="width:60px; height:30px;border-bottom:1px solid #ccc;">标签</td>
			<td style="border-bottom:1px solid #ccc;">日志内容</td>
		</tr>
		<?php 
			for($i=0;$i<count($log);$i++)
			{
				?>
				<tr style="vertical-align:top">
					<td class="no_multiple" style="border-bottom:1px solid #f5f5f5"><?php echo $i+1 ?>&nbsp;</td>
					<td class="no_multiple" style="border-bottom:1px solid #f5f5f5"><?php echo date("Y-m-d",strtotime($log[$i]["l_date"])) ?>&nbsp;</td>
					<td class="no_multiple" style="border-bottom:1px solid #f5f5f5;color:#333;"><?php echo $log[$i]["l_uname"] ?>&nbsp;</td>
					<td class="no_multiple" style="border-bottom:1px solid #f5f5f5;color:#333;"><?php echo getTag($log[$i]["t_name"]) ?>&nbsp;</td>
					<td style="border-bottom:1px solid #f5f5f5;color:#333;"><?php echo $log[$i]["l_note"] ?>&nbsp;</td>
				</tr>
				<?php
			}
		?>
	</table>
	</div>
	<div id="insertPad" style="display:none;">
		<div style="padding:5px;"><span style="font-family:'黑体';font-size:22px;"><?php echo $pname ?></span><input type="button" style="margin-left:20px;padding:5px;" onclick="showList();" value="返回"/></div>
		<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;<?php echo $puser ?></div>
		<form id="logform" name="logform" method="post" action="action/addlog.php" onsubmit="return chkdata()">
			<table style="margin:10px auto; width:100%; height:50px;">
				<tr >
					<td colspan="3">
						<textarea id="l_note" name="l_note" style="width:100%;height:250px;"></textarea>
						<input id="p_id" name="p_id" type="hidden" value="<?php echo $pid ?>"/>
					</td>
				</tr>
				<tr >
					<td colspan="3" style="padding:3px">
						标签:&nbsp;&nbsp;
						<?php
							for($i=0;$i<count($tag);$i++){
								?>
									<label style="margin-right:5px;">
										<input type="radio" name="chktag[]" <?php echo $i==0?"checked":"" ?> value="<?php echo $tag[$i]["t_id"] ?>"><?php echo $tag[$i]["t_name"] ?>
									</label>
								<?php
							}
						?>
					</td>
				</tr>
				<tr >
					<td>完成进度:&nbsp;&nbsp;
						<select id="p_persent" name="p_persent" style="width:80px;">
							<option selected><?php echo $project[0]["p_persent"] ?></option>
							<?php
								for($i=$project[0]["p_persent"]+5;$i<105;$i=$i+5)
								{
									?>
										<option><?php echo $i ?></option>
									<?php
								}
							?>
						</select> ％
					</td>
					<td>记录人员: <span style="color:#ccc"><?php echo $_SESSION['u_name'] ?></span></td>
					<td>日期: <span style="color:#ccc"><?php echo $showtime=date("Y-m-d H:i:s") ?></span></td>
				</tr>
				<tr >
					<td colspan="3" style="text-align:center;padding-top:50px;">
						<input id="submit" name="submit" type="submit" style="width:100px; height:30px;" value="提交" onclick=""/>
						<input type="button" style="width:100px; height:30px;color:#999;" value="清空" onclick="document.loginform.reset();" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
<script>
	function chkdata(){
		if(editor.isEmpty()){
			alert("日志信息不能为空！");
			return false;
		}
		return true;
	}
</script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#l_note', {
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
</html>
