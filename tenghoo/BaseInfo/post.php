<?php 
  require('../checklogin.php');
  require_once THINC . '/class/file.class.php';
  $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
  switch ($type) {

    #####################  更新配置  ######################
  	case 'update':
      $cfg = $_POST['info'];
      if (!empty($_FILES) && $_FILES['web_mark']['error'] == 0) {
      	$fileUpload = new uploadFile();
      	$fileUpload -> save_path = ROOTPATH . '/upload/mark/';
      	$uploadInfo = $fileUpload -> upload_file($_FILES['web_mark']);
      	if(!$uploadInfo){
      		showmsg('图片上传失败');exit();
      	}
      	$cfg['web_mark'] = 'upload/mark/'.$uploadInfo['filename'];
      }
      $cfg['article'] = isset($_POST['info']['article']) ? $_POST['info']['article'] : 0;
      $cfg['shop'] = isset($_POST['info']['shop']) ? $_POST['info']['shop'] : 0;
      if(file_put_contents(ROOTPATH.'/config/config.php',serialize($cfg))){
        showmsg('更新成功',ADMIN.'/BaseInfo/index.php');
        exit();
      }else{
        showmsg('更新失败');
        exit();
      }
  		break;
     ###############  测试邮件发送  #################
  	case 'test_send_email':
      $email = Html2Text($_POST['email']);
      if(SendEmail($email,'测试邮件','内容内容内容内容内容内容内容内容内容内容内容内容')){
        echo 1;
      }else{
        echo 0;
      }
      break;
  }
?>