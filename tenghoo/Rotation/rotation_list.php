<?php
/**
 * 轮换图内容列表
 */
require('../checklogin.php');
if(!manager(22)){showmsg('没有权限访问');exit();}
//内容表
$rotation_table = 'rotation';
//分类表
$rotation_type_table = 'rotation_type';
//管理员表
$admin_table = 'admin';
$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
if (!$typeid) {
    showmsg('参数错误');
    exit();
}
$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '';
$where = array('order by'=>'sort','typeid'=>$typeid);
$rotation_list = $db -> th_selectall($rotation_table,$where,'*',array(20,$_g_page));

foreach ($rotation_list as $key => $value) {
    $where = array('id'=>$value['m_id']);
    $minfo = $db -> th_select($admin_table,$where,'name');
    $rotation_list[$key]['name'] = $minfo['name'];
}
$page = $db->page->html;

//标题
$typeinfo = $db -> th_select($rotation_type_table,array('id'=>$typeid));

$pos = $typeinfo['rotation_type_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>轮换图列表</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">分类管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-title">
                    <div class="result-list">
                    		<?php if(manager(23)){ ?>
                        <a href="rotation_edit.php?typeid=<?php echo $typeid;?>&type=add"><i class="fa fa-plus-square"></i> 添加轮换图</a>
                        <?php }?>
                        <a id="batchSort" href="javascript:void(0)"><i class="fa fa-refresh"></i> 更新排序</a>
                        <?php if(manager(25)){ ?>
                        <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i> 批量删除</a>
                        <?php }?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="3%"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
                            <th class="tc" width="4%" style="min-width: 35px;">排序</th>
                            <th width="3%" style="min-width: 35px;">ID</th>
                            <th width="40%" style='text-align:left;text-indent:10px;'>名称</th>
                            <th width="10%" style="min-width: 120px;">添加时间</th>
                            <th width="7%">管理员</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($rotation_list as $v){ ?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td class="tc"><input name="id[]" value="<?php echo $v['id']?>" type="checkbox" class='ids'></td>
                            <td>
                                <input name="ids[]" value="<?php echo $v['id']?>" type="hidden" >
                                <input name="sort[]" value="<?php echo $v['sort']?>" type="text" class='input30'>
                            </td>
                            <td><?php echo $v['id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;"><a href="rotation_edit.php?id=<?php echo $v['id'];?>&typeid=<?php echo $v['typeid'];?>&type=edit" class="edit"><?php echo $v['title']?></a>
                                </span> 
                            </td>
                            <td><?php echo date('Y-m-d H:i',$v['creattime']);?></td>
                            <td><?php echo $v['name'];?></td>
                            <td>
                            		<?php if(manager(24)){ ?>
                                <a class="link-update" href="rotation_edit.php?id=<?php echo $v['id'];?>&typeid=<?php echo $v['typeid'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if(manager(25)){ ?> | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"><?php echo $page;?></div>
                </div>
                <input type='hidden' name='typeid' value="<?php echo $typeid;?>">
                <input type='hidden' name='type' value=''>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
<?php if(!manager(24)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
    if(confirm('删除了再也无法恢复，确认要删除么？')) {
        $.post("post.php", {"type": "del_article", "id": id},
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
            $("input[name='type']").val('del_article')
            $('#myform').submit();
        }
	})
    $('#batchSort').click(function(){
        $("input[name='type']").val('article_sort');
        $('#myform').submit();
    })
})
</script>
</body>
</html>
