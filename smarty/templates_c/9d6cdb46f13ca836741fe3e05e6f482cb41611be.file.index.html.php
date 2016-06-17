<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-27 14:35:25
         compiled from "D:\wamp\www\thcms\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:3173571deb4bbf2fc8-17575706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d6cdb46f13ca836741fe3e05e6f482cb41611be' => 
    array (
      0 => 'D:\\wamp\\www\\thcms\\templates\\index.html',
      1 => 1461738898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3173571deb4bbf2fc8-17575706',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_571deb4bdb04c4_10721877',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571deb4bdb04c4_10721877')) {function content_571deb4bdb04c4_10721877($_smarty_tpl) {?><?php if (!is_callable('smarty_function_website')) include 'D:/wamp/www/thcms/smarty/plugins\\function.website.php';
if (!is_callable('smarty_block_banner')) include 'D:/wamp/www/thcms/smarty/plugins\\block.banner.php';
if (!is_callable('smarty_block_arclist')) include 'D:/wamp/www/thcms/smarty/plugins\\block.arclist.php';
if (!is_callable('smarty_block_type')) include 'D:/wamp/www/thcms/smarty/plugins\\block.type.php';
if (!is_callable('smarty_block_flinks')) include 'D:/wamp/www/thcms/smarty/plugins\\block.flinks.php';
?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="renderer" content="webkit">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo smarty_function_website(array('field'=>"web_name"),$_smarty_tpl);?>
</title>
    <meta name="description" content="<?php echo smarty_function_website(array('field'=>"web_description"),$_smarty_tpl);?>
">
    <meta name="keywords" content="<?php echo smarty_function_website(array('field'=>"web_keyword"),$_smarty_tpl);?>
">
    <link href="favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="<?php echo @constant('STATIC');?>
/css/metinfo_ui.css"
    id="metuimodule" data-module="10001">
    <link rel="stylesheet" type="text/css" href="<?php echo @constant('STATIC');?>
/css/metinfo.css">
    <?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/jQuery1.7.2.js" type="text/javascript">
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/metinfo_ui.js" type="text/javascript">
    <?php echo '</script'; ?>
>
    <!--[if IE]>
        <?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/html5.js" type="text/javascript">
        <?php echo '</script'; ?>
>
    <![endif]-->
</head>
    
    <body style="height: 100%;">
        <?php echo $_smarty_tpl->getSubTemplate ('header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <div class="banner-box" style="height:400px">
            <div class="banmove">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('banner', array('typeid'=>"1",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc")); $_block_repeat=true; echo smarty_block_banner(array('typeid'=>"1",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <a href="[field:link]" title="[field:title]" style="background-image: url([field:litpic]); display: block; z-index: 1000;">
                </a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_banner(array('typeid'=>"1",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>
            <div class="banmun">
                <font class="">
                </font>
                <font class="hover">
                </font>
                <font class="">
                </font>
            </div>
            <div class="banerbot">
            </div>
        </div>
        <img src="http://www.digo88.com/upload/image/category/20160322/20160322173050.jpg">
        <div class="main-box">
            <div class="main-topblock">
            </div>
            <div class="main-con not-marginleft">
                <div class="main-con-top" style="height: 165px;">
                    <div class="main-con-bot">
                        <div class="main-con-box">
                            <div class="main-con-img" style="background-image:url(<?php echo @constant('STATIC');?>
/images/1418135222.jpg);">
                            </div>
                            <div class="main-con-txt">
                                <a href="http://www.metinfo.cn/demo/M1156/342/news/news_5_1.html" class="title">
                                    <h3>
                                        风水指南
                                    </h3>
                                    <span>
                                        /
                                    </span>
                                    <font>
                                        Feng Shui
                                    </font>
                                </a>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('arclist', array('typeid'=>"53",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s")); $_block_repeat=true; echo smarty_block_arclist(array('typeid'=>"53",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <a href="[field:arcurl]" class="once"
                                title="[field:title]">[field:title]</a>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_arclist(array('typeid'=>"53",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            </div>
                            <div class="clear">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-con">
                <div class="main-con-top" style="height: 165px;">
                    <div class="main-con-bot">
                        <div class="main-con-box">
                            <div class="main-con-img" style="background-image:url(<?php echo @constant('STATIC');?>
/images/1418135522.jpg);">
                            </div>
                            <div class="main-con-txt">
                                <a href="http://www.metinfo.cn/demo/M1156/342/news/news_4_1.html" class="title">
                                    <h3>
                                        设计指南
                                    </h3>
                                    <span>
                                        /
                                    </span>
                                    <font>
                                        Design
                                    </font>
                                </a>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('arclist', array('typeid'=>"52",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s")); $_block_repeat=true; echo smarty_block_arclist(array('typeid'=>"52",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <a href="[field:arcurl]" class="once"
                                title="[field:title]">[field:title]</a>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_arclist(array('typeid'=>"52",'row'=>"5",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc",'titlelen'=>"20",'desclen'=>'','time'=>"Y-m-d H:i:s"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            </div>
                            <div class="clear">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-con">
                <div class="main-con-top" style="height: 165px;">
                    <div class="main-con-bot">
                        <div class="main-con-box">
                            <div class="main-con-img" style="background-image:url(<?php echo @constant('STATIC');?>
/images/1418135439.jpg);">
                            </div>
                            <div class="main-con-txt">
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/" class="title">
                                    <h3>
                                        招贤纳士
                                    </h3>
                                    <span>
                                        /
                                    </span>
                                    <font>
                                        Join Us
                                    </font>
                                </a>
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/job29.html" class="once"
                                title="室内设计师">
                                    室内设计师
                                </a>
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/job27.html" class="once"
                                title="报价师兼业务部经理 [热点]">
                                    报价师兼业务部经理 [热点]
                                </a>
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/job28.html" class="once"
                                title="设计师及市场营销员">
                                    设计师及市场营销员
                                </a>
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/job26.html" class="once"
                                title="网络文案策划">
                                    网络文案策划
                                </a>
                                <a href="http://www.metinfo.cn/demo/M1156/342/job/job30.html" class="once"
                                title="网站客服专员[热点]">
                                    网站客服专员[热点]
                                </a>
                            </div>
                            <div class="clear">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="main-pro">
                <div class="main-pro-top">
                    <div class="main-pro-tit">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('type', array('typeid'=>"54")); $_block_repeat=true; echo smarty_block_type(array('typeid'=>"54"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a href="[field:typelink]" class="more-pro">
                            更多
                            <font>
                                &gt;&gt;
                            </font>
                        </a>
                        <a href="[field:typelink]" class="title">
                            案例展示
                            <font>
                                /
                            </font>
                            <span>
                                Cases
                            </span>
                        </a>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_type(array('typeid'=>"54"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </div>
                    <div class="main-pro-con" style="height:160px;">
                        <div class="pro-left">
                        </div>
                        <div class="pro-center">
                            <div class="pro-move" display="0">
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('arclist', array('typeid'=>"54",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc")); $_block_repeat=true; echo smarty_block_arclist(array('typeid'=>"54",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                <a href="[field:arcurl]" title="[field:title]">
                                    <img src="[field:litpic]" width="210" height="160" title="[field:title]"
                                    alt="[field:title]">
                                    <h3 style="bottom: -40px;">
                                        [field:title]
                                    </h3>
                                </a>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_arclist(array('typeid'=>"54",'flag'=>"c",'orderby'=>"id",'orderway'=>"desc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                <div class="clear">
                                </div>
                            </div>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="pro-right" onselectstart="return false;">
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                    <div class="main-pro-tit link-xian">
                        <a href="" class="title">
                            友情链接
                            <span>
                                LINKS ▼
                            </span>
                        </a>
                    </div>
                    <div class="main-link">
                        <ul class="main-link-txt">
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('flinks', array('typeid'=>"10",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc")); $_block_repeat=true; echo smarty_block_flinks(array('typeid'=>"10",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <li>
                                <a href="[field:flink_link]" title="[field:flink_name]" target="_blank">
                                    [field:flink_name]
                                </a>
                            </li>
                            <li>
                                |
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_flinks(array('typeid'=>"10",'row'=>"6",'orderby'=>"sort",'orderway'=>"asc"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 
                        </ul>
                        <div class="clear">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-greet">
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>

</html><?php }} ?>
