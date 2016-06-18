<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@tenghoo.com>                        |
// |          李关生 <www.tenghoo.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$
//80字符宽度
//##############################################################################

/**
 * 打印函数
 * @param  [数组] $array [description]
 * @return [type]        [description]
 */
function p($array, $v = 0) {
    dump($array, 1, '<pre>', $v);
}
function dump($var, $echo = true, $label = null, $strict = true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo ($output);
        return null;
    } else return $output;
}
/**
 * 后台登陆验证
 *
 */
function checklogin() {
    if (isset($_SESSION['m_id']) && isset($_SESSION['m_name'])) {
        return true;
    } else {
        return false;
    }
}
//获取客服端IP
function getip() {
    $IP = getenv('REMOTE_ADDR');
    /*
    getenv() 功能是获取环境变量的值 格式: string getenv(string varname)
    getenv('REMOTE_ADDR');等价于 : $_SERVER['REMOTE_ADDR'];
    */
    $IP_ = getenv('HTTP_X_FORWARDED_FOR');
    if (($IP_ != "") && ($IP_ != "unknown")) $IP = $IP_;
    return $IP;
}
//获得GD库版本
function getGdVersion() {
    $ver = gd_info();
    $ver = $ver['GD Version'];
    return $ver;
}
/**
 * 为字符串或数组元素添加反斜杠
 */
function myAddslashes($str) {
    if (!is_array($str)) {
        //如果传进来不不是数组
        $str = addslashes($str); //那么进行转义
        return $str;
    } else {
        return array_map("myAddslashes", $str);
    }
}
/**
 *  过滤SQL关键字函数
 */
function stripSql($str) {
    $sqlkey = array( //SQL过滤关键字
        '/\s+select\s+/i',
        '/\s+delete\s+/i',
        '/\s+update\s+/i',
        '/\s+or\s+/i',
        '/\s+union\s+/i',
        '/\s+outfile\s+/'
    );
    $replace = array( //和上面数组内容对应
        '&nbsp;select&nbsp;',
        '&nbsp;delete&nbsp;',
        '&nbsp;update&nbsp;',
        '&nbsp;or&nbsp;',
        '&nbsp;union&nbsp;',
        '&nbsp;outfile&nbsp;'
    );
    if (!is_array($str)) {
        //如果不是数组直接替换
        $str = preg_replace($sqlkey, $replace, $str);
        return $str;
    } else {
        return array_map("stripSql", $str);
    }
}
/**
 * 字符串截取
 */
function getstr($String, $Length, $act = true) {
    if (mb_strwidth($String, 'UTF8') <= $Length) {
        return $String;
    } else {
        $I = 0;
        $len_word = 0;
        while ($len_word < $Length) {
            $StringTMP = substr($String, $I, 1);
            if (ord($StringTMP) >= 224) {
                $StringTMP = substr($String, $I, 3);
                $I = $I + 3;
                $len_word = $len_word + 2;
            } elseif (ord($StringTMP) >= 192) {
                $StringTMP = substr($String, $I, 2);
                $I = $I + 2;
                $len_word = $len_word + 2;
            } else {
                $I = $I + 1;
                $len_word = $len_word + 1;
            }
            $StringLast[] = $StringTMP;
        }
        /* raywang edit it for dirk for (es/index.php)*/
        if (is_array($StringLast) && !empty($StringLast)) {
            $StringLast = implode("", $StringLast);
            if ($act) {
                $StringLast.= "...";
            }
        }
        return $StringLast;
    }
}
/**
 *
 * @param number $pid,可以是单个数字也可以是一维数组
 * @return boolean
 */
function checknum($pid) {
    if (!is_array($pid)) {
        return preg_match("/^[0-9]+$/", $pid);
    } else {
        $str = true;
        foreach ($pid as $v) {
            if (!checknum($v)) {
                $str = false;
                break;
            }
        }
        return $str;
    }
}
/**
 * 删除文件
 * @param string $path 文件路径
 */
