<?php
//前台防刷流量控制
if(loadConfig('brush')){
  $ip = getip();
  $arr = isset($_SESSION['ips']) ? $_SESSION['ips'] : array();
  if (!isset($arr[$ip])) {
    $arr[$ip]['time'] = time();
    $arr[$ip]['count'] = 1;
    $_SESSION['ips'] = $arr;
  } else {
    //如果当前时间减去上次访问时间小于1，则作判断
    if (time() - $arr[$ip]['time'] <= 1) {
      $arr[$ip]['time'] = time();
      $arr[$ip]['count'] += 1;
      $_SESSION['ips'] = $arr;
      if ($arr[$ip]['count'] > 2) {
        unset($_SESSION['ips']);
        header("location:http://www.baidu.com");
        exit();
      }
    } else {
      $arr[$ip]['time'] = time();
      $arr[$ip]['count'] = 1;
      $_SESSION['ips'] = $arr;
    }
  }
}
//前台js/css/images路径
define('STATIC','/templates');
$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : 0;
$web_qq_status = loadConfig('web_qq_status');
$navs = $model -> nav($typeid);
$smarty->assign('web_qq_status',$web_qq_status);
$smarty->assign('typeid',$typeid);

$smarty->assign('navs',$navs);
?>