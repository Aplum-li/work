<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-16 13:50:21
         compiled from "F:\wamp\www\thcms\templates\index_article.html" */ ?>
<?php /*%%SmartyHeaderCode:2854656e8f41d1f7aa6-53765697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72a71704b51516648ebee299207b8c1ea24fc22d' => 
    array (
      0 => 'F:\\wamp\\www\\thcms\\templates\\index_article.html',
      1 => 1430652472,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2854656e8f41d1f7aa6-53765697',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e8f41d42d098_84973509',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8f41d42d098_84973509')) {function content_56e8f41d42d098_84973509($_smarty_tpl) {?><?php if (!is_callable('smarty_function_title')) include 'F:/wamp/www/thcms/smarty/plugins\\function.title.php';
if (!is_callable('smarty_function_cateinfo')) include 'F:/wamp/www/thcms/smarty/plugins\\function.cateinfo.php';
?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo smarty_function_title(array('type'=>"title"),$_smarty_tpl);?>
</title>
<meta name="description" content="<?php echo smarty_function_cateinfo(array('field'=>"typedesc"),$_smarty_tpl);?>
">
<meta name="keywords" content="<?php echo smarty_function_cateinfo(array('field'=>"keyword"),$_smarty_tpl);?>
">
<link href="favicon.ico" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="<?php echo @constant('STATIC');?>
/css/metinfo_ui.css" id="metuimodule" data-module="1">
<link rel="stylesheet" type="text/css" href="<?php echo @constant('STATIC');?>
/css/metinfo.css">
<?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/jQuery1.7.2.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/metinfo_ui.js" type="text/javascript"><?php echo '</script'; ?>
>
<!--[if IE]>
<?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/html5.js" type="text/javascript"><?php echo '</script'; ?>
>
<![endif]-->
</head>
<body style="height: 100%;">
<?php echo $_smarty_tpl->getSubTemplate ('header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('insied_banner.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="sidebar-box">
  <div class="sidebar-con">
    <?php echo $_smarty_tpl->getSubTemplate ('left.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="sidebar-con-right">    
      <?php echo $_smarty_tpl->getSubTemplate ('pos.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

      <div class="sidebar-con-right-con"> 
        <div class="editor active" id="showtext">
          <?php echo smarty_function_cateinfo(array('field'=>"typecontent"),$_smarty_tpl);?>

		    </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body></html><?php }} ?>
