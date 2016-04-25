<?php 
  require('../checklogin.php');
  //栏目表
  $rotation_type_table = 'rotation_type';
  //文章表
  $rotation_table = 'rotation';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {

    ###################  添加分类  ##################
  	case 'type_add':
      $info = $_POST['info'];
      if (empty($info['rotation_type_name'])) {
        showmsg('分类名称不能为空');
        exit();
      }
      $info['m_id'] = $_SESSION['m_id'];
      $info['creattime'] = time();
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_insert($rotation_type_table,$info)){
        showmsg('添加成功',ADMIN.'/Rotation/index.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
  		break;
     ###################  编辑分类 ###############
  	case 'type_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($rotation_type_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Rotation/index.php');
        exit();
      }else{
        showmsg('编辑失败');
        exit();
      }
      break;
    ###################  删除分类 ########################
    case 'del_type':
      $id = $_POST['id'];
      if (!$id || empty($id)) {
          echo '0';
          exit();
      }
      if (is_array($id)) {
        $id = implode(',', $id);
      }
      //查找该分类下所有的轮换图
			
      $where = ' AND id IN ('.$id.')';
      $typewhere = ' AND typeid IN ('.$id.')';
      if(@$db -> th_delete($rotation_type_table,$where)){
      		//删除该分类下所有的轮换图
      		@$db -> th_delete($rotation_table,$typewhere);
          echo 1;
          exit();
      }
      echo 0;
      exit();
      break;

    ###################  添加轮换图  ############################
    case 'article_add':
      $info = $_POST['info'];
      if (empty($info['title']) || empty($info['typeid'])) {
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
      if($db -> th_insert($rotation_table,$info)){
        showmsg('添加成功',ADMIN.'/Rotation/rotation_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;
    ###################  编辑轮换图  ###########################
    case 'article_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($rotation_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Rotation/rotation_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('编辑失败');
        exit();
      }
      break;
    ####################  轮换图排序  ######################
    case 'article_sort':
      $ids = $_POST['ids'];
      $sort = $_POST['sort'];
      $info = array_combine($ids,$sort);
      foreach ($info as $key => $value) {
        $where['id'] = $key;
        $data['sort'] = $value;
        if(!$db -> th_update($rotation_table,$where,$data)){
          showmsg('更新失败');
          exit();
        }
      }
      showmsg('更新成功',ADMIN.'/Rotation/rotation_list.php?typeid='.$_POST['typeid']);
      exit();
      break;
    ######################  删除轮换图  #######################
    case 'del_article':
      $id = $_POST['id'];
      if (!$id || empty($id)) {
        if (@isAjax()) {
          echo '0';
          exit();
        }else{
          showmsg('请选择数据');
          exit();
        }
      }
      if (is_array($id)) {
        $id = implode(',', $id);
      }
      $where = ' AND id IN ('.$id.')';
      if(@$db -> th_delete($rotation_table,$where)){
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Rotation/rotation_list.php?typeid='.$_POST['typeid']);
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
  	default:
  		
  		break;
  }
?>