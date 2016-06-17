<?php 
  require('../checklogin.php');
  error_reporting(E_ALL & ~E_NOTICE);
  if(!manager(33)){showmsg('没有权限访问');exit();}
  $config = loadConfig('','member.config.php');
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
  $pos = '会员配置';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员配置</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php"><?php echo $pos;?></a></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td colspan="4"><h2>会员配置</h2></td>
                        </tr>
                        <tr>
                            <td style="width:150px;" class='r'>验证码：</td>
                            <td>
                              <input type="checkbox" value="1" name="info[reg]" <?php if($config && $config['reg']){echo 'checked';}?>/> 注册
                              <input type="checkbox" value="1" name="info[login]"  <?php if($config && $config['login']){echo 'checked';}?>/> 登录
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;" class='r'>注册会员审核：</td>
                            <td>
                              <input type="radio" value="1" name="info[check]" <?php if($config && $config['check']){echo 'checked';}?>/> 是
                              <input type="radio" value="0" name="info[check]"  <?php if($config && !$config['check']){echo 'checked';}?>/> 否
                            </td>
                        </tr>
                        <tr>
                            <td style="width:160px;" class='r'>手机号码/邮箱账号登录：</td>
                            <td>
                              <input type="radio" value="1" name="info[account]" <?php if($config && $config['account']){echo 'checked';}?>/> 是
                              <input type="radio" value="0" name="info[account]"  <?php if($config && !$config['account']){echo 'checked';}?>/> 否
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <input type="hidden" name="type" value='update'>
                                <input type="submit" value="提 交" /><input type="reset" value="重 置" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
<script type="text/javascript">
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
    tiptype:2
  });
})
</script>
</html>
