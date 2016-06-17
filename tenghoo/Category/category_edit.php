<?php 
  require('../checklogin.php');
  if(manager(11) || manager(12)){
    $type = isset($_GET['type']) ? Html2Text($_GET['type']) : '';
    if (!$type) {
      showmsg('参数错误');
      exit();
    }
    switch ($type){
      case 'add':
        if(!manager(11)){showmsg('没有权限访问');exit();}
        break;
        
      case 'edit':
        if(!manager(12)){showmsg('没有权限访问');exit();}
        break;
        
      default:
        break;
    }
    
    //栏目表
    $article_typetable = 'article_type';
    $typewhere = array('order by'=>'id asc');
    $typelist = $db -> th_selectall($article_typetable,$typewhere,'id,typename,pid');
    $category = new category();
    $typelist = $category->toLevel($typelist,'┖ ');
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
    $where['id'] = $id;
    $info = array();
    $info = $db -> th_select($article_typetable,$where,'*');
    
    $model = $db -> th_selectall('model',array('order by'=>'model_id','model_status'=>1),'*');
    //修改栏目
    $typeinfo = '';
    if ($type != 'add') {
      if ($id) {
        $where['order by'] = 'id asc';
        $typeinfo = $db -> th_select($article_typetable,$where,'*');
        if (!$typeinfo) {
          showmsg('获取栏目信息出错');
          exit();
        }
      }
    }
  }else{
    showmsg('没有权限访问');exit();
  }
  //标题
