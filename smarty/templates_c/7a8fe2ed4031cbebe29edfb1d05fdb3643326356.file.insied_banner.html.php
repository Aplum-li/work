<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-16 13:50:21
         compiled from "F:\wamp\www\thcms\templates\insied_banner.html" */ ?>
<?php /*%%SmartyHeaderCode:1806756e8f41d4d3554-88269440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a8fe2ed4031cbebe29edfb1d05fdb3643326356' => 
    array (
      0 => 'F:\\wamp\\www\\thcms\\templates\\insied_banner.html',
      1 => 1428630048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1806756e8f41d4d3554-88269440',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e8f41d5098b0_68846107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8f41d5098b0_68846107')) {function content_56e8f41d5098b0_68846107($_smarty_tpl) {?><?php if (!is_callable('smarty_block_type')) include 'F:/wamp/www/thcms/smarty/plugins\\block.type.php';
?><div class="banner-box">
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('type', array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top")); $_block_repeat=true; echo smarty_block_type(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <a class="one" href="" title="" style="background-image:url([field:litpic]); height:200px;"></a>
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_type(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div><?php }} ?>
