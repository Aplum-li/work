<?php 
  require('../checklogin.php');
  if(manager(15) || manager(16)){
	  
	  //权限判断
	  $type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
	  if (!$type) {
	  	showmsg('参数错误');
	  	exit();
	  }
	  switch ($type){
	  	case 'add':
	  		if(!manager(15)){showmsg('没有权限访问');exit();}
	  		break;
	  	  
	  	case 'edit':
	  		if(!manager(16)){showmsg('没有权限访问');exit();}
	  		break;
	  	  
	  	default:
	  		break;
	  }
	  //文章表
	  $article_table = 'article';
	  //栏目表
	  $article_typetable = 'article_type';
	  $typewhere = array('order by'=>'id asc');
	  $typelist = $db -> th_selectall($article_typetable,$typewhere,'id,typename,pid',array(1000,''));
	  $category = new category();
	  $typelist = $category->toLevel($typelist,'┖ ');
	
	  $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	  $typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';

    //获取当前栏目的信息
    $typeInfo = $db -> th_select( $article_typetable, array( 'id' => $typeid ), '`model`' );
    $model = $db -> th_select('model',array('model_id'=>$typeInfo['model']));
      switch ($typeInfo['model']){
          case '1':
              $t = 'article';
              break;
          case '2':
              $t = 'product';
              break;
          default:
              $t = 'article';
              break;
      }
	  $arcinfo = '';
    $litArr = array();
	  if ($id) {
      $sql = 'SELECT arc.*,addtable.* FROM `'.DB_PRE.'article` as arc LEFT JOIN `'.DB_PRE.$model['model_addtable'].'` as addtable ON arc.id=addtable.article_id WHERE arc.id='.$id;
      $arcinfo = $db -> sql_select($sql);
      $litpics = !empty($arcinfo['litpics']) ? $arcinfo['litpics'] : '';
      if ($litpics) {
        $litArr = explode('+', $litpics);
        foreach ($litArr as $key => $value) {
          $arr = explode('---', $value);
          $arr2['litpic'] = $arr[0];
          $arr2['sort'] = $arr[1];
          $litArr[$key] = $arr2;
        }
       $litArr = array_sort($litArr,'sort');
      }
	    if (!$arcinfo) {
	      showmsg('获取文章信息出错');
	      exit();
	    }
	  }
	}else{
	  showmsg('没有权限访问');exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<?php include '../adminstatic.html';?>
<?php include '../editor.html';?>
    <script type="text/javascript">
        var type = "<?php echo $t;?>";
    </script>
    <link rel="stylesheet" type="text/css" href="/data/upload/uploadify.css">
<style type="text/css">
.albumslist li{
  width: 65px;
  height: 77px;
  float: left;
  margin-right: 10px;
}
#load{
    display: none;
}
#success{
    float: none;
    display: none;
}
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">栏目管理</a><span class="crumb-step">&gt;</span><span>添加栏目</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                 <form class="registerform" method="post" action="post.php">
                    <input type="hidden" name="model_addtable" value="<?php echo $model['model_addtable'];?>">
                    <ul class="catelist" id="catelist1">
                      <li>
                        <span class="span1 fl"><label>*</label>文章栏目：</span>
                        <span class="fl">
                          <select name="info[typeid]">
                            <option value="">==作为顶级栏目==</option>
                            <?php if($typelist){ foreach ($typelist as $key => $value) { ?>
                            <option value="<?php echo $value['id'];?>" <?php if($typeid == $value['id']){echo 'selected';}?>><?php echo $value['delimiter'];?> <?php echo getstr($value['typename'],29);?></option>
                            <?php }}?>
                          </select>
                        </span>
                      </li>
                      <li>
                        <span class="span1 fl"><label>*</label>文章标题：</span>
                        <span class="fl">
                          <input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['title'];}?>" name="info[title]" class="inputxt input400"/>
                        </span>
                      </li>
                      <li>
                        <span class="span1 fl">文章属性：</span>
                        <span class="fl">
                          <input type="checkbox" value="1" <?php if(!empty($arcinfo)){if($arcinfo['c']){echo 'checked';}}?> name="info[c]" /> 推荐
                              <input type="checkbox" value="1" <?php if(!empty($arcinfo)){if($arcinfo['h']){echo 'checked';}}?> name="info[h]" /> 头条
                        </span>
                      </li>
                      <li>
                        <span class="span1 fl">缩略图：</span>
                        <span class="fl">
                          <label class="input-large">
                              <input type="file" id="upload_picture" name="upload_picture">
                              <input type="hidden" name="info[litpic]" id="icon" value="<?php if(!empty($arcinfo)){echo $arcinfo['litpic'];}?>"/>
                          </label>
                        </span>
                        <span class="fl">
                            <div class="upload-img-box">
                                <div class="upload-pre-item"><?php if(!empty($arcinfo) && $arcinfo['litpic']){echo '<img src="'.$arcinfo['litpic'].'" class="litpic"><img src="/data/images/close.png" onClick="delimg(this)" class="close" title="删除图片">';}?></div>
                            </div>
                        </span>
                      </li>
                        <?php if(check_litpic($typeInfo['model']) ) {?>
                        <li>
                          <span class="span1 fl">更多图片：</span>
                          <span class="fl">
                            <input type='button' onClick="upImages();" value='上传更多图片' style="padding: 10px 13px;background:#dddddd;border: 1px solid #dddddd;cursor:pointer;"/> (提示：按住Ctrl键，然后再点击要上传的图片，可以批量上传)
                          </span>
                        </li>
                        <li id="albumslist" <?php if($litArr){?><?php }else{?>style="display:none;"<?php }?>>
                            <span class="fl">
                              <ul class='albumslist' id="J_imageView">
                                <?php if($litArr){?>
                                  <?php foreach ($litArr as $key => $value) {?>
                                   <li><input type="hidden" name="litpics[]" value="<?php echo $value['litpic'];?>"><div style="min-height:32px;"><img src="<?php echo $value['litpic'];?>" style="max-height:41px;max-width:65px;"></div><a href="javascript:;" onClick="dellitpic(this)"><i class="fa fa-times-circle"></i></a><br>排序:<input type="text" name="lsort[]" style="width:30%;" value="<?php echo $value['sort'];?>"></li>
                                <?php }}?>
                              </ul>
                            </span>
                        </li>
                        <?php }?>
                        <li>
                          <span class="span1 fl"><label></label>关键字：</span>
                          <span class="fl">
                            <input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['keywords'];}?>" name="info[keywords]" class="inputxt input400"/>
                          </span>
                        </li>
                        <li>
                            <span class="span1 fl">文章摘要：</span>
                            <span class="fl">
                              <textarea name='info[description]' style='width: 600px;height: 70px;'><?php if(!empty($arcinfo)){echo $arcinfo['description'];}?></textarea>
                            </span>
                        </li>
                        <!--模型附加字段-->
                        <?php
                          if( $model['model_addfile'] && 
                            file_exists($model['model_addfile']) ) {
                            include_once $model['model_addfile'];
                          }
                        ?>
                        <!--模型附加字段END-->
                        <li class="ch">
                            <span class="span1 fl">文章内容：</span>
                            <span class='c fl'>
                              <textarea name='info[content]' id='myEditor' style="width:100%;" ><?php if(!empty($arcinfo)){echo $arcinfo['content'];}?></textarea>
                            </span>
                        </li>
                        <li>
                            <span class="span1 fl">日期：</span>
                            <span class="fl"><input type="text" value="<?php if(!empty($arcinfo)){echo date("Y-m-d H:i:s",$arcinfo['creattime']);}else{echo date("Y-m-d H:i:s");}?>" name="info[creattime]" id="creattime" class="inputxt input400"/></span>
                        </li>
                        <li>
                            <span class="span1 fl">排序：</span>
                            <span class="fl"><input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['sort'];}else{echo 50;}?>" name="info[sort]" class="inputxt input400"/></span>
                        </li>
                        <li>
                          <span class="span1 fl">状态：</span>
                          <span class="fl">
                            <?php if(!empty($arcinfo)) {?>
                            <input type="radio" value="1" name="info[status]" class="pr1" <?php if($arcinfo['status']) { echo 'checked';}?>><label for="male">显示</label>
                            <input type="radio" value="0" name="info[status]" class="pr1"  <?php if(!$arcinfo['status']) { echo 'checked';}?>><label for="female">不显示</label>
                            <?php } else {?>
                            <input type="radio" value="1" name="info[status]" class="pr1" checked><label for="male">显示</label>
                            <input type="radio" value="0" name="info[status]" class="pr1"><label for="female">不显示</label>
                            <?php }?>
                          </span>
                      </li>
                        <li>
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
<script type="text/plain" id="upload_ue"></script>
<script type="text/plain" id="litpics"></script>
<script type="text/javascript">
$(function(){
<?php if ($arcinfo && $arcinfo['litpic']) { ?>
    $('#preview').show();
<?php }?>

laydate({
    elem: '#creattime',
    format: 'YYYY-MM-DD hh:mm:ss', // 分隔符可以任意定义，该例子表示只显示年月
    festival: true, //显示节日
    istime: true
});

})


