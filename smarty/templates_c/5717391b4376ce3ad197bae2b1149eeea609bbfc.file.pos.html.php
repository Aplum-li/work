<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-16 13:50:21
         compiled from "F:\wamp\www\thcms\templates\pos.html" */ ?>
<?php /*%%SmartyHeaderCode:3040956e8f41d6e4bc9-06034171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5717391b4376ce3ad197bae2b1149eeea609bbfc' => 
    array (
      0 => 'F:\\wamp\\www\\thcms\\templates\\pos.html',
      1 => 1428630112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3040956e8f41d6e4bc9-06034171',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e8f41d73bad6_22587043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8f41d73bad6_22587043')) {function content_56e8f41d73bad6_22587043($_smarty_tpl) {?><?php if (!is_callable('smarty_function_title')) include 'F:/wamp/www/thcms/smarty/plugins\\function.title.php';
if (!is_callable('smarty_function_cateinfo')) include 'F:/wamp/www/thcms/smarty/plugins\\function.cateinfo.php';
?><div class="sidebar-con-tit">
<p>当前位置： <?php echo smarty_function_title(array('type'=>"position"),$_smarty_tpl);?>
</p>
<font class="this"><?php echo smarty_function_cateinfo(array('field'=>"typename"),$_smarty_tpl);?>
</font><span class="this"><?php echo smarty_function_cateinfo(array('field'=>"subtitle"),$_smarty_tpl);?>
&nbsp;</span>
</div><?php }} ?>
