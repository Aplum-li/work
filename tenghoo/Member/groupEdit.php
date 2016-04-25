<?php 
  require('../checklogin.php');
  
  //权限判断
  $type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
  if (!$type) {
  	showmsg('参数错误');
  	exit();
  }
  switch ($type){
  	case 'add':
  		if(!manager(45)){showmsg('没有权限访问');exit();}
  		break;
  
  	case 'edit':
  		if(!manager(46)){showmsg('没有权限访问');exit();}
  		break;
  	default:
  		break;
  }
	
  //会员组表
  $memberGroupTable = 'member_group';
  $group_id = isset($_GET['group_id']) ? intval($_GET['group_id']) : '';
  $roleinfo = '';
  if ($group_id) {
      $where['group_id'] = $group_id;
      $where['order by'] = 'group_id asc';
      $roleinfo = $db -> th_select($memberGroupTable,$where,'*');
      if (!$roleinfo) {
        showmsg('获取用户组信息出错');
        exit();
      }
  }

//标题
$pos = '新增会员组';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增会员组</title>
<?php include '../adminstatic.html';?>
<style type="text/css">
h2{background:#e5e5e5;text-indent: 15px;}
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list">
                <a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a>
                <span class="crumb-step">&gt;</span>
                <a class="crumb-name" href="groupList.php">会员组管理</a>
                <span class="crumb-step">&gt;</span><span><?php echo $pos;?></span>
            </div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>会员组：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($roleinfo)){echo $roleinfo['group_name'];}?>" name="info[group_name]" class="inputxt" datatype="s2-10" nullmsg="请输入会员组名称！" errormsg="会员组名称至少2个字符,最多10个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">会员组名称至少2个字符,最多10个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <?php if(!empty($roleinfo)) {?>
                                <input type="hidden" name='group_id' value="<?php echo $group_id;?>" />
                                <input type="hidden" name='type' value="groupEdit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="groupAdd" />
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
