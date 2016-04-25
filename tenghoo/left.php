<?php
require('checklogin.php');
$sql = 'SELECT count(message_id) as count FROM `'.DB_PRE.'message` WHERE `status`=0';
$countMessage = $db -> sql_select($sql);
?>
<?php include 'adminstatic.html';?>
<div class="sidebar-wrap">
    <div class="sidebar-content">
        <ul class="sidebar-list">
            <?php if(manager(10) || manager(22) || manager(27)){ ?>
            <li class="list1 y">
                <h4>常用操作</h4>
            </li>
            <?php }?>
            <li class="list2" style="display:list-item;">
                <?php if(manager(10)){ ?>
                <a href="<?php echo ADMIN;?>/Category/index.php" target="mainFrame">栏目管理</a>
                <?php }?>
                <?php if(manager(22)){ ?>
                <a href="<?php echo ADMIN;?>/Rotation/index.php" target="mainFrame">轮换图管理</a>
                <?php }?>
                <?php if(manager(27)){ ?>
                <a href="<?php echo ADMIN;?>/Ad/index.php" target="mainFrame">广告位管理</a>
                <?php }?>
                <?php if(manager(34)){ ?>
                <a href="<?php echo ADMIN;?>/Message/index.php" target="mainFrame">在线留言 (<span style="color:red;"><?php if($countMessage['count'] !=0){echo $countMessage['count'];}?></span>)</a>
                <?php }?>
                <?php if(manager(36)){ ?>
                <a href="<?php echo ADMIN;?>/Flink/index.php" target="mainFrame">友情链接</a>
                <?php }?>
                <?php if(loadConfig('ishtml')){?>
                <a href="<?php echo ADMIN;?>/Mkhtml/index.php" target="mainFrame">更新主页</a>
                <a href="<?php echo ADMIN;?>/Mkhtml/list.php" target="mainFrame">更新列表页</a>
                <a href="<?php echo ADMIN;?>/Mkhtml/view.php" target="mainFrame">更新内容页</a>
                <?php }?>
                <?php if(manager(48)){ ?>
                <a href="<?php echo ADMIN;?>/Recover/index.php" target="mainFrame">回收站</a>
                <?php }?>
            </li>

            <?php if(manager(2) || manager(6)){ ?>
            <li class="list1">
                <h4>用户管理</h4>
            </li>
            <?php }?>
            <li class="list2">
                    <?php if(manager(2)){ ?>
                    <a href="<?php echo ADMIN;?>/Manager/index.php" target="mainFrame">用户列表</a>
                <?php }?>
                <?php if(manager(6)){ ?>
                    <a href="<?php echo ADMIN;?>/Manager/role_list.php" target="mainFrame">用户组列表</a>
                    <?php }?>
                    <?php if($_SESSION['role_id'] == 1){?>
                    <a href="<?php echo ADMIN;?>/Manager/node_list.php" target="mainFrame">权限列表</a>
                    <?php }?>
            </li>
            <?php if(manager(40) || manager(44)){ ?>
            <li class="list1">
                <h4>会员管理</h4>
            </li>
            <?php }?>
            <li class="list2">
                <?php if(manager(40)){ ?>
                <a href="<?php echo ADMIN;?>/Member/index.php" target="mainFrame">会员列表</a>
                <?php }?>
                <?php if(manager(44)){ ?>
                <a href="<?php echo ADMIN;?>/Member/groupList.php" target="mainFrame">会员组列表</a>
                <?php }?>
                <?php if($_SESSION['role_id'] == 1){?>
                <a href="<?php echo ADMIN;?>/Member/system.php" target="mainFrame">会员配置</a>
                <?php }?>
            </li>
            <li class="list1">
                <?php if(manager(26)){ ?>
                <h4>系统管理</h4>
                <?php }?>
            </li>
            <li class="list2">
                <?php if(manager(26)){ ?>
                <a href="<?php echo ADMIN;?>/BaseInfo/index.php" target="mainFrame">网站基本信息</a>
                <?php }?>
                <?php if(manager(32)){ ?>
                <a href="<?php echo ADMIN;?>/Db/index.php" target="mainFrame">数据库备份</a>
                <?php }?>
                <?php if($_SESSION['role_id'] == 1){?>
                <a href="<?php echo ADMIN;?>/Model/index.php" target="mainFrame">模型管理</a>
                <?php }?>
            </li>
        </ul>
    </div>
</div>
<!--/sidebar-->
<script type="text/javascript">
$(function(){
    var sidebarList = $(".sidebar-list").children('li.list1');
    sidebarList.click(function(){
        if ($(this).hasClass('y')) {
            $(this).next('li').slideUp();
            $(this).removeClass('y');
        }else{
            $(this).addClass('y');
            $(this).next('li').slideDown();
        }
    })
})
</script>