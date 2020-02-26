<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class indexControl extends mobileHomeControl{

    public function testOp()
    {
        Tpl::setLayout('null_layout');
        Tpl::showpage('test');
    }

    public function indexOp(){
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('core_category', $category);

        $client = self::getPlatform();

        Tpl::output('client',$client);
        //$web_seo = C('site_name');

        $condition = array();
        $condition['h_type'] = $_SESSION['__ccid'];

        foreach ($category['result']['category'] as $item){
            if ($condition['h_type'] == $item['id']){
                Tpl::output('web_seo',$item['name']);
            }
        }

        // -------- 首页筛选商品分类
        $arr = array();
        $model_list = Model('recommend')->where($condition)->order('sort asc')->limit(4)->select();
        //$list = explode(',',$model_list['mb_recommend']);
        //unset($list[5]);
        foreach ($model_list as $_ik=>$_ic) {
            $arr[] = "<a class='index-category' data-ik=\"{$_ic['id']}\" href='javascript:void(0);'>{$_ic['name']}</a>";
        }
        Tpl::output('index_category',implode('<span>|</span>', $arr));
        unset($arr);
        // -------- 首页筛选商品分类 end

        // 获取首页推荐
        # 商品
        $goods = Model()->table('index_recommend_goods,goods,recommend')->join('left')->on('index_recommend_goods.rec_goods_id=goods.goods_id,index_recommend_goods.rec_gc_id=recommend.id')->field('goods.*,index_recommend_goods.rec_gc_id')->where(['recommend.h_type'=>$_SESSION['__ccid']])->order('index_recommend_goods.sort asc')->limit(1000)->select();
        # 店铺
//        $stores = Model()->table('index_recommend_store,store,member')->join('left')->on('index_recommend_store.store_id=store.store_id,store.member_id=member.member_id')->where($condition)->order('index_recommend_store.sort asc')->field('store.*,member.member_avatar')->limit(4)->select();
        # 上下广告
        $topslide = Model()->table('index_recommend_topslide')->order('sort asc,id desc')->where($condition,array(
            'rtype' => array('in',['ad','bottom','middle'])
        ))->select();
        //最下侧商品推荐
        $goods_recommend = Model()->table('goods_recommend,goods')->join('left')->on('goods_recommend.rec_goods_id=goods.goods_id')->where($condition)->order('goods_recommend.rec_id asc')->field('goods.*')->limit(4)->select();
        //var_dump($goods_recommend);exit;
        // 整理推荐
        $slides = array();
        # 上下广告
        foreach ($topslide as $slide) {
            $slides[$slide['rtype']][] = $slide;
        }
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('core_category', $category);

        Tpl::output('site_logo',UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.C('site_logo'));
        Tpl::output('site_name',C('site_name'));
        Tpl::output('intro',C('microshop_seo_description'));
        //首页配置读取

        $config = Model('indexconfig')->where($condition)->select();
        Tpl::output('config',$config);

        Tpl::output('goods',$goods);
        Tpl::output('stores',$stores=[]);
        Tpl::output('slides',$slides);
        Tpl::output('goods_recommend',$goods_recommend);

        Tpl::showpage('index');
    }

    public function shopcategoryOp(){

        if(!empty($_GET['category_id'])){
            $category_id = $_GET['category_id'];
            $dataGet = explode('-',$category_id);
            if(count($dataGet)==3){
                $info_type = $dataGet[0];
                $_GET['type_id'] = $dataGet[1];
                $_GET['__cid'] = $dataGet[2];
            }
        }

        //分类的类型
        $arr_fenlei = array();
        $arr_fenlei[1] = array(
            'id'=>1,
            'name'=>'横图信息',
            'opname' => 'crafstman'
        );
        $arr_fenlei[2] = array(
            'id'=>2,
            'name'=>'圆图信息',
            'opname' => 'master'
        );

        $opName = $arr_fenlei[$info_type]['opname']."Op";
        //die($opName);

        //var_dump($_GET);
        //die();
        $this->$opName();

    }

    /*
     * 巧匠营
     * */

    public function crafstmanOp()
    {
        $model = Model('appraisal');
        $order = 'sort asc';
        $condition = array();
        $condition['h_type'] = $_GET['__cid']?:($_SESSION['__ccid']);
		if(!empty($_GET['type_id'])){
            $condition['info_type_id'] = intval($_GET['type_id']);
		}else{
			die("配置参数有错误！");
		}
        $condition['type'] = 2;
        $mark = $model->where($condition)->order($order)->find();
        Tpl::output('mark',$mark);
        $condition['type'] = 1;
        $main = $model->where($condition)->order($order)->find();
        Tpl::output('main',$main);
        $condition['type'] = 0;
        $informaiton = $model->where($condition)->order($order)->select();
        Tpl::output('client',$this->judge_client());
        Tpl::output('information',$informaiton);
        Tpl::output('web_seo',$main['web_title']);
        Tpl::showpage('crafstman');
    }

    /*
     * 大师坊
     * */

    public function masterOp()
    {
        //var_dump($_GET);
        //die();

        $model = Model('collection');
        $order = 'sort asc';
        $condition = array();
        $condition['h_type'] = $_GET['__cid']?:($_SESSION['__ccid']);
		if(!empty($_GET['type_id'])){
            $condition['info_type_id'] = intval($_GET['type_id']);
		}else{
			die("配置参数有错误！");
		}
        //var_dump($condition);
        //die();

        $condition['type'] = 2;
        $mark = $model->where($condition)->order($order)->find();
        Tpl::output('mark',$mark);
        $condition['type'] = 1;
        $main = $model->where($condition)->order($order)->find();
        Tpl::output('main',$main);
        $condition['type'] = 0;
        $informaiton = $model->where($condition)->order($order)->select();
        $level = [];
        if (!empty($informaiton)){
            foreach ($informaiton as $item){
                if ($item['level'] == 2){
                    $level['up'][] = $item;
                } elseif ($item['level'] == 1){
                    $level['middle'][] = $item;
                }
            }
        }
        Tpl::output('level',$level);
        Tpl::output('web_seo',$main['web_title']);
        Tpl::showpage('great_master');
    }

    /*
     * 广告加载
     */
    public function adv_ajaxOp(){
        $map = array();
        $post = $_REQUEST;
        $map['h_type'] = $_SESSION['__ccid'];
        $map['rtype'] = 'middle';
        $model_advs = Model('index_recommend_topslide');
        $adv_list = $model_advs->where($map)->order('sort asc')->page(4)->select();
        $page_count = $model_advs->gettotalpage();
        foreach ($adv_list as $key=>$value){
            $adv_list[$key]['url'] = $this->swiperLink($value);
        }
        output_data(array(
            'rec_advs_list_count' => count($adv_list),
            'rec_advs_list' => $adv_list,
        ), mobile_page($page_count));
    }

    public function swiperLink($slide)
    {

        $module = $action = $args = '';

        switch ($slide['type']) {
            case 'goods':
                $module = 'goods';
                $action = 'detail';
                $args = array('goods_id' => $slide['object']);
                return urlMobile($module, $action, $args);
                break;

            case 'store':
                $module = 'store';
                $action = 'index';
                $args = array('store_id' => $slide['object']);
                return urlMobile($module, $action, $args);
                break;

            case 'url':
                $args = $slide['object'];
                return $args;
                break;
        }
    }

        /*
         * 专题
         * */

    public function specialsOp(){

        $client = parent::judge_client();

        Tpl::output('client',$client);

        //$web_seo = C('site_name');

        $condition = array();
        $condition['type'] = $_GET['type_id'];

        //标题
        $web_seo = Model('recommend_type')->where('id ='.$_GET['type_id'])->find();
        Tpl::output('web_seo',$web_seo['name']);
        Tpl::output('info',$web_seo);

        // -------- 商品分类
        $arr = array();
        $model_list = Model('recommend_tag')->where($condition)->order('sort asc')->limit(4)->select();
        //$list = explode(',',$model_list['mb_recommend']);
        //unset($list[5]);
        $display = count($model_list)<=1?'hidden':'';
        Tpl::output('display',$display);

        foreach ($model_list as $_ik=>$_ic) {
            $arr[] = "<a class='index-category' data-ik=\"{$_ic['id']}\" href='javascript:void(0);'>{$_ic['name']}</a>";
        }
        Tpl::output('index_category',implode('<span>|</span>', $arr));
        unset($arr);
        $goods = Model()->table('recommend_tag,recommend_goods,goods')->join('right')->on('recommend_tag.id=recommend_goods.rec_gc_id,recommend_goods.rec_goods_id=goods.goods_id')->where($condition)->select();

        for ($i=0;$i<count($goods);$i++){
            if (empty($goods[$i]['goods_id'])){
                unset($goods[$i]);
            }
        }

        // -------- 商品分类 end

        // 获取首页推荐
        # 商品
        //$goods = Model()->table('index_recommend_goods,goods')->join('left')->on('index_recommend_goods.rec_goods_id=goods.goods_id')->field('goods.*,index_recommend_goods.rec_gc_id')->where(['goods.category_id'=>$_SESSION['__ccid']])->order('index_recommend_goods.rec_id asc')->limit(1000)->select();
        // 整理推荐
        $slides = array();
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('core_category', $category);

        Tpl::output('goods',$goods);
        Tpl::output('slides',$slides);
        Tpl::showpage('specials');
    }

    /*
     * 大师频道
     * */
    public function channelsOp()
    {
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);
        Tpl::showpage('channels');
    }

    /*
     * 珍品
     * */
    public function zhenpinOp()
    {
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);
        $model = Model();

        $store_id = $_POST['store_id'];

        Tpl::showpage('zhenpin');
    }


    /*
    *获取首页
    */
    public function ajax_index_dataOp(){
        $model_mb_special = Model('mb_special');
        $data = $model_mb_special->getMbSpecialIndex();
        $this->_output_special($data, $_GET['type']);
    }
    public function specialOp(){
        $web_seo = C('site_name')."-专题页";
        Tpl::output('web_seo',$web_seo);
        Tpl::showpage('special');
    }

     public function get_specialOp(){
         $model_mb_special = Model('mb_special');
        $data = $model_mb_special->getMbSpecialItemUsableListByID($_GET['special_id']);
        $this->_output_special($data, $_GET['type'], $_GET['special_id']);
    }
     /**
     * 输出专题
     */

    private function _output_special($data, $type = 'json', $special_id = 0, $datas=array()) {
        $model_special = Model('mb_special');

        if($_GET['type'] == 'html') {
            $html_path = $model_special->getMbSpecialHtmlPath($special_id);
            if(!is_file($html_path)) {
                ob_start();
                Tpl::output('list', $data);
                Tpl::showpage('mb_special');
                file_put_contents($html_path, ob_get_clean());
            }
            header('Location: ' . $model_special->getMbSpecialHtmlUrl($special_id));
            die;
        } else {
            $datas['list'] = $data;
            $datas['special_id'] = $special_id;
            $datas = $datas;
            output_data($datas);
        }
    }
    /**
     * 默认搜索词列表
     */
    public function search_key_listOp() {
        //热门搜索

        $list = @explode(',',C('hot_search'));
        if (!$list || !is_array($list)) {
            $list = array();
        }

        //历史搜索
        if (cookie('his_sh') != '') {
            $his_search_list = explode('~', cookie('his_sh'));
        }

        $data['list'] = $list;
        $data['his_list'] = is_array($his_search_list) ? $his_search_list : array();
        output_data($data);
    }

    /**
     * 热门搜索列表
     */
    public function search_hot_infoOp() {
                //热门搜索
        if (C('rec_search') != '') {
            $rec_search_list = @unserialize(C('rec_search'));
            $rec_value = array();
            foreach($rec_search_list as $v){
                $rec_value[] = $v['value'];
            }

        }
        output_data(array('hot_info'=>$result ? $rec_value : array()));
    }

    /**
     * 高级搜索
     */
    public function search_advOp() {
        $area_list = Model('area')->getAreaList(array('area_deep'=>1),'area_id,area_name');
        if (C('contract_allow') == 1) {
            $contract_list = Model('contract')->getContractItemByCache();
            $_tmp = array();$i = 0;
            foreach ($contract_list as $k => $v) {
                $_tmp[$i]['id'] = $v['cti_id'];
                $_tmp[$i]['name'] = $v['cti_name'];
                $i++;
            }
        }
        $tagarr = array (
                 0 =>
                array (
                  'name' => 'tag_none',
                  'zhname' => '无',
                  'val' => '1',
                ),
                1 =>
                array (
                  'name' => 'tag_new',
                  'zhname' => '新品上市',
                  'val' => '2',
                ),
                2 =>
                array (
                  'name' => 'tag_tuijian',
                  'zhname' => '热门推荐',
                  'val' => '3',
                ),
                3 =>
                array (
                  'name' => 'tag_temai',
                  'zhname' => '特卖专场',
                  'val' => '4',
                ),
                4 =>
                array (
                  'name' => 'tag_remai',
                  'zhname' => '超级热卖',
                  'val' => '5',
                ),
 /*                3 =>
                array (
                  'name' => 'tag_sale',
                  'zhname' => '特价',
                  'val' => '4',
                ),
               4 =>
                array (
                  'name' => 'tag_berserk',
                  'zhname' => '疯抢',
                  'val' => '5',
                ),
                5 =>
                array (
                  'name' => 'tag_real',
                  'zhname' => '推荐',
                  'val' => '6',
                ),
                6 =>
                array (
                  'name' => 'tag_zk',
                  'zhname' => '折扣',
                  'val' => '7',
                ),
                7 =>
                array (
                  'name' => 'tag_kb',
                  'zhname' => '口碑',
                  'val' => '8',
                ),   */

              );
        output_data(array('area_list'=>$area_list ? $area_list : array(),'contract_list'=>$_tmp,'tag_list'=>$tagarr));
    }

    /**
     * json输出地址数组 原data/resource/js/area_array.js
     */
    public function json_areaOp()
    {
        $_GET['src'] = $_GET['src'] != 'db' ? 'cache' : 'db';
        echo $_GET['callback'].'('.json_encode(Model('area')->getAreaArrayForJson($_GET['src'])).')';
    }

    /**
     * 根据ID返回所有父级地区名称
     */
    public function json_area_showOp()
    {
        $area_info['text'] = Model('area')->getTopAreaName(intval($_GET['area_id']));
        echo $_GET['callback'].'('.json_encode($area_info).')';
    }
}
