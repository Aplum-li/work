<?php 
  require('../checklogin.php');
  //权限分类表
  $node_type_table = 'node_type';
  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
  $roleinfo = '';
  if ($id) {
      $where['node_type_id'] = $id;
      $where['order by'] = 'node_type_id asc';
      $roleinfo = $db -> th_select($node_type_table,$where,'*');
      if (!$roleinfo) {
        showmsg('获取分类信息出错');
        exit();
      }
  }

//标题
$pos = '编辑权限分类';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<?php include '../adminstatic.html';?>
<style type="text/css">
h2{background:#e5e5e5;text-indent: 15px;}
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../main.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="admin_post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>分类名称：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($roleinfo)){echo $roleinfo['node_type_name'];}?>" name="info[node_type_name]" class="inputxt" datatype="s2-10" nullmsg="请输入分类名称！" errormsg="分类名称至少2个字符,最多10个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">分类名称至少2个字符,最多10个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <input type="hidden" name='type' value="note_type_add" />
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