function delfile($path) {
    if ($path != '') {
        $path = ROOTPATH . '/' . $path;
        if (file_exists($path)) {
            if (unlink($path)) {
                return true;
            }
        }
    }
}
/**
 * 统计字符串长度
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function strlen_utf8($str) {
    $i = 0;
    $count = 0;
    $len = strlen($str);
    while ($i < $len) {
        $chr = ord($str[$i]);
        $count++;
        $i++;
        if ($i >= $len) break;

        if ($chr & 0x80) {
            $chr <<= 1;
            while ($chr & 0x80) {
                $i++;
                $chr <<= 1;
            }
        }
    }
    return $count;
}
/**
 *  短消息函数,可以在某个动作处理后友好的提示信息 前端.
 *
 * @param     string  $msg      消息提示信息
 * @param     string  $gourl    跳转地址
 * @return    void
 */
function showmsg($msg, $gourl = '-1',$refresh=1,$time=1000) {
    $html = '<!doctype html><html lang="en"><head><meta charset="UTF-8">';
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
    $html .= '<title>提示信息</title>';
    $html .= '<script type="text/javascript" src="/data/js/jquery-1.10.2.min.js"></script>';
    $html .= '<script type="text/javascript" src="/data/layer/layer.js"></script>';
    $html .= '</head><body></body>';
    if($gourl != '-1'){
        $html .= '<script type="text/javascript">layer.msg("'.$msg.'");setTimeout(function(){window.location.href="'.$gourl.'"},'.$time.')</script></html>';
    } else {
        if($refresh){
            $html .= '<script type="text/javascript">layer.msg("'.$msg.'");setTimeout(function(){window.location.href=document.referrer},'.$time.')</script></html>';
        } else{
            $html .= '<script type="text/javascript">layer.msg("'.$msg.'");setTimeout(function(){window.history.go(-1)},'.$time.')</script></html>';
        }
    }
    echo $html;
    exit();
}
/**
 * 判断是否是ajax提交
 * @return [type] [description]
 */
function isAjax() {
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
        return true;
    } else {
        return false;
    };
}
//url处理函数
function pe_updateurl($k, $v = '') {
    $querystr = $_SERVER['QUERY_STRING'];
    $url = $v === '' ? preg_replace('/' . $k . '=[^&]*/', '', $querystr) : ((stripos($querystr, "&{$k}=") === false && stripos($querystr, "{$k}=") === false) ? "{$querystr}&{$k}={$v}" : preg_replace('/' . $k . '=[^&]*/', "$k=$v", $querystr));
    $url = trim($url, '&');
    return $url ? "?{$url}" : '?';
}
//url批量处理函数
function pe_updateurl_arr($arr) {
    $querystr = $_SERVER['QUERY_STRING'];
    foreach ($arr as $val) {
        $k = $val[0];
        $v = $val[1];
        $querystr = $v === '' ? preg_replace('/' . $k . '=[^&]*/', "", $querystr) : (stripos($querystr, $k . '=') === false ? "{$querystr}&{$k}={$v}" : preg_replace('/' . $k . '=[^&]*/', "$k=$v", $querystr));
        $querystr = trim($querystr, '&');
    }
    return $querystr ? '?' . $querystr : '';
}
//#####################@ 杂项函数 @#####################//
function pe_bug($notice, $line = null) {
    header("Content-type: text/html; charset=utf-8");
    $html = "<p style='width:800px;margin:100px auto;padding:50px 10px;background:#f8f8f8'>错误提示：{$notice}<br/>错误定位：{$_SERVER[SCRIPT_FILENAME]}(第{$line}行)</p>";
    die($html);
}
//数据库安全
function th_dbhold($str, $exc = array()) {
    if (is_array($str)) {
        foreach ($str as $k => $v) {
            $str[$k] = in_array($k, $exc) ? th_dbhold($v, 'all') : th_dbhold($v);
        }
    } else {
        $str = $exc == 'all' ? mysql_real_escape_string($str) : mysql_real_escape_string(htmlspecialchars($str));
    }
    return $str;
}
/**
 *  中文截取2，单字节截取模式
 *  如果是request的内容，必须使用这个函数
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if (!function_exists('cn_substrR')) {
    function cn_substrR($str, $slen, $startdd = 0) {
        $str = cn_substr(stripslashes($str) , $slen, $startdd);
        return addslashes($str);
    }
}
/**
 *  中文截取2，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if (!function_exists('cn_substr')) {
    function cn_substr($str, $slen, $startdd = 0) {
        if (SOFT_LANG == 'utf-8') {
            return cn_substr_utf8($str, $slen, $startdd);
        }
        $restr = '';
        $c = '';
        $str_len = strlen($str);
        if ($str_len < $startdd + 1) {
            return '';
        }
        if ($str_len < $startdd + $slen || $slen == 0) {
            $slen = $str_len - $startdd;
        }
        $enddd = $startdd + $slen - 1;
        for ($i = 0; $i < $str_len; $i++) {
            if ($startdd == 0) {
                $restr.= $c;
            } else if ($i > $startdd) {
                $restr.= $c;
            }
            if (ord($str[$i]) > 0x80) {
                if ($str_len > $i + 1) {
                    $c = $str[$i] . $str[$i + 1];
                }
                $i++;
            } else {
                $c = $str[$i];
            }
            if ($i >= $enddd) {
                if (strlen($restr) + strlen($c) > $slen) {
                    break;
                } else {
                    $restr.= $c;
                    break;
                }
            }
        }
        return $restr;
    }
}
/**
 *  utf-8中文截取，单字节截取模式
 *
 * @access    public
 * @param     string  $str  需要截取的字符串
 * @param     int  $slen  截取的长度
 * @param     int  $startdd  开始标记处
 * @return    string
 */
