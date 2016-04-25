<?php 
require('../checklogin.php');

//权限判断
if(!manager(6)){showmsg('没有权限访问');exit();}
//用户组表
$role_table = 'role';

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '';
$where = array('order by'=>'id asc');

$role_list = $db -> th_selectall($role_table,$where,'*',array(10,$_g_page));
$page = $db->page->html;
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
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户管理</a><span class="crumb-step">&gt;</span><span>用户列表</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="admin_post.php">
                <div class="result-title">
                    <div class="result-list">
                        <a href="role_list.php" class='cur'><i class="fa fa-users"></i>查看用户组</a>
                        <?php if(manager(7)){ ?>
                        <a href="role_edit.php?type=add"><i class="fa fa-plus-square"></i>新增用户组</a>
                        <?php }?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th width="3%">ID</th>
                            <th width="40%">名称</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($role_list as $v){?>
                        <?php if($v['id'] == 1 && $_SESSION['role_id'] != 1) continue;?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['name']?></td>
                            <td>
                            	<?php if($v['id'] == 1) continue;?>
                            	<?php if($v['id'] == 2 && $_SESSION['role_id'] != 1) continue;?>
                            		<?php if(manager(8)){ ?>
                                <a class="link-update" href="role_edit.php?id=<?php echo $v['id'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if(manager(9)){ ?> | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a>
                                <?php }?>
                            </td>
                        </tr>
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
    if(confirm('删除了再也无法恢复，确认要删除么？')) {
        $.post("admin_post.php", {"type": "del_role", "id": id},
            function (data) {
                if (data) {
                    $('.del_' + id).fadeOut();
                } else {
                    showmsg('删除失败');
                }
            }, "json");
    }
}
</script>
</body>
</html>
