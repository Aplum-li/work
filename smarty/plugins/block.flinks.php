<?php
/**
 * 调用友情链接
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty [smarty对象]
 * @param  [type] &$repeat  [description]
 */
function smarty_block_flinks($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        global $model,$db;
        //显示条数
        $row = isset($params['row']) ? intval($params['row']) : 6;
		//栏目id
        $typeid = isset($params['typeid']) ? trim($params['typeid']) : '';
        //排序方式
        $orderby = isset($params['orderby']) ? trim($params['orderby']) : 'flink_id';
        //排序方法
        $orderway = isset($params['orderway']) ? trim($params['orderway']) : 'desc';

        $order = ''.$orderby.' '.$orderway;
        $flinksList = $model -> GetFlinksList($row,$order,$typeid);
		//p($flinksList);die;
        $str = '';
        if ($flinksList) {
            foreach ($flinksList as $key => $value) {
                $tmp = $content;
                
                //取得字段名
                $fieldName = array_keys($value);
                foreach ($fieldName as $name) {
                    $res = $value[$name];
                    $tmp = preg_replace("/\[field:".$name."\]/",$res,$tmp);
                }
                $str .= $tmp;
            }
            return $str;
        }else{
            return '';
        }
    }
    

}
