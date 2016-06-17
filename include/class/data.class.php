<?php
header("Content-type: text/html; charset=utf-8"); 
/**
 * 前台获取数据
 */
class Data{
	protected $db;

	Public function __construct($db){
		$this -> db = $db;
	}

	/**
	 * 获取导航
	 * $typeid    [num] [当前样式]
	 * @return [array] [二维数组]
	 */
	Public function nav($typeid=''){
		global $listdir;
		$category = new category();
		$navs = array();
		$where = array('status'=>1,'order by'=>'sort asc,id asc');
		$field = '`id`,`pid`,`topid`,`typename`,`subtitle`,`type`,`typetpl`,`typelink`';
		$navs = $this -> db -> th_selectall('article_type',$where,$field);

		if ($navs) {
			if ($typeid) {
				$topid = $this -> GetTypeInfo($typeid,'topid');
				if ($topid != 0) {
					$typeid = $topid;
				}
			}
			foreach ($navs as $key => $value) {
				if ($typeid == $value['id']) {
					$navs[$key]['class'] = 'on';
				}else{
					$navs[$key]['class'] = '';
				}
			}
		}
		$navs = $category -> toLayer($navs,'child','0');
		return $navs;
	}
	
	/**
	 * 获取轮换图 传入轮换图的分类id
	 * @param [num] $cateid
	 */
	Public function banner($typeid,$row='10',$orderby="id asc"){
		if (!$typeid) {
			return '';
		}
		$where = array('typeid'=>$typeid,'order by'=>$orderby,'status'=>1);
		return $this -> db -> th_selectall('rotation',$where,'title,link,litpic',array($row));
	}

	/**
	 * 获取友情链接
	 * @param [num] $cateid
	 */
	Public function GetFlinksList($row='10',$orderby="flink_id desc",$typeid=""){
		
		//$where = array('order by'=>$orderby,'status'=>1);
		
		$where['order by'] = $orderby;
		$where['status'] = '1';
		if(!empty($typeid)){
			$where['typeid'] = $typeid;
		}
		return $this -> db -> th_selectall('flink',$where,'flink_name,flink_link,flink_logo',array($row));
	}
	
	/**
	 * 传入当前栏目id，返回所在位置，如果$title=1，则是返回当前网页标题
	 * @param [num] $typeid
	 * @param [num] $title
	 */
	Public function GetTitle($typeid,$title=0){
		global $listdir;
		if (!$typeid) {
			return '';
		}
		$category = new category();
		$where = array('order by'=>'sort asc,id asc');
		$field = '`id`,`pid`,`topid`,`typename`,`type`,`typetpl`,`typelink`';
		$cates = $this -> db -> th_selectall('article_type',$where,$field);
		$position = $category -> getParents($cates,$typeid);
		if ($title) {
			rsort($position);
			$str = '';
			foreach ($position as $key => $value) {
				$str .= $value['typename'].'_';
			}
			return $str.loadConfig('web_name');
		}else{
			$str = '<a href="'.loadConfig('web_host').'" title="'.loadConfig('web_name').'">首页</a>';
			foreach ($position as $key => $value) {
				$listurl = $this->getlisturl($value['id']);
				$str .= ' &gt; <a href="'.$listurl.'" title="'.$value['typename'].'">'.$value['typename'].'</a>';
			}
			
			return $str;
		}
	}

	/**
	 * 获取指定栏目信息
	 * @param [num] $typeid
	 * @param string $data
	 * @return string
	 */
	Public function GetTypeInfo($typeid,$f=''){
		global $listdir;
		if (!$typeid) {
			return '';
		}
		$field = '`id`,`pid`,`topid`,`typename`,`subtitle`,`type`,`model`,`typetpl`,`viewtpl`,`pagetpl`,`typelink`,`litpic`,`typedesc`,`typecontent`,`page`,`keyword`';
		$cateinfo = @$this -> db -> th_select('article_type',array('id'=>$typeid),$field);
		if ($f && $f != '*') {
			if ($f == 'typelink') {
				$cateinfo['typelink'] = $this->getlisturl($cateinfo['id']);
			}
			return $cateinfo[$f];
			exit();
		}
		return $cateinfo;
	}
	
	
	/**
	 * 获取顶级栏目信息
	 * @param [num] $typeid
	 * @param string $data
	 * @return string
	 */
	Public function GetTypeTopInfo($typeid){
		global $listdir;
		if (!$typeid) {
			return '';
		}
		$cur_cate_info = $this -> db -> th_select('article_type',array('id'=>$typeid),'`id`,`pid`,`topid`,`typename`,`type`,`model`,`typetpl`,`typelink`,`litpic`,`typedesc`,`typecontent`,`subtitle`');
		if ($cur_cate_info['pid'] != 0) {
			$cur_cate_info = $this -> GetTypeTopInfo($cur_cate_info['pid']);
		}
		$cur_cate_info['typelink'] = $this->getlisturl($cur_cate_info['id']);
		return $cur_cate_info;
	}

	/**
	 * 获取广告信息
	 * @param [num] $adid
	 * @param string $data
	 * @return string
	 */
	Public function getadinfo($adid,$data='ad_content'){
		if (!$adid) {
			return '';
		}
		$adinfo = $this -> db -> th_select('ad',array('ad_id'=>$adid,'status'=>1),$data);
		if ($data != '*') {
			return $adinfo[$data];;
		}else{
			return $adinfo;
		}
	}
	
