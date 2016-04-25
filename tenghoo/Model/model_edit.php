<?php 
  require('../checklogin.php');
  //权限判断
  if($_SESSION['role_id'] != 1){showmsg('没有权限访问');exit();}

  //模型表
  $model_table = 'model';

  $model_id = isset($_GET['model_id']) ? intval($_GET['model_id']) : '';
  
  if ($model_id) {
    $where['model_id'] = $model_id;
    $info = array();
    $info = $db -> th_select($model_table,$where,'*');
    if (!$info) {
      showmsg('获取模型信息出错');
      exit();
    }
  }
    
  //标题
$pos = '编辑模型';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pos;?><</title>
<?php include '../adminstatic.html';?>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">模型管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
          <div class="result-content">
            <form class="registerform" method="post" action="post.php">
              <ul class="catelist">
                <li>
                  <span class="span1">名称：</span>
                  <span><input type="text" value="<?php if(!empty($model_id) && $info){echo $info['model_name'];}?>" name="info[model_name]" class="inputxt input400" /></span>
                </li>
                <li>
                  <span class="span1">列表模板：</span>
                  <span>
                    <input type="text" class="inputxt input400" value="<?php if(!empty($model_id) && $info){echo $info['model_list_tpl'];}?>" name="info[model_list_tpl]"/>
                  </span>
                </li>
                <li>
                  <span class="span1">内容模板：</span>
                  <span>
                    <input type="text" value="<?php if(!empty($model_id) && $info){echo $info['model_view_tpl'];}?>" name="info[model_view_tpl]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1">单页模板：</span>
                  <span>
                    <input type="text" value="<?php if(!empty($model_id) && $info){echo $info['model_page_tpl'];}?>" name="info[model_page_tpl]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1">附加php文件：</span>
                  <span>
                    <input type="text" value="<?php if(!empty($model_id) && $info){echo $info['model_addfile'];}?>" name="info[model_addfile]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1">附加表：</span>
                  <span>
                    <input type="text" value="<?php if(!empty($model_id) && $info){echo $info['model_addtable'];}?>" name="info[model_addtable]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1">状态：</span>
                  <span>
                    <?php if(!empty($model_id) && $info) {?>
                    <input type="radio" value="1" name="info[model_status]" class="pr1" <?php if($info['model_status']) { echo 'checked';}?>><label for="male" style="color:#333;">启用</label>
                    <input type="radio" value="0" name="info[model_status]" class="pr1"  <?php if(!$info['model_status']) { echo 'checked';}?>><label for="female" style="color:#333;">禁用</label>
                    <?php } else {?>
                    <input type="radio" value="1" name="info[model_status]" class="pr1" checked><label for="male" style="color:#333;">启用</label>
                    <input type="radio" value="0" name="info[model_status]" class="pr1"><label for="female" style="color:#333;">禁用</label>
                    <?php }?>
                  </span>
                </li>
              </ul>
              <ul style="padding-left:30px;">
                <li>
                  <?php if(!empty($model_id)) {?>
                  <input type="hidden" name='model_id' value="<?php echo $model_id;?>" />
                  <input type="hidden" name='type' value="model_edit" />
                  <?php } else {?>
                  <input type="hidden" name='type' value="model_add" />
                  <?php }?>
                  <input type="submit" value="提 交" /><input type="reset" value="重 置" />
                </li>
              </ul>
            </form>
          </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
