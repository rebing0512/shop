<?php


/**
 * 获取栏目相关信息
 * @param type $catid 栏目id
 * @param type $field 返回的字段，默认返回全部，数组
 * @param type $newCache 是否强制刷新
 * @return boolean
 */
function getCategory($catid, $field = '') {
    if (empty($catid)) {
        return false;
    }
   
    //读取数据
    $cache = Model()->table('ncms_category')->where(array('catid' => $catid))->find();
    $cache['setting'] = unserialize($cache['setting']);
    if ($field) {
        //支持var.property，不过只支持一维数组
        if (false !== strpos($field, '.')) {
            $vars = explode('.', $field);
            return $cache[$vars[0]][$vars[1]];
        } else {
            return $cache[$field];
        }
    } else {
        return $cache;
    }
}