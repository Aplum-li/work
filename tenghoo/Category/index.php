<?php
/**
 * 栏目管理列表
 */
require('../checklogin.php');

//权限判断
if(!manager(10)){showmsg('没有权限访问');exit();}
//栏目表
$article_type_table = 'article_type';
$where = array('order by'=>'sort,id');
$article_type_list = $db -> th_selectall($article_type_table,$where,'*');
$category = new category();
$article_type_list = $category->toLevel($article_type_list,' ┖ ');
$str = '&nbsp;&nbsp;&nbsp;';
foreach ($article_type_list  as $key => $value) {
    $article_type_list[$key]['count'] = '';
    if ($value['type'] == 'list') {
        $where = ' typeid IN ('.$value['id'].') AND isrecover=0';
        $count = $db -> count_num('article',$where);
        $article_type_list[$key]['count'] = '('.$count.')';
    }
    
    $pre = str_repeat($str, $value['level']);
    $article_type_list[$key]['str'] = $pre;
}

//标题
$pos = '栏目列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<style type="text/css">
tr.hide{display:none;}
</style>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">栏目管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-title">
                    <div class="result-list">
                            <?php if($_SESSION['role_id'] == 1){ ?>
                        <a href="category_edit.php?type=add"><i class="fa fa-plus-square"></i> 新增栏目</a>
                        <?php }?>
                        <a id="batchDel" href="javascript:void(0)"><i class="fa fa-refresh"></i> 更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="3%">排序</th>
                            <th width="3%">栏目ID</th>
                            <th width="40%" style='text-align:left;text-indent:10px;'>名称</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($article_type_list as $v){ ?>
                        <tr <?php if($v['pid'] != 0){
                                echo 'class="del_'.$v["id"].' class_'.$v["pid"].' hide"';
                            }else{
                                echo 'class="del_'.$v["id"].'" ';
                            }?>>
                            <td class="tc" style="height: 30px;">
                                <input name="ids[]" value="<?php echo $v['id']?>" type="hidden" >
                                <input name="sort[]" value="<?php echo $v['sort']?>" type="text" class='input30'>
                            </td>
                            <td><?php echo $v['id']?></td>
                            <td class="fl">
                                <span>
                                    <?php echo $v['str'];?>
                                    <?php echo $v['delimiter'];?> 
                                    <?php if($v['type'] =='page'){?>
                                    <a href="javascript:showmsg('单页栏目不允许发表文章');" class='b'>
                                        <?php echo $v['typename']?>
                                    </a>
                                    <?php }else{?>
                                    <a href="article_list.php?typeid=<?php echo $v['id'];?>" class='b check'>
                                        <?php echo $v['typename']?> <?php echo $v['count']?>
                                    </a>
                                    <?php }?> 
                                    <?php if(!$v['status']){?>
                                    <i class="fa fa-eye-slash fa-1x" title="隐藏"></i>
                                    <?php }?>
                                </span> 
<span class="plus" onclick="sh(this,<?php echo $v["id"];?>,'s')">
+
</span>
<span class="minus" onclick="sh(this,<?php echo $v["id"];?>,'h')">
-
</span>
                            </td>
                            <td>
                                <a href="/list.php?typeid=<?php echo $v['id'];?>" target="_blank">预览</a> |
                                    <?php if(manager(11)){ ?>
                                <a class="link-update" href="category_edit.php?id=<?php echo $v['id'];?>&type=add">添加子栏目</a>
                                <?php }?>
                                <?php if(manager(12)){ ?> | 
                                <a class="link-update" href="category_edit.php?id=<?php echo $v['id'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if(manager(13)){ ?>
                                    <?php if($v['pid'] == 0 && $_SESSION['role_id'] == 1){?>
                                 | <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a>
                                <?php }elseif ($v['pid'] != 0){?>
                                 | <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a>
                                <?php }}?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
                <input type='hidden' name='type' value='type_sort'>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
function sh(obj,id,t){
    if(t == 's'){
        $('.class_'+id).show();
        $(obj).hide();
        $(obj).siblings('.minus').show();
    }else{
        $('.class_'+id).hide();
        $(obj).hide();
        $(obj).siblings('.plus').show();
    }
}
</script>
<script type="text/javascript">
<?php if(!manager(14)){ ?>
    $(function(){
    $('a.check').click(function(){showmsg('没有权限访问');return false;})
    })
<?php }?>
function del_one(id){
    if(confirm('删除栏目会把该栏目及子栏目的所有文章全部删除，确认要删除么？')) {
        $.post("post.php", {"type": "del_type", "id": id},
        function (data) {
            if (data.status) {
                var obj = data.lists;
                $(obj).each(function (index) {
                    var val = obj[index];
                    $('.del_' + val).fadeOut();
                    setTimeout(function () {
                        $('.del_' + val).remove();
                    }, 2000);
                });
                layer.closeAll();
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
