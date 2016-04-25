<?php
###############################################################################
require_once 'config.php';
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
if ($type != 'register' && $type != 'login') {
	$mid = $_SESSION['memberInfo']['id'];
	if (!$mid) {
		die('请先登录');
	}
}
switch ($type){
	case 'register':
		//账号
		$account = isset($_POST['account']) ? clstring($_POST['account']) : '';

		//检测账号是否存在
		$where = array('account'=>$account);
		$minfo = $db -> th_select('member', $where, 'id');
		if ($minfo) {
			$resutl['msg'] = '账号已存在';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['account'] = $account;
		}
		//密码
		$password = isset($_POST['password']) ? trim($_POST['password']) : '';
		//确认密码
		$re_password = isset($_POST['repassword']) ? trim($_POST['repassword']) : '';
		if ($password !== $re_password) {
			$resutl['msg'] = '密码不一致';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['password'] =  md5($password);
		}

		//手机号码
		$phone = isset($_POST['phone']) ? clstring($_POST['phone']) : '';
		//检测手机号码是否存在
		$where = array('phone'=>$phone);
		$minfo = $db -> th_select('member', $where, 'id');
		if ($minfo) {
			$resutl['msg'] = '手机号码已存在';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['phone'] = $phone;
		}
		//邮箱账号
		$email = isset($_POST['email']) ? clstring($_POST['email']) : '';
		//检测邮箱账号是否存在
		$where = array('email'=>$email);
		$minfo = $db -> th_select('member', $where, 'id');
		if ($minfo) {
			$resutl['msg'] = '邮箱账号已存在';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['email'] = $email;
		}
		//验证码
		$isRegCode = loadConfig('reg','member.config.php');
		if ($isRegCode) {
			$vcode = isset($_POST['vcode']) ? trim(strtolower($_POST['vcode'])) : '';
			$vcode = md5($vcode);
			if ($vcode !== md5($_SESSION['safecode'])) {
				$resutl['msg'] = '验证码错误';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
		}
		if (loadConfig('check','member.config.php')) {
			$info['status'] = 'check';
		}else{
			$info['status'] = 'y';
		}
		if (htmlspecialchars($_POST['sex']) == 'b') {
			$info['sex'] = 'b';
			$info['face'] = '/data/images/dfboy.png';
		}else{
			$info['sex'] = 'g';
			$info['face'] = '/data/images/gfboy.png';
		}
		$info['group_id'] = 1;
		$info['register_time'] = time();
		$info['nickname'] = $info['member_account'];
		$mid = $db -> th_insert($memberTable,$info);
		if($mid){
			if (loadConfig('check','member.config.php')) {
				$resutl['msg'] = '注册成功，请等待管理员审核';
				$resutl['status'] = 'y';
				$resutl['gourl'] = '';
			}else{
				$resutl['msg'] = '注册成功，正在前往会员中心...';
				$resutl['status'] = 'y';
				$resutl['gourl'] = 'index.php';
				$_SESSION['id'] = $mid;
				$_SESSION['nickname'] = $info['nickname'];
			}
			echo json_encode($resutl);
			exit();
		}else{
			$resutl['msg'] = '注册失败';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}
		break;
	case 'login':
		$account = isset($_POST['account']) ? clstring($_POST['account']) : '';
		$password = isset($_POST['password']) && $_POST['password'] ? md5(trim($_POST['password'])) : '';
		if (!$account) {
			$resutl['msg'] = '账号不能为空';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}

		//目前支持两种登录方式，手机号和邮箱号
		if(checkPhone($account)){
			//手机号登录
			$where = array('phone'=>$account);
		} else if(checkEmail($account)){
			//邮箱号登录
			$where = array('email'=>$account);
		}
		$field = '`id`,`nickname`,`status`,`password`,`last_logintime`';
		$minfo = $db -> th_select('member',$where,$field);
		if ($minfo) {
			if ($minfo['password'] !== $password) {
				$resutl['msg'] = '密码不正确';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			if ($minfo['status'] == 'check') {
				$resutl['msg'] = '账号在审核当中，请耐心等候';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			if ($minfo['member_status'] == 'n') {
				$resutl['msg'] = '该账号已禁止登录';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			$updateData = array('last_logintime'=>time());
			$db -> th_update('member',array('id'=>$minfo['id']),$updateData);
			$memberS['id'] = $minfo['id'];
			$memberS['nickname'] = $minfo['nickname'];
			$memberS['last_logintime'] = $minfo['last_logintime'];

			$_SESSION['minfo'] = $memberS;
			$resutl['msg'] = '登录成功，正在前往会员中心...';
			$resutl['status'] = 'y';
			$resutl['gourl'] = 'index.php';
			echo json_encode($resutl);
			exit();
		}else{
			$resutl['msg'] = '账号不存在';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}
		break;
	####################### 修改基本资料 ############################
	case 'updateBase':
		$info = $_POST['info'];
		$member_account = isset($info['member_account'])
		 ? htmlspecialchars($info['member_account']) : '';
		//检测账号是否存在
		//如果开启了手机号码、邮箱账号可以登录，则需要同时判断
		//是否存在手机号和邮箱号
		if (loadConfig('account','member.config.php')) {
			$accountWhere = ' AND (`member_account`="'.$member_account.'"
					 || `member_phone`="'.$member_account.'"
					 || `member_email`="'.$member_account.'")';
		}else{
			$accountWhere = ' AND `member_account`="'.$member_account.'"';
		}
		$accountWhere .= ' AND `id` != '.$mid;
		
		$memberIsset = $db -> th_select($memberTable,$accountWhere,'id');
		if ($memberIsset) {
			$resutl['msg'] = '账号名称已存在，请更换';
			echo json_encode($resutl);
			exit();
		} else {
			$info ['member_account'] = $member_account;
		}
		//昵称
		$member_nickname = $info['member_nickname'] ?
		htmlspecialchars($info['member_nickname']) : '';
		if ($member_nickname) {
			$nickWhere = ' AND `member_nickname`="'.$member_nickname.'" AND `id` != '.$mid;
			if($db -> th_select($memberTable,$nickWhere,'id')){
				$resutl['msg'] = '昵称已存在，请更换';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}else{
				$info['member_nickname'] = $member_nickname;
			}
		}
		//手机号码
		$member_phone = $info['member_phone'] ?
		htmlspecialchars($info['member_phone']) : '';
		//检测手机号码是否存在
		//如果开启了手机号码、邮箱账号可以登录，则需要同时判断
		//是否存在账号和邮箱号
		if (loadConfig('account','member.config.php')) {
			$phoneWhere = ' AND (`member_account`="'.$member_phone.'" || `member_phone`="'.$member_phone.'" || `member_email`="'.$member_phone.'")';
		}else{
			$phoneWhere = ' AND `member_phone`="'.$member_phone.'"';
		}
		$phoneWhere .= ' AND `id` != '.$mid;
		$memberIsset = $db -> th_select($memberTable,$phoneWhere,'id');
		if ($memberIsset) {
			$resutl['msg'] = '手机号码已存在，请更换';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['member_phone'] = $member_phone;
		}
		//邮箱账号
		$member_email = isset($info['member_email']) ?
		htmlspecialchars($info['member_email']) : '';
		//检测手机号码是否存在
		//如果开启了手机号码、邮箱账号可以登录，则需要同时判断
		//是否存在账号和邮箱号
		if (loadConfig('account','member.config.php')) {
			$emailWhere = ' AND (`member_account`="'.$member_email.'" || `member_phone`="'.$member_email.'" || `member_email`="'.$member_email.'")';
		}else{
			$emailWhere = ' AND `member_email`="'.$member_email.'"';
		}
		$emailWhere .= ' AND `id` != '.$mid;

		$memberIsset = $db -> th_select($memberTable,$emailWhere,'id');
		if ($memberIsset) {
			$resutl['msg'] = '邮箱账号已存在，请更换';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}else{
			$info['member_email'] = $member_email;
		}
		if($db -> th_update($memberTable, array('id'=>$mid), $info)){
			$resutl['msg'] = '修改资料成功，正在跳转...';
			$resutl['status'] = 'y';
			$resutl['gourl'] = 'action.php?act=base';
			echo json_encode($resutl);
			exit();
		}else{
			$resutl['msg'] = '修改资料失败，请联系管理员';
			$resutl['status'] = '0';
			echo json_encode($resutl);
			exit();
		}
		break;
		####################### 修改密码 ############################
		case 'updatePass':
			$member_password = isset($_POST['member_password']) ? 
			trim($_POST['member_password']) : '';
			if (!$member_password) {
				$resutl['msg'] = '原密码不能为空';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			$where = array('id'=>$mid);
			$info = $db -> th_select($memberTable,$where,'member_password');
			if ($info['member_password'] != md5($member_password)) {
				$resutl['msg'] = '原密码错误';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			$member_password1 = isset($_POST['password']) ? 
			trim($_POST['password']) : '';
			$member_password2 = isset($_POST['repassword']) ? 
			trim($_POST['repassword']) : '';
			if ($member_password1 !== $member_password2) {
				$resutl['msg'] = '两次密码不一样';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
			$info['member_password'] = md5($member_password1);
			if($db -> th_update($memberTable, $where, $info)){
				$resutl['msg'] = '修改成功，请重新登录';
				$resutl['status'] = 'y';
				$resutl['gourl'] = 'index.php?act=quit';
				echo json_encode($resutl);
				exit();
			} else {
				$resutl['msg'] = '修改密码失败';
				$resutl['status'] = '0';
				echo json_encode($resutl);
				exit();
			}
		break;
		####################### 修改头像 ############################
		case 'updateFace':
			if (!empty($_FILES) && $_FILES['face']['error'] == 0) {
				require_once THINC . '/class/File.class.php';
				$fileUpload = new uploadFile();
				$fileUpload -> save_path = ROOTPATH . '/upload/face/';
				$uploadInfo = $fileUpload -> upload_file($_FILES['face']);
				if(!$uploadInfo){
					showmsg('图片上传失败');exit();
				}
				$info['member_face'] = '/upload/face/'.$uploadInfo['filename'];
				$where = array('id'=>$mid);
				if($db -> th_update($memberTable, $where, $info)){
					showmsg('修改成功','action.php?act=updateFace');
					exit();
				} else {
					showmsg('修改失败');
					exit();
				}
			}else{
				showmsg('请选择头像');
				exit();
			}
		break;
}