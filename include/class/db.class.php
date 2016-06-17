<?php
/**
 * @copyright   2015 腾虎技术 <http://www.tenghoo.com>
 * @creatdate   Aplum <1096831030@qq.com>
 */
class db { 
	private $pconnect = FALSE;
	private $dbconn;
	public $page;
	private $table_index;
	private $sql;

	public function __construct($db_host, $db_user, $db_pw, $db_name, $db_coding){
		$this->connect($db_host, $db_user, $db_pw, $db_name, $db_coding);
	}
	public function connect($db_host, $db_user, $db_pw, $db_name, $db_coding)
	{
		if ($this->pconnect) {
			$this->dbconn = @mysql_pconnect($db_host, $db_user, $db_pw);
		}
		else {
			$this->dbconn = @mysql_connect($db_host, $db_user, $db_pw);
		}
		if (!$this->dbconn) pe_bug('数据库连接失败...数据库ip，用户名，密码对吗？', __LINE__); 
		if (!mysql_select_db($db_name, $this->dbconn)) pe_bug('数据库选择失败...数据库名对吗？', __LINE__);
		$this->query("SET NAMES {$db_coding}");
		$this->query("SET sql_mode = ''");
	}
  	public function query($sql)
  	{
  		$this->sql[] = $sql;
		$result = mysql_query($sql, $this->dbconn);
		if ($sqlerror = mysql_error($this->dbconn)) $this->sql[] = $sqlerror;
		return $result;
  	}

  	//发送sql，并且返回处理过的结果集
  	public function query_result($sql)
  	{
  		$this->sql[] = $sql;
		$result = mysql_query($sql, $this->dbconn);
		if ($sqlerror = mysql_error($this->dbconn)) $this->sql[] = $sqlerror;
		$result = $this -> fetch_assoc($result);
		return $result;
  	}
	public function fetch_assoc($result = null)
	{
  		return mysql_fetch_assoc($result);
  	}
  	public function fetch_row($result = null)
  	{
  		return mysql_fetch_row($result);
  	}
	public function num_rows($result = null)
  	{
  		return mysql_num_rows($result);
  	}
	public function insert_id()
	{
		return mysql_insert_id();
	}
	public function index($table_index)
	{
		$this->table_index = $table_index;
		return $this;
	}
	/* ====================== 原始mysql处理函数 ====================== */
	public function sql_insert($sql)
	{
		$this->query($sql);
		if ($insert_id = mysql_insert_id()) {
			return $insert_id;
		}
		else {
			$result = mysql_affected_rows();
			return $result > 0 ? $result : 0;
		}
	}
	public function sql_delete($sql)
	{
		$this->query($sql);
		$result = mysql_affected_rows();
		return $result > 0 ? $result : 0;
	}
	public function sql_update($sql)
	{
		if ($this->query($sql) == true) {
			$result = mysql_affected_rows();
			return $result == 0 ? 1 : $result;
		}
		return 0;		
	}
	public function sql_selectall($sql, $limit_page = array())
	{
		//每页数量显示+分页 or 每页数量显示+不分页
		if (count($limit_page)==2) {
			$allnum = $this->sql_num(preg_replace('/select [\s\S]+?(?!from) from/i', 'select count(1) from', $sql, 1));
			$this->page = @new page($allnum, $limit_page[1], $limit_page[0]);
			$sqllimit = $this->page->limit;
		} elseif (count($limit_page)==1) {
			$sqllimit = " limit {$limit_page[0]}";
		}else{
			$sqllimit = '';
		}

		$result = $this->query($sql.$sqllimit);
		$rows = array();
		//自定义索引
		if ($this->table_index) {
			$table_index = explode('|', $this->table_index);
			$table_index_num = count($table_index);
			unset($this->table_index);
		}
		else {
			$table_index_num = 0;
		}
		while ($row = $this->fetch_assoc($result)) {
			if ($table_index_num == 0) {
				$rows[] = $row;
			}
			elseif ($table_index_num == 1) {
				$rows[$row[$table_index[0]]] = $row;
			}
			elseif ($table_index_num == 2) {
				$rows[$row[$table_index[0]]][$row[$table_index[1]]] = $row;
			}
		}
		return $rows;
	}
	public function sql_select($sql)
	{
		$row = array();
		return $row = $this->fetch_assoc($this->query($sql));
	}
	//可以用于判断符合sql条件的总行数(但sql必须遵循 "select count(1) from table where条件")合适，也可以用户判断某行是否存在
	public function sql_num($sql)
	{
		$rows = $this->fetch_row($this->query($sql));
		return intval($rows[0]);
	}
	/* ====================== 快速mysql处理函数 ====================== */
	public function th_selectall($table, $where = '', $field = '*', $limit_page = array())
	{
		//处理条件语句
		if ($where != '') {
			$sqlwhere = $this->_dowhere($where);
		}else{
			$sqlwhere = '';
		}

		if($field != '*'){
			$farr = explode(',', $field);
			if($farr){
				$str = '';
				foreach($farr as $k=>$v){
					if(strpos($v, '`') === false){
						$str .= '`'.$v.'`';
					} else {
						$str .= $v;
					}
					$str .= ',';
				}
				$field = rtrim($str, ',');
			}
		}

		return $this->sql_selectall("select {$field} from `".DB_PRE."{$table}` {$sqlwhere}", $limit_page);
	}

