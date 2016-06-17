<?php
/**
 *
 * 腾虎网络科技有限公司
 * 详情页数据处理
 * 
 *
 * TENGHOO
 * Author li
 */
require_once 'include/common.inc.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if (!$id) {
	showmsg('参数错误');
	exit();
}
$arctileinfo = $db -> th_select('article',array('id'=>$id,'status'=>1),'id,typeid,title,litpic,litpics,description,content,creattime,click,m_id');
$typeid = $_GET['typeid'] = $arctileinfo['typeid'];
require_once 'home.common.php';
$model -> AddClick($id);
//获取当前栏目信息
$cateinfo = $model -> GetTypeInfo($typeid,'*');

$amodel = $db -> th_select('model',array('model_id'=>$cateinfo['model']),'model_addtable');

if ($cateinfo['viewtpl']) {
	$tpl = $cateinfo['viewtpl'];
}else{
	showmsg('请先指定模板文件');
	exit();
}
if(!file_exists(ROOTPATH.'/templates/'.$tpl)){
	showmsg('模板不存在，请先创建模板');
	exit();
}

//详情页多图处理
$litpics = array();
$con = loadConfig();
if (isset($con['article']) || isset($con['shop'])) {
	if (!empty($arctileinfo['litpics'])) {
		if (strpos($arctileinfo['litpics'], '+')) {
			$litpics = explode('+', $arctileinfo['litpics']);
		} else {
			$litpics[] = $arctileinfo['litpics'];
		}
	}
}
//附加表信息
$arctileinfo['addInfo'] = $db -> th_select($amodel['model_addtable'],array('article_id'=>$id));
$topinfo = $model -> GetTypeTopInfo($typeid);
//三级左侧栏目处理
if ($topinfo['id'] == 54) {
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
}
$smarty -> assign('typeid',$typeid);
$smarty -> assign('litpics',$litpics);
$smarty -> assign('arctileinfo',$arctileinfo);
$smarty -> display($tpl);