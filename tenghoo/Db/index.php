<?php 
require('../checklogin.php');

//权限判断
if(!manager(32)){showmsg('没有权限访问');exit();}
$pos = '备份数据库';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台主窗口</title>
<style type="text/css">
<!--
	body{
		font-size:12px;
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
	td{font-size:12px;}
	
	.khwz {
	color: #FF0000;
	font-weight: bold;
	font-family:"黑体";
	filter: shadow(color=999999,direction=150); 
	zoom:1; 
	padding:10px;
	font-size: 36px; 
	}
	.pysm{
	color: #003399;
	font-weight: bold;
	font-size: 26px;
	font-family:"隶书"
	}
-->
</style>
<?php include '../adminstatic.html';?>
</head>
<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="index.html"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
        	<div style="padding: 0 0 0 30px;height: 150px;">
        		<h1>请每隔一段时间备份一次数据库，以免数据丢失</h1>
	        	<p>如若需要还原数据库，请联系 <a href="http://www.tenghoo.com" target='_blank' style="color:#E83319;"><b>广州腾虎网络科技有限公司</b></a></p>
	        	<p>全国服务热线：400-603-3310 &nbsp;&nbsp;&nbsp;广州热线：020-85201720</p>
				<br><br><br>
	        	<a href="dbback.php" style="padding: 5px 10px;border: 2px outset buttonface;"><i class="fa fa-download fa-fw"></i> 立即备份</a>
        	</div>
        	
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>