UE.getEditor('myEditor',{
    initialFrameHeight:400,
    enableAutoSave: true,
    saveInterval: 500,
    //更多其他参数，请参考ueditor.config.js中的配置项
    serverUrl: '/data/ueditor136/php/controller.php'
});

//多图上传
  //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
var _editor2 = UE.getEditor('litpics');
_editor2.ready(function () {
   //设置编辑器不可用
   _editor2.setDisabled('insertimage');
   //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
   _editor2.hide();
   //侦听图片上传
   _editor2.addListener('beforeInsertImage', function (t, arg) {
    var lis_str = '';
       //将地址赋值给相应的input,只去第一张图片的路径
      for (var i = 1; i <= arg.length; i++) {
        lis_str += '<li><input type="hidden" name="litpics[]" value="'+arg[i-1].src+'"><div style="min-height:32px;"><img src="'+arg[i-1].src+'" style="max-height:41px;max-width:65px;"></div><a href="javascript:;" onClick="dellitpic(this)"><i class="fa fa-times-circle"></i></a><br>排序:<input type="text" name="lsort[]" style="width:30%;" value="'+i+'"></li>';

      };
      if ($('.albumslist').children('li').length > 0) {
        $('.albumslist').append(lis_str);
      }else{
        $('.albumslist').html(lis_str);
      }
      $('#albumslist').show();
   })
   //侦听文件上传，取上传文件列表中第一个上传的文件的路径
   // _editor.addListener('afterUpfile', function (t, arg) {
   //    $("#file").attr("value", _editor.options.filePath + arg[0].url);
   // })
});
//弹出图片上传的对话框
function upImages() {
  var myImage = _editor2.getDialog("insertimage");
   myImage.open();
}

