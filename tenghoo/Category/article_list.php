<?php
/**
 * 文章列表
 */
require('../checklogin.php');

if(!manager(14)){showmsg('没有权限访问');exit();}
//文章表
$article_table = 'article';
//栏目表
$article_type_table = 'article_type';
//管理员表
$admin_table = 'admin';

//如果是导入文件
if ($_POST) {
    require THINC . '/class/phpexcel.class.php';
    $phpexcel = new myphpexcel();
    $file = $_FILES['file'];
    $typeid = isset($_POST['typeid']) ? intval($_POST['typeid']) : '';
    if (!$typeid || empty($file)) {
        showmsg('请选择文件');
        exit();
    }
    if($phpexcel -> importExcel($file,$typeid)){
        showmsg('导入成功',ADMIN.'Category/article_list.php?typeid='.$typeid);
        exit();
    } else {
        showmsg('导入失败');
        exit();
    }
}
$where = array('order by'=>'id asc');
$article_type_list = $db -> th_selectall($article_type_table,$where,'id,pid,typename,type');
$category = new category();
$article_type_list = $category->toLevel($article_type_list,' ┖ ');
$str = '&nbsp;&nbsp;&nbsp;';
foreach ($article_type_list  as $key => $value) {
    //str_repeat(string,repeat),重复 repeat 次 string 
    $pre = str_repeat($str, $value['level']);
    $article_type_list[$key]['str'] = $pre;
}



$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
if (!$typeid) {
    showmsg('参数错误');
    exit();
}
$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '0';
$map = ' a.isrecover=0';

$article_list = $db -> th_selectallarticle($typeid,$map,'*',array(15,$_g_page));

foreach ($article_list as $key => $value) {
    $where = array('id'=>$value['m_id']);
    $minfo = $db -> th_select($admin_table,$where,'name');
    $article_list[$key]['name'] = $minfo['name'];
}
$page = $db->page->html;

if (isset($_GET['type']) && $_GET['type'] == 'excelall') {
    require THINC . '/class/phpexcel.class.php';
    $phpexcel = new myphpexcel();
    $articleList = $db -> th_selectallarticle($typeid,'','*','');
    $phpexcel -> excelOut($articleList);
}

//标题
$typeinfo = $db -> th_select($article_type_table,array('id'=>$typeid));
$pos = $typeinfo['typename'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员密码修改</title>
<?php include '../adminstatic.html';?>
<style type="text/css">
#imgBox{
    display: none;
    background: #ffffff;
    padding: 10px;
}
#imgBox table tr{
    height: 40px;
}
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php">栏目管理</a><span class="crumb-step">&gt;</span><span><?php echo $pos;?></span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post" action="post.php">
                <input type="hidden" name="recover" value="1"/>
                <div class="result-title">
                    <div class="result-list">
                    		<?php if(manager(15)){ ?>
                        <a href="article_edit.php?typeid=<?php echo $typeid;?>&type=add"><i class="fa fa-plus-square"></i> 添加文章</a>
                        <?php }?>
                        
                        <a id="batchSort" href="javascript:void(0)"><i class="fa fa-refresh"></i> 更新排序</a>
                        <?php if(manager(17)){ ?>
                        <a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>批量删除</a>
                        <?php }?>
