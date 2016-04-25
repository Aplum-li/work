<?php
/**
 * 留言列表
 */
require('../checklogin.php');

//权限判断
if(!manager(34)){showmsg('没有权限访问');exit();}
//留言表
$messageTable = 'message';
$where = array('order by'=>'message_id desc');

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '1';
$ad_list = $db -> th_selectall($messageTable,$where,'*',array(20,$_g_page));

$page = $db->page->html;
//标题
$pos = '留言列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>留言列表</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">留言列表</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <div class="result-list">
                <?php if(manager(35)){ ?>
                    <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>批量删除</a>
                <?php }?>
                </div>
            </div>
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="4%" style="min-width: 35px;"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
                            <th width="3%">ID</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>名称</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>联系方式</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>邮箱</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>状态</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>留言时间</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($ad_list as $v){ ?>
                        <tr class="del_<?php echo $v['message_id']?>">
                            <td class="tc"><input name="message_id[]" value="<?php echo $v['message_id']?>" type="checkbox" class='ids'></td>
                            <td><?php echo $v['message_id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;"><a href="messageEdit.php?message_id=<?php echo $v['message_id'];?>" class='b edit'><?php echo $v['username']?></a>
                                </span> 
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php echo $v['phone']?>
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php echo $v['email']?>
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php if($v['status']){ ?>
                                <span style="color:green">已查看</span>
                                <?php }else{?>
                                <span style="color:red">未查看</span>
                                <?php }?> 
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php echo date('Y-m-d H:i:s',$v['addtime'])?>
                            </td>
                            <td>
                            		<?php if(manager(34)){ ?>
                                 <a class="link-update" href="messageEdit.php?message_id=<?php echo $v['message_id'];?>">查看</a><?php }?>
                                <?php if(manager(35)){ ?>
                                 | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['message_id'];?>);">删除</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"><?php echo $page;?></div>
                </div>
                <input type='hidden' name='type' value=''>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
<?php if(!manager(34)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
	$.post("post.php", { "type": "del", "message_id": id },
    function(data){
    	if (data) {
    		$('.del_'+id).fadeOut();
    	}else{
    		showmsg('删除失败');
    	}
    }, "json");
}
$(function(){
	$('#batchDel').click(function(){
        $("input[name='type']").val('del')
		$('#myform').submit();
	})
})
</script>
</body>
</html>
