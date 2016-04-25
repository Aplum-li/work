<?php 
  require('../checklogin.php');
  if(manager(3) || manager(4)){
  	
	  	//权限判断
	  	$type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
	  	if (!$type) {
	  		showmsg('参数错误222');
	  		exit();
	  	}
	  	switch ($type){
	  		case 'add':
	  		if(!manager(3)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		case 'edit':
	  			if(!manager(16)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		default:
	  			break;
	  	}
	  //管理员表
	  $admintable = 'admin';
	
	  //用户组表
	  $role_table = 'role';
	
	  //用户和用户组关系表
	  $role_user_table = 'role_user';
	
	  $_g_page = isset($_GET['page']) ? intval($_GET['page']) : '';
	  $where = array('order by'=>'id asc');
	  $role_list = $db -> th_selectall($role_table,$where,'*',array(20,$_g_page));
	
	  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	  $admininfo = '';
	  if ($id) {
	  		if(!manager(4)){showmsg('没有权限访问');exit();}
	      $where['id'] = $id;
	      $where['order by'] = 'id asc';
	      $admininfo = $db -> th_select($admintable,$where,'*');
	      $admininfo2 = $db -> th_select($role_user_table,array('user_id'=>$id),'*');
	      if (!$admininfo) {
	        showmsg('获取管理员信息出错');
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
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户管理</a><span class="crumb-step">&gt;</span><span>添加用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="admin_post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:50px;" class='r'>用户组：</td>
                            <td style="width:280px;">
                              <select name="role_id">
                                <!--<option value="0">==选择用户组==</option>-->
                                <?php foreach ($role_list as $key => $value) { ?>
                                <?php if($_SESSION['role_id'] !=1) {?>
                                <?php if($value['id'] == 1) continue;?>
                                <?php if($value['id'] == 2) continue;?>
                                <?php }?>
                                <option value="<?php echo $value['id'];?>" <?php if(isset($admininfo2['role_id']) && $admininfo2['role_id'] == $value['id']){echo 'selected';}?>><?php echo $value['name'];?></option>
                                <?php }?>
                              </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need">*</td>
                            <td class='r'>用户名：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($admininfo)){echo $admininfo['name'];}?>" name="info[name]" class="inputxt" datatype="s2-10" nullmsg="请输入用户名！" errormsg="用户名至少2个字符,最多10个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">用户名至少2个字符,最多10个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need">*</td>
                            <td class='r'>密码：</td>
                            <td>
                                <input type="password" value="" name="info[password]" class="inputxt" <?php if(!empty($admininfo)){echo 'ignore="ignore"';}?>  datatype="*5-18" nullmsg="请输入密码！" errormsg="密码至少5个字符,最多18个字符！" />
                            </td>
                            <td>
                                <div class="Validform_checktip" <?php if(!empty($admininfo)){echo 'style="display:inline;"';}?>><?php if(!empty($admininfo)){echo '密码不修改请留空';}?></div>
                                <div class="info">密码至少5个字符,最多18个字符！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                          <td class="need">*</td>
                          <td class='r'>状态：</td>
                          <td style="padding-left:18px;">
                            <?php if(!empty($admininfo)) {?>
                            <input type="radio" value="y" name="info[status]" class="pr1" <?php if($admininfo['status']) { echo 'checked';}?>><label for="male">允许登录</label>
                            <input type="radio" value="n" name="info[status]" class="pr1"  <?php if(!$admininfo['status']) { echo 'checked';}?>><label for="female">禁止登录</label>
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
                                <?php if(!empty($admininfo)) {?>
                                <input type="hidden" name='id' value="<?php echo $id;?>" />
                                <input type="hidden" name='type' value="admin_edit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="admin_add" />
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
    tiptype:2
  });
})
</script>
</html>