<!--                        <a href="article_list.php?typeid=--><?php //echo $typeid;?><!--&type=excelall"><i class="fa fa-cloud-download"></i> 批量导出</a>-->
<!--                        <a href="javascript:inputIn();"><i class="fa fa-cloud-download"></i> 批量导入</a>-->
                        <select name="search-sort" onchange="select_jump(this)">
                            <?php if($article_type_list) { foreach ($article_type_list as $key => $value) { ?>
                                <option value="<?php echo ADMIN;?>/Category/article_list.php?typeid=<?php echo $value['id'];?>" <?php if($typeid == $value['id']){echo 'selected';}?>  <?php if($value['type'] == 'page'){?> disabled<?php }?>><?php echo $value['delimiter'];?> <?php echo getstr($value['typename'],20);?></option>
                            <?php }}?>
                        </select>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="4%" style="min-width: 35px;"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
                            <th class="tc" width="4%" style="min-width: 35px;">排序</th>
                            <th width="3%" style="min-width: 35px;">ID</th>
                            <th width="40%" style='text-align:left;text-indent:10px;min-width: 470px;'>名称</th>
                            <th width="11%" style="min-width: 120px;">添加时间</th>
                            <th width="7%" style="min-width: 60px;">管理员</th>
                            <th width="5%" style="min-width: 80px;">点击数</th>
                            <th width="10%" style="min-width: 120px;">状态</th>
                            <th width="10%" style="min-width: 120px;">操作</th>
                        </tr>
                        <?php foreach($article_list as $v){ ?>
                        <tr class="del_<?php echo $v['id']?>">
                            <td class="tc"><input name="id[]" value="<?php echo $v['id']?>" type="checkbox" class='ids'></td>
                            <td>
                                <input name="ids[]" value="<?php echo $v['id']?>" type="hidden" >
                                <input name="sort[]" value="<?php echo $v['sort']?>" type="text" class='input30'>
                            </td>
                            <td><?php echo $v['id']?></td>
                            <td style='text-align:left;text-indent:10px;'>
                                <span style="float:left;">[<?php echo $v['t_typename'];?>]<a href="article_edit.php?id=<?php echo $v['id'];?>&typeid=<?php echo $v['typeid'];?>&type=edit" class="edit"><?php echo getstr($v['title'],50);?></a><?php if($v['litpic']){?>&nbsp;&nbsp;<img src="<?php echo $v['litpic'];?>" height="15px" onclick="showimg(this)"><?php }?>
                                </span> 
                            </td>
                            <td><?php echo date('Y-m-d H:i',$v['creattime']);?></td>
                            <td><?php echo $v['name'];?></td>
                            <td><?php echo $v['click'];?></td>
                            <td>
                            <?php if($v['h']){?> 
                            <i class="fa fa-star fa-fw fa_h" style="color:#428bca;cursor:pointer;" title="头条" onclick="changestatus(<?php echo $v["id"];?>,0,this,'h')"></i>
                            <i class="fa fa-star-o fa-fw fa_h" style="color:#ddd;cursor:pointer;display:none;" title="取消头条" onclick="changestatus(<?php echo $v["id"];?>,1,this,'h')"></i>
                            <?php }else{?>
                            <i class="fa fa-star fa-fw fa_h" style="color:#428bca;cursor:pointer;display:none;" title="头条" onclick="changestatus(<?php echo $v["id"];?>,0,this,'h')"></i>
                            	<i class="fa fa-star-o fa-fw fa_h" style="color:#ddd;cursor:pointer;" title="取消头条" onclick="changestatus(<?php echo $v["id"];?>,1,this,'h')"></i>
                            <?php }?>
                            
                            <?php if($v['c']){?> 
                            <i class="fa fa-thumbs-up fa-fw fa_c" style="color:#428bca;cursor:pointer;" title="推荐" onclick="changestatus(<?php echo $v["id"];?>,0,this,'c')"></i>
                            <i class="fa fa-thumbs-o-up fa-fw fa_c" style="color:#ddd;cursor:pointer;display:none;" title="取消推荐" onclick="changestatus(<?php echo $v["id"];?>,1,this,'c')"></i>
                            <?php }else{?>
                            <i class="fa fa-thumbs-up fa-fw fa_c" style="color:#428bca;cursor:pointer;display:none;" title="推荐" onclick="changestatus(<?php echo $v["id"];?>,0,this,'c')"></i>
                            	<i class="fa fa-thumbs-o-up fa-fw fa_c" style="color:#ddd;cursor:pointer;" title="取消推荐" onclick="changestatus(<?php echo $v["id"];?>,1,this,'c')"></i>
                            <?php }?>
                            
                            <?php if($v['status']){?>
                            <i class="fa fa-check fa-fw fa_status" style="color:#428bca;cursor:pointer;" title="显示" onclick="changestatus(<?php echo $v["id"];?>,0,this,'status')"></i>
                            <i class="fa fa-close fa-fw fa_status" style="color:red;cursor:pointer;display:none;" title="不显示" onclick="changestatus(<?php echo $v["id"];?>,1,this,'status')"></i>
                            <?php }else{?>
                            <i class="fa fa-check fa-fw fa_status" style="color:#428bca;cursor:pointer;display:none;" title="显示" onclick="changestatus(<?php echo $v["id"];?>,0,this,'status')"></i>
                            	<i class="fa fa-close fa-fw fa_status" style="color:red;cursor:pointer;" title="不显示" onclick="changestatus(<?php echo $v["id"];?>,1,this,'status')"></i>
                            <?php }?>
                            </td>
                            <td>
                                <a class="link-update edit" href="article_edit.php?id=<?php echo $v['id'];?>&typeid=<?php echo $v['typeid'];?>&type=edit">修改</a>
                                <?php if(manager(17)){ ?> | 
                                <a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a><?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                    <div class="list-page"><?php echo $page;?></div>
                </div>
                <input type='hidden' name='typeid' value="<?php echo $typeid;?>">
                <input type='hidden' name='type' value=''>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<div id="imgBox">
    <form method="post" action="article_list.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td width="65px">选择栏目</td>
            <td>
                <select name="typeid">
                    <?php if($article_type_list){ foreach ($article_type_list as $key => $value) { ?>
                    <option value="<?php echo $value['id'];?>" <?php if($value['type'] == 'page'){?> disabled<?php }?>><?php echo $value['delimiter'];?> <?php echo getstr($value['typename'],20);?></option>
                    <?php }}?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="65px">选择文件</td>
            <td>
                <input type="file" name="file">
            </td>
        </tr>
        <tr>
            <td width="65px">&nbsp;</td>
            <td>
                <input type="submit" value="提 交" style="margin-left:2px;"/>
            </td>
        </tr>
    </table>
    </form>
</div>
<style type="text/css">
#simg{
    position: relative;
}
#clo{
    position: absolute;
    right: 0;
    top: 0;
    cursor: pointer;
}
#img1{
    max-width: 100%;
}
</style>
<div id="simg" style="display:none">
  <img src="" alt="" id="img1"/>
  <img src="../images/close.png" id="clo" onclick="easyDialog.close()">
