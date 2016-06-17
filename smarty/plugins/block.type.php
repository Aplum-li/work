<?php
/**
 * 获取指定栏目信息
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty [smarty对象]
 * @param  [type] &$repeat  [description]
 * @return [type]           [description]
 */
function smarty_block_type($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        global $model,$db,$listdir;
        $str = '';
        //栏目id
        $typeid = isset($params['typeid']) ? intval($params['typeid']) : '';
        if (!$typeid) {
            $str = '请传入栏目id';
            return $str;
        }

        //获取栏目类型 分当前栏目和顶级栏目 默认为当前栏目
        $type = isset($params['type']) ? trim($params['type']) : '';
        //栏目标题长度
        $typenamelen = isset($params['typenamelen']) ? intval($params['typenamelen']) : '';
        //栏目摘要长度
        $typedesclen = isset($params['typedesclen']) ? intval($params['typedesclen']) : '';
        //栏目内容长度
        $typecontentlen = isset($params['typecontentlen']) ? intval($params['typecontentlen']) : '';
        if ($type == 'top') {
            $typeinfo = $model -> GetTypeTopInfo($typeid);
        }else{
            $typeinfo = $model -> GetTypeInfo($typeid);
        }
        

        if ($typeinfo) {
            $tmp = $content;
            if (!$typeinfo['typelink']) {
	            $typeinfo['typelink'] = $model->getlisturl($typeinfo['id']);
            }
            //取得字段名
            $fieldName = array_keys($typeinfo);
            foreach ($fieldName as $name) {
                $res = $typeinfo[$name];
                if ($name == 'typename' && $typenamelen) {
                    $res = getstr($res,$typenamelen,false);
                }
                if ($name == 'typedesc' && $typedesclen) {
                    $res = getstr($res,$typedesclen,false);
                }
                if ($name == 'typecontent' && $typecontentlen) {
                    $res = getstr($res,$typecontentlen,false);
                }
                $tmp = preg_replace("/\[field.".$name."\]/",$res,$tmp);
            }
            $str .= $tmp;
            return $str;
        }else{
            return '暂无内容！！！';
        }
    }
    

}
