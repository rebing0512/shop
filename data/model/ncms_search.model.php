<?php
/**
 * 模型搜索
 *
 *
 *
 
 */
defined('TTShop') or exit('Access Invalid!');
class ncms_searchModel extends Model{

    public function __construct(){
        parent::__construct('ncms_search');
    }


       /**
     * 列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getList($condition,$page=''){
        $condition_str = $this->_condition($condition);
        $param = array();
        $param['table'] = 'ncms_search';
        $param['where'] = $condition_str;
        $param['field'] = empty($condition['field'])?'*':$condition['field'];;
        $param['limit'] = $condition['limit'];
        $param['order'] = (empty($condition['order'])?'searchid desc':$condition['order']);
        $result = Db::select($param,$page);
        return $result;
    }
   /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

    
        if ($condition['searchid'] != ''){
            $condition_str .= " and ncms_search.searchid = '". $condition['searchid'] ."'";
        }
        if ($condition['ac_ids'] != ''){
            $condition_str .= " and ncms_search.searchid in(". $condition['ac_ids'] .")";
        }

        if ($condition['like_title'] != ''){
            $condition_str .= " and ncms_search.title like '%". $condition['like_title'] ."%'";
        }
      
        return $condition_str;
    }


    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isExist($condition) {
        $result = $this->getOne($condition);
        if(empty($result)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function save($param){
        return $this->insert($param);
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function saveAll($param){
        return $this->insertAll($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function modify($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function drop($condition){
        return $this->where($condition)->delete();
    }

        //清空表
    public function emptyTable() {
        //删除旧的搜索数据
        $DB_PREFIX = DBPRE;
         Db::execute("DELETE FROM `{$DB_PREFIX}ncms_search`");
         Db::execute("ALTER TABLE `{$DB_PREFIX}ncms_search` AUTO_INCREMENT=1");
    }




}