$(function(){
  $('.ch').children('span.c').width($('.ch').width()-115);
})
</script>

<!-- 上传插件 -->
<script type="text/javascript" src="/data/upload/jquery.uploadify.min.js"></script>
<script type="text/javascript">
    //上传图片
    /* 初始化上传插件 */
    $("#upload_picture").uploadify({
        "height"          : 30,
        "swf"             : "/data/upload/uploadify.swf",
        "fileObjName"     : "litpic",
        "buttonText"      : "上传图片",
        "uploader"        : "<?php echo ADMIN.'/upload.php?type='.$t?>",
        "width"           : 120,
        'removeTimeout'   : 1,
        'fileTypeExts'    : '*.jpg; *.png; *.gif;',
        "onUploadSuccess" : uploadPicture,
        'onFallback' : function() {
            alert('未检测到兼容版本的Flash.');
        }
    });
    function uploadPicture(file, data){
        var data = $.parseJSON(data);
        var src = '';
        if(data.status){
            $("#icon").val(data.path);
            src = data.url || '' + data.path;
            $("#icon").val(src);
            $('.upload-img-box').html(
                '<div class="upload-pre-item"><img src="' + src + '" class="litpic"/><img src="/data/images/close.png" onClick="delimg(this)" class="close" title="删除图片"></div>'
            );
        } else {
            updateAlert(data.info);
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        }
    }
    
    function delimg (obj) {
        $(obj).parent('.upload-pre-item').hide();
        $("#icon").val('');
    }

    function dellitpic(obj){
      $(obj).parent('li').remove();
      if ($('.albumslist').children('li').length <= 0) {
        $('#albumslist').hide();
      }
    }
</script>
<!-- 上传插件 -->
</html>