if (!function_exists('cn_substr_utf8')) {
    function cn_substr_utf8($str, $length, $start = 0) {
        if (strlen($str) < $start + 1) {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';
        //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
        for ($i = 0; isset($ar[0][$i]); $i++) {
            if (strlen($tstr) < $start) {
                $tstr.= $ar[0][$i];
            } else {
                if (strlen($str) < $length + strlen($ar[0][$i])) {
                    $str.= $ar[0][$i];
                } else {
                    break;
                }
            }
        }
        return $str;
    }
}
/**
 *  HTML转换为文本
 *
 * @param    string  $str 需要转换的字符串
 * @param    string  $r   如果$r=0直接返回内容,否则需要使用反斜线引用字符串
 * @return   string
 */
if (!function_exists('Html2Text')) {
    function Html2Text($str, $r = 0) {
        if ($r == 0) {
            return SpHtml2Text($str);
        } else {
            $str = SpHtml2Text(stripslashes($str));
            return addslashes($str);
        }
    }
}
function SpHtml2Text($str) {
    $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU", "", $str);
    $alltext = "";
    $start = 1;
    for ($i = 0; $i < strlen($str); $i++) {
        if ($start == 0 && $str[$i] == ">") {
            $start = 1;
        } else if ($start == 1) {
            if ($str[$i] == "<") {
                $start = 0;
                $alltext.= " ";
            } else if (ord($str[$i]) > 31) {
                $alltext.= $str[$i];
            }
        }
    }
    $alltext = str_replace("　", " ", $alltext);
    $alltext = preg_replace("/&([^;&]*)(;|&)/", "", $alltext);
    $alltext = preg_replace("/[ ]+/s", " ", $alltext);
    return $alltext;
}
/**
 * 权限判断函数  $_SESSION['node'] 为所有节点
 * @param  [type] $node_id [节点id]
 * @return [type]          [description]
 */
function manager($node_id) {
    $node = isset($_SESSION['node']) ? $_SESSION['node'] : array();
    if (in_array($node_id, $node) || $_SESSION['role_id'] == 1) {
        return true;
    } else {
        return false;
    }
}
/**
 * 判断多图开启 
 * @param  [type] $model_id [模型id]
 * @return [type]          [description]
 */
function check_litpic( $model_id ){
    switch ($model_id) {
        case '1':
            $article = loadConfig('article');
            if (!$article) {
                return false;
            }
            break;
        case '2':
            $shop = loadConfig('shop');
            if (!$shop) {
                return false;
            }
            break;
        default:
            return false;
            break;
    }
    return true;
}
//读取配置文件
function loadConfig($args = '',$file='config.php') {
    $fp = fopen(ROOTPATH. '/config/'.$file, 'r'); //读
    $cf = unserialize(fread($fp, filesize(ROOTPATH. '/config/config.php'))); //反序列化，并赋值
    if ($args) {
        return $cf[$args];
        exit();
    }
    return $cf;
}
function SendEmail($to, $subject = "测试邮件", $body = "", $fujian = '') {
    $config = loadConfig();
    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    //error_reporting(E_ALL);
    error_reporting(E_STRICT);
    date_default_timezone_set("Asia/Shanghai"); //设定时区东八区
    require_once (THINC . '/class/class.phpmailer.php');
    include (THINC . '/class/class.smtp.php');
    try {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
        $mail->SMTPAuth = true; //开启认证
        $mail->Port = $config['port'];
        $mail->Host = $config['smtp'];
        $mail->Username = $config['email'];
        $mail->Password = $config['password'];
        //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
        $mail->AddReplyTo($config['email'], $config['username']); //回复地址
        $mail->From = $config['email'];
        $mail->FromName = $config['username'];
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
        //$mail->WordWrap = 80; // 设置每行字符串的长度
        //$mail->AddAttachment("f:/test.png"); //可以添加附件
        $mail->IsHTML(true);
        $mail->Send();
        return true;
    }
    catch(phpmailerException $e) {
        return false;
    }
}

//判断是否是手机登录
function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
          'sony',
          'ericsson',
          'mot',
          'samsung',
          'htc',
          'sgh',
          'lg',
          'sharp',
          'sie-',
          'philips',
          'panasonic',
          'alcatel',
          'lenovo',
          'iphone',
          'ipod',
          'blackberry',
          'meizu',
          'android',
          'netfront',
          'symbian',
          'ucweb',
          'windowsce',
          'palm',
          'operamini',
          'operamobi',
          'openwave',
          'nexusone',
          'cldc',
          'midp',
          'wap',
          'mobile'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}



