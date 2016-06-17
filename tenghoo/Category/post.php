<?php
##字符字数限制 以下为准，每行代码尽量不超出80字符
##############################################################################
  require('../checklogin.php');
  //栏目表
  $article_type_table = 'article_type';
  //文章表
  $article_table = 'article';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
  ###################  添加栏目  ####################
  	case 'type_add':
      $info = $_POST['info'];
  		if ($info['pid'] == 0) {
  			if($_SESSION['role_id'] != 1){
  				showmsg('不允许添加一级栏目');
  				exit();
  			}
  		}
      if (empty($info['typename']) || empty($info['typetpl'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      if ($info['pid'] != 0) {
        $category = new category();
        $typewhere = array('order by'=>'id asc');
        $field = 'id,typename,pid';
        $typelist = $db -> th_selectall($article_type_table,$typewhere,$field);
        $toparr = $category -> getParents($typelist,$info['pid']);
        $info['topid'] = $toparr[0]['id'];
      }else{
        $info['topid'] = 0;
      }
      if ($info['typedesc'] == '') {
      	$info['typedesc'] = trim(@cn_substr(Html2Text($info['typecontent']),AUTO_DESCRIPTION));
      }
      $info['m_id'] = $_SESSION['m_id'];
      $info['creattime'] = time();
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
	    $name = $info['name'];
	    if ($name == '') {
		    $name = $info['name'] = pinyin($info['typename']);
	    }
	    if ($info['pid'] != 0) {
		    if ($name == $_POST['pname']) {
			    $name .= pinyin($info['typename']);
		    }
		    $info['name'] = $name;
	    } else {
		    if(substr($name, 0, 1) != '/'){
			    $name = $info['name'] = '/'.$name;
		    }
	    }
	    if(substr($name, -1) != '/'){
		    $name = $info['name'] .= '/';
	    }
	    $w = ' and name="'.$name.'"';
	    if($db->th_select($article_type_table, $w)){
		    showmsg('标识已存在，请更换');
		    exit();
	    }
      if($db -> th_insert($article_type_table,$info)){
        showmsg('添加成功',ADMIN.'/Category/index.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
  		break;
    ########################  编辑栏目  #######################
  	case 'type_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      if ($info['pid'] != 0) {
        $category = new category();
        $typewhere = array('order by'=>'id asc');
        $typelist = $db -> th_selectall($article_type_table,$typewhere,'id,typename,pid');
        $toparr = $category -> getParents($typelist,$info['pid']);
        $info['topid'] = $toparr[0]['id'];
      }else{
        $info['topid'] = 0;
      }
      if ($info['typedesc'] == '') {
      	$info['typedesc'] = trim(@cn_substr(Html2Text($info['typecontent']),AUTO_DESCRIPTION));
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
	    $name = $info['name'];
	    if ($name == '') {
		    $name = $info['name'] = pinyin($info['typename']);
	    }
	    if(substr($name, -1) != '/'){
		    $name = $info['name'] .= '/';
	    }
	    if ($info['pid'] == 0) {
		    if(substr($name, 0, 1) != '/'){
			    $name = $info['name'] = '/'.$name;
		    }
	    }
	    $w = ' and name="'.$name.'" and id !='.$where['id'];
	    if($db->th_select($article_type_table, $w)){
		    showmsg('标识已存在，请更换');
		    exit();
	    }
      if($db -> th_update($article_type_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Category/index.php');
        exit();
      }else{
        showmsg('编辑失败');
        exit();
      }
      break;
    ############## 获取模型模板  ###################
    case 'gettpl':
      $where['model_id'] = intval($_POST['model_id']);
      $field = 'model_list_tpl,model_view_tpl,model_page_tpl,model_addfile,model_addtable';
      $modelinfo = $db -> th_select('model',$where,$field);
      if ($modelinfo) {
        $data = $modelinfo;
        $data['status'] = 1;
      }else{
        $data['status'] = 0;
        $data['msg'] = '获取模板失败';
      }
      echo json_encode($data);
      exit();
      break;
    ##########################  删除栏目  ##########################
    case 'del_type':
      $id = intval($_POST['id']);
      if (!$id || empty($id)) {
          echo '0';
          exit();
      }
      //查询所有栏目
      $article_type_list = $db -> th_selectall('article_type',array('order by'=>'id asc'),'*');
      $category = new category();
      //把当前id传入，返回当前id的所有子级id，第三个参数为1则表示返回的数组里包括当前id
      $typeids = $category->getChildsId($article_type_list,$id,0);
      
      $tids = '';
      if ($typeids) {
      	foreach ($typeids as $key => $value) {
	        $tids .= $value;
	        $tids .= ',';
	      }
      }
      
      $tids .= $id;
      $articlewhere = ' AND typeid IN ('.$tids.')';
      $articleIds = $db -> th_selectall($article_table,$articlewhere,'id');
      $article_ids = array();
      foreach ($articleIds as $key => $value) {
        $article_ids[] = $value['id'];
      }
      $article_ids_str = '';
      if ($article_ids) {
        $article_ids_str = implode(',', $article_ids);
      }
      $where = ' AND id IN ('.$tids.')';
      $ishavechild = strpos($tids,',');
      $tidarr = array();
      if ($ishavechild) {
        $tidarr = explode(',',$tids);
      }else{
      	$tidarr[] = $tids;
      }
      if(@$db -> th_delete($article_type_table,$where)){
        //删除栏目下的文章
        	@$db -> th_delete($article_table,$articlewhere);
          //删除附加表信息
          if ($article_ids_str) {
            $addwhere = ' AND article_id IN ('.$article_ids_str.')';
            $model = $db -> th_selectall('model','','model_addtable',array(100));
            foreach ($model as $key => $value) {
              @$db -> th_delete($value['model_addtable'],$addwhere);
            }
          }
          
        	$data['lists'] = $tidarr;
        	$data['status'] = '1';
          echo json_encode($data);
          exit();
      }
      echo 0;
      exit();
      break;
    ############################  栏目排序  ##########################
    case 'type_sort':
      $ids = $_POST['ids'];
      $sort = $_POST['sort'];
      $info = array_combine($ids,$sort);
      foreach ($info as $key => $value) {
        $where['id'] = $key;
        $data['sort'] = $value;
        if(!$db -> th_update($article_type_table,$where,$data)){
          showmsg('更新失败');
          exit();
        }
      }
      showmsg('更新成功',ADMIN.'/Category/index.php');
      exit();
      break;
    #############################  添加文章  #########################
    case 'article_add':
      $info = $_POST['info'];
      $litpics = isset($_POST['litpics']) ? $_POST['litpics'] : '';
      $lsort = isset($_POST['lsort']) ? $_POST['lsort'] : '';
      if ($litpics) {
        if ($lsort) {
          foreach ($litpics as $key => $value) {
            $litpics[$key] .= '---'.$lsort[$key];
          }
        }
        $info['litpics'] = implode('+', $litpics);
      }
      if (empty($info['title']) || empty($info['typeid'])) {
        showmsg('参数错误，请重新填写');
        exit();
      }
      $info['m_id'] = $_SESSION['m_id'];
      $info['creattime'] = isset($info['creattime']) ? strtotime($info['creattime']) : time();

      if ($info['description'] == '') {
        $info['description'] = trim(cn_substr(Html2Text($info['content']),AUTO_DESCRIPTION));
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      $id = $db -> th_insert($article_table,$info);
      if($id){
        //处理附加字段
        $add = isset($_POST['add']) ? $_POST['add'] : '';
        $addtable = isset($_POST['model_addtable']) ? trim($_POST['model_addtable']) : '';
        if ($add) {
          $add['article_id'] = $id;
          if (!$db -> th_insert($addtable,$add)) {
            showmsg('添加失败');
            exit();
          }
        }
        showmsg('添加成功',ADMIN.'/Category/article_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;
    ###########################  编辑文章  ##########################
    case 'article_edit':
      $where['id'] = intval($_POST['id']);
      $info = $_POST['info'];
      $info['c'] = isset($info['c']) ? $info['c'] : 0;
      $info['h'] = isset($info['h']) ? $info['h'] : 0;
      $litpics = isset($_POST['litpics']) ? $_POST['litpics'] : '';
      $lsort = isset($_POST['lsort']) ? $_POST['lsort'] : '';
      
      //处理附加字段
      $add = isset($_POST['add']) ? $_POST['add'] : '';
      $addtable = isset($_POST['model_addtable']) ? trim($_POST['model_addtable']) : '';
      if ($add) {
        if($db -> th_select($addtable,array('article_id'=>$where['id']))){
          if (!$db -> th_update($addtable,array('article_id'=>$where['id']),$add)) {
            showmsg('编辑失败');
            exit();
          }
        } else {
          $add['article_id'] = $where['id'];
          if (!$db -> th_insert($addtable,$add)) {
            showmsg('编辑失败');
            exit();
          }
        }
      }
      if ($litpics) {
        if ($lsort) {
          foreach ($litpics as $key => $value) {
            $litpics[$key] .= '---'.$lsort[$key];
          }
        }
        $info['litpics'] = implode('+', $litpics);
      }else{
        $info['litpics'] = '';
      }
      if (!get_magic_quotes_gpc()) {
        foreach ($info as $key => $value) {
          $info[$key] = addslashes($value);
        }
      }
      $info['creattime'] = isset($info['creattime']) ? strtotime($info['creattime']) : time();
      if($db -> th_update($article_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Category/article_list.php?typeid='.$info['typeid']);
        exit();
      }else{
        showmsg('编辑失败');
        exit();
      }
      break;
    #############################  文章排序  ##########################
    case 'article_sort':
      $ids = $_POST['ids'];
      $sort = $_POST['sort'];
      $info = array_combine($ids,$sort);
      foreach ($info as $key => $value) {
        $where['id'] = $key;
        $data['sort'] = $value;
        if(!$db -> th_update($article_table,$where,$data)){
          showmsg('更新失败');
          exit();
        }
      }
      showmsg('更新成功',ADMIN.'/Category/article_list.php?typeid='.$_POST['typeid']);
      exit();
      break;
      #############################  改变文章状态  ########################
      case 'changestatus':
      	$id = intval($_POST['id']);
      	if (!$id) {
      		$data = array(
      				'msg'=>'参数错误，请重新选择',
      				'status'=>0
      		);
      		echo json_encode($data);
      		exit();
      	}
      	$info[$_POST['operating']] = $_POST['status'];
      	$where['id'] = $id;
      	if(!$db -> th_update($article_table,$where,$info)){
      		$data = array(
      				'msg'=>'更新失败',
      				'status'=>0
      		);
      		echo json_encode($data);
      		exit();
      	}
      	$data = array(
      			'status'=>1
      	);
      	echo json_encode($data);
      	exit();
      	break;
    ############################# 文章回收站  #######################
    case 'recover':
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $recover = isset($_POST['recover']) ? $_POST['recover'] : 1;
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
      $info = array('isrecover'=>$recover);
      if(!$db -> th_update($article_table,$where,$info)){
        if (@isAjax()) {
          echo 0;
          exit();
        } else {
          showmsg('删除失败');
          exit();
        }
      }
      if (@isAjax()) {
        echo 1;
        exit();
      }else{
        showmsg('删除成功',ADMIN.'/Category/article_list.php?typeid='.$_POST['typeid']);
        exit();
      }
      break;
    #############################  删除文章  ############################
    case 'del_article':
      $id = isset($_POST['id']) ? $_POST['id'] : '';
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
      if(@$db -> th_delete($article_table,$where)){
        //删除附加表的信息
        $addwhere = ' AND article_id IN ('.$id.')';
        $model = $db -> th_selectall('model','','model_addtable');
        foreach ($model as $key => $value) {
          @$db -> th_delete($value['model_addtable'],$addwhere);
        }
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Category/article_list.php?typeid='.$_POST['typeid']);
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