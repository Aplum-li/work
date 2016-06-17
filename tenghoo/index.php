<?php
/**
 * 后台首页
 */
$path = dirname(__FILE__);
$incpath = str_replace("\\", '/', substr($path,0,-8) );
require_once $incpath.'/include/common.inc.php';
if(!checklogin()){
	header("Location: ".ADMIN."/login.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>网站后台管理</title>
</head>

<FRAMESET border=0 frameSpacing=0 rows=* frameBorder=NO >
	<FRAMESET border=0 frameSpacing=0 rows=69,* frameBorder=NO cols=*>
		<FRAME name=topFrame src="head.php" noResize scrolling=no >
		<frameset border="0" name="downfr" framespacing="0" rows="*" frameborder="no" cols="190,*">
			<FRAME name=leftFrame src="left.php" scrolling="no" >
			<FRAME name=mainFrame src="main.php" scrolling=yes>
		</frameset>
	</FRAMESET>
	<!-- <FRAME name=bottomFrame src="bottom.php" noResize scrolling=no> -->
</FRAMESET>
</html>