//$multi_array要排序的数组，$sort_key根据某个键排序，$sort排序方式
function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC)
{
    if(is_array($multi_array))
    {
        foreach ($multi_array as $row_array)
        {
            if(is_array($row_array))
            {
                $key_array[] = $row_array[$sort_key];
            }
            else
            {
                return false;
            }
        }
    }
    else
    {
        return false;
    }
    array_multisort($key_array,$sort,$multi_array);
    return $multi_array;
}


/**
 * 获取当前 url 某些空间设置不一样，返回的url不一样
 * @return [type] [description]
 */
function request_uri(){
    if (isset($_SERVER['REQUEST_URI'])){
        if (strstr($_SERVER["REQUEST_URI"], ".php")) {
            $uri = $_SERVER["HTTP_X_REWRITE_URL"];
        } else {
            $uri = $_SERVER['REQUEST_URI'];
        }
        
    } else{
        if (isset($_SERVER['argv'])){
            $uri = $_SERVER['PHP_SELF'] .(empty($_SERVER['argv'])?'':('?'. $_SERVER['argv'][0])); 
        } else{
            $uri = $_SERVER['PHP_SELF'] .(empty($_SERVER['QUERY_STRING'])?'':('?'. $_SERVER['QUERY_STRING'])); 
        }
    }
    return $uri; 
     
}

/**
  *获取目录下的文件、目录
  *
  */
