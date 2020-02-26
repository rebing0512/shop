<?php
/**
 * 分类model
 *
 *
 *
 
 */
defined('TTShop') or exit('Access Invalid!');
class ncms_categoryModel extends Model {
    public function __construct() {
        parent::__construct('ncms_category');
    }

     /**
     * 添加栏目
     * @param type $data 页面提交数据
     * @return boolean]
     */
    public function addCategory($params) {
        $param = array();
        $param = $params['info'];
        $param['setting'] =serialize($params['setting']);
        $param['image'] =$params['image'];
        $param['ismenu'] = $params['ismenu'];

         //终极栏目设置
        if (!isset($param['child'])) {
            $data['child'] = 1;
        }

        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }

            $result = Db::insert('ncms_category',$tmp);
            return $result;
        }else {
            return false;
        }

    }

     /**
     * 编辑栏目
     * @param type $data 页面提交数据
     * @return boolean]
     */
    public function editCategory($params,$catid) {
        $param = array();
        $param = $params['info'];
        $param['setting'] =serialize($params['setting']);
        $param['image'] =$params['image'];
        $param['ismenu'] = $params['ismenu'];
       
         //终极栏目设置
        if (!isset($param['child'])) {
            $data['child'] = 1;
        }

        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }

            $result = Db::update('ncms_category',$tmp," catid = {$catid}");
            return $result;
        }else {
            return false;
        }

    }

    
    /**
     * 获取子栏目ID列表
     * @staticvar type $categorys 静态变量 栏目数据
     * @param type $catid 栏目id
     * @return string 返回栏目子列表，以逗号隔开
     */
    public function getArrchildid($catid) {
        if (!$this->categorys) {
            $this->categorys = Model('ncms_category')->field('catid,parentid')->select();
        }
        $arrchildid = $catid;
        if (is_array($this->categorys)) {
            foreach ($this->categorys as $id => $cat) {
                if ($cat['parentid'] && $id != $catid && $cat['parentid'] == $catid) {
                    $arrchildid .= ',' . $this->getArrchildid($id);
                }
            }
        }
        return $arrchildid;
    }


    /**
     * 删除栏目，如果有子栏目，会删除对应的子目录
     * @param type $catid 可以是数组，可以是栏目id
     * @return boolean
     */
    public function deleteCatid($catid) {
        if (!$catid) {
            return false;
        }
       
        
        $where = array();
        //取得子栏目
        
        $where['table'] = 'ncms_category';
        $where['where'] = " and parentid ={$catid}";
        $catList =Db::select($where);
        if($catList){
            return false;
           
        }else{
           $rese =  Db::delete('ncms_category',"catid = {$catid}");
           if($rese){
                return true;
           }else{
                return false;
           }
            
        }
       
    }


    /**
     * 取到当前分类和当前分类子类下新闻
     * @param type $table 表名
     * @param type $catid 可以是栏目id
     * @param type $field 查询字段
     * @param type $limit 查询条数
     * @param type $order 排序
     */
    public function getPncmslist($table,$catid,$where,$field='*',$limit=10,$order='id DESC',$isthumb='') {
        $catelist = array();
        $catelist = Model()->table('ncms_category')->where(array('parentid'=>$catid))->field('catid')->select();

       if(is_array($catelist) && !empty($catelist)){ 
            foreach($catelist as $vt){
                $vtlist .= $vt['catid'].',';
            }
        }
        $vtlist = $vtlist.$catid;
  
        $cons = empty($where) ? "catid IN({$vtlist})":"catid IN({$vtlist}) and {$where}";
     
        $article_list = Model()->table("{$table}")->where($cons)->field($field)->limit($limit)->order($order)->select();
     
        if(!empty($isthumb) && is_array($article_list) && !empty($article_list)){

            foreach($article_list as &$vhy){
                    if ($vhy[$isthumb]!= '') {
                       $vhy[$isthumb] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$vhy[$isthumb];
                    }else{
                       $vhy[$isthumb] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_article.png';
                    }
                }
      
        }
        
        return $article_list;
       
    }

    /**
     * 取到当前分类和当前分类子类下新闻 主表 ，附表
     * @param type $table 表名
     * @param type $catid 可以是栏目id
     * @param type $field 查询字段
     * @param type $limit 查询条数
     * @param type $order 排序
     */
    public function getPncmslists($table,$table1,$catid,$where,$field='*',$limit=10,$order='',$isthumb='') {
        $catelist = array();
        $catelist = Model()->table('ncms_category')->where(array('parentid'=>$catid))->field('catid')->select();

       if(is_array($catelist) && !empty($catelist)){ 
            foreach($catelist as $vt){
                $vtlist .= $vt['catid'].',';
            }
        }
        $vtlist = $vtlist.$catid;
  
        $cons = empty($where) ? "{$table}.catid IN({$vtlist})":"{$table}.catid IN({$vtlist}) and {$where}";
     
        $article_list = Model()->table("{$table},{$table1}")->where($cons)->field($field)->limit($limit)->order($order)->select();
     
        if(!empty($isthumb) && is_array($article_list) && !empty($article_list)){

            foreach($article_list as &$vhy){
                    if ($vhy[$isthumb]!= '') {
                       $vhy[$isthumb] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$vhy[$isthumb];
                    }else{
                       $vhy[$isthumb] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_article.png';
                    }
                }
      
        }
        
        return $article_list;
       
    }
    //获得单条文章

   
    public function getncmsone($table,$catid,$where,$field='*',$order='id DESC',$isthumb='') {
        $catelist = array();
        $catelist = Model()->table('ncms_category')->where(array('parentid'=>$catid))->field('catid')->select();

       if(is_array($catelist) && !empty($catelist)){ 
            foreach($catelist as $vt){
                $vtlist .= $vt['catid'].',';
            }
        }
        $vtlist = $vtlist.$catid;
  
        $cons = empty($where) ? "catid IN({$vtlist})":"catid IN({$vtlist}) and {$where}";
     
        $article_list = Model()->table("{$table}")->where($cons)->field($field)->limit(1)->order($order)->find();
        
        if(!empty($isthumb) && !empty($article_list)){

          
            if ($article_list[$isthumb]!= '') {
               $article_list[$isthumb] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$article_list[$isthumb];
            }else{
               $article_list[$isthumb] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_article.png';
            }
                
      
        }
        
        return $article_list;
       
    }

}
