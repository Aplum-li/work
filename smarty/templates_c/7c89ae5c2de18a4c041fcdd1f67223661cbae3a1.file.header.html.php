<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-25 18:02:51
         compiled from "D:\wamp\www\thcms\templates\header.html" */ ?>
<?php /*%%SmartyHeaderCode:15674571deb4bdcf8c7-47377606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c89ae5c2de18a4c041fcdd1f67223661cbae3a1' => 
    array (
      0 => 'D:\\wamp\\www\\thcms\\templates\\header.html',
      1 => 1457534976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15674571deb4bdcf8c7-47377606',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'navs' => 0,
    'v' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_571deb4be7b6c1_14836377',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571deb4be7b6c1_14836377')) {function content_571deb4be7b6c1_14836377($_smarty_tpl) {?><?php if (!is_callable('smarty_function_website')) include 'D:/wamp/www/thcms/smarty/plugins\\function.website.php';
if (!is_callable('smarty_function_ad')) include 'D:/wamp/www/thcms/smarty/plugins\\function.ad.php';
if (!is_callable('smarty_function_getlisturl')) include 'D:/wamp/www/thcms/smarty/plugins\\function.getlisturl.php';
?><div class="header-box">
            <div class="header-top">
                <div class="top-nav">
                    <span class="i">
                    </span>
                    <form name="formsearch" action="<?php echo @constant('WEBPATH');?>
search.php" class='searchform'>
                      <input name="q" type="text" class="keyword" id="search-keyword">
                      <input type="submit" value="搜 索" class="sub">
                    </form>
                    <a href="<?php echo smarty_function_website(array('field'=>"web_host"),$_smarty_tpl);?>
member/" title="会员中心">
                        会员中心
                    </a>
                    <a href="<?php echo smarty_function_website(array('field'=>"web_host"),$_smarty_tpl);?>
#" onclick="SetHome(this,window.location,&quot;浏览器不支持此功能，请手动设置！&quot;);"
                    style="cursor:pointer;" title="设为首页">
                        设为首页
                    </a>
                    |
                    <a href="<?php echo smarty_function_website(array('field'=>"web_name"),$_smarty_tpl);?>
#" onclick="addFavorite(&quot;浏览器不支持此功能，请手动设置！&quot;);"
                    style="cursor:pointer;" title="收藏本站">
                        收藏本站
                    </a>
                </div>
            </div>
            <div class="header-con">
                <a href="<?php echo smarty_function_website(array('field'=>"web_host"),$_smarty_tpl);?>
" title="<?php echo smarty_function_website(array('field'=>"web_name"),$_smarty_tpl);?>
" id="web_logo">
                	<?php echo smarty_function_ad(array('id'=>"8",'field'=>"ad_content"),$_smarty_tpl);?>

                </a>
                <div class="nav-box">
                    <ul>
                    	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['navs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                        <li class="<?php echo $_smarty_tpl->tpl_vars['v']->value['class'];?>
">
                            <a href="<?php echo smarty_function_getlisturl(array('id'=>((string)$_smarty_tpl->tpl_vars['v']->value['id'])),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['typename'];?>
">
                                <font><?php echo $_smarty_tpl->tpl_vars['v']->value['typename'];?>
</font>
                            </a>
                            <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['child'])) {?>
                            <ul>
                            	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                <li>
                                    <a href="<?php echo smarty_function_getlisturl(array('id'=>((string)$_smarty_tpl->tpl_vars['item']->value['id'])),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['typename'];?>
">
                                        <font><?php echo $_smarty_tpl->tpl_vars['item']->value['typename'];?>
</font>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php }?>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div><?php }} ?>