$pos = '编辑栏目';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<?php include '../adminstatic.html';?>
<?php include '../editor.html';?>
  <link rel="stylesheet" type="text/css" href="/data/upload/uploadify.css">
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">栏目管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
          <div class="result-content">
            <form class="registerform" method="post" action="post.php">
              <div class="base">
                <a javascript:; class="on" onClick="sh('catelist1','catelist2',this)">基本设置</a>
                <a javascript:; onClick="sh('catelist2','catelist1',this)">高级设置</a>
              </div>
              <ul class="catelist" id="catelist1">
                <li>
                  <span class="span1 fl"><label>*</label>内容模型：</span>
                  <span class="fl">
                    <select name="info[model]" id="model" onchange="GetTpl()">
                    <?php foreach($model as $v){?>
                      <option value="<?php echo $v['model_id'];?>" <?php if($type=='add' && $info['model'] == $v['model_id']){echo 'selected';}?> <?php if($typeinfo && $typeinfo['model'] == $v['model_id']){echo 'selected';}?>>==<?php echo $v['model_name'];?>==</option>
                      <?php }?>
                    </select>
                  </span>
                </li>
                <li>
                  <span class="span1 fl"><label>*</label>上级栏目：</span>
                  <span>
                    <select name="info[pid]">
                      <option value="0">==作为顶级栏目==</option>
                      <?php foreach ($typelist as $key => $value) { ?>
                      <option value="<?php echo $value['id'];?>" <?php if(isset($type) && $type =='add' && $id == $value['id']){echo 'selected';}?> <?php if(isset($typeinfo['pid']) && $typeinfo['pid'] == $value['id']){echo 'selected';}?>><?php echo $value['delimiter'];?> <?php echo getstr($value['typename'],29);?></option>
                      <?php }?>
                    </select>
                  </span>
                </li>
                <li>
                  <span class="span1 fl"><label>*</label>栏目名称：</span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['typename'];}?>" name="info[typename]" class="inputxt input400" datatype="*" nullmsg="请输入栏目名称！" errormsg="请输入栏目名称！" />
                  </span>
                </li>
	              <li>
		              <span class="span1 fl"><label></label>文件保存目录：</span>
                  <span class="fl">
                    <input type="hidden" name="pname" value="<?php echo $info['name'];?>" />
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['name'];}else{if($info && $info['name']) echo $info['name'];}?>" name="info[name]" class="inputxt input400" />
                  </span>
	              </li>
                <li>
                  <span class="span1 fl">栏目属性：</span>
                  <span class="fl">
                    <?php if(!empty($typeinfo)){?>
                      <input name="info[type]" type="radio" id="radio" onClick="islist()" value="list" <?php if($typeinfo['type'] == 'list'){?>checked="1"<?php }?>>
                      最终列表栏目（允许在本栏目发布文档）<br>
                      <input name="info[type]" type="radio" id="radio2" onClick="islist()" value="page" <?php if($typeinfo['type'] == 'page'){?>checked="1"<?php }?>>
                      单页（栏目本身不允许发布文档）
                      <?php }else{ ?>
                      <input name="info[type]" type="radio" id="radio" onClick="islist()" value="list" checked="1">
                      最终列表栏目（允许在本栏目发布文档）<br>
                      <input name="info[type]" type="radio" id="radio2" onClick="islist()" value="page">
                      单页（栏目本身不允许发布文档）
                      <br>
                      <?php }?></span>
                      <span id="page" class="fl">每页显示条数： <input type="text" name="info[page]" value="<?php if($info && $info['page']){ echo $info['page'];}else{echo 10;}?>" style="width: 30px;"/></span>
                </li>
                <li>
                  <span class="span1 fl">栏目链接：</span>
                  <span class="fl"><input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['typelink'];}?>" name="info[typelink]" class="inputxt input400" /></span>
                </li>
                <li>
                  <span class="span1 fl">缩略图：</span>
                  <span class="fl">
                    <label class="input-large">
                      <input type="file" id="upload_picture" name="upload_picture">
                      <input type="hidden" name="info[litpic]" id="icon" value="<?php if(!empty($typeinfo['litpic'])){echo $typeinfo['litpic'];}?>"/>
                    </label>
                  </span>
                  <span class="fl">
                    <div class="upload-img-box">
                      <div class="upload-pre-item"><?php if(!empty($typeinfo) && $typeinfo['litpic']){echo '<img src="'.$typeinfo['litpic'].'" class="litpic"><img src="/data/images/close.png" onClick="delimg(this)" class="close" title="删除图片">';}?></div>
                    </div>
                  </span>
                </li>
                <li id="ch">
                  <span class="span1 fl">栏目内容：</span>
                  <span class="c fl">
                    <textarea name='info[typecontent]' id='myEditor' style="width:100%;"><?php if(!empty($typeinfo)){echo $typeinfo['typecontent'];}?></textarea>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">排序：</span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['sort'];}else{echo 50;}?>" name="info[sort]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">状态：</span>
                  <span class="fl">
                    <?php if(!empty($typeinfo)) {?>
                    <input type="radio" value="1" name="info[status]" class="pr1" <?php if($typeinfo['status']) { echo 'checked';}?>><label for="male">显示在导航</label>
                    <input type="radio" value="0" name="info[status]" class="pr1"  <?php if(!$typeinfo['status']) { echo 'checked';}?>><label for="female">不显示在导航</label>
                    <?php } else {?>
                    <input type="radio" value="1" name="info[status]" class="pr1" checked><label for="male">显示在导航</label>
                    <input type="radio" value="0" name="info[status]" class="pr1"><label for="female">不显示在导航</label>
                    <?php }?>
                  </span>
                </li>
              </ul>
              <ul class="catelist" id="catelist2" style="display:none;">
                <li>
                  <span class="span1 fl">副标题：</span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['subtitle'];}?>" name="info[subtitle]" class="inputxt input400"/>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">关键字：</span>
                  <span class="fl"><input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['keyword'];}?>" name="info[keyword]" class="inputxt input400"/></span>
                </li>
                <li>
                  <span class="span1 fl">栏目描述：</span>
                  <span class="fl">
                    <textarea name='info[typedesc]' style='width: 400px;height: 70px;margin-left:0;'><?php if(!empty($typeinfo)){echo $typeinfo['typedesc'];}?></textarea>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">
                    列表模板：
                  </span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['typetpl'];}?>" name="info[typetpl]" id="typetpl" class="inputxt input400" datatype="*" nullmsg="请输入栏目模板！" errormsg="请输入栏目模板！" <?php if($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2){echo 'readonly';}?>/>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">
                    内容模板：
                  </span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['viewtpl'];}?>" name="info[viewtpl]" class="inputxt input400" id="viewtpl" datatype="*" nullmsg="请输入内容模板！" errormsg="请输入内容模板！" <?php if($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2){echo 'readonly';}?>/>
                  </span>
                </li>
                <li>
                  <span class="span1 fl">
                    单页模板：
                  </span>
                  <span class="fl">
                    <input type="text" value="<?php if(!empty($typeinfo)){echo $typeinfo['pagetpl'];}?>" name="info[pagetpl]" class="inputxt input400" id="pagetpl" datatype="*" nullmsg="请输入单页模板！" errormsg="请输入单页模板！" <?php if($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2){echo 'readonly';}?>/>
                  </span>
                </li>
              </ul>
              <ul style="padding-left:30px;">
                <li>
                  <?php if(!empty($typeinfo)) {?>
                  <input type="hidden" name='id' value="<?php echo $id;?>" />
                  <input type="hidden" name='type' value="type_edit" />
                  <?php } else {?>
                  <input type="hidden" name='type' value="type_add" />
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
<script type="text/javascript">
$(function(){
islist();
// js根据所选内容模型改变模板
<?php if(empty($typeinfo)){?>
  GetTpl();
<?php }?>
<?php if ($typeinfo && $typeinfo['litpic']) { ?>
    $('#preview').show();
<?php }?>
})

//判断是否是列表页，如果是列表页，则显示每页输出的条数
function islist(){
  if($('#radio').attr('checked')){
    $('#page').show();
  }else{
    $('#page').hide();
  }
}
//获取内容模型模板
function GetTpl(){
  var model = $('#model').val();
  if (model) {
    $.post("post.php", { "type":'gettpl',"model_id": model },
      function(data){
        if (data.status) {
          $('#typetpl').val(data.model_list_tpl);
          $('#viewtpl').val(data.model_view_tpl);
          $('#pagetpl').val(data.model_page_tpl);
        }else{
          showmsg(data.msg);
        }
      }, "json");
  };
}
</script>
<script type="text/plain" id="upload_ue"></script>
<script type="text/javascript">
function sh(s1,s2,obj){
  $("#"+s1).show();
  $("#"+s2).hide();
  $(obj).addClass('on');
  $(obj).siblings('a').removeClass('on');
}
var type = "category";

UE.getEditor('myEditor',{
    initialFrameHeight:400,
    enableAutoSave: true,
    saveInterval: 500,
    //更多其他参数，请参考ueditor.config.js中的配置项
    serverUrl: '/data/ueditor136/php/controller.php'
});


$(function(){
  $('#ch').children('span.c').width($('#ch').width()-118);
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
    "uploader"        : "<?php echo ADMIN.'/upload.php?type=category'?>",
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
</script>
<!-- 上传插件 -->
</html>
