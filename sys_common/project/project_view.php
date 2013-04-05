<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>项目信息页面</title>
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css">

<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
<?php include_once("./action/sys/db.php");?>

<?
	date_default_timezone_set('ETC/GMT-8');
	//error_reporting(-1);
	$pid = $_GET['pid'];
	$db = new DB("pm");
	$pro = $db->getone("select * from pm_project_info where p_id='".$pid."'");
?>
</head>

<body style="padding:10px;">
	<div style="font-family:'黑体';font-size:18px">名称: <span style="color:#999;"><?php echo $pro["p_name"] ?></span></div><br/>
	<div>
		<div style="float:left;width:400px;margin-bottom:10px;">负责人: 
		<?php
			$db = new DB();
			$ds = $db->getlist("select * from pm_user, pm_p2user where u_id = p2u_uid and p2u_pid='".$pid."'");
			$db->close();
			
			for($i=0;$i<count($ds);$i++)
			{
				?>
					<span style="color:#999; margin-right:5px;"><?php echo $ds[$i]["u_name"] ?></span>
				<?php
			}
		?>
		</div>
	</div>
	
	<div style="clear:both;">
	启动日: <span style="color:#999;margin-right:50px;"><?php echo date("Y-m-d",strtotime($pro["p_date_start"])) ?></span>
	验收日: <span style="color:#999;"><?php echo date("Y-m-d",strtotime($pro["p_date_end"])) ?></span>
	</div> <br/>
	<div>备　注:</div>
	<div style="border:1px solid #ccc;padding:3px;margin:2px;"><?php echo $pro["p_remark"] ?></div>
</body>
</html>


