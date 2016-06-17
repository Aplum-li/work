<?php 
require('../checklogin.php');

//权限判断
if(!manager(44)){showmsg('没有权限访问');exit();}
//会员组表
$memberGroupTable = 'member_group';

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '';
$where = array('order by'=>'group_id asc');

$memberGroupList = $db -> th_selectall($memberGroupTable,$where,'*',array(10,$_g_page));
$page = $db->page->html;
//标题
$pos = '会员组列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pos;?></title>
<?php include '../adminstatic.html';?>
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
            <form name="myform" id="myform" method="post" action="admin_post.php">
                <div class="result-title">
                    <div class="result-list">
                        <a href="groupList.php" class='cur'><i class="fa fa-users"></i>会员组列表</a>
                        <?php if(manager(45)){ ?>
                        <a href="groupEdit.php?type=add"><i class="fa fa-plus-square"></i>新增会员组</a>
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
                        <?php foreach($memberGroupList as $v){?>
                        <tr class="del_<?php echo $v['group_id']?>">
                            <td><?php echo $v['group_id']?></td>
                            <td><?php echo $v['group_name']?></td>
                            <td>
                            		<?php if(manager(46)){ ?>
                                <a class="link-update" href="groupEdit.php?group_id=<?php echo $v['group_id'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if($v['group_id'] == 1) continue;?>
                                <?php if(manager(47)){ ?> | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['group_id'];?>);">删除</a>
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
        $.post("post.php", {"type": "groupDel", "group_id": id},
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
