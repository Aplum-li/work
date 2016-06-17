<?php
//开启错误提示，正式上线后 display_errors 设置为 Off，error_reporting 设置为0;
ini_set("display_errors", "On");
error_reporting(E_ALL);
date_default_timezone_set('PRC');
define('THINC', str_replace("\\", '/', dirname(__FILE__) ) );
define('ROOTPATH', str_replace("\\", '/', substr(THINC,0,-8) ) );
define('DATAPATH',ROOTPATH.'/data/');
define('WEBPATH', 'http://'.$_SERVER['HTTP_HOST'].'/');

//错误日志
ini_set("error_log",ROOTPATH."/log/".date('YmdH')."errors.log");

//内存设置
ini_set("memory_limit", "128M");

//定义自动截取的长度，改变该长度需要修改数据库字段长度
define('AUTO_DESCRIPTION', 250);

//该系统的语言编码
define('SOFT_LANG', 'utf-8');

//判断是否存在数据库配置文件
if(!file_exists(ROOTPATH.'/config/db.config.php')){
	exit('数据库配置文件不存在');
}
//后台名称
define('ADMIN',WEBPATH.'tenghoo');

require_once ROOTPATH.'/config/db.config.php';

// 函数
require_once THINC.'/func/common.func.php';
set_error_handler("errorLog");
//数据库操作类
require_once THINC.'/class/db.class.php';

//数据操作类
require_once THINC.'/class/data.class.php';

header("Content-Type: text/html; charset=".SOFT_LANG);
//开启session
session_start();
$db = new db(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_CHARTSET);
$model = new Data($db);
//分页类
require_once THINC.'/class/page.class.php';
//数组操作类
require_once THINC.'/class/category.class.php';
//文件操作类
require_once THINC.'/class/file.class.php';

//实例化Smarty
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.THINC.'/smarty/Smarty.class.php');
require_once THINC.'/smarty/Smarty.class.php';
require_once THINC.'/class/thoo.class.php';
$smarty = new Thoo();