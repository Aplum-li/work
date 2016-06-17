<?php
/**
 * 自定义模板函数
 * 调用网站基本信息
 */
function smarty_function_getnext($args,$smarty){
	global $model;
	$id = isset($_GET['id']) ? intval($_GET['id']) : '';
	if ($id) {
		return $model -> GetPre($id,'<',$args['field']);
	}else{
		return '';
	}
}