<?php
//会员操作
###############################################################################
require_once 'config.php';
if (!isset($_SESSION['memberInfo'])) {
	header('location:index.php');
	exit();
}
$mid = $_SESSION['memberInfo']['id'];
$act = isset($_GET['act']) ? htmlspecialchars($_GET['act']) : '';
switch ($act) {
	####################### 基本资料 ############################
	case 'base':
		$field = 'account,nickname,face,sex,phone,tel,email,blog_account,qq_account';
		$userInfo = $db -> th_select('member',array('id'=>$mid),$field);
		$smarty -> assign('userInfo',$userInfo);
		$title = '基本资料';
		break;
	####################### 修改密码 ############################
	case 'updatePass':
		$title = '修改密码';
		break;
	####################### 修改密码 ############################
	case 'updateFace':
		$field = 'face';
		$where = array('id'=>$mid);
		$userInfo = $db -> th_select('member',$where,$field);
		if (trim($userInfo['face'] == '')) {
			$userInfo['face'] = '/member/images/default.png';
		}
		$smarty -> assign('userInfo',$userInfo);
		$title = '修改头像';
		break;
	####################### 首页 ############################
	default:
		$title = '会员首页';
		break;
}
$tpl = $act.'.html';
$smarty -> assign('title',$title);
$smarty -> display($tpl);
?>