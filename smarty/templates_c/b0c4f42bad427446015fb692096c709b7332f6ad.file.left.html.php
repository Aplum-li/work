<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-16 13:50:21
         compiled from "F:\wamp\www\thcms\templates\left.html" */ ?>
<?php /*%%SmartyHeaderCode:174456e8f41d5382a8-17237285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0c4f42bad427446015fb692096c709b7332f6ad' => 
    array (
      0 => 'F:\\wamp\\www\\thcms\\templates\\left.html',
      1 => 1457536842,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174456e8f41d5382a8-17237285',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'typeid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e8f41d6041b2_12612239',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8f41d6041b2_12612239')) {function content_56e8f41d6041b2_12612239($_smarty_tpl) {?><?php if (!is_callable('smarty_block_type')) include 'F:/wamp/www/thcms/smarty/plugins\\block.type.php';
if (!is_callable('smarty_block_channel')) include 'F:/wamp/www/thcms/smarty/plugins\\block.channel.php';
?><div class="sidebar-con-left">

      <div class="sidebar-con-tit">
        <div class="sidebar-con-box">
        	<?php $_smarty_tpl->smarty->_tag_stack[] = array('type', array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top")); $_block_repeat=true; echo smarty_block_type(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        	<font class="this">[field:typename]</font><span class="this">[field:subtitle]&nbsp;</span>
        	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_type(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </div>
      </div>
      <div class="sidebar-con-left-nav">
        <ul class="left-nav-list">
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('channel', array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top",'curclass'=>'on')); $_block_repeat=true; echo smarty_block_channel(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top",'curclass'=>'on'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<li class="[field:class]">
				<div>
					<strong class="[field:class]">&nbsp;</strong>
					<a href="[field:typelink]" title="[field:typename]">[field:typename]</a>
				</div>
				</li>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_channel(array('typeid'=>((string)$_smarty_tpl->tpl_vars['typeid']->value),'type'=>"top",'curclass'=>'on'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </ul>
        <div class="clear"></div>  
      </div>


      <div class="sidebar-con-tit">
        <div class="sidebar-con-box"><font class="this">联系方式</font><span class="this">CONTACT&nbsp;</span></div>
      </div>
      <div class="sidebar-con-left-con"><div>
	<span style="line-height: 2;">地址：英协广场1号楼25C</span></div>
<div>
	电话：0731-3338888</div>
<div>
	联系人：冯先生 18733338888</div>
<div>
	邮箱：service369@aliyun.com</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$('.left-nav-list li:first-child').css("borderTop","none");
})
<?php echo '</script'; ?>
><?php }} ?>
