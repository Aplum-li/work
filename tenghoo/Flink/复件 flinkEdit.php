<?php 
  require('../checklogin.php');
  if(manager(37) || manager(38)){
    //友情链接表
    $flinkTable = 'flink';
    //标题
    $pos = '添加友情链接';  
    $flink_id = isset($_GET['flink_id']) ? intval($_GET['flink_id']) : '';
    $typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
    $flinkInfo = '';
	$flink_type_table = 'flink_type';
	$typewhere = array('order by'=>'id asc');
	$typelist = $db -> th_selectall($flink_type_table,$typewhere,'id,flink_type_name',array(1000,''));
	//p($typelist);die;
    if ($flink_id) {
      $where['flink_id'] = $flink_id;
      $where['order by'] = 'flink_id asc';
      $flinkInfo = $db -> th_select($flinkTable,$where,'*');
      @$db -> th_update($flinkTable,$where,array('status'=>1));
      //标题
      $pos = '编辑友情链接';  
      if (!$flinkInfo) {
        showmsg('获取友情链接信息出错');
        exit();
      }
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看留言</title>
<?php include '../adminstatic.html';?>
<?php include '../editor.html';?>

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
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>选择分类：</td>
                            <td style="width:292px;">
                              <select name="info[typeid]" datatype="*" nullmsg="请选择分类！" errormsg="请选择文章栏目！" >
                                <option value="">==选择分类==</option>
                                <?php foreach ($typelist as $key => $value) { ?>
                                <option value="<?php echo $value['id'];?>" <?php if($typeid == $value['id']){echo 'selected';}?>><?php echo $value['flink_type_name'];?></option>
                                <?php }?>
                              </select>
                            </td>
                            <td><div class="Validform_checktip"></div>
                                <div class="info">请选择分类！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div></td>
                        </tr>
                        <tr>
                            <td class="need" style="width:10px;">*</td>
                            <td style="width:70px;" class='r'>名 称：</td>
                            <td style="width:420px;"><input type="text" value="<?php if(!empty($flinkInfo)){echo $flinkInfo['flink_name'];}?>" name="info[flink_name]" class="inputxt input400" datatype="*" nullmsg="请输入友情链接名称！" errormsg="请输入友情链接名称！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入友情链接名称！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need">*</td>
                            <td class='r'>链 接：</td>
                            <td ><input type="text" value="<?php if(!empty($flinkInfo)){echo $flinkInfo['flink_link'];}?>" name="info[flink_link]" class="inputxt input400" datatype="*" nullmsg="请输入友情链接路径！" errormsg="请输入友情链接路径！" /></td>
                            <td>
                              <div class="Validform_checktip"></div>
                                <div class="info">请输入友情链接路径！<span class="dec"><s class="dec1">&#9670;</s><s class="dec2">&#9670;</s></span></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td class='r'>logo：</td>
                            <td >
                              <input type="text"  class="inputxt input400" value="<?php if(!empty($flinkInfo)){echo $flinkInfo['flink_logo'];}?>" name="info[flink_logo]" id="litpic"/>
                              <input type='button' id="uploadButton" value='上传图片' style="padding: 10px 13px;background:#dddddd;border: 1px solid #dddddd;cursor:pointer;"/>
                              </td>
                            <td><img src="<?php if(!empty($flinkInfo)){echo $flinkInfo['flink_logo'];}?>" id="preview" style="max-height:37px;display:none;"></td>
                        </tr>
                        <tr>
                          <td class="need"></td>
                          <td class='r'>状态：</td>
                          <td style="padding-left:18px;">
                            <?php if(!empty($flinkInfo)) {?>
                            <input type="radio" value="1" name="info[status]" class="pr1" <?php if($flinkInfo['status']) { echo 'checked';}?>><label for="male">显示</label>
                            <input type="radio" value="0" name="info[status]" class="pr1"  <?php if(!$flinkInfo['status']) { echo 'checked';}?>><label for="female">不显示</label>
                            <?php } else {?>
                            <input type="radio" value="1" name="info[status]" class="pr1" checked><label for="male">显示</label>
                            <input type="radio" value="0" name="info[status]" class="pr1"><label for="female">不显示</label>
                            <?php }?>
                          </td>
                          <td></td>
                      </tr>
                        <tr>
                            <td class="need"></td>
                            <td class='r'>排 序：</td>
                            <td><input type="text" value="<?php if(!empty($flinkInfo)){echo $flinkInfo['sort'];}else{echo '50';}?>" name="info[sort]" class="inputxt input400"/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="need"></td>
                            <td></td>
                            <td colspan="2" style="padding:10px 0 18px 0;">
                                <?php if(!empty($flinkInfo)) {?>
                                <input type="hidden" name='flink_id' value="<?php echo $flink_id;?>" />
                                <input type="hidden" name='type' value="flinkEdit" />
                                <?php } else {?>
                                <input type="hidden" name='type' value="flinkAdd" />
                                <?php }?>
                                <input type="submit" value="提 交" /><input type="reset" value="重 置" />
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
    //上传图片
    /* 初始化上传插件 */
	
    $("#upload_picture2").uploadify({
        "height"          : 30,
        "swf"             : "/data/upload/uploadify.swf",
        "fileObjName"     : "litpic",
        "buttonText"      : "上传文件",
        "uploader"        : "<?php echo ADMIN.'/upload.php?type='.$t?>",
        "width"           : 120,
        'removeTimeout'   : 1,
        'fileTypeExts'    : '*.txt; *.rar; *.doc; *.docx; *.xls; *.xlsx; *.ppt; *.pdf; *.zip;',
        "onUploadSuccess" : uploadPicture2,
        'onFallback' : function() {
            alert('未检测到兼容版本的Flash.');
        }
    });
    function uploadPicture2(file, data){
        var data = $.parseJSON(data);
        var src = '';
        if(data.status){
            $("#icon2").val(data.path);
            src = data.url || '' + data.path;
            $("#icon2").val(src);
            $('.upload-img-box2').html(
                '<div class="upload-pre-item2"><img src="' + src + '" class="litpic"/><img src="/data/images/close.png" onClick="delimg2(this)" class="close" title="删除文件"></div>'
            );
        } else {
            updateAlert(data.info);
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        }
    }
    function delimg2 (obj) {
        $(obj).parent('.upload-pre-item2').hide();
        $("#icon2").val('');
    }
	
	
	$("#upload_picture2_en").uploadify({
        "height"          : 30,
        "swf"             : "/data/upload/uploadify.swf",
        "fileObjName"     : "litpic",
        "buttonText"      : "上传文件",
        "uploader"        : "<?php echo ADMIN.'/upload.php?type='.$t?>",
        "width"           : 120,
        'removeTimeout'   : 1,
        'fileTypeExts'    : '*.txt; *.rar; *.doc; *.docx; *.xls; *.xlsx; *.ppt; *.pdf; *.zip;',
        "onUploadSuccess" : uploadPicture2_en,
        'onFallback' : function() {
            alert('未检测到兼容版本的Flash.');
        }
    });
    function uploadPicture2_en(file, data){
        var data = $.parseJSON(data);
        var src = '';
        if(data.status){
            $("#icon2_en").val(data.path);
            src = data.url || '' + data.path;
            $("#icon2_en").val(src);
            $('.upload-img-box2_en').html(
                '<div class="upload-pre-item2_en"><img src="' + src + '" class="litpic"/><img src="/data/images/close.png" onClick="delimg2_en(this)" class="close" title="删除文件"></div>'
            );
        } else {
            updateAlert_en(data.info);
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        }
    }
    function delimg2_en (obj) {
        $(obj).parent('.upload-pre-item2_en').hide();
        $("#icon2_en").val('');
    }
</script>
</html>
