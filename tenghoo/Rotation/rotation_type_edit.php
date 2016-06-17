<?php 
  require('../checklogin.php');
  
  //权限判断
  if(manager(19) || manager(20)){
  	
	  	//权限判断
	  	$type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
	  	if (!$type) {
	  		showmsg('参数错误');
	  		exit();
	  	}
	  	switch ($type){
	  		case 'add':
	  			if(!manager(19)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		case 'edit':
	  			if(!manager(20)){showmsg('没有权限访问');exit();}
	  			break;
	  	
	  		default:
	  			break;
	  	}
	  //轮换图分类表
	  $rotation_type_table = 'rotation_type';
	  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	  $typeinfo = '';
	  if ($type != 'add') {
	    if ($id) {
	      $where['id'] = $id;
	      $where['order by'] = 'id asc';
	      $typeinfo = $db -> th_select($rotation_type_table,$where,'*');
	      if (!$typeinfo) {
	        showmsg('获取分类信息出错');
	        exit();
	      }
	    }
	  }
  }else{
  	showmsg('没有权限访问');exit();
	}
  //标题
$pos = '编辑分类';
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
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">分类管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>分类名称：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['rotation_type_name'];}?>" name="info[rotation_type_name]" class="inputxt input400" datatype="*" nullmsg="请输入分类名称！" errormsg="请输入分类名称！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入分类名称！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <?php if(!empty($typeinfo)) {?>
                                <input type="hidden" name='id' value="<?php echo $id;?>" />
                                <input type="hidden" name='type' value="type_edit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="type_add" />
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
