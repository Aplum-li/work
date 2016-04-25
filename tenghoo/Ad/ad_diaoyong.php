<?php 
  require('../checklogin.php');  
  //广告表
  $ad_table = 'ad';

  $ad_id = isset($_GET['ad_id']) ? intval($_GET['ad_id']) : '';
  $typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
  $adinfo = '';
  if ($ad_id) {
    $where['ad_id'] = $ad_id;
    $where['order by'] = 'ad_id asc';
    $adinfo = $db -> th_select($ad_table,$where,'*');
$code = <<< END
{th:ad id="{$adinfo['ad_id']}" field="ad_content"}
END;
    $adinfo['code'] = $code;
    //标题
    $pos = '广告位调用';  
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
                    <table width="100%" class="insert-tab">
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>名 称：</td>
                            <td style="width:280px;"><input type="text" value="<?php if(!empty($adinfo)){echo $adinfo['ad_name'];}?>" name="info[ad_name]" class="inputxt input400" /></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;"></td>
                            <td style="width:70px;" class='r'>调用代码：</td>
                            <td style="width:800px;" colspan='2'>
                              <textarea style="width: 400px;height: 50px;margin-left: 0px;"><?php if(!empty($adinfo)){echo $adinfo['code'];}?></textarea> <span>(默认调用广告位内容)</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <input type="button" style="padding: 5px 10px;margin-left: 18px;" value="返 回" onClick="window.history.go(-1)"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
<script type="text/javascript">
$(function(){
	$('input,textarea').attr('readonly','true');
  //$(".registerform").Validform();  //就这一行代码！;
  
  var getInfoObj=function(){
      return  $(this).parents("td").next().find(".info");
    }
  
  $("[datatype]").focusin(function(){
    if(this.timeout){clearTimeout(this.timeout);}
    var infoObj=getInfoObj.call(this);
    if(infoObj.siblings(".Validform_right").length!=0){
      return; 
    }
    infoObj.show().siblings().hide();
    
  }).focusout(function(){
    var infoObj=getInfoObj.call(this);
    this.timeout=setTimeout(function(){
      infoObj.hide().siblings(".Validform_wrong,.Validform_loading").show();
    },0);
    
  });
  
  $(".registerform").Validform({
    tiptype:2
  });
})
</script>
</html>
