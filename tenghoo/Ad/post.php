<?php 
  require('../checklogin.php');
  //栏目表
  $ad_table = 'ad';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {

    ####################### 添加广告位  #######################
  	case 'ad_add':
      $info = $_POST['info'];
      if (empty($info['ad_name'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      $info['m_id'] = $_SESSION['m_id'];
      $info['creattime'] = time();
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_insert($ad_table,$info)){
        showmsg('添加成功',ADMIN.'/Ad/index.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
  		break;
     ##################  编辑广告位  #######################
  	case 'ad_edit':
      $where['ad_id'] = intval($_POST['ad_id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($ad_table,$where,$info)){
        showmsg('更新成功',ADMIN.'/Ad/index.php');
        exit();
      }else{
        showmsg('更新失败');
        exit();
      }
      break;
    ###################  删除栏目  ###################
    case 'ad_del':
      $ad_id = intval($_POST['ad_id']);
      if (!$ad_id || empty($ad_id)) {
          echo '0';
          exit();
      }
      $where = ' AND ad_id IN ('.$ad_id.')';
      if (@$db -> th_delete($ad_table,$where)) {
        echo 1;
        exit();
      }
      echo 0;
      exit();
      break;
  }
?>