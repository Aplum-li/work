<?php
/**
 * 模型管理
 */
require('../checklogin.php');

//权限判断
if($_SESSION['role_id'] != 1){showmsg('没有权限访问');exit();}
//模型表
$model_table = 'model';
$where = array('order by'=>'model_id');
$model_list = $db -> th_selectall($model_table,$where,'*');

//标题
$pos = '模型列表';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo WEBPATH;?>/data/Dialog/zDrag.js"></script>
<script type="text/javascript" src="<?php echo WEBPATH;?>/data/Dialog/zDialog.js"></script>
<title><?php echo $pos;?></title>
<style type="text/css">
tr.hide{display:none;}
</style>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">模型管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-title">
                    <div class="result-list">
                        <?php if($_SESSION['role_id'] == 1){ ?>
                        <a href="model_edit.php"><i class="fa fa-plus-square"></i> 新增模型</a>
                        <?php }?>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th width="50px">模型ID</th>
                            <th width="200px">名称</th>
                            <th width="200px">状态</th>
                            <th width="200px">操作</th>
                        </tr>
                        <?php foreach($model_list as $v){ ?>
                        <tr>
                            <td><?php echo $v['model_id']?></td>
                            <td><?php echo $v['model_name'];?></td>
                            <td>
                            <?php if($v['model_status']){?>
                            <a href="javascript:;" style="color:green;" class="m_<?php echo $v['model_id']?>">启用</a>
                            <?php } else { ?>
                            <a href="javascript:;" style="color:red;" class="m_<?php echo $v['model_id']?>">禁用</a>
                            <?php }?>
                            </td>
                            <td>
                                <?php if($v['model_status']){?>
                                <a href="javascript:;" onClick="changeStatus(<?php echo $v['model_id'];?>,this)">禁用</a>
                                <?php } else { ?>
                                <a href="javascript:;" onClick="changeStatus(<?php echo $v['model_id']?>,this)">启用</a>
                                <?php }?>| 
                                <a class="link-update" href="model_edit.php?model_id=<?php echo $v['model_id'];?>">修改</a>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<script type="text/javascript">
function changeStatus(id,obj){
    $.post("post.php", { "type": "changeStatus", "model_id": id },
    function(data){
        if (data.status) {
          if (data.msg) {
            $('.m_'+id).html('启用');
            $('.m_'+id).css('color','green');
            $(obj).html('禁用');
          } else {
            $('.m_'+id).html('禁用');
            $('.m_'+id).css('color','red');
            $(obj).html('启用');
          }
        }else{
            showmsg('操作失败');
        }
    }, "json");
}
</script>
</body>
</html>
