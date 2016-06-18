<?php 
  require('../checklogin.php');
  if(!manager(34)){showmsg('没有权限访问');exit();};
  //留言表
  $messageTable = 'message';

  $message_id = isset($_GET['message_id']) ? intval($_GET['message_id']) : '';
  $typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
  $messageInfo = '';
  if ($message_id) {
    $where['message_id'] = $message_id;
    $where['order by'] = 'message_id asc';
    $messageInfo = $db -> th_select($messageTable,$where,'*');
    @$db -> th_update($messageTable,$where,array('status'=>1));
    //标题
    $pos = '查看留言';  
    if (!$messageInfo) {
      showmsg('获取留言信息出错');
      exit();
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看留言</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i>首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">留言列表</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td style="width:70px;" class='r'>名 称：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['username'];}?></td>
                        </tr>
                        <tr>
                            <td style="width:70px;" class='r'>公 司：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['company'];}?></td>
                        </tr>
                        <tr>
                            <td style="width:70px;" class='r'>电 话：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['phone'];}?></td>
                        </tr>
	                    <tr>
		                    <td style="width:70px;" class='r'>手 机：</td>
		                    <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['mobile'];}?></td>
	                    </tr>
                        <tr>
                            <td style="width:70px;" class='r'>邮 箱：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['email'];}?></td>
                        </tr>
                        <tr>
                            <td style="width:70px;" class='r'>Q Q：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['qq'];}?></td>
                        </tr>
                        <tr>
                            <td style="width:70px;" class='r'>留言内容：</td>
                            <td style="width:280px;" colspan='2'><?php if(!empty($messageInfo)){echo $messageInfo['content'];}?></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
