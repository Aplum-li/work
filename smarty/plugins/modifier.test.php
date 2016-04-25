<?php
/**
 * Smarty测试插件
 */
function smarty_modifier_test($var,$args1=''){
	return '<h1 style="color:'.$args1.'">'.$var.'</h1>';
}