</div>
<script type="text/javascript">
//图片放大
function showimg(obj){
    $("#img1").attr('src',$(obj).attr('src'));
    easyDialog.open({
      container : 'simg',
      fixed : false
    });
}

function inputIn () {
    easyDialog.open({
      container : 'imgBox'
    });
}
<?php if(!manager(16)){ ?>
$(function(){
	$('a.edit').click(function(){showmsg('没有权限访问');return false;})
	})
<?php }?>
function del_one(id){
    if(confirm('确认要删除么？')) {
        $.post("post.php", {"type": "recover", "id": id, "recover": 1},
            function (data) {
                if (data) {
                    $('.del_' + id).fadeOut();
                } else {
                    showmsg('删除失败');
                }
            }, "json");
    }
}
//更改状态
/**
 * article_id 文章id
 * status 要更改的状态
 * obj 当前对象
 * type 更改的类型  status为控制文章显示,c为控制文章推荐属性,h为控制文章头条属性
 */
function changestatus(article_id,status,obj,type){
	$.post("post.php", { "type": "changestatus", "id": article_id,"operating": type,'status':status},
    function(data){
    	if (data.status) {
        $(obj).hide();
        $(obj).siblings('.fa_'+type).fadeIn();
    		//$('.del_'+article_id).fadeOut();
    	}else{
    		showmsg(data.msg);
    	}
    }, "json");
}
$(function(){
	$('#batchDel').click(function(){
        if(confirm('确认要删除么？')){
            $("input[name='type']").val('recover')
            $('#myform').submit();
        }
	})
    $('#batchSort').click(function(){
        $("input[name='type']").val('article_sort');
        $('#myform').submit();
    })
})
</script>
</body>
</html>
