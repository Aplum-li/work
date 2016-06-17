<?php
/**
 * 友情链接列表
 */
require('../checklogin.php');

//权限判断
if(!manager(36)){showmsg('没有权限访问');exit();}
//友情链接表
$flinkTable = 'flink';
$flinkTypeTable = 'flink_type';
$typeid = $_GET['typeid'];
$where = array('typeid'=>$typeid,'order by'=>'flink_id desc');

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '1';
$list = $db -> th_selectall($flinkTable,$where,'*',array(20,$_g_page));

$flinkType = $db -> th_selectall($flinkTypeTable);

$page = $db->page->html;
//标题
$pos = '友情链接列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>友情链接列表</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">友情链接列表</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                    <div class="result-list">
            <?php if(manager(37)){ ?>
                <a href="flinkEdit.php?type=add&typeid=<?php echo $typeid;?>"><i class="fa fa-plus-square"></i> 添加友情链接</a>
            <?php }?>
            <?php if(manager(39)){ ?>
                <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>批量删除</a>
            <?php }?>
            <a id="batchSort" href="javascript:void(0)"><i class="fa fa-refresh"></i> 更新排序</a>
			<select name="search-sort" onchange="select_jump(this)">
				<?php  foreach ($flinkType as $key => $value) { ?>
					<option value="<?php echo ADMIN;?>/Flink/flink_list.php?typeid=<?php echo $value['id'];?>" <?php if($typeid == $value['id']){echo 'selected';}?>><?php echo getstr($value['flink_type_name'],20);?></option>
				<?php }?>
			</select>
                </div>
            </div>
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="4%" style="min-width: 35px;"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
                            <th class="tc" width="4%" style="min-width: 35px;">排序</th>
                            <th width="3%">ID</th>
                            <th width="10%" style='text-align:left;text-indent:10px;'>名称</th>
                            <th style='text-align:left;text-indent:10px;'>链接</th>
                            <th width="15%" style='text-align:left;text-indent:10px;'>添加时间</th>
                            <th width="10%" style='text-align:left;text-indent:10px;'>状态</th>
                            <th width="10%">操作</th>
                        </tr>
                        <?php foreach($list as $v){ ?>
                        <tr class="del_<?php echo $v['flink_id']?>">
                            <td class="tc"><input name="flink_id[]" value="<?php echo $v['flink_id']?>" type="checkbox" class='ids'></td>
                            <td>
                                <input name="ids[]" value="<?php echo $v['flink_id']?>" type="hidden" >
								<input name="typeid" value="<?php echo $typeid?>" type="hidden" >
                                <input name="sort[]" value="<?php echo $v['sort']?>" type="text" class='input30'>
                            </td>
                            <td><?php echo $v['flink_id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;"><a href="flinkEdit.php?typeid=<?php echo $v['typeid'];?>&flink_id=<?php echo $v['flink_id'];?>" class='b edit'><?php echo $v['flink_name']?></a>
                                </span> 
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php echo $v['flink_link']?>
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php echo date('Y-m-d H:i:s',$v['creattime'])?>
                            </td>
                            <td style='text-align:left;text-indent:10px;'>
                                <?php if($v['status']){ ?>
                                <span style="color:green">正常显示</span>
                                <?php }else{?>
                                <span style="color:red">隐藏</span>
                                <?php }?> 
                            </td>
                            <td>
                            		<?php if(manager(38)){ ?>
                                 <a class="link-update" href="flinkEdit.php?typeid=<?php echo $v['typeid'];?>&flink_id=<?php echo $v['flink_id'];?>">编辑</a><?php }?>
                                <?php if(manager(39)){ ?>
                                 | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['flink_id'];?>);">删除</a>
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
<?php if(!manager(38)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
    if(confirm('删除了再也无法恢复，确认要删除么？')) {
        $.post("post.php", {"type": "del","typeid":"<?php echo $typeid;?>","flink_id": id},
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
            $("input[name='type']").val('del')
            $('#myform').submit();
        }
	})
    $('#batchSort').click(function(){
        $("input[name='type']").val('sort');
		//$("input[name='typeid']").val($typeid);
        $('#myform').submit();
    })
})
</script>
</body>
</html>
