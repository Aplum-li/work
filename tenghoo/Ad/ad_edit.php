<?php 
  require('../checklogin.php');
  if ($_SESSION['role_id'] !=1) {
  	if(!manager(29)){showmsg('没有权限访问');exit();};
  } 
  //标题
  $pos = '添加广告位';  
  //广告表
  $ad_table = 'ad';

  $ad_id = isset($_GET['ad_id']) ? intval($_GET['ad_id']) : '';
  $typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
  $adinfo = '';
  if ($ad_id) {
    $where['ad_id'] = $ad_id;
    $where['order by'] = 'ad_id asc';
    $adinfo = $db -> th_select($ad_table,$where,'*');
    //标题
    $pos = '编辑广告位';  
    if (!$adinfo) {
      showmsg('获取广告信息出错');
      exit();
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告位编辑</title>
<?php include '../adminstatic.html';?>
<?php include '../editor.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="fa fa-home fa-fw"></i><a href="../main.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">广告管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                  <ul class="catelist">
                    <li>
                      <span class="span1 fl"><label>*</label>名 称：</span>
                      <input type="text" value="<?php if(!empty($adinfo)){echo $adinfo['ad_name'];}?>" name="info[ad_name]" class="inputxt input400"/>
                    </li>
                    <li id="ch">
                      <span class="span1 fl"><label>*</label>内 容：</span>
                      <span class='c fl'><textarea name='info[ad_content]' id='myEditor' style="width:100%;"><?php if(!empty($adinfo)){echo $adinfo['ad_content'];}?></textarea></span>
                    </li>
                    <li>
                      <span class="span1 fl">状态：</span>
                      <span class="fl">
                        <?php if(!empty($adinfo)) {?>
                        <input type="radio" value="1" name="info[status]" class="pr1" <?php if($adinfo['status']) { echo 'checked';}?>><label for="male">显示</label>
                        <input type="radio" value="0" name="info[status]" class="pr1"  <?php if(!$adinfo['status']) { echo 'checked';}?>><label for="female">不显示</label>
                        <?php } else {?>
                        <input type="radio" value="1" name="info[status]" class="pr1" checked><label for="male">显示</label>
                        <input type="radio" value="0" name="info[status]" class="pr1"><label for="female">不显示</label>
                        <?php }?>
                      </span>
                    </li>
                    <li style="padding-left:33px;">
                      <span class="fl">
                          <?php if(!empty($adinfo)) {?>
                          <input type="hidden" name='ad_id' value="<?php echo $ad_id;?>" />
                          <input type="hidden" name='type' value="ad_edit" />
                          <?php } else {?>
                          <input type="hidden" name='type' value="ad_add" />
                          <?php }?>
                          <input type="submit" value="提 交" /><input type="reset" value="重 置" />
                      </span>
                    </li>
                  </ul>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
<script>
  var type = "ad";
 UE.getEditor('myEditor',{
    initialFrameHeight:400,
    enableAutoSave: true,
    saveInterval: 500,
    //更多其他参数，请参考ueditor.config.js中的配置项
    serverUrl: '<?php echo WEBPATH?>/data/ueditor136/php/controller.php'
  });
 $(function(){
  $('#ch').children('span.c').width($('#ch').width()-110);
})
</script>
</body>
</html>
