<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="/css/base.css"/>
<link rel="stylesheet" href="/css/main.css"/>
<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>


<title>项目进度管理-主页面</title>
<?include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
<?include_once("action/sys/db.php");?>
</head>

<body>
<form name="indexform" method="post" action="">
<div id="user_list" style="width:800px;margin-top:5px;"> 
<?php 
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
	
	function getColor( $persent )
	{
		if($persent>90){return "#060";}		//深绿色
		elseif($persent>70){return "#9c0";}	//绿色
		elseif($persent>30){return "#fc3";}	//黄色
		else{return "#900";}	//红色
	}
	
	$db = new DB("da_powersys");
	$set = $db->getlist("select pu_id, pu_name from da_powersys.p_user order by pu_oid asc, pu_name asc");
	//error_reporting(-1);
	$db->close();
	
	$chked = "";
	//echo $_POST['chkuser'][0];
	
	for($i=0;$i<count($set);$i++){
		if( $_POST ) 
		{ 
			if($set[$i]["pu_id"] === $_POST['chkuser'][0]){
				$chked = "checked"; 
			}
		}
		?>
			<label style="margin-right:5px;"><input type="radio" <?php echo $chked ?> name="chkuser[]" onclick="document.indexform.submit();" value="<?php echo $set[$i]["pu_id"] ?>"><?php echo $set[$i]["pu_name"] ?></label>
		<?php
		$chked = "";
	}
	if( !$_POST || $_POST && "-1" == $_POST['chkuser'][0] ) 
	{
		$chked = "checked";
	}
	
	$date1 = isset($_POST['date_from']) ? $_POST['date_from'] : "";
	$date2 = isset($_POST['date_to']) ? $_POST['date_to'] : "";
	$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";
?>
	<label style="color:#c00;"><input type="radio" <?php echo $chked ?> name="chkuser[]" onclick="document.indexform.submit();" value="-1"/>最近50个项目</label>
</div>

<div style="width:800px;margin:0px 0px 10px 15px;">
	<span style="color:#ccc;">
	日期:&nbsp;&nbsp;从 <input id="date_from" name="date_from" type="text" style="width:80px" value="<?php echo $date1 ?>"/>
	&nbsp;&nbsp;到 <input id="date_to" name="date_to" type="text" style="width:80px" value="<?php echo $date2 ?>"/>
	&nbsp;&nbsp;关键词 <input id="keyword" name="keyword" type="text" style="width:80px" value="<?php echo $keyword ?>"/></span>
	<a style="font-size:9px;" href="javascript:void(0)" onclick="clearDate()">清除</a>
	<input type="button" style="width:80px;height:25px;" onclick="document.indexform.submit();" value="筛选"/>
	<input type="button" style="margin-left:20px;width:80px;height:25px;" value="新增项目" onclick="createproj()"/>
</div><hr/>

