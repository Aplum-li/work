<?php
###############################################################################
require_once 'config.php';
$act = isset($_GET['act']) ? htmlspecialchars($_GET['act']) : '';
switch ($act) {
	####################### 注册 ############################
	case 'register':
		$isRegCode = loadConfig('reg','member.config.php');
		$title = '会员注册';
		$smarty -> assign('isRegCode',$isRegCode);
		break;
	####################### 退出 ############################
	case 'quit':
		unset($_SESSION['memberInfo']);
		showmsg('退出成功','index.php');
		exit();
		break;
	####################### 首页 ############################
	default:
		if (!isset($_SESSION['memberInfo'])) {
			$isRegCode = loadConfig('login','member.config.php');
			$title = '会员登录';
			$smarty -> assign('isRegCode',$isRegCode);
			$act = 'login';
		}else{
			$title = '会员首页';
			$act = 'index';
		}
		break;
}
$tpl = $act.'.html';
$smarty -> assign('title',$title);
$smarty -> display($tpl);
?>