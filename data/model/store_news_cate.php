<?php
/**
 * 店铺文章分类管理
 *
 *
 *
 */
defined('TTShop') or exit('Access Invalid!');

class store_news_cateModel extends Model {
    public function __construct() {
        parent::__construct('store_news_cate');
    }
    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getStore_newsList($condition,$page=''){
        $condition_str = $this->_condition($condition);
        $param = array();
        $param['table'] = 'store_news_cate';
        $param['where'] = $condition_str;
        $param['field'] = empty($condition['field'])?'*':$condition['field'];;
        $param['limit'] = $condition['limit'];
        $param['order'] = (empty($condition['order'])?'cate_sort asc,id desc':$condition['order']);
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

       
        if ($condition['id'] != ''){
            $condition_str .= " and store_news_cate.id = '". $condition['id'] ."'";
        }
        if ($condition['ids'] != ''){
            $condition_str .= " and store_news_cate.id in(". $condition['ids'] .")";
        }
       

        return $condition_str;
    }

    /**
     * 取单个内容
     *
     * @param int $id ID
     * @return array 数组类型的返回结果
     */
    public function getOneStore_news($id){
        if (intval($id) > 0){
            $param = array();
            $param['table'] = 'store_news_cate';
            $param['field'] = 'id';
            $param['value'] = intval($id);
            $result = Db::getRow($param);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function add($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('store_news_cate',$tmp);
           
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 更新信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function updates($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $where = " id = '". $param['id'] ."'";
            $result = Db::update('store_news_cate',$tmp,$where);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 删除
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function del($id){
        if (intval($id) > 0){
            $where = " id = '". intval($id) ."'";
            $result = Db::delete('store_news_cate',$where);
            return $result;
        }else {
            return false;
        }
    }


    /**
     * 取得文章数量
     * @param unknown $condition
     */
    public function getCount($condition = array()) {
        return $this->table('store_news_cate')->where($condition)->count();
    }
}
