<?php
/**
 * 会员店铺
 *
 *
 *
 
 */



defined('TTShop') or exit('Access Invalid!');

class show_storeControl extends BaseStoreControl {
    public function __construct(){
        parent::__construct();
    }
 public function indexOp(){
       if(!$this->store_decoration_only) {
            $goods_class = Model('goods');

            $condition = array();
            $condition['store_id'] = $this->store_info['store_id'];

            $model_goods = Model('goods'); // 字段
            $fieldstr = "goods_id,goods_commonid,goods_name,goods_jingle,store_id,store_name,goods_price,goods_promotion_price,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,goods_promotion_type";
            //得到最新12个商品列表
            if (C('dbdriver') == 'oracle') {
                $oracle_fields = array();
                $fields = explode(',', $fields);
                foreach ($fields as $val) {
                    $oracle_fields[] = 'min('.$val.') '.$val;
                }
                $fields = implode(',', $oracle_fields);
            }
            $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
            $new_goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 8, 'goods_id desc', 0, 'goods_commonid', false, $count);

            $condition['goods_commend'] = 1;
            //得到12个推荐商品列表
            $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
            $recommended_goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 8, 'goods_id desc', 0, 'goods_commonid', false, $count);
            
            $goods_list = $this->getGoodsMore($new_goods_list, $recommended_goods_list);
            Tpl::output('new_goods_list',$goods_list[1]);
            Tpl::output('recommended_goods_list',$goods_list[2]);

