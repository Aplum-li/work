<?php
/**
 * 自定义函数
 * 调用获取网页标题
 */
function smarty_function_title($args,$smarty){
	global $model;
	$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
	if (!$typeid) {
		return '';
	}
	$istitle = isset($args['type']) ? htmlspecialchars($args['type']) : 'position';
	if ($istitle == 'title') {
		$istitle = 1;
	}else{
		$istitle = 0;
	}
	return $model -> GetTitle($typeid,$istitle);
}