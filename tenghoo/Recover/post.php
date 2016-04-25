<?php
##字符字数限制 以下为准，每行代码尽量不超出80字符
##############################################################################
  require('../checklogin.php');
  //栏目表
  $article_type_table = 'article_type';
  //文章表
  $article_table = 'article';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  if(!manager(48)){showmsg('没有权限访问');exit();}
  switch ($type) {
    ################################### 还原文章  ###########################
    case 'recover':
      $id = isset($_POST['id']) ? $_POST['id'] : '';
      $recover = isset($_POST['recover']) ? $_POST['recover'] : 0;
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
          showmsg('还原失败');
          exit();
        }
      }
      if (@isAjax()) {
        echo 1;
        exit();
      }else{
        showmsg('还原成功',ADMIN.'/Recover/index.php?typeid='.$_POST['typeid']);
        exit();
      }
      break;
    ###################################  删除文章  #################################
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
          showmsg('删除成功',ADMIN.'/Recover/index.php?typeid='.$_POST['typeid']);
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