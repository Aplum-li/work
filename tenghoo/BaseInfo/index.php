<?php
  require('../checklogin.php');
  error_reporting(E_ALL & ~E_NOTICE);
  if(!manager(26)){showmsg('没有权限访问');exit();}
  $config = loadConfig();
  // $arr = array(
  //   'web_host' => 'http://www.thcms.com/',
  //   'web_name' => '广州腾虎网络科技有限公司',
  //   'web_keyword' => '广州网站建设,网站建站,建网站广州,广州网站设计公司,网站设计,网站制作,广州做网站公司,广州建网站公司,广州企业网站建设',
  //   'web_description' => '广州腾虎网络主营为广州地区提供网站建设服务,网站设计与制作,网站托管,网站服器租用,域名注册等，一系列为绕网站建设的服务,10年间服务近5000多家企业网站的建设。',
  //   'web_beian' => '粤ICP备13073147号',
  //   'web_qq_status' => '0',
  //   'web_qq_num' => '1096831030 591540345',
  //   'smtp' => 'smtp.qq.com',
  //   'port' => '25',
  //   'email' => '1096831030@qq.com',
  //   'password' => 'qiying70520*',
  //   'username' => '网站管理员'
  // );
  // file_put_contents(ROOTPATH.'/config/config.php',serialize($arr));
  //读取配置文件
  $pos = '网站基本信息配置';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站信息配置</title>
