<?php/** * 所有店铺首页 */defined('TTShop') or exit('Access Invalid!');class shopControl extends mobileHomeControl{    public function __construct()    {        parent::__construct();    }    /*   * 首页显示   */    public function indexOp()    {        $web_seo = C('site_name');        Tpl::output('web_seo', $web_seo);        Tpl::showpage('shop');    }    public function g_storeOp()    {        Tpl::output('web_seo', '好店');        Tpl::showpage('great_store');    }    public function great_storeOp()    {        Tpl::output('web_seo', '好店');        Tpl::showpage('g_store');    }    public function store_listOp()    {        $conditon = [];        $model = Model();        $data = $model->table('great_store,store')->join('inner')->on('great_store.store_id=store.store_id')            ->order('great_store.sort asc')->page($_GET['page'])->select();        $page_count = $model->gettotalpage();        $store_id = [];        $array = [];        foreach ($data as $k => $v) {            $v['avatar_url'] = getStoreLogo($v['store_avatar']);            $v['store_url'] = urlMobile('store', 'index', ['store_id' => $v['store_id']]);            $array[$v['store_id']]['store_info'] = $v;            array_push($store_id, $v['store_id']);        }        //$conditon['store_id'] = ['in',$store_id];        if (!empty($store_id)) {            $sql = 'SELECT * FROM s_goods AS a WHERE store_id in (' . implode(',', $store_id) . ') and 6 > ( SELECT COUNT(*) FROM s_goods WHERE store_id = a.store_id AND goods_id > a.goods_id) order by goods_id asc';            $result = Db::getAll($sql);        } else {            exit;        }        //$goods_list = $model->table('goods')->where($conditon)->order('goods_id desc')->select();        if (!empty($result)) {            foreach ($result as $k => $v) {                $v['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $v['goods_id']]);                $v['goods_img'] = cthumb($v['goods_image'], 360, $v['store_id']);                $array[$v['store_id']]['goods_list'][] = $v;            }        }        output_data([            'list' => $array        ], mobile_page($page_count));    }    public function g_store_listOp()    {        $conditon = [];        $model = Model();        $data = $model->table('great_store,store')->on('great_store.store_id=store.store_id')            ->order('great_store.sort asc')->page($_GET['page'])->select();//        p(DB::getLastSql());die;        $page_count = $model->gettotalpage();        $store_id = [];        $array = [];        foreach ($data as $k => $v) {            $v['avatar_url'] = getStoreLogo($v['store_avatar']);            $v['store_url'] = urlMobile('store', 'index', ['store_id' => $v['store_id']]);            $array[$k]['store_info'] = $v;            //店铺信息格式化            unset($array[$k]['store_info']['store_slide']);            unset($array[$k]['store_info']['store_slide_url']);            unset($array[$k]['store_info']['store_slide_title']);            array_push($store_id, $v['store_id']);        }        if (!empty($store_id)) {            $sql = 'SELECT * FROM s_goods AS a WHERE store_id in (' . implode(',', $store_id) . ') and 1 > ( SELECT COUNT(*) FROM s_goods WHERE store_id = a.store_id AND goods_id > a.goods_id) order by goods_addtime desc';            $result = Db::getAll($sql);        } else {            exit;        }        $goods_id = [];        if (!empty($result)) {            foreach ($array as $index => $item){                foreach ($result as $k => $v) {                    $v['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $v['goods_id']]);                    $v['goods_img'] = cthumb($v['goods_image'], 360, $v['store_id']);                    $v['goods_addtime'] = date('Y年m月d日 H:i', $v['goods_addtime']);                    $v['goods_price'] = _out_formatPrice($v['goods_price'], '¥');                    $v['_size'] = $v['_size']?:NULL;                    if ($array[$index]['store_info']['store_id'] == $v['store_id']){                        $array[$index]['goods_list'][] = $v;                        $array[$index]['store_info']['update_time'] = $v['goods_addtime'];                    }                    array_push($goods_id, $v['goods_id']);                }            }        } else {            //        }        if (!empty($goods_id)) {            $sql = 'SELECT * FROM s_goods_images as b WHERE goods_commonid in (' . implode(',', $goods_id) . ') and 10 > ( SELECT COUNT(*) FROM s_goods_images WHERE goods_commonid = b.goods_commonid AND goods_image_id > b.goods_image_id) order by goods_image_id asc';            $result = Db::getAll($sql);            $sql_fav = [];            foreach ($goods_id as $item) {                array_push($sql_fav, "SELECT fav_id,COUNT(*) FROM `s_favorites` WHERE fav_id = " . $item . " AND fav_type = 'goods'");            }            $sql_fav = implode(' UNION ', $sql_fav);            $result_fav = Db::getAll($sql_fav);        } else {            exit;        }        if (!empty($result)) {            foreach ($array as $key => $value) {                if ($value['goods_list']){                    foreach ($value['goods_list'] as $kk => $vv) {                        $array[$key]['goods_list'][$kk]['goods_image_array'] = [];                        foreach ($result as $k => $v) {                            if ($array[$key]['goods_list'][$kk]['goods_id'] == $v['goods_commonid']) {                                array_push($array[$key]['goods_list'][$kk]['goods_image_array'], cthumb($v['goods_image'], 360,$array[$key]['goods_list'][$kk]['store_id']));                            }                        }                        if (!empty($result_fav)) {                            foreach ($result_fav as $item) {                                if ($item['fav_id'] == $array[$key]['goods_list'][$kk]['goods_id']) {                                    $array[$key]['goods_list'][$kk]['favorites'] = $item['COUNT(*)'];                                }                            }                        }                    }                }            }        }        foreach ($array as $index => $item){            if (!$item['goods_list']){                unset($array[$index]);            }        }        output_data([            'list' => $array        ], mobile_page($page_count));    }    /**     * 输出店铺分类     */    public function categoryOp()    {        $area_info = $_GET['area_info'];        if ($area_info) {            //        }        // 输出分类        $model = Model('store_class');        $ret = $model->where(array(            'core_category_id' => ($_GET['__ccid'] ?: $_SESSION['__ccid'])        ))->order('sc_sort asc')->select();        if (is_array($ret)) {            /*$ret = array_merge($ret,array(                array('sc_id' => 'other',                    'sc_name' => '其他',)            ));*/        }        output_data(array(            'category_list' => $ret        ));    }    /*     * 店铺街     */    public function store_streetOp()    {        $systemcategoryModel = Model('systemcategory');        $category = $systemcategoryModel::getSystemCategory();        Tpl::output('core_category', $category);        $model = Model('yellowpage');        if (!in_array($_GET['type'], array('dp', 'qy', 'ds', 'xx', ''))) {            exit('参数错误');        }        $condition = array();        $condition['h_type'] = $_GET['__ccid'] ?: ($_SESSION['__ccid']);        $condition['type'] = $_GET['type'] ?: 'dp';        switch ($condition['type']) {            case 'dp':                $web_seo = '品牌街';                break;            case 'qy':                $web_seo = '企业黄页';                break;            case 'ds':                $web_seo = '大师黄页';                break;            case 'xx':                $web_seo = '新秀黄页';                break;            default:                $web_seo = '黄页';                break;        }        Tpl::output('web_seo', $web_seo);        //下部列表        $condition['sb_type'] = 'pt';        $arr = $model->order('sort asc')->where($condition)->limit(1000)->select();        //最新上线        $condition['sb_type'] = 'new';        $hot_new = $model->where($condition)->limit(1000)->order('sort asc')->select();        //热门品牌-名铺推荐        $condition['sb_type'] = 'brand';        $hot_brand = $model->where($condition)->limit(10)->order('sort asc')->select();        //var_dump($hot_brand);exit;        //热门品类        $condition['sb_type'] = 'category';        $hot_type = $model->where($condition)->limit(8)->order('sort asc')->select();        if ($arr == null) {            Tpl::output('null', '无数据');            Tpl::showpage('store_street');            exit;        }        foreach ($arr as $k => $v) {            $right[] = strtoupper($v['first_char']);        }        $right = array_unique($right);        sort($right);        foreach ($right as $value) {            $list[$value] = array();            foreach ($arr as $v) {                if (strtoupper($v['first_char']) == $value) {                    array_push($list[$value], $v);                }            }        }        Tpl::output('hot_new', $hot_new);        Tpl::output('hot_brand', $hot_brand);        Tpl::output('hot_type', $hot_type);        Tpl::output('list', $list);        Tpl::output('right', $right);        Tpl::showpage('store_street');    }    /*     * 首页显示     */    public function shop_listOp()    {        //店铺搜索        $model = Model();        $keyword = trim($_GET['keyword']);        $condition = array();        if ($keyword != '') {            $condition['name'] = array('like', '%' . $keyword . '%');        }        $condition['sc_id'] = $_GET['category'];        $condition['is_open'] = $_GET['store_state'];        $order = 'sort asc';        $pagesize = (int)$_GET['page'];        if ($_GET['store_state'] == 0 && $pagesize > 20)            $pagesize = 20;        $store_list = $model->table('store_street,store_class')->join('left')->on('store_street.class_id = store_class.sc_id')->where($condition)->order($order)->page($pagesize)->select();        $page_count = $model->gettotalpage();        foreach ($store_list as $key => $item) {            if (!empty($item['is_open'])) {                if (!empty($item['url'])) {                    $store_list[$key]['url'] = $item['url'];                } elseif (!empty($item['store_id'])) {                    $store_list[$key]['url'] = urlMobile('store', 'index', array('store_id' => $item['store_id']));                } else {                    $store_list[$key]['url'] = 'javascript:;';                }            } else {                $store_list[$key]['url'] = 'javascript:;';            }        }        output_data(array('store_list' => $store_list), mobile_page($page_count));    }    private function _get_Own_Store_List()    {        $model_store = Model('store');        //查询条件        $condition = array();        $keyword = trim($_GET['keyword']);        if (C('fullindexer.open') && !empty($keyword)) {            //全文搜索            $condition = $this->full_search($keyword);        } else {            if ($keyword != '') {                $condition['store_name|store_zy'] = array('like', '%' . $keyword . '%');            }        }        if (!empty($_GET['area_info'])) {            $condition['area_info'] = array('like', '%' . $_GET['area_info'] . '%');        }        if (!empty($_GET['sc_id']) && intval($_GET['sc_id']) > 0) {            $condition['sc_id'] = $_GET['sc_id'];        }        //所需字段        $fields = "*";        //排序方式        $order = $this->_store_list_order($_GET['key'], $_GET['order']);        $store_list = $model_store->where($condition)->order($order)->page(10)->select();        $page_count = $model_store->gettotalpage();        $own_store_list = $store_list;        $simply_store_list = array();        foreach ($own_store_list as $key => $value) {            $simply_store_list[$key]['store_id'] = $own_store_list[$key]['store_id'];            $simply_store_list[$key]['store_name'] = $own_store_list[$key]['store_name'];            $simply_store_list[$key]['store_collect'] = $own_store_list[$key]['store_collect'];            $simply_store_list[$key]['store_address'] = $own_store_list[$key]['store_address'];            $simply_store_list[$key]['store_area_info'] = $own_store_list[$key]['area_info'];            $simply_store_list[$key]['store_avatar'] = $own_store_list[$key]['store_avatar'];            $simply_store_list[$key]['goods_count'] = $own_store_list[$key]['goods_count'];            $simply_store_list[$key]['store_avatar_url'] = UPLOAD_SITE_URL . '/' . ATTACH_COMMON . DS . C('default_store_avatar');            if ($own_store_list[$key]['store_avatar']) {                $simply_store_list[$key]['store_avatar_url'] = UPLOAD_SITE_URL . '/shop/store/' . $own_store_list[$key]['store_avatar'];            }        }        output_data(array('store_list' => $simply_store_list), mobile_page($page_count));    }    /**     * 商品列表排序方式     */    private function _store_list_order($key, $order)    {        $result = 'store_id desc';        if (!empty($key)) {            $sequence = 'desc';            if ($order == 1) {                $sequence = 'asc';            }            switch ($key) {                //销量                case '1' :                    $result = 'store_id' . ' ' . $sequence;                    break;                //浏览量                case '2' :                    $result = 'store_name' . ' ' . $sequence;                    break;                //价格                case '3' :                    $result = 'store_name' . ' ' . $sequence;                    break;            }        }        return $result;    }    public function shopclassOp()    {        $web_seo = C('site_name') . "-店铺分类";        Tpl::output('web_seo', $web_seo);        Tpl::showpage('shop_class');    }    public function get_shopclassOp()    {        //获取自营店列表        $model_store_class = Model("store_class");        //如果只想显示自营店铺，把下面的//去掉即可        //$condition = array(        //   'is_own_shop' => 1,        //);        $lst = $model_store_class->getStoreClassList($condition);        $new_lst = array();        foreach ($lst as $key => $value) {            $new_lst[$key]['sc_id'] = $lst[$key]['sc_id'];            $new_lst[$key]['sc_name'] = $lst[$key]['sc_name'];            $new_lst[$key]['sc_bail'] = $lst[$key]['sc_bail'];            $new_lst[$key]['sc_sort'] = $lst[$key]['sc_sort'];        }        output_data(array('class_list' => $new_lst));    }    public function get_favorites_listOp(){        $member_id = $_SESSION['member_id'];        $condition = [];        if ($member_id){            $condition['member_id'] = $member_id;        } else {            output_data([                'msg' => '用户未登陆'            ]);        }        $model = Model('favorites');        $store_list_data = $model->getStoreFavoritesList($condition, 'fav_id');        $store_list = [];        if (!empty($store_list_data)){            foreach ($store_list_data as $item){                $store_list[] = $item['fav_id'];            }        }//        $store_list = implode(',', $store_list);        $goods_list_data = $model->getGoodsFavoritesList($condition, 'fav_id');        $goods_list = [];        if (!empty($goods_list_data)){            foreach ($goods_list_data as $item){                $goods_list[] = $item['fav_id'];            }        }//        $goods_list = implode(',', $goods_list);        output_data([            'member_id' => $_SESSION['member_id'],            'goods_list' => $goods_list,            'store_list' => $store_list        ]);    }}