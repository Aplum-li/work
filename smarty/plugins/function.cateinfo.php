<?php
/**
 * 自定义函数
 * 调用栏目信息
 */
function smarty_function_cateinfo($args,$smarty){
	global $model;
	$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
	if (!$typeid) {
		return '';
	}
	$field = isset($args['field']) ? htmlspecialchars($args['field']) : 'typename';
	return $model -> GetTypeInfo($typeid,$field);
}