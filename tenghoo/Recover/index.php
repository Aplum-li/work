<?php
/**
 * 文章列表
 */
require('../checklogin.php');

if(!manager(48)){showmsg('没有权限访问');exit();}
//文章表
$article_table = 'article';
//栏目表
$article_type_table = 'article_type';
//管理员表
$admin_table = 'admin';

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : '0';
$map = ' and isrecover=1';

$article_list = $db -> th_selectall('article',$map,'*',array(15,$_g_page));
foreach($article_list as $k=>$v){
	$info = $db->th_select('article_type', array('id'=>$v['typeid']), 'typename');
	$article_list[$k]['t_typename'] = $info['typename'];
}

$page = $db->page->html;

$pos = '回收站';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $pos;?></title>
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
				<input type="hidden" name="recover" value="0"/>
				<div class="result-title">
					<div class="result-list">
						<a id="batchhy" href="javascript:void(0)"><i class="fa fa-refresh"></i>批量还原</a>
						<a id="batchDel" href="javascript:void(0)"><i class="fa fa-trash-o fa-lg"></i>彻底删除</a>
					</div>
				</div>
				<div class="result-content">
					<table class="result-tab" width="100%">
						<tr>
							<th class="tc" width="4%" style="min-width: 35px;"><input class="allChoose" onclick="check_all_other('ids',this)" type="checkbox"></th>
							<th class="tc" width="4%" style="min-width: 35px;">排序</th>
							<th width="3%" style="min-width: 35px;">ID</th>
							<th width="40%" style='text-align:left;text-indent:10px;min-width: 470px;'>名称</th>
							<th width="11%" style="min-width: 120px;">文章分类</th>
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
                                <span style="float:left;"><a href="##" class="edit"><?php echo getstr($v['title'],50);?></a><?php if($v['litpic']){?>&nbsp;&nbsp;<img src="<?php echo $v['litpic'];?>" height="15px" onclick="showimg(this)"><?php }?>
                                </span>
								</td>
								<td><?php echo $v['t_typename'];?></td>
								<td>
									<a class="link-update edit" href="javascript:recover_one(<?php echo $v['id'];?>);">还原</a>
									<?php if(manager(17)){ ?> |
									<a class="link-del" href="javascript:del_one(<?php echo $v['id'];?>);">删除</a><?php }?>
								</td>
							</tr>
						<?php }?>
					</table>
					<div class="list-page"><?php echo $page;?></div>
				</div>
				<input type='hidden' name='type' value=''>
			</form>
		</div>
	</div>
	<!--/main-->
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
<script type="text/javascript">
	//图片放大
	function showimg(obj){
		$("#img1").attr('src',$(obj).attr('src'));
		easyDialog.open({
			container : 'simg',
			fixed : false
		});
	}

	//还原一篇文章
	function recover_one(id){
		if(confirm('确认要还原文章么？')) {
			$.post("post.php", {"type": "recover", "id": id, "recover": 0},
				function (data) {
					if (data) {
						$('.del_' + id).fadeOut();
					} else {
						showmsg('还原失败');
					}
				}, "json");
		}
	}

	function del_one(id){
		if(confirm('删除了文章再也无法恢复，确认要删除么？')) {
			$.post("post.php", {"type": "del_article", "id": id},
				function (data) {
					if (data) {
						$('.del_' + id).fadeOut();
					} else {
						showmsg('删除失败');
					}
				}, "json");
		}
	}
	$(function(){
		$('#batchDel').click(function(){
			if(confirm('删除了文章再也无法恢复，确认要删除么？')){
				$("input[name='type']").val('del_article')
				$('#myform').submit();
			}
		})
		$('#batchhy').click(function(){
			if(confirm('确认要还原么？')){
				$("input[name='type']").val('recover');
				$('#myform').submit();
			}
		})
	})
</script>
</body>
</html>