	/* ====================== 快速mysql处理函数 文章列表页专用 ====================== */
	/**
	 * 文章列表页专用
	 * @param  [type] $typeid     [当前栏目id]
	 * @param  string $where      [文章条件 只能传入字符串，不能传入数组，例如：'a.status=1']
	 * @param  string $field      [description]
	 * @param  array  $limit_page [description]
	 * @return [type]             [description]
	 */
	public function th_selectallarticle($typeid, $where='', $field = '*', $limit_page = array(),$order='a.sort,a.creattime desc')
	{
		//查询所有栏目
		$article_type_list = $this -> th_selectall('article_type',array('order by'=>'id asc'),'*');
		$category = new category();
		$tidss = explode(',', $typeid);
		$tids = '';
		foreach($tidss as $v){
			$typeids = $category->getChildsId($article_type_list,$v,0);
			foreach ($typeids as $key => $value) {
				$tids .= $value;
				$tids .= ',';
			}
		}
		$tids .= $typeid;
		if ($where == '') {
			$where = ' a.typeid IN ('.$tids.')';
		}else{
			$where .= ' AND a.typeid IN ('.$tids.')';
		}

		//加上附加表
		$typeInfo = $this -> th_select( 'article_type', array( 'id' => $typeid ), '`model`' );
		$model = $this -> th_select('model',array('model_id'=>$typeInfo['model']));
		$issettable = "SHOW TABLES LIKE '".DB_PRE.$model['model_addtable']."'";
		$res = $this->query_result($issettable);
		if(!$res){
			echo '附加表'.$model['model_addtable'].'不存在';
		}
		$sql = "SELECT a.*,fj.*, t.id as t_id,t.pid as t_pid,t.topid as t_topid,t.typename as t_typename,t.subtitle as t_subtitle,t.type as t_type,t.typetpl as t_typetpl,t.typelink as t_typenlink,t.litpic as t_litpic,t.typedesc as t_typedesc,t.model as t_model,t.typecontent as t_typecontent,t.sort as t_sort,t.status as t_status,t.keyword as t_keyword,t.m_id as t_mid,t.creattime as t_creattime FROM `".DB_PRE."article` as a LEFT JOIN `".DB_PRE."article_type` as t ON a.typeid=t.id LEFT JOIN ".DB_PRE.$model['model_addtable']." AS fj ON a.id=fj.article_id WHERE {$where} order by ".$order;
		return $this->sql_selectallarticle($sql, $limit_page);
	}

	/**
	 * 文章列表页专用
	 * @param  [type] $sql        [description]
	 * @param  array  $limit_page [description]
	 * @return [type]             [description]
	 */
	public function sql_selectallarticle($sql, $limit_page = array())
	{
		//统计总数
		$res1 = $this->query($sql);
		$newarr = array();
		while ($row1 = $this->fetch_assoc($res1)) {
			$newarr[] = $row1;
		}
		$allnum = count($newarr);
		/**
		 * $allnum  总数
		 * $limit_page['1']  当前第几页
		 * $limit_page['0'] 每页显示几条
		 * $list_num        栏数，就是有多少个页码
		 * @var [type]
		 */
		$this->page = @new page($allnum, $limit_page[1], $limit_page[0],5);
		if (!empty($limit_page)) {
			$sqllimit = $this->page->limit;
		}else{
			$sqllimit = '';
		}
		//echo $sql.$sqllimit;
		$result = $this->query($sql.$sqllimit);
		$rows = array();
		//自定义索引
		if ($this->table_index) {
			$table_index = explode('|', $this->table_index);
			$table_index_num = count($table_index);
			unset($this->table_index);
		}
		else {
			$table_index_num = 0;
		}
		while ($row = $this->fetch_assoc($result)) {
			if ($table_index_num == 0) {
				$rows[] = $row;
			}
			elseif ($table_index_num == 1) {
				$rows[$row[$table_index[0]]] = $row;
			}
			elseif ($table_index_num == 2) {
				$rows[$row[$table_index[0]]][$row[$table_index[1]]] = $row;
			}
		}
		return $rows;
	}


