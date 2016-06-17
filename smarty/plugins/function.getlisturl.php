<?php
/**
 * 自定义模板函数
 * 调用网站基本信息
 */
function smarty_function_getlisturl($args,$smarty){
	global $model;
	$id = $args['id'];
	if ($id) {
		return $model -> getlisturl($id);
	}else{
		return '';
	}
}