<?php
	$sql = "";
	$isall = false;
	if( !$_POST || $_POST && "-1" == $_POST['chkuser'][0] )
	{
		$isall = true;
	}
	
	if($isall)
	{
		$sql = "select * from pm_project_info, pm_tag where p_lasttagid=t_id ";
	}
	else{
		$sql = "select * from pm_project_info, pm_p2user, pm_tag where p_lasttagid=t_id ";
	}
	
	if( $date1 ){
		$sql .= " and p_date_start >='".$date1." 00:00:00'";
		if( $date2 ){
			$sql .= " and p_date_end <='".$date2." 23:59:59'";
		}
	}
	else{
		if( $date2 ){
			$sql .= " and p_date_end <='".$date2." 23:59:59'";
		}
	}
	
	if( $keyword ){
		$sql .= " and p_name like '%".$keyword."%' ";
	}
	
	if($isall)
	{
		$sql .= " order by p_date_start desc,p_id desc limit 50";
	}
	else
	{
		$sql .= " and p2u_pid=p_id and p2u_uid='".$_POST['chkuser'][0]."' order by p_date_start desc,p_id desc";
	}
	
	$db = new DB("pm");
	$ds = $db->getlist($sql);
	$db->close();
	//echo $db->error_message;
	//echo "select * from pm_project_info, pm_p2user where p2u_pid=p_id and p2u_uid='".$_POST['chkuser'][0]."'";
	//echo count($ds);
	
	$s_date1;
	$s_date2;
	$arr_date1 = "";
	$arr_date2 = "";
	$now = time();
	$real_per = 0;
	$msg1 = "";
	$msg2 = "未设定验收日期";
	
	for($i=0; $ds && $i<count($ds); $i++){
		if( "0000-00-00 00:00:00" !== $ds[$i]["p_date_end"])
		{
			$s_date1 = date("Y-m-d",strtotime($ds[$i]["p_date_start"]));		//项目启动日期
			$s_date2 = date("Y-m-d",strtotime($ds[$i]["p_date_end"]));			//项目既定结束日期
			// $Date3=explode("-",date("Y-m-d",strtotime($ds[$i]["p_date_realend"])));		//项目实际结束日期
			
			$arr_date1=explode("-",$s_date1);
			$arr_date2=explode("-",$s_date2);
			
			$d1=mktime(0,0,0,$arr_date1[1],$arr_date1[2],$arr_date1[0]);
			$d2=mktime(0,0,0,$arr_date2[1],$arr_date2[2],$arr_date2[0]);
			
			if( $now >= $d2 )
			{
				$real_per = 300;
				$msg2 = "已逾期,验收日为".$s_date2;
			}
			else
			{
				$real_per = (time() - $d1)/($d2 - $d1)*300;
				$msg2 = "余".round(($d2-$now)/3600/24)."日";
			}
			$msg1 = "总工期".round(($d2-$d1)/3600/24)."日";
		}
?>
</form>
<div class="pro_list" onmouseover="this.style.backgroundColor='#ffc'" onmouseout="this.style.backgroundColor=''">
	<div class="" style="float:left;height:50px; font-size:22px;padding:0px 10px;color:#ccf;"><?php echo $i+1 ?></div>
	<div class="pro_list_left">
		<div>
			<a style="font-size:14px;" href="javascript:void(0)" onclick="showproj(<?php echo $ds[$i]["p_id"]?>)"><?php echo $ds[$i]["p_name"] ?></a>
			<span class="pro_date"><?php echo date("Y-m-d",strtotime($ds[$i]["p_date_start"])) ?></span> 
		</div>
		<div class="persent_bar">
			<div style="height:10px; width:<?php echo $ds[$i]["p_persent"] ?>%; background:<?php echo getColor($ds[$i]["p_persent"]) ?>"></div>
			<div class="persent_text"><?php echo $ds[$i]["p_persent"] ?>%</div>
			<div class="persent_text2"><?php echo $ds[$i]["p_persent"] ?>%</div>
			
		</div>
		<div class="persent_bar">
			<div style="height:10px; width:<?php echo $real_per ?>px; background:#ccc"></div>
			<div class="persent_ltext"><?php echo $msg1 ?></div>
			<div class="persent_ltext2"><?php echo $msg1 ?></div>
			<div class="persent_text"><?php echo $msg2 ?></div>
			<div class="persent_text2"><?php echo $msg2 ?></div>
		</div>
			
	</div>
	<div style="float:left;width:15px;height:50px; background:url(image/left.png) no-repeat;"></div>
	<div class="pro_list_right" onclick="showlog(<?php echo $ds[$i]["p_id"]?>)">
		<span>
			<?php echo $ds[$i]["p_lastlog"] ?>
		</span>
	</div>
	<div style="float:left;width:70px;height:50px;padding:0px 5px;"><?php echo getTag($ds[$i]["t_name"]) ?></div>
	
	<?php
		if("finished" == $ds[$i]["p_isclosed"])
		{
			?>
			<div style="position:relative; top:0px; left:18%; width:96px; height:65px; background:url(image/end.gif);"></div>
			<?php
		}
	?>
	
</div>
<?php
	}
?>
</body>
</html>


<script src="/js/jquery-1.8.3.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/main.js"></script>