function getDir($dir){
    $handle = opendir($dir);
    if (!$handle) {
        die($dir . '目录不存在');
    }
    //逐一读取文件
    while ($row = readdir($handle)) {
        if ($row != '.' && $row != '..') {
            $path = $dir.'/'.$row;
            if (is_dir($path)) {
                $arr[] = $row;
            }
        }
    }
    rsort($arr);
    //关闭文件操作句柄
    closedir($handle);
    return $arr;
}

/**
  *创建目录
  *
  */
function mk_dir($dirname, $mode = 0755) 
{ 
    if(!is_dir($dirname)) {
        return mkdir($dirname, $mode, true);
    } else {
        return true;
    }
}

function makehtml($file,$content){
 $fp = fopen($file,'w');
 fwrite($fp,$content);
 fclose($fp);
}

/**
 * 递归删除文件，不删除目录
 * @param $dir
 */
function delfiles($dir){
  $lh = opendir($dir);
  while ($row = readdir($lh)) {
    if ($row != '.' && $row != '..') {
      $path = $dir.$row;
      if(is_dir($path)){
        delfiles($path.'/');
      }
      if (is_file($path)) {
        unlink($path);
      }
    }
  }
}

function ExecTime(){
    $time = explode(" ", microtime());
    $usec = (double)$time[0];
    $sec = (double)$time[1];
    return $sec + $usec;
}

/**
 * 二维数组排序
 * @param  [type] $arr  [要排序的数组]
 * @param  [type] $keys [根据哪个键来排序]
 * @param  string $type [asc or desc]
 * @return [type]       [array]
 */
function array_sort($arr,$keys,$type='asc'){ 
    $keysvalue = $new_array = array();

    //先取得排序的值,取得排序的1、2、3、4，要保持原来的键值
    foreach ($arr as $k=>$v){
        $keysvalue[$k] = $v[$keys];
    }

    //对排序作调整，按传进来的参数调整
    if($type == 'asc'){
        asort($keysvalue);
    }else{
        arsort($keysvalue);
    }

    //把数组指针指向第一个元素
    reset($keysvalue);

    foreach ($keysvalue as $k=>$v){
        $new_array[$k] = $arr[$k];
    }
    return $new_array; 
}

/**
* 
*调用 time_tran("2014-7-8 19:22:01");
*
*/
function time_tran($the_time) {
    $now_time = date("Y-m-d H:i:s", time());
    //echo $now_time;
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return $the_time;
                    }
                }
            }
        }
    }
}

/**
* 递归创建文件夹
* $dir 参数格式为 dir1/dir2/dir3
*
*/
function mkDirs($dir){
    if(!is_dir($dir)){
        if(!mkDirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,0777)){
            return false;
        }
    }
    return true;
}

/**
 * 判断前台登录账号类型
 * @param $account 要检测的账号
 * @return string 手机返回member_phone 邮箱返回member_email 用户名返回 member_account
 */
function checkAccountType($account){
    $type = '';
    if(checkPhone($account)){
        $type = 'member_phone';
    } elseif(checkEmail($account)) {
        $type = 'member_email';
    } else {
        $type = 'member_account';
    }
    return $type;
}

/**

 * 正则匹配手机格式

 * @param $phone

 */

function checkPhone($phone){

    $res = false;

    $search ='/^(1(([35][0-9])|(47)|[8][0123546789]))\d{8}$/';

    if(preg_match($search,$phone)) {

        $res = true;

    }

    return $res;

}



/**

 * 正则匹配邮箱格式

 * @param $email

 */

function checkEmail($email){

    $res = false;

    $search ='/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';

    if(preg_match($search,$email)) {

        $res = true;

    }

    return $res;

}

/**
 * 获取不同尺寸的缩略图
 * @param $litpic
 * @param $w
 * @param $h
 */
function getlitpic($litpic, $w, $h){
    $w = $w;
    $h = $h;
    $pos = strrpos($litpic, '/');
    $pre = substr($litpic, 0, $pos+1);
    $end = substr($litpic, $pos+1);
    $end = $w.'_'.$h.'_'.$end;
    $thumb = $pre.$end;
    if(file_exists($_SERVER['DOCUMENT_ROOT'].$thumb)){
        return $thumb;
    } else {
        return $litpic;
    }
}

