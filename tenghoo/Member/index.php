<?php 
require('../checklogin.php');

//权限判断
if(!manager(40)){showmsg('没有权限访问');exit();}
//会员表
$membertable = 'member';
$_g_page = isset($_GET['page']) ? intval($_GET['page']) : 0;

$where = '';
$k = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
if ($k) {
    $where .= ' AND (`account` LIKE "%'.$k.'%" OR `nickname` LIKE "%'.$k.'%" OR `phone` LIKE "%'.$k.'%" OR `email` LIKE "%'.$k.'%")';
}

$adminlist = $db -> th_selectall($membertable,$where,'*',array(10,$_g_page));
foreach ($adminlist as $key => $value) {
    $w = array('group_id'=>$value['group_id']);
    $ginfo = $db -> th_select('member_group',$w,'group_name');
    $adminlist[$key]['gname'] = $ginfo['group_name'];
}
$page = $db->page->html;


$count = $db -> query_result('select count(*) as count from `'.DB_PRE.$membertable.'` WHERE 1'.$where);

//标题
$pos = '会员列表';
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
                <a class="crumb-name" href="index.php">会员管理</a>
                <span class="crumb-step">&gt;</span><span><?php echo $pos;?></span>
            </div>
        </div>
        <div class="result-wrap">
                <div class="result-title">
                    <div class="result-list">
                    		<?php if(manager(41)){?>
                        <a href="memberEdit.php?type=add"><i class="fa fa-user"></i>新增会员</a>
                        <?php }?>
                        <?php if(manager(43)){?>
                        <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>批量删除</a>
                        <?php }?>
                        <form class='registerform' style="display: inline;" onsubmit="return mcheckform()">
                            <input type="text" style="padding: 5px;font-size:12px;" onfocus="this.value=''" onblur="if(this.value == '')this.value='可输入会员账号、姓名、电话、邮箱进行搜索'" value="<?php if(isset($_GET['keyword']) && !empty($_GET['keyword'])){echo $_GET['keyword'];} else { echo '可输入会员账号、姓名、电话、邮箱进行搜索';}?>" name="keyword" class="inputxt" />
                            <input type="submit" value="搜索" />
                        </form>
                    </div>
                </div>
                <script type="text/javascript">
function mcheckform () {
    if ($.trim($("input[name='keyword']").val()) == '' || $("input[name='keyword']").val() == '可输入会员账号、姓名、电话、邮箱进行搜索')  {
        showmsg('请输入关键字');
        return false;
    };
}
                </script>
            <form name="myform" id="myform" method="post" action="post.php">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" onclick="check_all_other('member_ids',this)" type="checkbox"></th>
                            <th>ID</th>
                            <th width="30%">账号</th>
                            <th width="15%">手机号码</th>
                            <th width="15%">邮箱账号</th>
                            <th width="15%">身份</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php foreach($adminlist as $v){?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td class="tc"><?php if($v['id'] != 1){?><input name="id[]" value="<?php echo $v['id']?>" type="checkbox" class='member_ids'><?php }?></td>
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['account']?>(昵称：<?php echo $v['nickname']?>)</td>
                            <td><?php echo $v['phone'];?></td>
                            <td><?php echo $v['email'];?></td>
                           	<td><?php echo $v['gname'];?></td>
                            <td>
                                <?php if(manager(42)){?>
                                <a class="link-update" href="memberEdit.php?id=<?php echo $v['id'];?>&type=edit">修改</a>
                                <?php }?>
                                <?php if(manager(43)){?>
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
        $.post("post.php", {"type": "del", "id": id},
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
