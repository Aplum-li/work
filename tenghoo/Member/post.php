<?php 
  require('../checklogin.php');
  //会员组表
  $memberGroupTable = 'member_group';
  //会员表
  $memberTable = 'member';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
    #################  添加会员组  ##################
    case 'groupAdd':
      $info = $_POST['info'];
      if (empty($info['group_name'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      $where['group_name'] = trim($info['group_name']);
      $where['order by'] = 'group_id asc';
      if($db -> th_select($memberGroupTable,$where,'group_id')){
        showmsg('会员组名称 '.$info['group_name'].' 已存在，请更换');
        exit();
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      $role_id = $db -> th_insert($memberGroupTable,$info);
      if($role_id){
        showmsg('添加成功',ADMIN.'/Member/groupList.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;
    ################## 修改会员组  ###################
    case 'groupEdit':
      $where['group_id'] = intval($_POST['group_id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($memberGroupTable,$where,$info)){
        showmsg('更新成功',ADMIN.'/Member/groupList.php');
        exit();
      }else{
        showmsg('更新失败');
        exit();
      }
      break;
    ##################  删除会员组  ###################
    case 'groupDel':
      $group_id = isset($_POST['group_id']) ? $_POST['group_id'] : '';
      if (!$group_id || empty($group_id)) {
        echo '0';
        exit();
      }
      $where = ' AND group_id IN ('.$group_id.')';
      if($db -> th_delete($memberGroupTable,$where)){
        echo 1;
        exit();
      }
      echo 0;
      exit();
      break;
    #################  添加会员  ######################
    case 'memberAdd':
    $info = isset($_POST['info']) ? $_POST['info'] : array();
    if (empty($info)) {
      exit();
    }
    if (!get_magic_quotes_gpc()) {
      foreach ($info as $key => $value) {
        $info[$key] = addslashes($value);
      }
    }
    //账号
    $account = isset($info['account']) ? clstring($info['account']) : '';
    
    //检测账号是否存在
      $accountWhere = array('account'=>$account);
    $memberIsset = $db -> th_select($memberTable,$accountWhere,'id');
    if ($memberIsset) {
      $resutl['msg'] = '账号已存在';
      $resutl['status'] = '0';
      echo json_encode($resutl);
      exit();
    }
    //密码
    $member_password = isset($info['password']) ? trim($info['password']) : '';
    $info['password'] = md5($member_password);
    //手机号码
    $member_phone = isset($info['phone']) ? clstring($info['phone']) : '';
      $phoneWhere = array('phone'=>$member_phone);
    $memberIsset = $db -> th_select($memberTable,$phoneWhere,'id');
    if ($memberIsset) {
      $resutl['msg'] = '手机号码已存在';
      $resutl['status'] = '0';
      echo json_encode($resutl);
      exit();
    }
    //邮箱账号
    $member_email = isset($info['email']) ? clstring($info['email']) : '';
      $emailWhere = array('email'=>$member_email);
    $memberIsset = $db -> th_select($memberTable,$emailWhere,'id');
    if ($memberIsset) {
      $resutl['msg'] = '邮箱账号已存在';
      $resutl['status'] = '0';
      echo json_encode($resutl);
      exit();
    }

    if (htmlspecialchars($info['sex']) == 'b') {
      $info['sex'] = 'b';
      $info['face'] = '/data/images/dfboy.png';
    }else{
      $info['sex'] = 'g';
      $info['face'] = '/data/images/gfboy.png';
    }
    $info['register_time'] = time();
    $info['nickname'] = $info['nickname'];

    $member_id = $db -> th_insert($memberTable,$info);
    if($member_id){
      $resutl['msg'] = '添加成功';
      $resutl['status'] = 'y';
      echo json_encode($resutl);
      exit();
    }else{
      $resutl['msg'] = '注册失败';
      $resutl['status'] = '0';
      echo json_encode($resutl);
      exit();
    }
    break;
    ###################################  编辑会员  ##############################
    case 'memberEdit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      //检测账号是否存在
        $accountWhere = ' AND `account`="'.$info['account'].'"';
        $accountWhere .= ' AND `id`!='.$where['id'];
      $memberIsset = $db -> th_select($memberTable,$accountWhere,'id');
      if ($memberIsset) {
        $resutl['msg'] = '账号名重复';
        $resutl['status'] = '0';
        echo json_encode($resutl);
        exit();
      }
      //检测手机号码是否存在
        $phoneWhere = ' AND `phone`="'.$info['phone'].'"';
        $phoneWhere .= ' AND `id`!='.$where['id'];
      $memberIsset = $db -> th_select($memberTable,$phoneWhere,'id');
      if ($memberIsset) {
        $resutl['msg'] = '手机号码重复';
        $resutl['status'] = '0';
        echo json_encode($resutl);
        exit();
      }
      //检测邮箱账号是否存在
        $emailWhere = ' AND `email`="'.$info['email'].'"';
        $emailWhere .= ' AND `id`!='.$where['id'];
      $memberIsset = $db -> th_select($memberTable,$emailWhere,'id');
      if ($memberIsset) {
        $resutl['msg'] = '邮箱账号重复';
        $resutl['status'] = '0';
        echo json_encode($resutl);
        exit();
      }


      if ($info['password'] == '') {
        unset($info['password']);
      }else{
        $info['password'] = md5(trim($info['password']));
      }
      if($db -> th_update($memberTable,$where,$info)){
          $resutl['msg'] = '更新成功';
          $resutl['status'] = 'y';
          echo json_encode($resutl);
          exit();
      }else{
        $resutl['msg'] = '更新失败';
        $resutl['status'] = '0';
        echo json_encode($resutl);
        exit();
      }
      break;
    ###################################  删除会员  ##############################
    case 'del':
      $member_id = isset($_POST['id']) ? $_POST['id'] : '';
      if (!$member_id || empty($member_id)) {
        if (@isAjax()) {
          echo '0';
          exit();
        }else{
          showmsg('请选择数据');
          exit();
        }
      }
      if (is_array($member_id)) {
        $member_id = implode(',', $member_id);
      }
      $where = ' AND id IN ('.$member_id.')';
      if($db -> th_delete($memberTable,$where)){
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Member/index.php');
          exit();
        }
        
      }else{
        if (@isAjax()) {
          echo 0;
          exit();
        }else{
          showmsg('删除失败');
          exit();
        }
      }
      break;
    #############  更新配置  #################
  	case 'update':
      $cfg = isset($_POST['info']) ? $_POST['info'] : '';
      $cfg['reg'] = isset($_POST['info']['reg']) ? $_POST['info']['reg'] : 0;
      $cfg['login'] = isset($_POST['info']['login']) ? $_POST['info']['login'] : 0;
      if(file_put_contents(ROOTPATH.'/config/member.config.php',serialize($cfg))){
        showmsg('更新成功','system.php');
        exit();
      }else{
        showmsg('更新失败');
        exit();
      }
  		break;
  }
?>