function errorLog($error_type, $error_message, $error_file, $error_line){
    //只有把错误级别设为E_ALL才在页面上显示错误
    if(ini_get("error_reporting") == 30719){
        switch($error_type){
            case 1:
                $level = '<font color="red">严重错误</font>';
                break;
            case 2:
                $level = '<font color="yellow">警告错误</font>';
                break;
            case 8:
                $level = '<font color="yellow">注意错误</font>';
                break;
        }
        echo '错误级别：'.$level.'<br>';
        echo '错误信息：'.$error_message.'<br>';
        echo '错误文件：'.$error_file.'<br>';
        echo '出错行数：'.$error_line.'<br>';
    }
}

/**
 * 默认过滤字符串函数
 * @param $str
 */
function clstring($str){
	return htmlspecialchars(trim($str));
}

/**
 * 中文转为拼音
 * @param $_String
 * @param string $pix
 * @param string $_Code
 * @return mixed
 */
// $_Code is utf8 or gb2312
function pinyin($_String, $pix = '', $_Code='utf8')
{
	$_String = strtolower($_String);
	$_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
		"|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
		"cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
		"|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
		"|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
		"|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
		"|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
		"|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
		"|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
		"|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
		"|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
		"she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
		"tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
		"|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
		"|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
		"zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";

	$_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
		"|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
		"|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
		"|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
		"|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
		"|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
		"|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
		"|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
		"|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
		"|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
		"|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
		"|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
		"|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
		"|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
		"|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
		"|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
		"|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
		"|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
		"|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
		"|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
		"|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
		"|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
		"|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
		"|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
		"|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
		"|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
		"|-10270|-10262|-10260|-10256|-10254";
	$_TDataKey = explode('|', $_DataKey);
	$_TDataValue = explode('|', $_DataValue);

	$_Data = (PHP_VERSION>='5.0') ? array_combine($_TDataKey, $_TDataValue) : _Array_Combine($_TDataKey, $_TDataValue);
	arsort($_Data);
	reset($_Data);

	if($_Code != 'gb2312') $_String = _U2_Utf8_Gb($_String);

	$_Res = '';
	for($i=0; $i<strlen($_String); $i++)
	{
		$_P = ord(substr($_String, $i, 1));
		if($_P>160) { $_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536; }
		$_Res .= _Pinyin($_P, $_Data).$pix;
	}
	return preg_replace("/[^a-z0-9".$pix."]*/", '', $_Res);
}

function _Pinyin($_Num, $_Data)
{
	if ($_Num>0 && $_Num<160 ) return chr($_Num);
	elseif($_Num<-20319 || $_Num>-10247) return '';
	else {
		foreach($_Data as $k=>$v){ if($v<=$_Num) break; }
		return $k;
	}
}

function _U2_Utf8_Gb($_C)
{
	$_String = '';
	if($_C < 0x80) $_String .= $_C;
	elseif($_C < 0x800)
	{
		$_String .= chr(0xC0 | $_C>>6);
		$_String .= chr(0x80 | $_C & 0x3F);
	}elseif($_C < 0x10000){
		$_String .= chr(0xE0 | $_C>>12);
		$_String .= chr(0x80 | $_C>>6 & 0x3F);
		$_String .= chr(0x80 | $_C & 0x3F);
	} elseif($_C < 0x200000) {
		$_String .= chr(0xF0 | $_C>>18);
		$_String .= chr(0x80 | $_C>>12 & 0x3F);
		$_String .= chr(0x80 | $_C>>6 & 0x3F);
		$_String .= chr(0x80 | $_C & 0x3F);
	}
	return iconv('UTF-8', 'GB2312', $_String);
}

function _Array_Combine($_Arr1, $_Arr2)
{
	for($i=0; $i<count($_Arr1); $i++) $_Res[$_Arr1[$i]] = $_Arr2[$i];
	return $_Res;
}