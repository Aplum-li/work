<?php 
require('../checklogin.php');

//权限判断
if(!manager(2)){showmsg('没有权限访问');exit();}
//管理员表
$admintable = 'admin';
$_g_page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$where = array('order by'=>'id asc');
$status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';
$orderby = isset($_GET['orderby']) ? htmlspecialchars($_GET['orderby']) : '';
$count_where = '';
if ($status != '' && $status != 'all') {
		$count_where = ' AND status="'.$status.'"';
    $where['status'] = $status;
}
if ($orderby != '') {
    $where['order by'] = ' id '.$orderby;
}

$adminlist = $db -> th_selectall($admintable,$where,'*',array(10,$_g_page));
foreach ($adminlist as $key => $value) {
    $ruinfo = array();
    $sql = 'SELECT ro.name FROM `'.DB_PRE.'role` as ro LEFT JOIN `'.DB_PRE.'role_user` as ru ON ru.role_id=ro.id WHERE ru.user_id='.$value['id'];
    $ruinfo = $db -> sql_select($sql);
    if (empty($ruinfo['name'])) {
        $ruinfo['name'] = '无';
    }
    $adminlist[$key]['card'] = $ruinfo['name'];
}
$page = $db->page->html;


$count = $db -> query_result('select count(*) as count from `'.DB_PRE.$admintable.'` WHERE 1'.$count_where);

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
                    		<?php if(manager(3)){?>
                        <a href="admin_edit.php?type=add"><i class="fa fa-user"></i>新增用户</a>
                        <?php }?>
                        <?php if(manager(5)){?>
                        <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>批量删除</a>
                        <?php }?>
                        <select name="search-sort" onchange="select_jump(this)">
                            <option value="index.php?status=all" <?php if($status == 'all'){echo 'selected';}?>>全部</option>
                            <option value="index.php?status=y" <?php if($status == 'y'){echo 'selected';}?>>正常登录</option>
                            <option value="index.php?status=n" <?php if($status == 'n'){echo 'selected';}?>>禁止登录</option>
                            <option value="index.php?orderby=desc" <?php if($orderby == 'desc'){echo 'selected';}?>>最新添加</option>
                        </select>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
                            <th>ID</th>
                            <th width="40%">名称</th>
                            <th width="15%">状态</th>
                            <th width="15%">身份</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($adminlist as $v){?>
                        <?php if($v['id'] == 1){ if($_SESSION['role_id'] != 1){continue;}}?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td class="tc"><?php if($v['id'] != 1){?><input name="id[]" value="<?php echo $v['id']?>" type="checkbox" class='ids'><?php }?></td>
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['name']?></td>
                            <td><?php if($v['status']){echo '<span style="color:green;">正常登录</span>';}else{echo '<span style="color:green;">禁止登录</span>';}?></a>
                           	</td>
                           	<td><?php echo $v['card'];?></td>
                            <td>
                            		<?php if(manager(4)){?>
                                <a class="link-update" href="admin_edit.php?id=<?php echo $v['id'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if($v['id'] == 1){ continue;}?>
                                <?php if($v['id'] == 21){ continue;}?>
                                <?php if(manager(5)){?>
                                 | <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a>
                                 <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                    <style type="text/css">
					.list-page{overflow:hidden;}
					.list-page .fenye{float: left;}
                    </style>
                    <div class="list-page"><div style="float:left">共 <span class='blue'><?php echo $count['count'];?></span> 位管理员 </div><?php echo $page;?></div>
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
        $.post("admin_post.php", {"type": "del", "id": id},
            function (data) {
                if (data) {
                    $('.del_' + id).fadeOut();
                } else {
                    showmsg('删除失败');
                }
            }, "json");
    }
}
$(function(){
	$('#batchDel').click(function(){
        if(confirm('删除了再也无法恢复，确认要删除么？')) {
            $('#myform').submit();
        }
	})
})
</script>
</body>
</html>
