<?php
/**
 * 权限分类列表
 */
require('../checklogin.php');

/**
 * 这是添加后台节点的地方，一般不准访问
 */
//showmsg('禁止访问');exit();
//权限分类表
$node_type_table = 'node_type';
//节点表
$node_table = 'node';

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '';
$where = array('order by'=>'node_type_id asc');

$node_type_list = $db -> th_selectall($node_type_table,$where,'*',array(50,$_g_page));
foreach ($node_type_list as $k=>$v){
	$nodewhere = array('node_type_id'=>$v['node_type_id']);
	$node_list = $db -> th_selectall($node_table,$nodewhere,'*',array(50,$_g_page));
	$node_type_list[$k]['node_list'] = $node_list;
}
$page = $db->page->html;
//标题
$pos = '权限分类列表';
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
            <div class="crumb-list"><i class="fa fa-home fa-fw"></i><a href="../main.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="admin_post.php">
                <div class="result-title">
                    <div class="result-list">
                        <a href="node_list.php" class='cur'><i class="fa fa-users"></i>权限列表</a>
                        <a href="node_type_edit.php"><i class="fa fa-user"></i>新增分类</a>
                        <a href="node_edit.php"><i class="fa fa-user"></i>新增节点</a>
                        <!-- <a href="role_edit.php"><i class="fa fa-plus-square"></i>新增用户组</a>
                        <a href="role_list.php"><i class="fa fa-users"></i>查看用户组</a> -->
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th width="3%">ID</th>
                            <th width="40%" style="text-align:left;">名称</th>
                        </tr>
                        <?php foreach($node_type_list as $v){ ?>
                        <tr class="del_<?php echo $v['node_type_id']?>">
                            <td><?php echo $v['node_type_id']?></td>
                            <td style="text-align:left;">
                            	<span style="float:left"><?php echo $v['node_type_name']?></span>
                            	<span onclick="tooglechild(<?php echo $v['node_type_id']?>,this);" style="float:right;padding: 10px;cursor:pointer;"><i class="fa fa-plus-square"></i></span>
                                <span onclick="tooglechild1(<?php echo $v['node_type_id']?>,this);" style="float:right;padding: 10px;cursor:pointer;display:none;"><i class="fa fa-minus-square"></i></span>
                            </td>
                        </tr>
                        <?php if(!empty($v['node_list'])){?>
                        <tr style="display:none;" class="typechild_<?php echo $v['node_type_id'];?>">
                            <td></td>
                            <td style="text-align:left;">
                             <?php foreach ($v['node_list'] as $node) {?>
                            	<?php echo '&nbsp;&nbsp;'.$node['node_name']?>
                        		<?php }?>
                            </td>
                        </tr>
                        <?php }?>
                        <?php }?>
                    </table>
                    <style type="text/css">
					.list-page{overflow:hidden;}
					.list-page .fenye{float: left;}
                    </style>
                    <div class="list-page"><?php echo $page;?></div>
                </div>
                <input type='hidden' name='type' value='del'>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
function del_one(id){
	$.post("admin_post.php", { "type": "del_node_type", "id": id },
    function(data){
    	if (data) {
    		$('.del_'+id).fadeOut();
    	}else{
    		showmsg('删除失败');
    	}
    }, "json");
}
function tooglechild(idnum,obj){
    $('.typechild_'+idnum).show();
    $(obj).siblings('span').show();
    $(obj).hide();
}
function tooglechild1(idnum,obj){
    $('.typechild_'+idnum).hide();
    $(obj).siblings('span').show();
    $(obj).hide();
}
</script>
</body>
</html>
