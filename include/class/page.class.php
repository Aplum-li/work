<?php
/**
 * @copyright   2015 腾虎技术 <http://www.tenghoo.com>
 * @creatdate   Aplum <1096831030@qq.com>
 */
//分页类
class page {
	public $page;//当前是第几页
	public $pagenum;//翻页栏显示数
	public $pagenums;//总页数
	public $listnum;//每页文章数
	public $listnums;//文章总数
	public $limit;//生成sql中limit数据
	public $html;//生成page翻页html模板 -- 动态
	public $rhtml;//生成page翻页html模板 -- 静态
	//构造函数初始化类设置
	function __construct($allnum, $page = null, $listnum = null, $pagenum = null) 
	{
		$this->listnums = $allnum;
		$this->page = $page === null ? 1 : intval($page);
		$this->listnum = $listnum === null ? 20 : intval($listnum);
		$this->pagenum = $pagenum === null ? 5 : intval($pagenum);

		$this->pagenums = ceil($this->listnums / $this->listnum);
		
		$this->limit = $this->get_limit();
		$this -> rhtml = $this->getpagelisthtmlwrite();
		$this->html = $this->getpagelisthtml();
		
	}
	//获取sql中limit函数的开始指针位置
	function get_limit()
	{
		empty($this->page) && $this->page = 1;
		$limit = ($this->page - 1) * $this->listnum;
		return " limit {$limit}, {$this->listnum}";
	}
	//获取翻页栏列表
	function get_pagelist()
	{
		//获取当前翻页栏左右指针理论位置
		if (floor($this->pagenum / 2) == ceil($this->pagenum / 2)) {
			$left = $this->page - ($this->pagenum / 2);
			$right = $this->page + ($this->pagenum / 2);
		}
		else {
			$left = $this->page - floor($this->pagenum / 2);
		 	$right = $this->page + floor($this->pagenum / 2);
		}
		//获取当前翻页栏起始指针位置
		if ($this->pagenums <= $this->pagenum) {
			$pagenumstart = 1;
			$pagenumend = $this->pagenums;
		}
		elseif ($left <= 1) {
			$pagenumstart = 1;
			$pagenumend = $this->pagenum;
		}
		elseif ($right >= $this->pagenums) {
			$pagenumstart = $this->pagenums - $this->pagenum + 1;
			$pagenumend = $this->pagenums;
		}
		else {
			$pagenumstart = $left;
			$pagenumend = $right;
		}
		for ($i = $pagenumstart; $i <= $pagenumend; $i++) {
			$pagelist[] = $i;
		}
		return $pagelist;
	}
	//获取翻页块带html的列表
	function getpagelisthtml()
	{
		$url = pe_updateurl('page',1);				
		$pagelisthtml = "<ul class='fenye'><li>共{$this -> listnums}条/每页{$this -> listnum}条</li><li><a href='{$url}'>首页</a></li>";
		if (count($this->get_pagelist()) > 1) {
			if ($this -> page > 1) {
				$url = pe_updateurl('page', $this -> page-1);;
				$pagelisthtml .= '<li><a href="'.$url.'">上一页</a></li>';
			}
			foreach ($this->get_pagelist() as $k => $v) {
				$url = pe_updateurl('page', $v);
				$pagelisthtml .= ($this->page == $v) ? "<li><a href='{$url}' class='sel'>{$v}</a></li>" : "<li><a href='{$url}'>{$v}</a></li>";	
			}
			if ($this -> page < $this->pagenums) {
				$url = pe_updateurl('page', $this -> page+1);;
				$pagelisthtml .= '<li><a href="'.$url.'">下一页</a></li>';
			}
		} else{
			$pagelisthtml .= "<li><a href='{$url}' class='sel'>1</a></li>";
		}

$url = pe_updateurl('page', $this->pagenums);
$pagelisthtml .= "<li><a href='{$url}'>末页</a></li>";
$pagelisthtml .="<li><a href='javascript:;'>".$this -> page ."/".$this->pagenums."页 </a></li></ul>";
			return $pagelisthtml;
	}

	//获取翻页块带html的列表
	function getpagelisthtmlwrite()
	{
		global $db;
		$typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
		$info = $db->th_select('article_type', array('id'=>$typeid),'name');
		$urlstrpre = $info['name'].$typeid.'_page_';
		$url = $urlstrpre.'1.html';				
		$pagelisthtml = "<ul class='fenye pagination pagination-lg'><li><a href='{$url}'>首页</a></li>";
		if (count($this->get_pagelist()) > 1) {
			if ($this -> page > 1) {
				$url = $urlstrpre.($this -> page-1).'.html';
				$pagelisthtml .= '<li><a href="'.$url.'">上一页</a></li>';
			}
			foreach ($this->get_pagelist() as $k => $v) {
				$url = $urlstrpre.$v.'.html';
				//$url = pe_updateurl('page', $v);
				$pagelisthtml .= ($this->page == $v) ? "<li class='active cel'><a href='{$url}'>{$v}</a></li>" : "<li><a href='{$url}'>{$v}</a></li>";	
			}
			if ($this -> page < $this->pagenums) {
				$url = $urlstrpre.($this -> page+1).'.html';
				$pagelisthtml .= '<li><a href="'.$url.'">下一页</a></li>';
			}
		} else{
			$pagelisthtml .= "<li class='active cel'><a href='{$url}'>1</a></li>";	
		}
		$url = $urlstrpre.$this->pagenums.'.html';
		$pagelisthtml .= "<li><a href='{$url}'>末页</a></li>";
		$pagelisthtml .="<li><a href='javascript:;'>".$this -> page ."/".$this->pagenums."页 </a></li></ul>";
			return $pagelisthtml;
	}
	//ajax模式分页
	function ajax($func_name = 'page_ajax') {
		return preg_replace("|href='[^']*page=(\d+)[^']*'|", "href='javascript:{$func_name}($1);'", $this->html);
	}
}