<?php
/**
 * 自定义函数
 * 调用广告,传入广告id，要获取的字段
 */
function smarty_function_getlitpic($args,$smarty){

	global $model;
    $litpic = $args['litpic'];
    $w = $args['w'];
    $h = $args['h'];
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