	/**
	 * 获取当前栏目的子栏目,只返回子级栏目，返回所有子级请参考 GetChilds($typeid);
	 */
	Public function getchild($typeid){
		if (!$typeid) {
			return '';
		}

		$where = array('pid'=>$typeid,'order by'=>'sort asc','status'=>1);
		$cateinfo = $this -> db -> th_selectall('article_type',$where,'id,typename,typelink,typetpl');
		foreach ($cateinfo as $key=>$value){
			if ($value['typelink'] == '') {
				$cateinfo[$key]['typelink'] = $value['typetpl'];
			}
		}
		return $cateinfo;
	}

	/**
	 * 获取当前栏目的所有子级，并以多维数组返回
	 * @param [type] $typeid [description]
	 */
	Public function GetChilds($typeid,$status=""){
		global $listdir;
		if (!$typeid) {
			return '';
		}
		
		$where['order by'] = 'sort asc,id';
		
		if($status == 'on'){
			$where['status'] = '1';
		}
		
		
		//查询所有栏目
		$article_type_list = $this -> db -> th_selectall('article_type',$where,'id,pid,topid,typetpl,viewtpl,pagetpl,typelink,litpic,typename,subtitle,status');
		$category = new category();
		$cates = array();
		$cates = $category -> toLayer($article_type_list,'child',$typeid);
		return $cates;
	}

	/**
	 * 增加文章点击数
	 * @param [type] $id [description]
	 */
	Public function AddClick($id){
		if (!$id) {
			exit();
		}
		$id=intval($id);
		$sql = "update `".DB_PRE."article` set `click` = `click`+1 where `id` = {$id}";
		@$this -> db -> sql_update($sql);
	}
	
	/**
	 * 获取文章详情 传入文章id
	 * @param unknown $id
	 */
	Public function GetArticle($id){
		if (!$id) {
			return '';
		}
		$id = intval($id);
		return $this -> db -> th_select('article',array('id'=>$id,'status'=>1),'id,typeid,title,litpic,description,content,creattime,click');
	}


	/**
	 * 获取文章列表
	 * @param [type]  $typeid [当前栏目id]
	 * @param integer $row    [获取的条数]
	 * @param string  $flag   [是否头条、推荐]
	 */
	Public function GetArticleList($typeid='',$row = array(10,0),$flag='',$order='a.sort,a.creattime desc'){
		global $listdir,$viewdir;
		$where = 'a.status=1 AND a.isrecover=0';
		if ($flag) {
			$where .= ' AND a.`'.$flag.'`=1';
		}
		//$_g_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$articlelist = $this -> db -> th_selectallarticle($typeid,$where,'*',$row,$order);

		foreach ($articlelist as $key => $value) {
			$articlelist[$key]['t_typelink'] = $this->getlisturl($value['t_id']);
			$articlelist[$key]['arcurl'] = $this->getarcurl($value['id']);
		//获取当前栏目信息
		$cateinfo = $this -> GetTypeInfo($value['typeid'],'*');

		$amodel = $this -> db -> th_select('model',array('model_id'=>$cateinfo['model']),'model_addtable');
			//附加表信息
			$articlelist[$key]['addInfo'] = $this -> db -> th_select($amodel['model_addtable'],array('article_id'=>$value['id']));
		}
		return $articlelist;
	}

	/**
	 * 获取上一篇,下一篇
	 * @param [type]  $id [当前文章id]
	 * @param string  $field   [获取的字段]
	 */
	Public function GetPre($id,$type,$field='title'){
		global $viewdir;
		$curArticleInfo = $this -> db -> th_select('article',array('id'=>$id,'status'=>1),'id,typeid');
		if ($type == '<') {
			$order = 'DESC';
		}else{
			$order = 'ASC';
		}
		$where = ' AND id '.$type.' '.$id .' AND `status`=1 AND `typeid`='.$curArticleInfo['typeid'].' ORDER BY id '.$order;
		$articleInfo = $this -> db -> th_select('article',$where,'id,title');
		if ($articleInfo) {
			if ($field == 'arcurl') {
				$articleInfo['arcurl'] = $this->getarcurl($articleInfo['id']);
			}
		return $articleInfo[$field];
		}else{
			if ($field == 'arcurl') {
				$articleInfo['arcurl'] = 'javascript:;';
				return $articleInfo['arcurl'];
			} elseif ($field == 'title') {
				$articleInfo['title'] = '没有了';
				return $articleInfo['title'];
			}
		}
		
	}

	/**
	 * 获取栏目链接
	 * @param $id
	 * @return string
	 *
	 */
	public function getlisturl($id){
		$where = array('id'=>$id);
		$info = $this->db->th_select('article_type', $where, '`name`,`typelink`,`typename`');
		if ($info['typelink'] == '') {
			if (loadConfig('ishtml')) {
				return $info['name'];
			} else {
				return WEBPATH.'list.php?typeid='.$id;
			}
		}else{
			return $info['typelink'];
		}
	}

	/**
	 * 获取文章链接
	 * @param $id
	 * @return string
	 *
	 */
	public function getarcurl($id){
		$where = array('id'=>$id);
		$info = $this->db->th_select('article', $where, 'typeid');
		$tinfo = $this->db->th_select('article_type', array('id'=>$info['typeid']), 'name');
		if (loadConfig('ishtml')) {
			return $tinfo['name'].$id.'.html';
		} else {
			return WEBPATH.'view.php?id='.$id;
		}
	}
}