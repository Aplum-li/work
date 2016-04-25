<?php
  require('../checklogin.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站信息配置</title>
<?php include '../adminstatic.html';?>
<?php include '../editor.html';?>
<script type="text/javascript">
    var type = "ohter";
</script>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">用户反馈</a></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form class="registerform" method="post" action="post.php">
                    <ul class="catelist" id="catelist1">
                        <li>
                            <span class="span1 fl">&nbsp;</span>
                            <span class='fl' style="overflow: hidden;">
                                <img src="../adminstatic/images/xiao.jpg" style="float: left;">
                                <span style="margin: 10px 0 0 10px;float: left;">在使用过程中有什么意见或建议，可以向我们提出来，我们会用心的去改进，打造一个更好用、更人性化的后台。</span>
                            </span>
                        </li>
                        <li class="ch">
                            <span class="span1 fl">反馈意见：</span>
                            <span class='c fl'>
                              <textarea name='info[content]' id='myEditor' style="width:100%;" ><?php if(!empty($arcinfo)){echo $arcinfo['content'];}?></textarea>
                            </span>
                        </li>
                        <li style="padding-left: 40px;">
                            <span colspan="2" style="padding:10px 0 18px 35px;">
                                <?php if(!empty($arcinfo)) {?>
                                    <input type="hidden" name='id' value="<?php echo $id;?>" />
                                    <input type="hidden" name='type' value="article_edit" />
                                <?php } else {?>
                                    <input type="hidden" name='type' value="article_add" />
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
</body>
<script type="text/javascript">
UE.getEditor('myEditor',{
    initialFrameHeight:400,
    enableAutoSave: true,
    saveInterval: 500,
    //更多其他参数，请参考ueditor.config.js中的配置项
    serverUrl: '/data/ueditor136/php/controller.php'
});
$(function(){
    $('.ch').children('span.c').width($('.ch').width()-110);
})
</script>
</html>
