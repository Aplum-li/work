<?php
/**
 * 调用文章
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty [smarty对象]
 * @param  [type] &$repeat  [description]
 * @return [type]           [description]
 */
function smarty_block_arclist($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        global $model,$db,$listdir,$viewdir;
        //栏目id
        $typeid = isset($params['typeid']) ? intval($params['typeid']) : '';
        //显示条数
        $row = isset($params['row']) ? intval($params['row']) : 5;
        $row = array($row,0);
        //文章属性
        $flag = isset($params['flag']) ? trim($params['flag']) : '';
        //排序方式
        $orderby = isset($params['orderby']) ? trim($params['orderby']) : 'sort';
        //排序方法
        $orderway = isset($params['orderway']) ? trim($params['orderway']) : 'asc';
        //limit
        $limit = isset($params['limit']) ? trim($params['limit']) : '';
        if ($limit) {
            if (strpos($limit, ',')) {
                $arr = explode(',', $limit);
                $row = array($arr[1],$arr[0]);
            }
        }

        //一些函数的处理
        //标题长度
        $titlelen = isset($params['titlelen']) ? intval($params['titlelen']) : '';
        //描述长度
        $desclen = isset($params['desclen']) ? intval($params['desclen']) : '';
        //时间格式化
        $time_ = isset($params['time']) ? trim($params['time']) : 'Y-m-d H:i:s';

        $order = 'a.'.$orderby.' '.$orderway.', a.creattime desc';
        $articlelist = $model -> GetArticleList($typeid,$row,$flag,$order);
        //p($articlelist);
        // $page = $db->page->html;
        // $smarty -> assign('page',$page);
        $str = '';
        if ($articlelist) {
            $i = 1;
            foreach ($articlelist as $key => $value) {
                $tmp = $content;
                    //取得字段名
                    $fieldName = array_keys($value);
                    foreach ($fieldName as $name) {
                            $res = $value[$name];
                        if (!is_array($res)) {
                            if ($name == 'title' && $titlelen) {
                                $r2 = $res;
                                $tmp = preg_replace("/\[field:title_\]/",$r2,$tmp);

                                $res = getstr($res,$titlelen);
                            }
                            if ($name == 'description' && $desclen) {
                                $res = getstr($res,$desclen);
                            }
                            if ($name == 'creattime' && $time_) {
                                $res = date($time_,$res);
                            }
                            //$tmp = str_replace("[field:".$name."]",$value[$name],$tmp);
                            $tmp = preg_replace("/\[field:".$name."\]/",$res,$tmp);
                        }
                    }
                    $tmp = preg_replace("/\[field:i\]/",$i,$tmp);
                    $str .= $tmp;
                    $i++;
            }
            return $str;
        }else{
            return '';
        }
    }
    

}
