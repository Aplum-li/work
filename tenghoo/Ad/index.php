<?php
/**
 * 广告位列表
 */
require('../checklogin.php');

//权限判断
if(!manager(27)){showmsg('没有权限访问');exit();}
//广告表
$ad_table = 'ad';
$where = array('order by'=>'ad_id asc');

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '1';
$ad_list = $db -> th_selectall($ad_table,$where,'*',array(10,$_g_page));

$page = $db->page->html;
//标题
$pos = '广告列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告列表</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">广告管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-title">
                    <div class="result-list">
                    		<?php if($_SESSION['role_id'] == 1){ ?>
                        <a href="ad_edit.php"><i class="fa fa-plus-square"></i> 新增广告位</a>
                        <?php }?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th width="3%">ID</th>
                            <th width="40%" style='text-align:left;text-indent:10px;'>名称</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($ad_list as $v){ ?>
                        <tr class="del_<?php echo $v['ad_id']?>">
                            <td><?php echo $v['ad_id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;"><a href="ad_edit.php?ad_id=<?php echo $v['ad_id'];?>" class='b edit'><?php echo $v['ad_name']?></a><?php if(!$v['status']){?><i class="fa fa-eye-slash fa-1x" title="隐藏"></i><?php }?>
                                </span> 
                            </td>
                            <td>
                            		<a class="link-update" href="ad_diaoyong.php?ad_id=<?php echo $v['ad_id'];?>">调用代码</a>
                            		<?php if(manager(29)){ ?>
                                 | <a class="link-update" href="ad_edit.php?ad_id=<?php echo $v['ad_id'];?>">修改</a><?php }?>
                                <?php if($_SESSION['role_id'] == 1){ ?>
                                 | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['ad_id'];?>);">删除</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"><?php echo $page;?></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
<?php if(!manager(29)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
    if(confirm('删除了再也无法恢复，确认要删除么？')) {
        $.post("post.php", {"type": "ad_del", "ad_id": id},
            function (data) {
                if (data) {
                    $('.del_' + id).fadeOut();
                } else {
                    showmsg('删除失败');
                }
            }, "json");
    }
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
$(function(){
	$('#batchDel').click(function(){
		$('#myform').submit();
	})
})
</script>
</body>
</html>
