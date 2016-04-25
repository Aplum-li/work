<?php
$path = dirname(__FILE__);
$GLOBALS["REWRITE"] = 0;
$incpath = str_replace("\\", '/', substr($path,0,-8) );
require_once $incpath.'/include/common.inc.php';
if(!checklogin()){
	showmsg('你还未登录',ADMIN.'/login.php');
	die();
}
?>
