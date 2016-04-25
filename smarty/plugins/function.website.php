<?php
/**
 * 自定义模板函数
 * 调用网站基本信息
 */
function smarty_function_website($args,$smarty){
	global $model;
	$config = loadConfig();
	return $config[$args['field']];
}