<?php include '../adminstatic.html';?>
<style type="text/css">
<?php if($_SESSION['role_id'] == 1){?>
tr.show{display: table-row;}
<?php } else { ?>
tr.show{display: none;}
<?php }?>
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php"><?php echo $pos;?></a></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php" enctype="multipart/form-data">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td colspan="4"><h2>网站信息配置</h2></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:100px;" class='r'>域名：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['web_host'];?>" name="info[web_host]" class="inputxt" datatype="*" nullmsg="请输入网站域名！"/> <span style="color:red;">网址后面带 “ / ”</span></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入网站域名！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:100px;" class='r'>网站标题：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['web_name'];?>" name="info[web_name]" class="inputxt" datatype="*" nullmsg="请输入网站标题！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入网站标题！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>关键字：</td>
                            <td colspan='2'><input type="text" value="<?php echo $config['web_keyword'];?>" name="info[web_keyword]" class="inputxt" style="width: 600px;"/></td>
                        </tr>
                        <tr>
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>网站描述：</td>
                            <td colspan='2'>
                              <textarea name="info[web_description]" style="width: 800px;height: 60px;line-height: 20px;"><?php echo $config['web_description'];?></textarea></td>
                        </tr>
                        <tr>
                          <td style="width:10px;"></td>
                          <td style="width:100px;" class='r'>防止刷流量：</td>
                          <td colspan='2'>
                            <input type="radio" value="1" <?php if($config['brush'])echo 'checked';?> name="info[brush]" class="common-text"> 开启
                            <input type="radio" value="0" <?php if(!$config['brush'])echo 'checked';?> name="info[brush]" class="common-text"> 关闭 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(网站如出现被人刷流量的情况可开启此项，开启后，若出现1秒内访问相同页面的次数超过3次则会跳转到百度首页)
                          </td>
                        </tr>
                        <tr class="show">
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>生成html：</td>
                            <td colspan='2'>
                              <input type="radio" value="1" <?php if($config['ishtml'])echo 'checked';?> name="info[ishtml]" class="common-text"> 是
                              <input type="radio" value="0" <?php if(!$config['ishtml'])echo 'checked';?> name="info[ishtml]" class="common-text"> 否
                            </td>
                        </tr>
                        <tr class="show">
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>悬浮QQ：</td>
                            <td colspan='2'>
                              <input type="radio" value="1" <?php if($config['web_qq_status'])echo 'checked';?> name="info[web_qq_status]" class="common-text"> 开启
                              <input type="radio" value="0" <?php if(!$config['web_qq_status'])echo 'checked';?> name="info[web_qq_status]" class="common-text"> 不开启
                            </td>
                        </tr>
                        <tr class="show">
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>QQ号码：</td>
                            <td colspan='2'>
                              <input type="text" value="<?php echo $config['web_qq_num'];?>" size="85" name="info[web_qq_num]" class="inputxt"><span style="color:red"> 开启悬浮qq之前请确认网站上已有悬浮QQ代码，QQ号码用空格分开</span></td>
                        </tr>
                        <tr class="show">
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>多图设置：</td>
                            <td colspan='2'>
                              <input type="checkbox" value="1" <?php if($config['article'])echo 'checked';?> name="info[article]" class="common-text"> 文章详情页开启&nbsp;&nbsp;
                              <input type="checkbox" value="1" <?php if($config['shop'])echo 'checked';?> name="info[shop]" class="common-text"> 商品详情页开启
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"><h2>图片水印配置</h2></td>
                        </tr>
                        <tr>
                            <td style="width:10px;"></td>
                            <td style="width:100px;" class='r'>开启水印：</td>
                            <td colspan='2'>
                              <input type="radio" value="1" <?php if($config['web_water'])echo 'checked';?> name="info[web_water]" class="common-text"> 开启
                              <input type="radio" value="0" <?php if(!$config['web_water'])echo 'checked';?> name="info[web_water]" class="common-text"> 不开启
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;"></td>
                            <td style="width:70px;" class='r'>水印图片：</td>
                            <td style="width:445px;">
                            	<input type="hidden" name="info[web_mark]" value="<?php if(!empty($config['web_mark'])){echo $config['web_mark'];}?>"/>
                              <input type='file' name="web_mark" value='上传图片' style="padding: 10px 13px;background:#dddddd;border: 1px solid #dddddd;cursor:pointer;"/>
                              </td>
                            <td><img src="<?php if(!empty($config['web_mark'])){echo WEBPATH.$config['web_mark'];}?>" id="preview" style="max-height:54px;display:none;"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><h2>邮箱配置</h2></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:100px;" class='r'>SMTP 服务器：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['smtp'];?>" name="info[smtp]" class="inputxt" datatype="s2-20" nullmsg="请输入SMTP 服务器！" errormsg="SMTP 服务器至少2个字符,最多20个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">SMTP 服务器至少2个字符,最多20个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>SMTP 端口：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['port'];?>" name="info[port]" class="inputxt" datatype="s2-20" nullmsg="请输入SMTP 端口！" errormsg="SMTP 端口至少2个字符,最多20个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">SMTP 端口至少2个字符,最多20个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>邮 箱：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['email'];?>" name="info[email]" class="inputxt" datatype="e" nullmsg="请输入邮箱账号！" errormsg="邮箱账号不正确" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请填写邮箱账号！！！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>邮箱密码：</td>
                            <td style="width:280px;"><input type="password" value="<?php echo $config['password'];?>" name="info[password]" class="inputxt" datatype="*" nullmsg="请输入邮箱密码！" errormsg="请输入邮箱密码！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请填写邮箱密码！！！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;"></td>
                            <td style="width:70px;" class='r'>发件人名称：</td>
                            <td style="width:280px;"><input type="text" value="<?php echo $config['username'];?>" name="info[username]" class="inputxt"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <input type="hidden" name="type" value='update'>
                                <input type="image" value="" src="../adminstatic/images/sub.jpg"/ style="float:left"><input type="reset" value="重 置" />
                            </td>
                        </tr>
                    </table>
                </form>
                <table width="100%" class="insert-tab">
                    <tr>
                        <td class="need" style="width:15px;">*</td>
                        <td style="width:105px;" class='r'>测试邮箱账号：</td>
                        <td style="width:280px;"><input type="text" value="" id="TestEmail" lass="inputxt" style="margin: 8px 18px 8px 7px;padding: 10px;width: 245px;"/></td>
                        <td><input type="submit" onclick="test_send_email()" value="测试邮件发送" /></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
<script type="text/javascript">
$(function(){
<?php if ($config && !empty($config['web_mark'])) { ?>
$('#preview').show();
<?php }?>
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
    tiptype:2
  });
})

function test_send_email(){
  var email = $('#TestEmail').val();
  if (email == '') {
    showmsg('请输入邮箱账号！');
    return false;
  };
  $.post("post.php", { "type": "test_send_email","email": email},
   function(data){

   }, "json");
}

</script>
</html>
