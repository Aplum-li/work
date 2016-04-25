<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-16 10:04:50
         compiled from "F:\wamp\www\thcms\member\templates\login.html" */ ?>
<?php /*%%SmartyHeaderCode:1169856e8bf427e6d99-09167829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5360cf7bd5a576f94368ba76ddf4e7f21681a206' => 
    array (
      0 => 'F:\\wamp\\www\\thcms\\member\\templates\\login.html',
      1 => 1441953155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1169856e8bf427e6d99-09167829',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'isRegCode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e8bf42a94a90_11255970',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8bf42a94a90_11255970')) {function content_56e8bf42a94a90_11255970($_smarty_tpl) {?><?php if (!is_callable('smarty_function_website')) include 'F:/wamp/www/thcms/smarty/plugins\\function.website.php';
if (!is_callable('smarty_function_ad')) include 'F:/wamp/www/thcms/smarty/plugins\\function.ad.php';
?><!DOCTYPE html>
<html class="login-alone">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-<?php echo smarty_function_website(array('field'=>"web_name"),$_smarty_tpl);?>
</title>
		<meta name="description" content="<?php echo smarty_function_website(array('field'=>"web_description"),$_smarty_tpl);?>
">
        <meta name="keywords" content="<?php echo smarty_function_website(array('field'=>"web_keyword"),$_smarty_tpl);?>
">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link href="../favicon.ico" rel="shortcut icon">
        <link rel="stylesheet" type="text/css" href="css/member.css?v=3.9">
        <?php echo '<script'; ?>
 src="<?php echo @constant('STATIC');?>
/js/jQuery1.7.2.js" type="text/javascript"><?php echo '</script'; ?>
>
        <link href="../data/Validform/Validform.css" rel="stylesheet" media="screen" type="text/css" />
    </head>
    <body>
        <div class="logina-logo" style="height: 55px">
            <a href="<?php echo smarty_function_website(array('field'=>"web_host"),$_smarty_tpl);?>
"><?php echo smarty_function_ad(array('id'=>"8",'field'=>"ad_content"),$_smarty_tpl);?>
</a>
        </div>
        <div class="logina-main main clearfix">
            <div><img src="images/login.png"></div>
            <div class="tab-con">
                <form method="post" action="post.php" class="registerform">
                    <div id='login-error' class="error-tip"></div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                             <tr>
                                <th>账 号</th>
                                <td width="245">
                                    <input id="email" type="text" name="member_account" placeholder="请输入账号" class="inputxt" autocomplete="off" value=""  datatype="*" nullmsg="请输入您的账号！" errormsg="账号不能为空"></td>
                                <td>
                                    <div class="Validform_checktip"></div>
                                    <div class="info">请输入您的账号！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                                </td>
                            </tr>
                            <tr>
                                <th>密码</th>
                                <td width="245">
                                    <input id="password" type="password" name="password" placeholder="请输入密码" autocomplete="off" class="inputxt" datatype="*5-18" nullmsg="请输入密码！" errormsg="密码至少5个字符,最多18个字符！" >
                                </td>
                                <td>
                                    <div class="Validform_checktip"></div>
                                    <div class="info">密码至少5个字符,最多18个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                                </td>
                            </tr>
                            <?php if ($_smarty_tpl->tpl_vars['isRegCode']->value) {?>
                            <tr id="tr-vcode">
                                <th>验证码</th>
                                <td width="245">
                                    <div class="valid">
                                        <input type="text" name="vcode" class="inputxt" style="width:125px;"><img class="vcode" src="<?php echo @constant('WEBPATH');?>
/captcha.php"  onClick="this.src='<?php echo @constant('WEBPATH');?>
/captcha.php?t='+Math.random()" style="cursor:pointer;width:85px;height:35px;">
                                    </div>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <?php }?>
                            <tr class="find">
                                <th></th>
                                <td>
                                    <div>
                                        <label class="checkbox" for="chk11"><input style="height: auto;" id="chk11" type="checkbox" name="remember_me" >记住我</label>
                                        <a href="passport/forget-pwd">忘记密码？</a>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td width="245"><input class="confirm" type="submit" value="登  录"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="type" value="login"/>
                </form>
            </div>
            <div class="reg">
                <p>还没有账号？<br>赶快免费注册一个吧！</p>
                <a class="reg-btn" href="index.php?act=register">立即免费注册</a>
            </div>
        </div>  
    </body>
<?php echo '<script'; ?>
 type="text/javascript" src="../data/Validform/Validform_v5.3.2.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="../data/Validform/plugin/passwordStrength/passwordStrength-min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="../data/easydialog/easydialog.css">
<?php echo '<script'; ?>
 type="text/javascript" src="../data/easydialog/easydialog.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="../data/js/common.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
    //$(".registerform").Validform();  //就这一行代码！;
    
    var getInfoObj=function(){
            return  $(this).parents("td").next().find(".info");
        }
    
    $("[datatype]").focusin(function(){
        if(this.timeout){clearTimeout(this.timeout);}
        var infoObj=getInfoObj.call(this);
        if(infoObj.siblings(".Validform_right").length!=0){
            return; 
        }
        infoObj.show().siblings().hide();
        
    }).focusout(function(){
        var infoObj=getInfoObj.call(this);
        this.timeout=setTimeout(function(){
            infoObj.hide().siblings(".Validform_wrong,.Validform_loading").show();
        },0);
        
    });
    
    $(".registerform").Validform({
        tiptype:2,
        usePlugin:{
            passwordstrength:{
                minLen:6,
                maxLen:18,
                trigger:function(obj,error){
                    if(error){
                        obj.parent().next().find(".passwordStrength").hide().siblings(".info").show();
                    }else{
                        obj.removeClass("Validform_error").parent().next().find(".passwordStrength").show().siblings().hide();  
                    }
                }
            }
        },
        tiptype:function(msg,o,cssctl){
            //msg：提示信息;
            //o:{obj:*,type:*,curform:*}, obj指向的是当前验证的表单元素（或表单对象），type指示提示的状态，值为1、2、3、4， 1：正在检测/提交数据，2：通过验证，3：验证失败，4：提示ignore状态, curform为当前form对象;
            //cssctl:内置的提示信息样式控制函数，该函数需传入两个参数：显示提示信息的对象 和 当前提示的状态（既形参o中的type）;
            if(!o.obj.is("form")){//验证表单元素时o.obj为该表单元素，全部验证通过提交表单时o.obj为该表单对象;
                var objtip=o.obj.siblings(".Validform_checktip");
                cssctl(objtip,o.type);
                objtip.text(msg);
            }else{
                var objtip=o.obj.find("#msgdemo");
                cssctl(objtip,o.type);
                objtip.text(msg);
            }
        },
        ajaxPost:true,
        callback:function(data){
            $("#msgdemo").hide();
            if(data.status=="y"){
                showmsg(data.msg);
                if (data.gourl != '') {
                    setTimeout(function(){
                        location.href=data.gourl;
                    },2000);
                };
            }else{
                $("#login-error").html(data.msg);
                $("#login-error").show();
            }
        }


    });
})
<?php echo '</script'; ?>
>
</html>
<?php }} ?>
