<?php
/**
 * 自定义函数
 * 调用广告,传入广告id，要获取的字段
 */
function smarty_function_ad($args,$smarty){

	global $model;
	return $model -> getadinfo($args['id'],$args['field']);
}