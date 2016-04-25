<?php
##字符字数限制 以下为准，每行代码尽量不超出80字符
##############################################################################
  require('../checklogin.php');
  //模型表
  $model_table = 'model';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {
    ################## 改变模型状态  ####################
    case 'changeStatus':
    	$model_id = intval($_POST['model_id']);
    	if (!$model_id) {
    		$data = array(
    				'msg'=>'参数错误，请重新选择',
    				'status'=>0
    		);
    		echo json_encode($data);
    		exit();
    	}

      $where['model_id'] = $model_id;
      $modelInfo = $db -> th_select($model_table,$where,'model_status');
      if ($modelInfo['model_status']) {
        //如果是启用的，改为禁用
        $info['model_status'] = 0;
      } else {
        //如果是禁用，改为启用
        $info['model_status'] = 1;
      }
    	
    	if(!$db -> th_update($model_table,$where,$info)){
    		$data = array(
            'msg'=>'更新失败',
            'status'=>0
        );
    		echo json_encode($data);
    		exit();
    	}
      $data['status'] = 1;
      $data['msg'] = $info['model_status'];
    	echo json_encode($data);
    	exit();
    	break;
    ###################  添加模型  ##################
    case 'model_add':
      $info = $_POST['info'];
      $filename = ROOTPATH.'/tenghoo/Category/'.$info['model_addfile'];
      if (!file_exists($filename)) {
        $myfile = @fopen($filename, "w");
        if ($myfile) {
          $phppre = "<?php\r\n//这是模型的附加文件\r\n?>";
          fwrite($myfile, $phppre);
        } else {
          echo '没有权限创建附加文件，请手工创建';
        }
        fclose($myfile);
      }
      $sql = "CREATE TABLE IF NOT EXISTS `".DB_PRE.$info['model_addtable']."` (`article_id` int(11) NOT NULL COMMENT '文章id') ENGINE=MyISAM DEFAULT CHARSET=utf8";
      @$db -> query($sql);
      if($db -> th_insert($model_table,$info)){
        $filename = $info['model_addfile'];

        showmsg('添加成功',ADMIN.'/Model/index.php');
        exit();
      }else{
        showmsg('添加失败');
        exit();
      }
      break;
    ###################  编辑模型  ######################
    case 'model_edit':
      $where['model_id'] = intval($_POST['model_id']);
      $info = $_POST['info'];
      if($db -> th_update($model_table,$where,$info)){
        showmsg('编辑成功',ADMIN.'/Model/index.php');
        exit();
      }else{
        showmsg('编辑失败');
        exit();
      }
      break;
  }
?>