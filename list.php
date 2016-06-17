<?php
/**
 *
 * 腾虎网络科技有限公司
 * 列表页数据处理
 * 
 *
 * TENGHOO
 * Author li
 */
require_once 'include/common.inc.php';
require_once 'home.common.php';
//获取当前栏目信息
$cateinfo = $model -> GetTypeInfo($typeid,'*');
if ($cateinfo['type'] == 'page') {
	if ($cateinfo['pagetpl']) {
		$tpl = $cateinfo['pagetpl'];
	}else{
		showmsg('请先指定模板文件');
		exit();
	}
}elseif ($cateinfo['type'] == 'list'){
	if ($cateinfo['typetpl']) {
		$tpl = $cateinfo['typetpl'];
	}else{
		showmsg('请先指定模板文件');
		exit();
	}
}
//防止后台用户填写当前栏目url
$curpath = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if ($cateinfo['typelink'] && $cateinfo['typelink'] !=$curpath) {
	header("location:".$cateinfo['typelink']);
	exit();
}

$amodel = $db -> th_select('model',array('model_id'=>$cateinfo['model']),'model_addtable');


if ($cateinfo['type'] == 'list'){
	$_g_page = isset($_GET['page']) ? intval($_GET['page']) : 0;
	$article_list = $db -> th_selectallarticle($typeid,"a.status=1 AND a.isrecover=0",'*',array($cateinfo['page'],$_g_page));
	foreach ($article_list as $k=>$v){
		$article_list[$k]['arcurl'] = $model->getarcurl($v['id']);
	}
	$smarty -> assign('article_list',$article_list);
	if (loadConfig('ishtml')) {
		$smarty -> assign('page',$db->page->rhtml);
	} else {
		$smarty -> assign('page',$db->page->html);
	}
}


$topinfo = $model -> GetTypeTopInfo($typeid);
//三级左侧栏目处理
//获取左侧栏
$inside = $model -> GetChilds($topinfo['id']);
foreach ($inside as $key => $value) {
	if ($typeid == $value['id']) {
		$inside[$key]['class'] = 'on';
	}else{
		$inside[$key]['class'] = '';
	}
}
$smarty -> assign('inside',$inside);

//检查当前模板是否存在，如果不存在，则选择默认模板，如果默认模板也没有，提示先创建模板
if ($tpl == '' || $tpl == null) {
	showmsg('模板不存在，请先创建模板');
	exit();
}else{
	$checktpl = ROOTPATH.'/templates/'.$tpl;
	if (!file_exists($checktpl)) {
		showmsg('模板不存在，请先创建模板');
		exit();
	}
}
$smarty -> assign('topinfo',$topinfo);
$smarty -> display($tpl,$_SERVER['REQUEST_URI']);