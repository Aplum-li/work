<?php
/**
 * 调用轮换图
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty [smarty对象]
 * @param  [type] &$repeat  [description]
 * @return [type]           [description]
 */
function smarty_block_banner($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        global $model,$db;
        //分类id
        $typeid = isset($params['typeid']) ? intval($params['typeid']) : '';
        //显示条数
        $row = isset($params['row']) ? intval($params['row']) : 6;
        //排序方式
        $orderby = isset($params['orderby']) ? trim($params['orderby']) : 'id';
        //排序方法
        $orderway = isset($params['orderway']) ? trim($params['orderway']) : 'asc';

        $order = ''.$orderby.' '.$orderway;
        $bannerList = $model -> banner($typeid,$row,$order);

        $str = '';
        if ($bannerList) {
            $i = 1;
            foreach ($bannerList as $key => $value) {
                $tmp = $content;
                
                //取得字段名
                $fieldName = array_keys($value);
                foreach ($fieldName as $name) {
                    $res = $value[$name];
                    $tmp = preg_replace("/\[field:".$name."\]/",$res,$tmp);
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
