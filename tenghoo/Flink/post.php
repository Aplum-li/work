<?php 
  require('../checklogin.php');
  //友情链接表
  $flinkTable = 'flink';
  $flinktype_table = 'flink_type';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
	  
	###################  添加分类  ##################
  	case 'type_add':
      $info = $_POST['info'];
      if (empty($info['flink_type_name'])) {
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
      if($db -> th_insert($flinktype_table,$info)){
        showmsg('添加成功',ADMIN.'/Flink/index.php');
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
      if($db -> th_update($flinktype_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Flink/index.php');
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
      if(@$db -> th_delete($flinktype_table,$where)){
      		//删除该分类下所有的轮换图
      		@$db -> th_delete($flinkTable,$typewhere);
          echo 1;
          exit();
      }
      echo 0;
      exit();
      break;
	  
	  
    ##################### 添加友情链接  ###################
    case 'flinkAdd':
      $info = $_POST['info'];
      if (empty($info['flink_name'])) {
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
      if($db -> th_insert($flinkTable,$info)){
        showmsg('添加成功',ADMIN.'/Flink/flink_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;
    ######################  修改友情链接  ####################
    case 'flinkEdit':
      $where['flink_id'] = intval($_POST['flink_id']);
      $info = $_POST['info'];
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($flinkTable,$where,$info)){
        showmsg('更新成功',ADMIN.'/Flink/flink_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('更新失败');
        exit();
      }
      break;
    #####################  删除友情链接  ######################
    case 'del':
      $flink_id = isset($_POST['flink_id']) ? $_POST['flink_id'] : '';
      if (!$flink_id || empty($flink_id)) {
        if (@isAjax()) {
          echo '0';
          exit();
        }else{
          showmsg('请选择数据');
          exit();
        }
      }
      if (is_array($flink_id)) {
        $flink_id = implode(',', $flink_id);
      }
	  $typeid = $_POST['typeid'];
      $where = ' AND flink_id IN ('.$flink_id.')';
      if(@$db -> th_delete($flinkTable,$where)){
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Flink/flink_list.php?typeid='.$typeid);
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
    ##################  排序  #####################
    case 'sort':
      $ids = $_POST['ids'];
      $sort = $_POST['sort'];
	  //p($_GET['typeid']);die;
	  $typeid = $_POST['typeid'];
      $info = array_combine($ids,$sort);
      foreach ($info as $key => $value) {
        $where['flink_id'] = $key;
        $data['sort'] = $value;
        if(!$db -> th_update($flinkTable,$where,$data)){
          showmsg('更新失败');
          exit();
        }
      }
      showmsg('更新成功',ADMIN.'/Flink/flink_list.php?typeid='.$typeid);
      exit();
      break;
  }
?>