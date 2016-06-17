<?php
/**
*上传图片处理
*
*/
$path = dirname(__FILE__);
$incpath = str_replace("\\", '/', substr($path,0,-8) );
require_once $incpath.'/include/common.inc.php';
$type = isset($_GET['type']) ? trim($_GET['type']) : 'other';
$save_path = '/upload/image/'.$type.'/'.date('Ymd').'/';
$upload = new uploadImg();
$upload->dst_path = ROOTPATH.$save_path;
$upload->save_path = $save_path;
$info = $upload -> upload_file($_FILES['litpic']);
$upload -> img_resized(220, 140);
$upload -> img_resized(140, 88);
$upload -> img_resized(145, 92);
$upload -> img_resized(101, 68);
echo json_encode($info);
exit();