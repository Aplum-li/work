<?php
/**
 * 自定义模板函数
 * 上一篇文章
 */
function smarty_function_getpre($args,$smarty){
	global $model;
	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	if ($id) {
		return $model -> GetPre($id,'>',$args['field']);
	}else{
		return '';
	}
}