<?php 
  require('../checklogin.php');
  //栏目表
  $messageTable = 'message';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
    ##################  删除留言  ###################
    case 'del':
      $message_id = isset($_POST['message_id']) ? $_POST['message_id'] : '';
      if (!$message_id || empty($message_id)) {
        if (@isAjax()) {
          echo '0';
          exit();
        }else{
          showmsg('请选择数据');
          exit();
        }
      }
      if (is_array($message_id)) {
        $message_id = implode(',', $message_id);
      }
      $where = ' AND message_id IN ('.$message_id.')';
      if(@$db -> th_delete($messageTable,$where)){
        if (@isAjax()) {
          echo 1;
          exit();
        }else{
          showmsg('删除成功',ADMIN.'/Message/index.php');
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
  }
?>