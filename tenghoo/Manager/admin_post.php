<?php 
  require('../checklogin.php');
  //管理员表
  $admintable = 'admin';
  //用户组表
  $role_table = 'role';
  //用户和用户组关系表
  $role_user_table = 'role_user';
  //权限分类表
  $node_type_table = 'node_type';
  //节点表
  $node_table = 'node';
  //权限表
  $access_table = 'access';
  
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
  	
    #####################  添加用户组  #######################
    case 'role_add':
      $info = $_POST['info'];
      if (empty($info['name'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      $where['name'] = trim($info['name']);
      $where['order by'] = 'id asc';
      if($db -> th_select($role_table,$where,'id')){
        showmsg('用户组名称 '.$info['name'].' 已存在，请更换');
        exit();
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      $role_id = $db -> th_insert($role_table,$info);
      if($role_id){
      	if (isset($_POST['access']) && !empty($_POST['access'])) {
      		foreach ($_POST['access'] as $k){
      			$v = $role_id.','.$k;
      			$sql = 'INSERT INTO `'.DB_PRE.$access_table.'` (`role_id`, `node_id`) VALUES ('.$v.')';
      			@$db -> sql_insert($sql);
      		}
      	}
        showmsg('添加成功',ADMIN.'/Manager/role_list.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;

    ####################  编辑用户组  ########################
    case 'role_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if (isset($_POST['access']) && !empty($_POST['access'])) {
      	$accesswhere = $where['id'];
      	@$db -> th_delete('access',' AND `role_id` IN ('.$accesswhere.')');
      	foreach ($_POST['access'] as $k){
      		$v = $where['id'].','.$k;
      		$sql = 'INSERT INTO `'.DB_PRE.$access_table.'` (`role_id`, `node_id`) VALUES ('.$v.')';
      		@$db -> sql_insert($sql);
      	}
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      if($db -> th_update($role_table,$where,$info)){
        showmsg('修改成功',ADMIN.'/Manager/role_list.php');
        exit();
      }else{
        showmsg('修改失败');
        exit();
      }
      break;

    ##################  删除用户组  ################
    case 'del_role':
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      if (!$id || empty($id)) {
        echo '0';
        exit();
      }
      $where = ' AND id IN ('.$id.')';
      if($db -> th_update($role_user_table,array('role_id'=>$id),array('role_id'=>''))){
        if($db -> th_delete($role_table,$where)){
          echo 1;
          exit();
          
        }
      }
      echo 0;
      exit();
      break;
	
      
      ###################################  添加权限分类  ###########################################
      case 'note_type_add':
      	
      	$info = $_POST['info'];
      	if (empty($info['node_type_name'])) {
      		showmsg('参数错误，请重新填写');
      		exit();
      	}
      	$where['node_type_name'] = trim($info['node_type_name']);
      	$where['order by'] = 'node_type_id asc';
      	if($db -> th_select($node_type_table,$where,'node_type_id')){
      		showmsg('分类名称 '.$info['node_type_name'].' 已存在，请更换');
      		exit();
      	}
      	$info['m_id'] = $_SESSION['m_id'];
      	$info['creattime'] = time();
        if (!get_magic_quotes_gpc()) {
          foreach ($info as $key => $value) {
            $info[$key] = addslashes($value);
          }
        }
      	if($db -> th_insert($node_type_table,$info)){
      		showmsg('添加成功',ADMIN.'/Manager/node_list.php');
      		exit();
      	}else{
      		showmsg('添加失败');
      		exit();
      	}
      	break;
      	
      	#################  添加节点  ###################
      	case 'node_add':
      		$info = $_POST['info'];
      		if (empty($info['node_name'])) {
      			showmsg('参数错误，请重新填写');
      			exit();
      		}
      		$where['node_name'] = trim($info['node_name']);
      		$where['order by'] = 'node_id asc';
      		if($db -> th_select($node_table,$where,'node_id')){
      			showmsg('节点名称 '.$info['node_name'].' 已存在，请更换');
      			exit();
      		}
      		$info['m_id'] = $_SESSION['m_id'];
      		$info['creattime'] = time();
          if (!get_magic_quotes_gpc()) {
            foreach ($info as $key => $value) {
              $info[$key] = addslashes($value);
            }
          }
      		if($db -> th_insert($node_table,$info)){
      			showmsg('添加成功',ADMIN.'/Manager/node_list.php');
      			exit();
      		}else{
      			showmsg('添加失败');
      			exit();
      		}
      		break;
      
    ################  添加用户  ##################
  	case 'admin_add':
      $info = $_POST['info'];
      if (empty($info['name']) || empty($info['password'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      $where['name'] = trim($info['name']);
      $where['order by'] = 'id asc';
      if($db -> th_select($admintable,$where,'id')){
        showmsg('管理员名称 '.$info['name'].' 已存在，请更换');
        exit();
      }
      $info['creattime'] = time();
      $info['password'] = md5(trim($info['password']));
      if (!get_magic_quotes_gpc()) {
        $info['name'] = addslashes($info['name']);
      }
      $admin_id = $db -> th_insert($admintable,$info);
      if($admin_id){
        $role_id = isset($_POST['role_id']) ? intval($_POST['role_id']) : '';
        $a_r['role_id'] = $role_id;
        $a_r['user_id'] = $admin_id;
        if($db -> th_insert($role_user_table,$a_r)){
          showmsg('添加管理员成功',ADMIN.'/Manager/index.php');
          exit();
        }
      }
      showmsg('添加管理员失败');
      exit();
  		break;
    ###############  编辑用户  ###############
  	case 'admin_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if ($info['password'] == '') {
        unset($info['password']);
      }else{
        $info['password'] = md5(trim($info['password']));
      }
      if (!get_magic_quotes_gpc()) {
        $info['name'] = addslashes($info['name']);
      }
      if($db -> th_update($admintable,$where,$info)){
        $role_id = isset($_POST['role_id']) ? intval($_POST['role_id']) : '';

        //默认只有1个超级管理员tenghoo，如果需要有多个超级管理员，需要改动这里和前台页面
        if ($where['id'] == 21) {
          $role_id = '2';
        }
        $a_r['role_id'] = $role_id;
        if($db -> th_update($role_user_table,array('user_id'=>$_POST['id']),$a_r)){
          showmsg('修改成功',ADMIN.'/Manager/index.php');
          exit();
        }
      }
      showmsg('修改失败');
      exit();
      break;

    #############  删除用户  #############
    case 'del':
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
      if ($id == 1) {
      	echo '0';
        exit();;
      }
      if (is_array($id)) {
        $id = implode(',', $id);
      }
      $where = ' AND id IN ('.$id.')';
      if($db -> th_delete($admintable,$where)){
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Manager/index.php');
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