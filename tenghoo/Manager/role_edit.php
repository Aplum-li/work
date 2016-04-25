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
  		if(!manager(7)){showmsg('没有权限访问');exit();}
  		break;
  
  	case 'edit':
  		if(!manager(8)){showmsg('没有权限访问');exit();}
  		break;
  	default:
  		break;
  }
  
  //获取权限节点列表
  //权限分类表
  $node_type_table = 'node_type';
  //节点表
  $node_table = 'node';
  $where = array('order by'=>'node_type_id asc');
  
  $node_type_list = $db -> th_selectall($node_type_table,$where,'*');
  foreach ($node_type_list as $k=>$v){
  	$nodewhere = array('node_type_id'=>$v['node_type_id']);
  	$node_list = $db -> th_selectall($node_table,$nodewhere,'*');
  	$node_type_list[$k]['node_list'] = $node_list;
  }
	
  //用户组表
  $role_table = 'role';
  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
  $roleinfo = '';
  if ($id) {
      $where['id'] = $id;
      $where['order by'] = 'id asc';
      $roleinfo = $db -> th_select($role_table,$where,'*');
      if (!$roleinfo) {
        showmsg('获取用户组信息出错');
        exit();
      }
      //获取角色权限
      $role_access = $db -> th_getaccess($id);
      $node_ids = array();
      foreach ($role_access as $k =>$v){
      	$node_ids[] = $v['node_id'];
      }
      foreach ($node_type_list as $key=>$value){
      	if (!empty($value['node_list'])) {
      		foreach ($value['node_list'] as $k=>$v){
      			if (in_array($v['node_id'],$node_ids)) {
      				$node_type_list[$key]['node_list'][$k]['is']=1;
      			}else{
      				$node_type_list[$key]['node_list'][$k]['is']=0;
      			}
      		}
      	}
      }
  }

//标题
$pos = '新增用户组';
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
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="admin_post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:65px;" class='r'>用户组：</td>
                            <td><input type="text" value="<?php if(!empty($roleinfo)){echo $roleinfo['name'];}?>" name="info[name]" class="inputxt" datatype="s2-10" nullmsg="请输入用户组名称！" errormsg="用户组名称至少2个字符,最多10个字符！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">用户组名称至少2个字符,最多10个字符<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <?php if(manager(31)){?>
                        <tr>
                            <td class="need"></td>
                            <td class='r'>权限管理：</td>
                            <td colspan='2'>
                            	<?php foreach ($node_type_list as $k=>$v){?>
	                            	<h2 style="font-size: 16px;"><?php echo $v['node_type_name'];?> <input class="allChoose" onclick="check_all_other('ids_<?php echo $v['node_type_id'];?>',this)" type="checkbox">&nbsp;&nbsp;</h2>
	                            	
	                            	<?php if(!empty($v['node_list'])){ foreach ($v['node_list'] as $n) {?>
	                            	<?php if($n['node_id'] == 19){ if($_SESSION['role_id'] != 1){continue;}}?>
	                            	<?php if($n['node_id'] == 21){ if($_SESSION['role_id'] != 1){continue;}}?>
	                            	<?php if($n['node_id'] == 30){ if($_SESSION['role_id'] != 1){continue;}}?>
	                            	<?php if($n['node_id'] == 28){ if($_SESSION['role_id'] != 1){continue;}}?>
	                            	&nbsp;&nbsp;&nbsp;<input type="checkbox" name="access[]" value="<?php echo $n['node_id']?>" class='ids_<?php echo $v['node_type_id'];?>' <?php if(isset($n['is']) && $n['is']){echo 'checked';}?>> <?php echo $n['node_name'];?>
	                            	<?php }}?>
                            	<?php }?>
                            </td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <?php if(!empty($roleinfo)) {?>
                                <input type="hidden" name='id' value="<?php echo $id;?>" />
                                <input type="hidden" name='type' value="role_edit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="role_add" />
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
<?php if($id == '1'){ ?>
	$("input[type='checkbox']").attr('checked','checked');
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
</script>
</html>