	/**
	 * 获取角色权限 传入角色id
	 * @param unknown $role_id
	 */
	public function th_getaccess($role_id){
		//权限表
		$access_table = DB_PRE.'access';
		//节点表
		$node_table = DB_PRE.'node';
		if (!$role_id) {
			return false;
		}
		$sql = 'SELECT n.node_id,n.node_name FROM `'.$access_table.'` AS a LEFT JOIN `'.$node_table.'` AS n ON a.node_id=n.node_id WHERE a.role_id='.$role_id;
		return $this -> sql_selectall($sql,array('150',''));
	}

	//有where条件的时候要在条件后面加上 order by 排序
	public function th_select($table, $where = '', $field = '*')
	{
		//处理条件语句
		if ($where) {
			$sqlwhere = $this->_dowhere($where);
		}else{
			$sqlwhere = '';
		}
		
		if($field != '*'){
			$farr = explode(',', $field);
			if($farr){
				$str = '';
				foreach($farr as $k=>$v){
					if(strpos($v, '`') === false){
						$str .= '`'.$v.'`';
					} else {
						$str .= $v;
					}
					$str .= ',';
				}
				$field = rtrim($str, ',');
			}
		}

		return $this->sql_select("select {$field} from `".DB_PRE."{$table}` {$sqlwhere} limit 1");
	}
	public function th_insert($table, $set)
	{
		//处理设置语句
		$sqlset = $this->_doset($set);
		return $this->sql_insert("insert into `".DB_PRE."{$table}` {$sqlset}");
	}
	public function th_update($table, $where, $set)
	{
		//处理设置语句
		$sqlset = $this->_doset($set);
		//处理条件语句
		$sqlwhere = $this->_dowhere($where);
		return $this->sql_update("update `".DB_PRE."{$table}` {$sqlset} {$sqlwhere}");	
	}
	public function th_delete($table, $where = '')
	{
		//处理条件语句
		$sqlwhere = $this->_dowhere($where);
		return $this->sql_delete("delete from `".DB_PRE."{$table}` {$sqlwhere}");
	}
	public function th_num($table, $where = '')
	{
		//处理条件语句
		$sqlwhere = $this->_dowhere($where);
		return $this->sql_num("select count(1) from `".DB_PRE."{$table}` {$sqlwhere}");
	}

	public function sql()
	{
		$i = 1;
		foreach ((array)$this->sql as $k => $v) {
			if ($k <=1) {
				continue;
			}
			else {
				echo  "<p>[".($i++)."] => {$v}</p>";
			}
		}
	}

	public function count_num($table, $where){
		$sql = "select count(*) as count from `".DB_PRE."{$table}` where ".$where;
		$result = $this -> query_result($sql);
		return $result['count'];
	}


	/* ====================== 仅供内部调用 ====================== */
	//处理条件语句
	protected function _dowhere($where)
	{
		if (is_array($where)) {
			$sqlby = '';
			$where_arr = '';
			foreach ($where as $k => $v) {
				$k = str_ireplace('`', '', $k);
				if (is_array($v)) {
					$where_arr[] = "`{$k}` in('".implode("','", $v)."')";			
				}
				else {
					in_array($k, array('order by', 'group by')) ? ($sqlby = " {$k} {$v}") : ($where_arr[] = "`{$k}` = '{$v}'");
				}
			}
			$sqlwhere = is_array($where_arr) ? 'where '.implode($where_arr, ' and ').$sqlby : $sqlby;
		}
		else {
			$where && $sqlwhere = (stripos(trim($where), 'order by') === 0 or stripos(trim($where), 'group by') === 0) ? "{$where}" : "where 1 {$where}";
		}
		return $sqlwhere;
	}
	//处理设置语句
	protected function _doset($set)
	{
		if (is_array($set)) {
			foreach ($set as $k => $v) {
				$k = str_ireplace('`', '', $k);
				$set_arr[] = "`{$k}` = '{$v}'";
			}
			$sqlset = 'set '.implode($set_arr, ' , ');
		}
		else {
			$sqlset = "set {$set}";
		}
		return $sqlset;
	}
}