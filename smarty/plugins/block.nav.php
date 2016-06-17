<?php
/**
 * 导航专用标签 
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty   [smarty对象]
 * @param  [type] &$repeat  [description]
 * @return [type]           [description]
 */
function smarty_block_nav($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        global $model,$db;
        $str = '';
        //栏目id
        $typeid = isset($params['typeid']) ? intval($params['typeid']) : '';
        if (!$typeid) {
            $str = '请传入栏目id';
            return $str;
        }

        //获取类型
        $type = isset($params['type']) ? trim($params['type']) : 'top';
        
        //获取条数
        $row = isset($params['row']) ? trim($params['row']) : '';

        //当前样式名称
        $curclass = isset($params['curclass']) ? trim($params['curclass']) : '';

        if ($type == 'self') {
            $topinfo['id'] = $typeid;
        }else{
            //获取当前栏目的顶级栏目信息
            $topinfo = $model -> GetTypeTopInfo($typeid);
        }
        //获取顶级栏目下所有子栏目
        $inside = $model -> GetChilds($topinfo['id']);
        //加上当前样式，当前样式适用于二级栏目，三级栏目请自行添加
        foreach ($inside as $key => $item){
            if ($row) {
                if ($key > $row - 1) {
                    unset($inside[$key]);
                    continue;
                }
            }
        }
        $str = '';
        $tmp = '';
        if ($inside) {
            foreach ($inside as $key => $value) {
                $tmp = $content;
                //取得字段名
                $fieldName = array_keys($value);
                foreach ($fieldName as $name) {
                    $res = $value[$name];
                    if (!is_array($res)) {
                        $tmp = preg_replace("/\[field.".$name."\]/",$res,$tmp);
                    }
                    
                }
               $_g_typeid = isset($_GET['typeid']) ? intval($_GET['typeid']) : '';
                if ($value['id'] == $typeid || $value['id'] == $_g_typeid) {
                    $tmp = str_replace("[field:class]",$curclass,$tmp);
                }else{
                    $tmp = str_replace("[field:class]",'',$tmp);
                }
                $str .= $tmp;
            }
            return $str;
        }else{
            return '';
        }
    }
    

}
