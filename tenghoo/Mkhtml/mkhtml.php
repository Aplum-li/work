<?php
/**
 * 进度条
 *
 */
require('../checklogin.php');

$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
if ($type) {
	if (!loadConfig('ishtml')) {
		showmsg('未开启生成静态，请先开启');
		exit();
	}
}
switch ($type) {
	case 'index':
		$smarty -> clearCompiledTemplate();
		//生成首页
		$file = ROOTPATH . "/index.html";
		$content=file_get_contents(WEBPATH.'index.php');
		makehtml($file,$content);
		echo '更新完成：<a href="'.WEBPATH.'index.html" target="_blank">浏览...</a>';
		break;
	case 'list':
		//生成列表页
		$pagesize= isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10; //每批次生成的文件数量
		//开始数量
		$startid  = isset($_GET['startid']) ? intval($_GET['startid']) : 0;
		//栏目表
		$article_type_table = 'article_type';
		//文章表
		$article_table = 'article';
		//栏目id
		$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : 0;

		$where = '';
		//如果是更新某个栏目
		if ($typeid) {
			if(isset($_SESSION['list_'])){
				$article_type_list = $_SESSION['list_'];
			} else {
				$article_type_list = $db -> th_selectall('article_type',array('order by'=>'id asc'),'*');
				$_SESSION['list_'] = $article_type_list;
			}
			if(isset($_SESSION['ids'])){
				$where = ' and id IN ('.$_SESSION['ids'].') order by id';
			} else {
				$category = new category();
				$ids = array();
				$ids = $category -> getChildsId($article_type_list,$typeid,1);
				$idsStr = implode(',', $ids);
				$_SESSION['ids'] = $idsStr;
				$where = ' and id IN ('.$idsStr.') order by id';
			}
			$lastInfo = $db->th_select('article_type', $where,'id,type,name,page');
		} else {
			if(isset($_GET['tid'])){
				if($where == ''){
					$where .= ' and id > '.$_GET['tid'].' order by id';
				} else {
					$where .= ' and id > '.$_GET['tid'].' order by id';
				}
				$lastInfo = $db->th_select('article_type', $where,'id,type,name,page');
			} else {
				$where .= ' order by id';
				$lastInfo = $db->th_select('article_type', $where,'id,type,name,page');
			}
		}
		//总数
		if(isset($_SESSION['total'])){
			$total = $_SESSION['total'];
		} else {
			$total = $db->th_num('article_type', $where);
			$_SESSION['total'] = $total;
		}
		$est1 = ExecTime();
		foreach ($_GET as $k => $v) {
			$$k=$v;
		}
		//总数量
		$totalnum = (empty($total) ? 10  : $total);
		$seltime  = (empty($seltime)  ? 0  : $seltime);
		$stime    = (empty($stime)    ? '' : $stime );
		$etime    = (empty($etime)    ? '' : $etime);
		$sstime   = (empty($sstime)   ? 0  : $sstime);
		//处理业务逻辑
		if ($lastInfo['type'] == 'list') {
			$dir = $lastInfo['name'];
			if (!is_dir(ROOTPATH.'/'.$dir)) {
				mkDirs(ROOTPATH.'/'.$dir);
			}
			$listfile = ROOTPATH . "/".$dir.'/index.html';

			$content=file_get_contents(WEBPATH.'/list.php?typeid='.$lastInfo['id']);
			makehtml($listfile,$content);
			$article_list = $db -> th_selectallarticle($lastInfo['id'],"a.status=1 and a.isrecover=0",'*');
			$count = count($article_list);
			for ($i=1; $i <= ceil($count/$lastInfo['page']); $i++) {
				$listfile = ROOTPATH . "/".$dir."/".$lastInfo['id'].'_page_'.$i.'.html';
				$content=file_get_contents(WEBPATH.'/list.php?typeid='.$lastInfo['id'].'&page='.$i);
				makehtml($listfile,$content);
			}
		} else {
			$dir = $lastInfo['name'];
			if (!is_dir(ROOTPATH.'/'.$dir)) {
				mkDirs(ROOTPATH.'/'.$dir);
			}
			$listfile = ROOTPATH . "/".$dir.'/index.html';
			$content=file_get_contents(WEBPATH.'/list.php?typeid='.$lastInfo['id']);
			makehtml($listfile,$content);
		}
		$startid++;
		if(empty($sstime)) {
			$sstime = time();
		}
		$t2 = ExecTime();
		$t2 = ($t2 - $est1);
		$ttime = (time() - $sstime)/2;
		$ttime = number_format(($ttime / 60),2);
		//返回提示信息
		$tjlen = $totalnum>0 ? ceil( ($startid/$totalnum) * 100 ) : 100;//当前进度
		$dvlen = $tjlen * 4;
		$tjsta = "<div style='width:$dvlen;height:15px;border:1px solid #898989;text-align:left'><div style='width:$dvlen;height:15px;background-color:#829D83'></div></div>";
		$tjsta .= "<br/>用时：$ttime 分钟，总任务：".($totalnum).",到达位置：".($startid)."<br/>完成创建文件总数的：$tjlen %，继续执行任务...";
		if($startid < $totalnum) {
			$nurl  = "?startid=$startid&type=list&typeid=$typeid&tid=".$lastInfo['id'];
			$nurl .= "&totalnum=$totalnum&pagesize=$pagesize";
			$nurl .= "&seltime=$seltime&sstime=$sstime&stime=".urlencode($stime)."&etime=".urlencode($etime);
			echo $tjsta;
			echo '<script>setTimeout(function(){window.location.href="'.$nurl.'"},100)</script>';
			exit();
		} else {
			unset($_SESSION['ids']);
			unset($_SESSION['total']);
			echo ("完成所有任务！，生成发送：$totalnum 总用时：{$ttime} 分钟。");
			exit();
		}
		break;
	case 'view':
		//生成文档页
		//每批次生成的文件数量
		$pagesize= isset($_GET['pagesize']) && $_GET['pagesize'] ? intval($_GET['pagesize']) : 10;
		//开始数量
		$startid  = isset($_GET['startid']) ? intval($_GET['startid']) : 0;
		if($startid == 0){
			$smarty -> clearCompiledTemplate();
		}
		$article_type_table = 'article_type';
		$article_table = 'article';

		$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : 0;
		$where = '';
		if ($typeid) {
			if(isset($_SESSION['list_'])){
				$article_type_list = $_SESSION['list_'];
			} else {
				$article_type_list = $db -> th_selectall('article_type',array('order by'=>'id asc'),'id,pid,topid,typetpl,viewtpl,pagetpl,typelink,litpic,typename,subtitle,status');
				$_SESSION['list_'] = $article_type_list;
			}
			$category = new category();
			$ids = array();
			$ids = $category -> getChildsId($article_type_list,$typeid,1);
			$idsStr = implode(',', $ids);
			$where = ' and typeid IN ('.$idsStr.')';
		}
		$field = "id,typeid";
		$sql = "select count(*) as c from `".DB_PRE.$article_table."` where 1 ".$where;
		$res = $db -> sql_num($sql);

		$where .= ' order by id asc';
		$typecount = ceil($res/$pagesize);
		//$startid要经过处理，page.class.php这个类文件的原因
		$limit = $startid ? ceil($startid/$pagesize)+1 : 1;
		$article_list = $db -> th_selectall($article_table,$where,$field,array($pagesize,$limit));
		$est1 = ExecTime();
		foreach ($_GET as $k => $v) {
			$$k=$v;
		}
		//总数量
		$totalnum = (empty($res) ? 10  : $res);
		$seltime  = (empty($seltime)  ? 0  : $seltime);
		$stime    = (empty($stime)    ? '' : $stime );
		$etime    = (empty($etime)    ? '' : $etime);
		$sstime   = (empty($sstime)   ? 0  : $sstime);
		$successnum  = (empty($successnum)  ? 0  : $successnum);//成功数量
		//处理业务逻辑
		for($h = 0; $h < count($article_list); $h++) {
			$info = $db->th_select('article_type', array('id'=>$article_list[$h]['typeid']),'name');
			if (!is_dir(ROOTPATH.'/'.$info['name'])) {
				mkDirs(ROOTPATH.'/'.$info['name']);
			}
			$viewfile = ROOTPATH . "/".$info['name']."/".$article_list[$h]['id'].'.html';
			$content=file_get_contents(WEBPATH.'/view.php?id='.$article_list[$h]['id']);
			makehtml($viewfile,$content);
			$successnum++;
		}
		$startid=$startid+$pagesize;
		if(empty($sstime)) {
			$sstime = time();
		}
		$t2 = ExecTime();
		$t2 = ($t2 - $est1);
		$ttime = time() - $sstime;
		$ttime = number_format(($ttime / 60),2);
		//返回提示信息
		$tjlen = $totalnum>0 ? ceil( ($startid/$totalnum) * 100 ) : 100;//当前进度
		$dvlen = $tjlen * 4;
		$tjsta = "<div style='width:400px;height:15px;border:1px solid #898989;text-align:left'><div style='width:$dvlen;height:15px;background-color:#829D83'></div></div>";
		$tjsta .= "<br/>用时：$ttime 分钟，总任务：".($totalnum).",到达位置：".($startid)."<br/>完成创建文件总数的：$tjlen %，继续执行任务...";

		if($startid < $totalnum) {
			$nurl  = "?startid=$startid&type=view&typeid=$typeid";
			$nurl .= "&totalnum=$totalnum&pagesize=$pagesize&successnum=$successnum";
			$nurl .= "&seltime=$seltime&sstime=$sstime&stime=".urlencode($stime)."&etime=".urlencode($etime);
			//showmsg($tjsta,$nurl,0,1000);
			echo $tjsta;
			echo '<script>setTimeout(function(){window.location.href="'.$nurl.'"},100)</script>';
			exit();
		} else {
			unset($_SESSION['list_']);
			echo ("完成所有任务！，生成发送：$successnum 总用时：{$ttime} 分钟。");
			//showmsg("完成所有任务！，生成发送：$successnum 总用时：{$ttime} 分钟。","javascript:;");
			exit();
		}
		break;

	default:

		break;
}
?>  