<?php
/**
 * 调用qq
 * @param  [type] $params   [参数]
 * @param  [type] $content  [标签]
 * @param  [type] $smarty [smarty对象]
 * @param  [type] &$repeat  [description]
 * @return [type]           [description]
 */
function smarty_block_qq($params, $content, $smarty, &$repeat) {
    if (!$repeat) {
        $qqs = loadConfig('web_qq_num');
        if (strpos($qqs, ' ')) {
            $qqArr = explode(' ', $qqs);
        }else{
            $qqArr[] = $qqs;
        }
        $str = '';
        $i = 1;
        foreach ($qqArr as $key => $value) {
            $tmp = $content;
            $tmp = preg_replace("/\[field:qq\]/",$value,$tmp);
            $tmp = preg_replace("/\[field:i\]/",$i,$tmp);
            $str .= $tmp;
            $i++;
        }
        
        return $str;
    }
    

}
