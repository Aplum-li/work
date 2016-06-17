<?php 
  require('../checklogin.php');
  if(manager(41) || manager(42)){
	  	//权限判断
	  	$type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
	  	if (!$type) {
	  		showmsg('参数错误');
	  		exit();
	  	}
	  	switch ($type){
	  		case 'add':
	  		if(!manager(41)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		case 'edit':
	  			if(!manager(42)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		default:
	  			break;
	  	}
	  //会员表
    $memberTable = 'member';
	
	  //会员组表
	  $groupTable = 'member_group';

    //标题
    $pos = '添加会员';
	  $where = array('order by'=>'group_id asc');
	  $groupList = $db -> th_selectall($groupTable,$where,'*');
	
	  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	  $memberInfo = '';
	  if ($id) {
	  		if(!manager(4)){showmsg('没有权限访问');exit();}
        //标题
        $pos = '修改会员信息';
	      $where['id'] = $id;
	      $where['order by'] = 'id asc';
	      $memberInfo = $db -> th_select($memberTable,$where,'*');
	      if (!$memberInfo) {
	        showmsg('获取会员信息出错');
	        exit();
	      }
	  }
	}else{
	  showmsg('没有权限访问');exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list">
                <a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a>
                <span class="crumb-step">&gt;</span>
                <a class="crumb-name" href="index.php">会员管理</a>
                <span class="crumb-step">&gt;</span><span><?php echo $pos;?></span>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <table width="100%" class="insert-tab">
                          <tr style="display:none">
                            <td class="need" style="width:10px;"></td>
                            <td style="width:70px;" class='r'>提示信息：</td>
                            <td style="width:280px;color:red;" id='login-error'></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>会员组：</td>
                            <td style="width:280px;">
                              <select name="info[group_id]" datatype="*" nullmsg="请选择会员组！" style="width: 267px;">
                                <?php foreach ($groupList as $key => $value) { ?>
                                <option value="<?php echo $value['group_id'];?>" <?php if(isset($memberInfo['group_id']) && $memberInfo['group_id'] == $value['group_id']){echo 'selected';}?>><?php echo $value['group_name'];?></option>
                                <?php }?>
                              </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>账号：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($memberInfo)){echo $memberInfo['account'];}?>" name="info[account]" class="inputxt" datatype="*" nullmsg="请输入账号！" errormsg="账号不能为空" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入账号！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;"></td>
                            <td style="width:70px;" class='r'>昵称：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($memberInfo)){echo $memberInfo['nickname'];}?>" name="info[nickname]" class="inputxt"/></td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>密码：</td>
                            <td style="width:210px;">
                                <input type="password" value="" name="info[password]" class="inputxt" <?php if(!empty($memberInfo)){echo 'ignore="ignore"';}?> datatype="*5-18" nullmsg="请输入密码！" errormsg="密码至少5个字符,最多18个字符！" />
                            </td>
                            <td>
                                <div class="Validform_checktip" <?php if(!empty($memberInfo)){echo 'style="display:inline;"';}?>><?php if(!empty($memberInfo)){echo '密码不修改请留空';}?></div>
                                <div class="info">密码至少5个字符,最多18个字符！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>性别</td>
                            <td>
                              <?php if(!empty($memberInfo)) {?>
                              <input type="radio" value="b" name="info[sex]" <?php if($memberInfo['sex'] == 'b') { echo 'checked';}?>/> 男
                                <input type="radio" value="g" name="info[sex]" <?php if($memberInfo['sex'] == 'g') { echo 'checked';}?>/> 女
                            <?php } else {?>
                                <input type="radio" value="b" name="info[sex]" checked/> 男
                                <input type="radio" value="g" name="info[sex]" /> 女
                            <?php }?>
                                
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>手机号码：</td>
                            <td style="width:210px;">
                                <input type="text" value="<?php if(!empty($memberInfo)){echo $memberInfo['phone'];}?>" name="info[phone]" class="inputxt" datatype="m" nullmsg="请输入您的手机号码！" errormsg="手机号码格式错误！" />
                            </td>
                            <td>
                                <div class="Validform_checktip"></div>
                                <div class="info">请输入您的手机号码<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>邮箱账号：</td>
                            <td style="width:210px;">
                                <input type="text" value="<?php if(!empty($memberInfo)){echo $memberInfo['email'];}?>" name="info[email]" class="inputxt" datatype="e" nullmsg="请输入您的邮箱账号！" errormsg="邮箱账号格式错误！" />
                            </td>
                            <td>
                                <div class="Validform_checktip"></div>
                                <div class="info">请输入您的邮箱账号<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                          <td class="need">*</td>
                          <td class='r'>状态：</td>
                          <td style="padding-left:18px;">
                            <?php if(!empty($memberInfo)) {?>
                            <input type="radio" value="y" name="info[status]" class="pr1" <?php if($memberInfo['status']) { echo 'checked';}?>><label for="male">允许登录</label>
                            <input type="radio" value="n" name="info[status]" class="pr1"  <?php if(!$memberInfo['status']) { echo 'checked';}?>><label for="female">禁止登录</label>
                            <?php } else {?>
                            <input type="radio" value="y" name="info[status]" class="pr1" checked><label for="male">允许登录</label>
                            <input type="radio" value="n" name="info[status]" class="pr1"><label for="female">禁止登录</label>
                            <?php }?>
                          </td>
                          <td></td>
                      </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <?php if(!empty($memberInfo)) {?>
                                <input type="hidden" name='id' value="<?php echo $id;?>" />
                                <input type="hidden" name='type' value="memberEdit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="memberAdd" />
                                <?php }?>
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
    tiptype:2,
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
            setTimeout(function(){
                location.href='index.php';
            },2000);
        }else{
            $("#login-error").html(data.msg);
            $("#login-error").parent('tr').show();
        }
    }
  });
})
</script>
</html>