            //幻灯片图片
            if($this->store_info['store_slide'] != '' && $this->store_info['store_slide'] != ',,,,'){
                Tpl::output('store_slide', explode(',', $this->store_info['store_slide']));
                Tpl::output('store_slide_url', explode(',', $this->store_info['store_slide_url']));
            }
        } else {
            Tpl::output('store_decoration_only', $this->store_decoration_only);
        }

        Tpl::output('page','index');
        Tpl::showpage('index');
    }

      public function mallOp(){
        if(!$this->store_decoration_only) {
            $goods_class = Model('goods');

            $condition = array();
            $condition['store_id'] = $this->store_info['store_id'];

            $model_goods = Model('goods'); // 字段
            $fieldstr = "goods_id,goods_commonid,goods_name,goods_jingle,store_id,store_name,goods_price,goods_promotion_price,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,goods_promotion_type";
            //得到最新12个商品列表
            if (C('dbdriver') == 'oracle') {
                $oracle_fields = array();
                $fields = explode(',', $fields);
                foreach ($fields as $val) {
                    $oracle_fields[] = 'min('.$val.') '.$val;
                }
                $fields = implode(',', $oracle_fields);
            }
            $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
            $new_goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 12, 'goods_id desc', 0, 'goods_commonid', false, $count);

            $condition['goods_commend'] = 1;
            //得到12个推荐商品列表
            $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
            $recommended_goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 12, 'goods_id desc', 0, 'goods_commonid', false, $count);
            
            $goods_list = $this->getGoodsMore($new_goods_list, $recommended_goods_list);
            Tpl::output('new_goods_list',$goods_list[1]);
            Tpl::output('recommended_goods_list',$goods_list[2]);

            //幻灯片图片
            if($this->store_info['store_slide'] != '' && $this->store_info['store_slide'] != ',,,,'){
                Tpl::output('store_slide', explode(',', $this->store_info['store_slide']));
                Tpl::output('store_slide_url', explode(',', $this->store_info['store_slide_url']));
            }
        } else {
            Tpl::output('store_decoration_only', $this->store_decoration_only);
        }

        Tpl::output('page','mall');
        Tpl::showpage('mall');
    }

 
    private function getGoodsMore($goods_list1, $goods_list2 = array()) {
        if (!empty($goods_list2)) {
            $goods_list = array_merge($goods_list1, $goods_list2);
        } else {
            $goods_list = $goods_list1;
        }
        // 商品多图
        if (!empty($goods_list)) {
            $commonid_array = array(); // 商品公共id数组
            foreach ($goods_list as $value) {
                $commonid_array[] = $value['goods_commonid'];
            }
            $commonid_array = array_unique($commonid_array);

            // 商品多图
            $goodsimage_more = Model('goods')->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)));

            foreach ($goods_list1 as $key => $value) {
                // 商品多图
                foreach ($goodsimage_more as $v) {
                    if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $v['is_default'] == 1) {
                        $goods_list1[$key]['image'][] = $v;
                    }
                }
            }

            if (!empty($goods_list2)) {
                foreach ($goods_list2 as $key => $value) {
                    // 商品多图
                    foreach ($goodsimage_more as $v) {
                        if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $v['is_default'] == 1) {
                            $goods_list2[$key]['image'][] = $v;
                        }
                    }
                }
            }
        }
        return array(1=>$goods_list1,2=>$goods_list2);
    }

    public function show_articleOp() {
        //判断是否为导航页面
        $model_store_navigation = Model('store_navigation');
        $store_navigation_info = $model_store_navigation->getStoreNavigationInfo(array('sn_id' => intval($_GET['sn_id'])));
        if (!empty($store_navigation_info) && is_array($store_navigation_info)){
            Tpl::output('store_navigation_info',$store_navigation_info);
            Tpl::showpage('article');
        }
    }

    /**
     * 全部商品
     */
    public function goods_allOp(){

        $condition = array();
        $condition['store_id'] = $this->store_info['store_id'];
        if (trim($_GET['inkeyword']) != '') {
            $condition['goods_name'] = array('like', '%'.trim($_GET['inkeyword']).'%');
        }

        // 排序
        $order = $_GET['order'] == 1 ? 'asc' : 'desc';
        switch (trim($_GET['key'])){
            case '1':
                $order = 'goods_id '.$order;
                break;
            case '2':
                $order = 'goods_promotion_price '.$order;
                break;
            case '3':
                $order = 'goods_salenum '.$order;
                break;
            case '4':
                $order = 'goods_collect '.$order;
                break;
            case '5':
                $order = 'goods_click '.$order;
                break;
            default:
                $order = 'goods_id desc';
                break;
        }

        //查询分类下的子分类
        if (intval($_GET['stc_id']) > 0){
            $condition['goods_stcids'] = array('like', '%,' . intval($_GET['stc_id']) . ',%');
        }

        $this->_getGoodsList($condition, $order);
        
        $stc_class = Model('store_goods_class');
        $stc_info = $stc_class->getStoreGoodsClassInfo(array('stc_id' => intval($_GET['stc_id'])));
        Tpl::output('stc_name',$stc_info['stc_name']);
        Tpl::output('page','index');

        Tpl::showpage('goods_list');
    }
    
    /**
     * 加价购活动列表
     */
    function cou_goodsOp() {
        $couId = (int) $_GET['cou_id'];
        $couInfo = Model('p_cou')->getActiveCouInfoById($couId, $this->store_info['store_id']);
        if (empty($couInfo)) {
            showDialog('店铺加价购活动不存在或未开启');
        }
    
        $tablePre = C('tablepre');
        $condition[] = array(
            'exp',
            "goods_id in (select sku_id from {$tablePre}p_cou_sku where cou_id = {$couId})",
        );
    
        Tpl::output('couInfo', $couInfo);
        
        $this->_getGoodsList($condition);

        Tpl::output('page','index');
        
        Tpl::showpage('goods_list.cou');
    }
    
    /**
     * 满即送活动列表
     */
    function mansong_goodsOp() {
        $this->_getGoodsList(array('store_id' => $this->store_info['store_id']));
        Tpl::output('page','index');

        $mansong_info = Model('p_mansong')->getMansongInfoByStoreID($this->store_info['store_id']);
        Tpl::output('mansong_info', $mansong_info);
        Tpl::showpage('goods_list.mansong');
    }

    /**
     * ajax获取动态数量
     */
    function ajax_store_trend_countOp(){
        $count = Model('store_sns_tracelog')->getStoreSnsTracelogCount(array('strace_storeid'=>$this->store_info['store_id']));
        echo json_encode(array('count'=>$count));exit;
    }
    /**
     * ajax 店铺流量统计入库
     */
    public function ajax_flowstat_recordOp(){
        $store_id = intval($_GET['store_id']);
        if ($store_id <= 0 || $_SESSION['store_id'] == $store_id){
            echo json_encode(array('done'=>true,'msg'=>'done')); die;
        }
        //确定统计分表名称
        $last_num = $store_id % 10; //获取店铺ID的末位数字
        $tablenum = ($t = intval(C('flowstat_tablenum'))) > 1 ? $t : 1; //处理流量统计记录表数量
        $flow_tablename = ($t = ($last_num % $tablenum)) > 0 ? "flowstat_$t" : 'flowstat';
        //判断是否存在当日数据信息
        $stattime = strtotime(date('Y-m-d',time()));
        $model = Model('stat');
        //查询店铺流量统计数据是否存在
        $store_exist = $model->getoneByFlowstat($flow_tablename,array('stattime'=>$stattime,'store_id'=>$store_id,'type'=>'sum'));
        if ($_GET['act_param'] == 'goods' && $_GET['op_param'] == 'index'){//统计商品页面流量
            $goods_id = intval($_GET['goods_id']);
            if ($goods_id <= 0){
                echo json_encode(array('done'=>false,'msg'=>'done')); die;
            }
            $goods_exist = $model->getoneByFlowstat($flow_tablename,array('stattime'=>$stattime,'goods_id'=>$goods_id,'type'=>'goods'));
        }
        //向数据库写入访问量数据
        $insert_arr = array();
        if($store_exist){
            $model->table($flow_tablename)->where(array('stattime'=>$stattime,'store_id'=>$store_id,'type'=>'sum'))->setInc('clicknum',1);
        } else {
            $insert_arr[] = array('stattime'=>$stattime,'clicknum'=>1,'store_id'=>$store_id,'type'=>'sum','goods_id'=>0);
        }
        if ($_GET['act_param'] == 'goods' && $_GET['op_param'] == 'index'){//已经存在数据则更新
            if ($goods_exist){
                $model->table($flow_tablename)->where(array('stattime'=>$stattime,'goods_id'=>$goods_id,'type'=>'goods'))->setInc('clicknum',1);
            } else {
                $insert_arr[] = array('stattime'=>$stattime,'clicknum'=>1,'store_id'=>$store_id,'type'=>'goods','goods_id'=>$goods_id);
            }
        }
        if ($insert_arr){
            $model->table($flow_tablename)->insertAll($insert_arr);
        }
        echo json_encode(array('done'=>true,'msg'=>'done'));
    }
    
    /**
     * 获取商品列表
     * @param unknown $condition
     * @param unknown $order
     */
    private function _getGoodsList($condition, $order = 'goods_id desc') {
        $model_goods = Model('goods');
        $fieldstr = "goods_id,goods_commonid,goods_name,goods_jingle,store_id,store_name,goods_price,goods_promotion_price,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,goods_promotion_type";
        //得到最新12个商品列表
        if (C('dbdriver') == 'oracle') {
            $oracle_fields = array();
            $fields = explode(',', $fields);
            foreach ($fields as $val) {
                $oracle_fields[] = 'min('.$val.') '.$val;
            }
            $fields = implode(',', $oracle_fields);
        }
        $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
        $recommended_goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 12, $order, 0, 'goods_commonid', false, $count);
        $recommended_goods_list = $this->getGoodsMore($recommended_goods_list);
        Tpl::output('recommended_goods_list',$recommended_goods_list[1]);
        loadfunc('search');
        
        //输出分页
        Tpl::output('show_page',$model_goods->showpage('5'));
    }

    //获取相册列表
    public function ablum_listOp(){
      $store_id = intval($_GET['store_id']);  
     $model_album = Model('store_album');

        /**
         * 验证是否存在默认相册
         */
        $return = $model_album->checkAlbum(array('album_aclass.store_id'=>$store_id,'is_default'=>'1'));
        if(!$return){
            $album_arr = array();
            $album_arr['aclass_name'] = Language::get('album_default_album');
            $album_arr['store_id'] = $_SESSION['store_id'];
            $album_arr['aclass_des'] = '';
            $album_arr['aclass_sort'] = '255';
            $album_arr['aclass_cover'] = '';
            $album_arr['upload_time'] = time();
            $album_arr['is_default'] = '1';
            $model_album->addClass($album_arr);
        }

        /**
         * 相册分类
         */
        $param = array();
        $param['album_aclass.store_id'] = $store_id;
        $param['order']                 = 'aclass_sort desc';
    
        $aclass_info = $model_album->getClassList($param,$page);
        // Tpl::output('show_page',$page->show());

        Tpl::output('aclass_info',$aclass_info);
        Tpl::showpage('store_ablum.list');
    }

    //相册详情展示
    public function ablum_detailsOp(){
        if(empty($_GET['id'])){
            showMessage(Language::get('album_parameter_error'),'','html','error');
        }
        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');

//  }
//   "title": "", //相册标题
//   "id": 123, //相册id
//   "start": 0, //初始显示的图片序号，默认0
//   "data": [   //相册包含的图片，数组格式
//     {
//       "alt": "图片名",
//       "pid": 666, //图片id
//       "src": "", //原图地址
//       "thumb": "" //缩略图地址
//     }
//   ]
// }

        /**
         * 相册信息
         */
        $param = array();
        $param['field']     = array('aclass_id','store_id');
        $param['value']     = array(intval($_GET['id']),$_GET['store_id']);
        $class_info         = $model_album->getOneClass($param);
  

        /**
         * 图片列表
         */
        $param = array();
        $param['aclass_id']         = intval($_GET['id']);
        $param['store_id']          = intval($_GET['store_id']);
    
        $pic_list                   = $model_album->getPicList($param);
        $list = array();

        $list['title'] = $class_info['aclass_name'];
        $list['id'] = $class_info['aclass_id'];
        $list['start'] =0;
        // $list['data'] = 
       
        foreach ($pic_list as $key=>$value) {
            $list['data'][$key]['alt'] = $value['apic_name'];
            $list['data'][$key]['pid'] = $value['apic_id'];
            $list['data'][$key]['src'] = str_replace("_240","",sthumb($value));
            $list['data'][$key]['thumb'] =sthumb($value);
        }
        echo json_encode($list);   
    }

    public function article_listOp(){
            Language::read('home_article_index');
        $lang   = Language::getLangContent();
        $store_id = intval($_GET['store_id']);
         /**
         * 分类导航
         */
        $nav_link = array(
            array(
                'title'=>$lang['homepage'],
                'link'=>SHOP_SITE_URL
            ),
            array(
                    'title'=>"资讯首页",
                    'link' => urlShop('article', 'index')
            ),
            array(
                'title'=>$article_class['ac_name']
            )
        );

        Tpl::output('nav_link_list',$nav_link);
         /**
         * 文章列表
         */
        $store_news = Model('store_news');
        $store_id = intval($_GET['store_id']);
        $s_catid = intval($_GET['id'])?intval($_GET['id']):'';
        $where = array();
        $where['store_id'] = $store_id;
        $where['s_status'] = 1;
        $where['s_catid'] = $s_catid;

        $page= new Page();
        $page->setEachNum(10);
        $news_list = $store_news->getStore_newsList($where, $page);
        if(!empty($news_list) && is_array($news_list)){
            foreach ($news_list as &$value) {
                $catename = Model()->table('store_news_cate')->where("id ={$value['s_catid']} and store_id = {$store_id}")->find();
                $value['cate_name'] = $catename['cate_name'];
                if ( !file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $value['s_thumb']) ) {
                    $value['s_thumb'] =  UPLOAD_SITE_URL.'/'.ATTACH_COMMON.'/'.C('default_goods_image');
                }else{
                    $value['s_thumb'] = UPLOAD_SITE_URL . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $value['s_thumb'];
                }
            }
        }
        Tpl::output('news_list', $news_list);
        Tpl::output('show_page', $page->show());
        //获取最新推荐
         $new_list = $store_news->getStore_newsList(array('order'=>'s_click DESC','limit'=>6));
         Tpl::output('new_list',$new_list);
        //获取推荐商品
        $tuijian = Model('goods')->where(array('store_id'=>$store_id,"goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_edittime desc")->select();
        Tpl::output('tuijian',$tuijian);
        //资讯分类

        $rs = Model()->table('store_news_cate')->where(array('store_id'=>$store_id,'cate_display'=>0))->select();
        Tpl::output('cate_list',$rs);


        Tpl::showpage('store_article.list');
    }

     public function article_detalisOp(){
            Language::read('home_article_index');
        $lang   = Language::getLangContent();
        $store_id = intval($_GET['store_id']);
        $id = intval($_GET['id']);
         /**
         * 分类导航
         */
        $nav_link = array(
            array(
                'title'=>$lang['homepage'],
                'link'=>SHOP_SITE_URL
            ),
            array(
                    'title'=>"资讯首页",
                    'link' => urlShop('article', 'index')
            ),
            array(
                'title'=>$article_class['ac_name']
            )
        );

        Tpl::output('nav_link_list',$nav_link);
        Model()->table('store_news')->where(array('id'=> intval($_GET['id'])))->update(array('s_click'=>array('exp', 's_click + 1')));

         /**
         * 文章详情
         */
        $news_info = Model('store_news')->where(array('store_id' => $store_id,'id'=>$id))->find();
        $cate_name = Model()->table('store_news_cate')->where("id ={$news_info['s_catid']} and store_id = {$news_info['store_id']}")->find();
        $news_info['cate_name'] = $cate_name['cate_name'];
        Tpl::output('news_info',$news_info);

        $where = array();
        $where['store_id'] = $store_id;
        $where['s_status'] = 1;
        $article_list =Model('store_news')->getStore_newsList($where);

        /**
         * 寻找上一篇与下一篇
         */
        $pre_article    = $next_article = array();
        if(!empty($article_list) && is_array($article_list)){
            $pos    = 0;
            foreach ($article_list as $k=>$v){
                if($v['id'] == $article['id']){
                    $pos    = $k;
                    break;
                }
            }
            if($pos>0 && is_array($article_list[$pos-1])){
                $pre_article    = $article_list[$pos-1];
            }
            if($pos<count($article_list)-1 and is_array($article_list[$pos+1])){
                $next_article   = $article_list[$pos+1];
            }
        }

        Tpl::output('pre_article',$pre_article);
        Tpl::output('next_article',$next_article);

         //获取最新推荐
         $new_list = Model('store_news')->getStore_newsList(array('order'=>'id DESC','limit'=>6));
        Tpl::output('new_list',$new_list);
        //获取最热推荐
         $hot_list = Model('store_news')->getStore_newsList(array('order'=>'s_click DESC','limit'=>6));
        Tpl::output('hot_list',$hot_list);
        //获取推荐商品
        $tuijian = Model('goods')->where(array('store_id'=>$store_id,"goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_edittime desc")->select();
        Tpl::output('tuijian',$tuijian);
        //资讯分类

        $rs = Model()->table('store_news_cate')->where(array('store_id'=>$store_id,'cate_display'=>0))->select();
        Tpl::output('cate_list',$rs);

        Tpl::showpage('store_article.detalis');
    }
}
