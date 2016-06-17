<?php
/**
 * 轮换图管理列表
 */
require('../checklogin.php');

//权限判断
if(!manager(18)){showmsg('没有权限访问');exit();}
//分类表
$rotation_type_table = 'rotation_type';
$where = array('order by'=>'id asc');
$rotation_type_list = $db -> th_selectall($rotation_type_table,$where,'*');
//标题
$pos = '轮换图分类';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>轮换图分类</title>
<script type="text/javascript" src="<?php echo WEBPATH;?>/data/Dialog/zDrag.js"></script>
<script type="text/javascript" src="<?php echo WEBPATH;?>/data/Dialog/zDialog.js"></script>
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
                    		<?php if(manager(19)){?>
                        <a href="rotation_type_edit.php?type=add"><i class="fa fa-plus-square"></i> 新增分类</a>
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
                        <?php foreach($rotation_type_list as $v){ ?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td><?php echo $v['id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;"><a href="rotation_list.php?typeid=<?php echo $v['id'];?>" class='b edit'><?php echo $v['rotation_type_name']?></a>
                                </span> 
                            </td>
                            <td>
                            		<?php if(manager(20)){ ?>
                            		<a class="link-update" href="rotation_type_edit.php?id=<?php echo $v['id'];?>&type=edit">修改</a><?php }?>
                            		<?php if(manager(21)){ ?> | 
                                <a class="link-del" href="javascript:Dialog.confirm('提示：删除分类会把分类下的文章一起删除，请确认？',function(){del_one(<?php echo $v['id'];?>);});">删除</a>
                                <?php }?>
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
<?php if(!manager(22)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
	$.post("post.php", { "type": "del_type", "id": id },
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
$(function(){
	$('#batchDel').click(function(){
		$('#myform').submit();
	})
})
</script>
</body>
</html>
