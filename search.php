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
require_once ROOTPATH.'/home.common.php';

$_g_page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$keyword = isset($_GET['q']) ? $_GET['q'] : '';
if ($keyword == '') {
	showmsg('请输入关键字再查询');
	exit();
}
if (strlen_utf8($keyword) < 2) {
	showmsg('关键字不能小于两个字符');
	exit();
}
$where = " AND status=1 AND `title` like '%".th_dbhold($keyword)."%'";
$article_list = $db -> th_selectall('article',$where,'*',array(2,$_g_page));
foreach ($article_list as $k=>$v){
	if (loadConfig('ishtml')) {
		$article_list[$k]['arcurl'] = WEBPATH.$viewdir.'/'.$v['id'].'.html';
	}else{
		$article_list[$k]['arcurl'] = WEBPATH.'view.php?id='.$v['id'];
	}
}
$count = $db->page->listnums;
@$smarty -> assign('count',$count);
@$smarty -> assign('article_list',$article_list);
@$smarty -> assign('page',$db->page->html);

//检查当前模板是否存在，如果不存在，则选择默认模板，如果默认模板也没有，提示先创建模板

$tpl = ROOTPATH.'/templates/search.html';
if (!file_exists($tpl)) {
	showmsg('模板不存在，请先创建模板');
	exit();
}
$smarty -> display('search.html');
?>