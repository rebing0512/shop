<?php

/**
 * 商品
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');

class goodsControl extends mobileHomeControl
{

    private $share_info = [
        'hongmuzhijia' => [
            2 => [
                'name' => '转转赚-家具-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/hmjj.jpg'
            ],
            8 => [
                'name' => '转转赚-木雕-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/mdys.png'
            ],
            4 => [
                'name' => '转转赚-手串-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/fzsc.jpg'
            ],
            5 => [
                'name' => '转转赚-小件-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/jjxj.jpg'
            ],
            6 => [
                'name' => '转转赚-大板-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/dbyc.png'
            ],
            'jp' => [
                'name' => '转转赚-精品-红木微商推客系统',
                'desc' => '今日货源已更新。自用省钱，转发赚钱，确保质量，一件代发。常期招募红木推客及红木资源。',
                'image' => MOBILE_TEMPLATES_URL.'/images/yptj.jpg'
            ]
        ],
        'guoshizhijia' => [
            9 => [
                'name' => '国石之家巴林国石',
                'desc' => '国石之家巴林国石集市，这里能找到您所想要的。',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            10 => [
                'name' => '国石之家昌化国石',
                'desc' => '国石之家昌化国石集市，这里能找到您所想要的。',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            11 => [
                'name' => '国石之家青田国石',
                'desc' => '国石之家青田国石集市，这里能找到您所想要的。',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            12 => [
                'name' => '国石之家寿山国石',
                'desc' => '国石之家寿山国石集市，这里能找到您所想要的。',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            13 => [
                'name' => '国石之家原石市场',
                'desc' => '国石之家原石市场集市，这里能找到您所想要的。',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
        ],
        'ptgm' => [
            //
        ],
        'zhile' => [
            19 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            20 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            21 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            22 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            23 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            24 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            25 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            26 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            27 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            28 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            29 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
            31 => [
                'name' => '值了',
                'desc' => '值了集市',
                'image' => MOBILE_TEMPLATES_URL.'/images/guoshizhijia.jpg'
            ],
        ]
    ];

    public function __construct()
    {
        parent::__construct();
        Tpl::output('share_info', $this->share_info);
    }

    public function tkOp()
    {
        $goods_id = (int) trim($_GET['goods_id']);

        if (!$goods_id) {
            return false;
        }

        $model = Model();

        $model->table('goods,store')
            ->join('left join')
            ->on('goods.store_id=store.store_id')
            ->field('goods.*,store.store_name as real_store_name,store.store_phone,store.store_avatar');

        $condition['goods.goods_state'] = 1;
        $condition['goods.goods_id'] = $goods_id;

        $data = $model->where($condition)->find();

        $images = Model('goods_images')->where(array(
            'goods_commonid' => $goods_id
        ))->select();

        // 获取所有商品的收藏用户列表
        $favs = Model()->table('favorites,member')->join('left join')->on('favorites.member_id=member.member_id')->where(array('favorites.fav_type'=>'goods','favorites.fav_id'=>$goods_id))->limit(30)->order('favorites.log_id desc')->field('member.member_id,member.member_avatar,member.hashkey')->select();

        foreach ($favs as $index=>$fav_detail)
        {
            $fav_detail['member_avatar'] = new_getMemberAvatar($fav_detail['hashkey']);
            $fav_details[$index] = $fav_detail;
        }

        $favs = $fav_details;

        foreach ($images as $image) {
            $data['images'][] = $image['goods_image'];
            $data['img_json'][] = cthumb($image['goods_image'],360,$image['store_id']);
        }

        if (count($data)>0)
            $_tmp = array();
            $_tmp['json_data'] = json_encode($data['images']);
            $_tmp['img_json'] = json_encode($data['img_json']);
            $_tmp['goods_jingle'] = $data['goods_jingle'];
            $_tmp['goods_id'] = $data['goods_id'];
            $_tmp['store_name'] = $data['real_store_name'];
            $_tmp['goods_name'] = $data['goods_name'];
            $_tmp['goods_image'] = cthumb($data['goods_image'], 360, $data['store_id']);
            $_tmp['avatar'] = getStoreLogo($data['store_avatar']);
            $_tmp['target_url'] = urlMobile('goods', 'detail', array('goods_id' => $data['goods_id']));
            $_tmp['goods_price'] = _formatPrice($data['goods_price'],'￥');
            $_tmp['created_at'] = date('m月d日', $data['goods_edittime']);
            $_tmp['shipping'] = $data['goods_freight']<=0?'包邮':('邮费:'.$data['goods_freight']);
            $_tmp['store_id'] = $data['store_id'];
            $_tmp['store_phone'] = $data['store_phone'];
            $_tmp['digg_users'] = $favs;

        if ($_COOKIE['key']) {
            $mToekn = Model('mb_user_token')->getMbUserTokenInfoByToken($_COOKIE['key']);
            $member = Model('member')->getMemberInfoByID($mToekn['member_id']);
            $hashkey = $member['hashkey'];
        }
        Tpl::output('__user_avatar',new_getMemberAvatar($hashkey));
        Tpl::output('data', $_tmp);

        Tpl::showpage('tk');
    }

    public function supermarketOp()
    {
        //@todo 优品推荐
//        if (!$_GET['__ccid'] && C('app_alias') == 'hongmuzhijia')
//        {
//            $this->heigh_qualityOp();
//            exit;
//        }

        //$member_id = $this->member_info['member_id'];
        if ($_COOKIE['key']) {
            $mToekn = Model('mb_user_token')->getMbUserTokenInfoByToken($_COOKIE['key']);
            $member = Model('member')->getMemberInfoByID($mToekn['member_id']);
            $hashkey = $member['hashkey'];
        }

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        $client = self::getPlatform();

        $condition['rtype'] = 'market';
        $condition['h_type'] = $_GET['__ccid']?:$_SESSION['__ccid'];

        $adv = Model()->table('index_recommend_topslide')->order('sort asc,id desc')->where($condition)->select();

        Tpl::output('adv',$adv);
        Tpl::output('client',$client);
        Tpl::output('web_seo', $_SESSION['__cname']);
        Tpl::output('core_category', $category);
        Tpl::output('__user_avatar',new_getMemberAvatar($hashkey));
        Tpl::showpage('market');
    }

    public function market_apiOp()
    {
        $last_id = (int)$_GET['last_id'];

        $condition = [];

        $order = '';

        switch (C('app_alias')):
            case 'guoshizhijia':
            case 'ptgm':
                if ($last_id) {
                    $condition['goods.goods_edittime'] = array('lt', $last_id);
                }
                $order .= 'goods.goods_edittime desc';
                break;
            case 'hongmuzhijia':
                if ($last_id) {
                    $condition['goods.goods_edittime'] = array('lt', $last_id);
                }
                $order .= 'goods.goods_edittime desc';
//                $order .= 'goods.goods_addtime desc';
                break;
            case 'ptgm':
                if ($last_id) {
                    $condition['goods.goods_edittime'] = array('lt', $last_id);
                }
                $order .= 'goods.goods_edittime desc';
                break;
            case 'zhile':
            default:
                if ($last_id) {
                    $condition['goods.goods_addtime'] = array('lt', $last_id);
                }
                $order .= 'goods.goods_addtime desc';
                break;
        endswitch;

        $model = Model();

        $model->table('goods,store')
            ->join('left join')
            ->on('goods.store_id=store.store_id')
            ->field('goods.*,store.store_name as real_store_name,store.store_phone,store.store_avatar');

        $condition['goods.goods_state'] = 1;
        $condition['goods.category_id'] = $_GET['__ccid']?:$_SESSION['__ccid'];


        switch (C('app_alias')) {
            case 'guoshizhijia':
                $data = $model->where($condition)->limit(5)->order($order)->select();
                break;

            case 'hongmuzhijia':
                $data = $model->where($condition)->limit(5)->order($order)->select();
//                $data = $model->where($condition)->page(5)->order($order)->select();
//                $page = mobile_page($model->gettotalpage());
                break;

            case 'zhile':
                $data = $model->where($condition)->limit(5)->order($order)->select();
                break;
            
            default:
                $data = $model->where($condition)->limit(5)->order($order)->select();
                break;
        }

        if (!$data) {
            still_break:
            output_data(array(
                'datas' => array(),
                'last_id'=>0,
            ));
        } else {
            $ret = array();
            $goods_id = array();

            // 取出商品ID数组
            foreach ($data as $item) {
                $ret[$item['goods_commonid']] = $item;
                $goods_id[] = $item['goods_commonid'];
            }
            $goods_id = array_unique($goods_id);

            // 获取所有商品图片
            $images = Model('goods_images')->where(array(
                'goods_commonid' => array(
                    'in', $goods_id
                )
            ))->select();

            // 获取所有商品的收藏用户列表
            $favs = array();
            foreach ($data as $item)
            {
                $favs[$item['goods_id']] = Model()->table('favorites,member')->join('left join')->on('favorites.member_id=member.member_id')->where(array('favorites.fav_type'=>'goods','favorites.fav_id'=>$item['goods_id']))->limit(30)->order('favorites.log_id desc')->field('member.member_id,member.member_avatar,member.hashkey')->select();
            }
            foreach($favs as $goods_id=>$fav_details)
            {
                foreach ($fav_details as $index=>$fav_detail)
                {
                    $fav_detail['member_avatar'] = new_getMemberAvatar($fav_detail['hashkey']);
                    $fav_details[$index] = $fav_detail;
                }
                $favs[$goods_id] = $fav_details;
            }

            $tmp_image = array();
            foreach ($images as $image) {
                $ret[$image['goods_commonid']]['images'][] = $image['goods_image'];
                $ret[$image['goods_commonid']]['img_json'][] = cthumb($image['goods_image'],360,$image['store_id']);
            }

            $lastid = '';
            $output = array();

            if (count($ret)>0)
                foreach ($ret as $item) {
                    $_tmp = array();
                    $_tmp['json_data'] = json_encode($item['images']);
                    $_tmp['img_json'] = json_encode($item['img_json']);
                    $_tmp['goods_jingle'] = $item['goods_jingle'];
                    $_tmp['goods_id'] = $item['goods_id'];
                    $_tmp['store_name'] = $item['real_store_name'];
                    $_tmp['goods_name'] = $item['goods_name'];
                    $_tmp['avatar'] = getStoreLogo($item['store_avatar']);
                    $_tmp['target_url'] = urlMobile('goods', 'detail', array('goods_id' => $item['goods_id']));
                    $_tmp['goods_price'] = _formatPrice($item['goods_price'],'￥');
                    $_tmp['created_at'] = date('m月d日', $item['goods_edittime']);
                    $_tmp['shipping'] = $item['goods_freight']<=0?'包邮':('邮费:'.$item['goods_freight']);
                    $_tmp['store_id'] = $item['store_id'];
                    $_tmp['store_phone'] = $item['store_phone'];
                    $_tmp['digg_users'] = $favs[$item['goods_id']];

                    $output[] = $_tmp;
                    $lastid = $item['goods_edittime'];
                }
            output_data(array(
                'datas' => $output,
                'last_id'=>$lastid
            ));
        }
    }

    public function heigh_qualityOp()
    {
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        if ($_COOKIE['key']) {
            $mToekn = Model('mb_user_token')->getMbUserTokenInfoByToken($_COOKIE['key']);
            $member = Model('member')->getMemberInfoByID($mToekn['member_id']);
            $hashkey = $member['hashkey'];
        }

        $client = self::getPlatform();

        $condition['rtype'] = 'heigh_quality';

        $adv = Model()->table('index_recommend_topslide')->order('sort asc,id desc')->where($condition)->select();

        Tpl::output('adv',$adv);
        Tpl::output('client',$client);
        Tpl::output('core_category', $category);
        Tpl::output('web_seo', '优品推荐');
        Tpl::output('__user_avatar',new_getMemberAvatar($hashkey));
        Tpl::showpage('heigh_quality');

    }

    public function quality_apiOp()
    {

        $order = '';

        $condition = [];

        $order .= 'heigh_quality.sort asc,goods.goods_addtime desc';

        $model = Model();

        $model->table('heigh_quality,goods,store')
            ->join('left join')
            ->on('heigh_quality.goods_id=goods.goods_id,goods.store_id=store.store_id')
            ->field('heigh_quality.sort,goods.*,store.store_name as real_store_name,store.store_phone,store.store_avatar');

        $condition['goods.goods_state'] = 1;

        $data = $model->where($condition)->page(5)->order($order)->select();

        mobile_page($model->gettotalpage());

        if (!$data) {
            still_break:
            output_data(array(
                'datas' => array(),
                'last_id'=>0,
            ));
        } else {
            $ret = array();
            $goods_id = array();

            // 取出商品ID数组
            foreach ($data as $item) {
                $ret[$item['goods_commonid']] = $item;
                $goods_id[] = $item['goods_commonid'];
            }
            $goods_id = array_unique($goods_id);

            // 获取所有商品图片
            $images = Model('goods_images')->where(array(
                'goods_commonid' => array(
                    'in', $goods_id
                )
            ))->select();

            // 获取所有商品的收藏用户列表
            $favs = array();
            foreach ($data as $item)
            {
                $favs[$item['goods_id']] = Model()->table('favorites,member')->join('left join')->on('favorites.member_id=member.member_id')->where(array('favorites.fav_type'=>'goods','favorites.fav_id'=>$item['goods_id']))->limit(30)->order('favorites.log_id desc')->field('member.member_id,member.member_avatar,member.hashkey')->select();
            }
            foreach($favs as $goods_id=>$fav_details)
            {
                foreach ($fav_details as $index=>$fav_detail)
                {
                    $fav_detail['member_avatar'] = new_getMemberAvatar($fav_detail['hashkey']);
                    $fav_details[$index] = $fav_detail;
                }
                $favs[$goods_id] = $fav_details;
            }

            $tmp_image = array();
            foreach ($images as $image) {
                $ret[$image['goods_commonid']]['images'][] = $image['goods_image'];
                $ret[$image['goods_commonid']]['img_json'][] = cthumb($image['goods_image'],360,$image['store_id']);
            }

            $lastid = '';
            $output = array();

            if (count($ret)>0)
                foreach ($ret as $item) {
                    $_tmp = array();
                    $_tmp['json_data'] = json_encode($item['images']);
                    $_tmp['img_json'] = json_encode($item['img_json']);
                    $_tmp['goods_jingle'] = $item['goods_jingle'];
                    $_tmp['goods_id'] = $item['goods_id'];
                    $_tmp['store_name'] = $item['real_store_name'];
                    $_tmp['goods_name'] = $item['goods_name'];
                    $_tmp['avatar'] = getStoreLogo($item['store_avatar']);
                    $_tmp['target_url'] = urlMobile('goods', 'detail', array('goods_id' => $item['goods_id']));
                    $_tmp['goods_price'] = _formatPrice($item['goods_price'],'￥');
                    $_tmp['created_at'] = date('m月d日', $item['goods_edittime']);
                    $_tmp['shipping'] = $item['goods_freight']<=0?'包邮':('邮费:'.$item['goods_freight']);
                    $_tmp['store_id'] = $item['store_id'];
                    $_tmp['store_phone'] = $item['store_phone'];
                    $_tmp['digg_users'] = $favs[$item['goods_id']];

                    $output[] = $_tmp;
                    $lastid = $item['goods_edittime'];
                }
            output_data(array(
                'datas' => $output
            ), mobile_page($model->gettotalpage()));
        }
    }

    public function indexOp()
    {

    }

    public function listOp()
    {
        $mode = trim($_GET['mode']);

        if (in_array($mode,['all'])){
            //禁止wap端顶部搜索框显示
            $mode = false;
        } else {
            $mode = true;
        }

        Tpl::output('mode',$mode);

        Tpl::output('web_seo', C('site_name'));

        Tpl::showpage('product_list');

    }

    public function goods_selectOp()
    {

        Tpl::showpage('index');

    }

    public function detailOp()
    {

        $goods_id = intval($_GET ['goods_id']);

        // 商品详细信息

        $model_goods = Model('goods');

        $goods_detail = $model_goods->getGoodsDetail($goods_id);


        Tpl::output('web_seo', C('site_name'));

        Tpl::showpage('product_detail');

    }

    //客服
    public function serviceOp()
    {
        Tpl::output('web_seo', C('site_name'));
        Tpl::showpage('service');
    }

    //专家张铭
    public function zmOp()
    {
        Tpl::output('web_seo', C('site_name'));
        Tpl::showpage('zm');
    }

    //专家黄日荣
    public function hrrOp()
    {
        Tpl::output('web_seo', C('site_name'));
        Tpl::showpage('hrr');
    }

    //专家鉴定团
    public function groupOp()
    {
        Tpl::output('web_seo', C('site_name'));
        Tpl::showpage('group');
    }

    //商品搜索

    public function searchOp()
    {

        Tpl::output('web_seo', C('site_name') . ' - ' . '商品搜索');

        Tpl::showpage('search');

    }


    /**
     * 商品列表
     */

    public function goods_listOp()
    {

        $model_goods = Model('goods');

        $model_search = Model('search');

        $_GET['is_book'] = 0;

        //查询条件

        $condition = array();

        // ==== 暂时不显示定金预售商品，手机端未做。  ====

        $condition['is_book'] = 0;

        if (!empty($_GET['stone']) && !empty($_GET['carve'])) {
            $condition['stone'] = $_GET['stone'] == 'all' ? '' : $_GET['stone'];
            $condition['carve'] = $_GET['carve'] == 'all' ? '' : $_GET['carve'];
            if (empty($condition['stone'])) {
                unset($condition['stone']);
            }
            if (empty($condition['carve'])) {
                unset($condition['carve']);
            }
        }
        // ==== 暂时不显示定金预售商品，手机端未做。  ====

        if (!empty($_GET['gc_id']) && intval($_GET['gc_id']) > 0) {

            $condition['gc_id'] = $_GET['gc_id'];

        } elseif (!empty($_GET['keyword'])) {

            $condition['goods_name|goods_jingle'] = array('like', '%' . $_GET['keyword'] . '%');


            if (cookie('his_sh') == '') {

                $his_sh_list = array();

            } else {

                $his_sh_list = explode('~', cookie('his_sh'));

            }

            if (strlen($_GET['keyword']) <= 30 && !in_array($_GET['keyword'], $his_sh_list)) {

                if (array_unshift($his_sh_list, $_GET['keyword']) > 8) {

                    array_pop($his_sh_list);

                }

            }

            setNcCookie('his_sh', implode('~', $his_sh_list), 2592000); //添加历史纪录

        } elseif (!empty($_GET['barcode'])) {

            $condition['goods_barcode'] = $_GET['barcode'];

        } elseif (!empty($_GET['b_id']) && intval($_GET['b_id'] > 0)) {

            $condition['brand_id'] = intval($_GET['b_id']);

        }

        //店铺服务

        if ($_GET['ci'] && $_GET['ci'] != 0) {

            //处理参数

            $search_ci = $_GET['ci'];

            $search_ci_arr = explode('_', $search_ci);

            $search_ci_str = $search_ci . '_';

            $indexer_searcharr['search_ci_arr'] = $search_ci_arr;

        }


        if (!empty($_GET['price_from']) && intval($_GET['price_from'] > 0)) {

            $condition['goods_price'][] = array('egt', intval($_GET['price_from']));

        }

        if (!empty($_GET['price_to']) && intval($_GET['price_to'] > 0)) {

            $condition['goods_price'][] = array('elt', intval($_GET['price_to']));

        }

        if (intval($_GET['area_id']) > 0) {

            $condition['areaid_1'] = intval($_GET['area_id']);

        }


        //赠品

        if ($_GET['gift'] == 1) {

            $condition['have_gift'] = 1;

        }

        //特卖

        if ($_GET['groupbuy'] == 1) {

            $condition['goods_promotion_type'][] = 1;

        }

        //限时折扣

        if ($_GET['xianshi'] == 1) {

            $condition['goods_promotion_type'][] = 2;

        }

        //虚拟

        if ($_GET['virtual'] == 1) {

            $condition['is_virtual'] = 2;

        }

        //推荐

        if ($_GET['tag']) {

            $condition['tag'] = intval($_GET['tag']);

        }
        //绑定品类材质

        if ($_GET['category_id']) {

            $condition['category_id'] = intval($_GET['category_id']);

        }

        if ($_GET['attribute_id']&&!empty(intval($_GET['attribute_id']))) {

            $condition['kind_id'] = intval($_GET['attribute_id']);

        }


        if ($_GET['texture_id']&&!empty(intval($_GET['texture_id']))) {

            $condition['texture_id'] = intval($_GET['texture_id']);

        }


        //所需字段

        $fieldstr = "goods_id,goods_commonid,store_id,goods_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_image,goods_salenum,evaluation_good_star,evaluation_count";


        // 添加3个状态字段

        $fieldstr .= ',is_virtual,is_presell,is_fcode,have_gift,goods_jingle,store_id,store_name,is_own_shop';


        //排序方式

        $order = $this->_goods_list_order($_GET['key'], $_GET['order']);

        //全文搜索搜索参数

        $indexer_searcharr = $_GET;

        //搜索消费者保障服务

        $search_ci_arr = array();

        $_GET['ci'] = trim($_GET['ci'], '_');

        if ($_GET['ci'] && $_GET['ci'] != 0 && is_string($_GET['ci'])) {

            //处理参数

            $search_ci = $_GET['ci'];

            $search_ci_arr = explode('_', $search_ci);

            $indexer_searcharr['search_ci_arr'] = $search_ci_arr;

        }

        if ($_GET['own_shop'] == 1) {

            $indexer_searcharr['type'] = 1;

        }

        $indexer_searcharr['price_from'] = $price_from;

        $indexer_searcharr['price_to'] = $price_to;


        //优先从全文索引库里查找

        list($goods_list, $indexer_count) = $model_search->indexerSearch($_GET, $this->page);

        if (!is_null($goods_list)) {

            $goods_list = array_values($goods_list);

            pagecmd('setEachNum', $this->page);

            pagecmd('setTotalNum', $indexer_count);

        } else {

            $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fieldstr, $order, $this->page);

        }

        $page_count = $model_goods->gettotalpage();

        //处理商品列表(特卖、限时折扣、商品图片)

        $goods_list = $this->_goods_list_extend($goods_list);

        for ($i = 0; $i < count($goods_list); $i++) {
            if ($goods_list[$i]['goods_price'] >= 1) {
                $goods_list[$i]['goods_price'] = number_format(doubleval($goods_list[$i]['goods_price']));
            }
        }
//var_dump($goods_list);

        output_data(array('goods_list' => $goods_list), mobile_page($page_count));

    }

    /**
     * 商品列表排序方式
     */

    private function _goods_list_order($key, $order)
    {

        $result = 'is_own_shop desc,goods_id desc';

        if (!empty($key)) {


            $sequence = 'desc';

            if ($order == 1) {

                $sequence = 'asc';

            }


            switch ($key) {

                //销量

                case '1' :

                    $result = 'goods_salenum' . ' ' . $sequence;

                    break;

                //浏览量

                case '2' :

                    $result = 'goods_click' . ' ' . $sequence;

                    break;

                //价格

                case '3' :

                    $result = 'goods_price' . ' ' . $sequence;

                    break;

            }

        }

        return $result;

    }


    /**
     * 处理商品列表(特卖、限时折扣、商品图片)
     */

    private function _goods_list_extend($goods_list)
    {

        //获取商品列表编号数组

        $goodsid_array = array();

        foreach ($goods_list as $key => $value) {

            $goodsid_array[] = $value['goods_id'];

        }


        $sole_array = Model('p_sole')->getSoleGoodsList(array('goods_id' => array('in', $goodsid_array)));

        $sole_array = array_under_reset($sole_array, 'goods_id');


        foreach ($goods_list as $key => $value) {

            $goods_list[$key]['sole_flag'] = false;

            $goods_list[$key]['group_flag'] = false;

            $goods_list[$key]['xianshi_flag'] = false;

            if (!empty($sole_array[$value['goods_id']])) {

                $goods_list[$key]['goods_price'] = $sole_array[$value['goods_id']]['sole_price'];

                $goods_list[$key]['sole_flag'] = true;

            } else {

                $goods_list[$key]['goods_price'] = $value['goods_promotion_price'];

                switch ($value['goods_promotion_type']) {

                    case 1:

                        $goods_list[$key]['group_flag'] = true;

                        break;

                    case 2:

                        $goods_list[$key]['xianshi_flag'] = true;

                        break;

                }


            }


            //商品图片url

            $goods_list[$key]['goods_image_url'] = cthumb($value['goods_image'], 360, $value['store_id']);

            unset($goods_list[$key]['goods_promotion_type']);

            unset($goods_list[$key]['goods_promotion_price']);

            unset($goods_list[$key]['goods_commonid']);

            unset($goods_list[$key]['nc_distinct']);

        }


        return $goods_list;

    }


    /**
     * 商品详细页
     */

    public function goods_detailOp()
    {

        $goods_id = intval($_GET ['goods_id']);


        //商城购买须知

        $model = Model('setting');

        $promise = $model->where('name = "promise"')->find();

        $buy = $model->where('name = "buy"')->find();

        $service = $model->where('name = "service"')->find();

        // 商品详细信息

        $model_goods = Model('goods');

        $goods_detail = $model_goods->getGoodsDetail($goods_id);

//        $share_image = cthumb($goods_detail['goods_image'], 60);

        $goods_commonid = $goods_detail['goods_info']['goods_commonid'];

        if (empty($goods_detail)) {

            output_error('商品不存在');

        }


        // 默认预订商品不支持手机端显示

        if ($goods_detail['is_book']) {

            output_error('预订商品不支持手机端显示');

        }


        //推荐商品

        $model_store = Model('store');

        $hot_sales = $model_store->getHotSalesList($goods_detail['goods_info']['store_id'], 8, true);

        $goodsid_array = array();

        foreach ($hot_sales as $value) {

            $goodsid_array[] = $value['goods_id'];

        }

        $sole_array = Model('p_sole')->getSoleGoodsList(array('goods_id' => array('in', $goodsid_array)));


        $sole_array = array_under_reset($sole_array, 'goods_id');

        $goods_commend_list = array();

        foreach ($hot_sales as $value) {

            $goods_commend = array();

            $goods_commend['goods_id'] = $value['goods_id'];

            $goods_commend['goods_name'] = $value['goods_name'];

            $goods_commend['goods_price'] = $value['goods_price'];

            $goods_commend['goods_promotion_price'] = $value['goods_promotion_price'];

            if (!empty($sole_array[$value['goods_id']])) {

                $goods_commend['goods_promotion_price'] = $sole_array[$value['goods_id']]['sole_price'];

            }

            $goods_commend['goods_image_url'] = cthumb($value['goods_image'], 240);

            $goods_commend_list[] = $goods_commend;

        }


        $goods_detail['goods_commend_list'] = $goods_commend_list;

        $store_info = $model_store->getStoreInfoByID($goods_detail['goods_info']['store_id']);

        $goods_detail['store_info']['store_id'] = $store_info['store_id'];

        $goods_detail['store_info']['store_name'] = $store_info['store_name'];

        $goods_detail['store_info']['member_id'] = $store_info['member_id'];

        $goods_detail['store_info']['member_name'] = $store_info['member_name'];

        $goods_detail['store_info']['store_qq'] = $store_info['store_qq'];

        $goods_detail['store_info']['store_phone'] = $store_info['store_phone'];

        $goods_detail['store_info']['avatar'] = getMemberAvatarForID($store_info['member_id']);

        $goods_detail['store_info']['store_avatar'] = getStoreLogo($store_info['store_avatar']);

        $goods_detail['store_info']['goods_online'] = Model('goods')->getGoodsCommonOnlineCount(array('store_id' => $store_info['store_id']));

        $goods_detail['store_info']['fans'] = Model('favorites')->getStoreFavoritesCountByStoreId($store_info['store_id']);

        $goods_detail['store_info']['goods_count'] = $store_info['goods_count'];

        $map = Model()->table('store_map')->where(array('store_id'=>$store_info['store_id']))->order('map_id asc')->find();

        $goods_detail['store_info']['store_map'] = $map['address_info'];

        $goods_detail['store_info']['baidu_lng'] = $map['baidu_lng'];

        $goods_detail['store_info']['baidu_lat'] = $map['baidu_lat'];

        $goods_detail['store_info']['promise'] = UPLOAD_SITE_URL . '/' . (ATTACH_MOBILE . DS . $promise['value']);

        $goods_detail['store_info']['buy'] = UPLOAD_SITE_URL . '/' . (ATTACH_MOBILE . DS . $buy['value']);

        $goods_detail['store_info']['service'] = $service['value'];

        if ($store_info['is_own_shop']) {

            $goods_detail['store_info']['store_credit'] = array(

                'store_desccredit' => array(

                    'text' => '描述',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

                'store_servicecredit' => array(

                    'text' => '服务',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

                'store_deliverycredit' => array(

                    'text' => '物流',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

            );

        } else {

            $storeCredit = array();

            $percentClassTextMap = array(

                'equal' => '平',

                'high' => '高',

                'low' => '低',

            );

            foreach ((array)$store_info['store_credit'] as $k => $v) {

                $v['percent_text'] = $percentClassTextMap[$v['percent_class']];

                $storeCredit[$k] = $v;

            }

            $goods_detail['store_info']['store_credit'] = $storeCredit;

        }


        //商品详细信息处理

        $goods_detail = $this->_goods_detail_extend($goods_detail);

//        $goods_detail['share_image'] = $share_image;


        // 如果已登录 判断该商品是否已被收藏

        if ($memberId = $this->getMemberIdIfExists()) {

            $c = (int)Model('favorites')->getGoodsFavoritesCountByGoodsId($goods_id, $memberId);

            $goods_detail['is_favorate'] = $c > 0;

            $goods_detail['cart_count'] = Model('cart')->countCartByMemberId($memberId);

        }
        $goods_detail['goods_info']['sx'] = [];
        if (!empty($goods_detail['goods_info']['category_id']) && !empty($goods_detail['goods_info']['kind_id']) &&!empty($goods_detail['goods_info']['texture_id'])){
            $systemCategoryModel = Model('systemcategory');
            $category = $systemCategoryModel::getCategoryText($goods_detail['goods_info']['category_id'], $goods_detail['goods_info']['kind_id'], $goods_detail['goods_info']['texture_id']);
            //$category = $systemCategoryModel::getSystemCategory();
//            if ($category['code'] == 1){
            if ($category){
                $goods_detail['goods_info']['sx'] = $category;
                if ($category['attribute'] == '其它'){
                    $goods_detail['goods_info']['sx']['attribute'] = $goods_detail['goods_info']['attribute'];
                }
                if ($category['texture'] == '其它'){
                    $goods_detail['goods_info']['sx']['texture'] = $goods_detail['goods_info']['texture'];
                }
            }
        }


        if ($goods_detail['goods_info']['goods_freight']){
            $content = '运费：'.$goods_detail['goods_info']['goods_freight'];
        } else {
            $content = '免运费';
        }
        if ($goods_detail['goods_info']['goods_storage']>0){
            //'库存：'.$goods_detail['goods_info']['goods_storage']
            $if_store_cn = '有货';
        } else {
            $if_store_cn = '无货';
        }

        $goods_detail['goods_hair_info'] = array('content' => $content, 'if_store_cn' => $if_store_cn, 'if_store' => true, 'area_name' => '全国');

        $goods_detail['goods_evaluate_info'] = array('good' => 0, 'normal' => 0, 'bad' => 0, 'all' => 0, 'img' => 0, 'good_percent' => 100, 'normal_percent' => 0, 'bad_percent' => 0, 'good_star' => 5, 'star_average' => 5);

        $goods_detail['goods_eval_list'] = '';

        $goods_commoninfo = $model_goods->getGoodsCommonInfoByID($goods_commonid,'_size');

        if ($goods_detail) {

            $model_goods_browse = Model('goods_browse')->addViewedGoods($goods_id, $memberId); //加入浏览历史数据库

//访问量+1
            Model('goods_common')->where('goods_commonid =' . $goods_commonid)->update(array('goods_click' => array('exp', 'goods_click + 1')));


//var_dump($goods_detail['goods_info']);
            if ($goods_detail['goods_info']['goods_price'] >= 1) {
                $goods_detail['goods_info']['goods_price'] = number_format(doubleval($goods_detail['goods_info']['goods_price']));
                $goods_detail['goods_info']['goods_marketprice'] = number_format(doubleval($goods_detail['goods_info']['goods_marketprice']));
                $goods_detail['goods_info']['goods_promotion_price'] = number_format(doubleval($goods_detail['goods_info']['goods_promotion_price']));
            }
            $order_id = Model('order_goods')->field('order_id')->where('goods_id = ' . $goods_id)->find();

            if ($order_id) {
                $pay_time = Model('orders')->field('payment_time,order_state')->where('order_id =' . $order_id['order_id'])->find();

                if ($pay_time['order_state'] >= 20) {
                    $goods_detail['goods_info']['payment_time'] = date('Y-m-d H:i', $pay_time['payment_time']);
                }
            }
            $goods_detail['goods_info']['_size'] = $goods_commoninfo['_size'];
            output_data($goods_detail);

        }

    }

    /**
     * 商品详细页
     */

    public function mini_goods_detailOp()
    {

        $goods_id = intval($_GET ['goods_id']);


        //商城购买须知

        $model = Model('setting');

        $promise = $model->where('name = "promise"')->find();

        $buy = $model->where('name = "buy"')->find();

        $service = $model->where('name = "service"')->find();

        // 商品详细信息

        $model_goods = Model('goods');

        $goods_detail = $model_goods->getGoodsDetail($goods_id);

//        $share_image = cthumb($goods_detail['goods_image'], 60);

        $goods_commonid = $goods_detail['goods_info']['goods_commonid'];

        if (empty($goods_detail)) {

            output_error('商品不存在');

        }


        // 默认预订商品不支持手机端显示

        if ($goods_detail['is_book']) {

            output_error('预订商品不支持手机端显示');

        }


        //推荐商品

        $model_store = Model('store');

        $hot_sales = $model_store->getHotSalesList($goods_detail['goods_info']['store_id'], 8, true);

        $goodsid_array = array();

        foreach ($hot_sales as $value) {

            $goodsid_array[] = $value['goods_id'];

        }

        $sole_array = Model('p_sole')->getSoleGoodsList(array('goods_id' => array('in', $goodsid_array)));


        $sole_array = array_under_reset($sole_array, 'goods_id');

        $goods_commend_list = array();

        foreach ($hot_sales as $value) {

            $goods_commend = array();

            $goods_commend['goods_id'] = $value['goods_id'];

            $goods_commend['goods_name'] = $value['goods_name'];

            $goods_commend['goods_price'] = $value['goods_price'];

            $goods_commend['goods_promotion_price'] = $value['goods_promotion_price'];

            if (!empty($sole_array[$value['goods_id']])) {

                $goods_commend['goods_promotion_price'] = $sole_array[$value['goods_id']]['sole_price'];

            }

            $goods_commend['goods_image_url'] = cthumb($value['goods_image'], 240);

            $goods_commend_list[] = $goods_commend;

        }


        $goods_detail['goods_commend_list'] = $goods_commend_list;

        $store_info = $model_store->getStoreInfoByID($goods_detail['goods_info']['store_id']);

        $goods_detail['store_info']['store_id'] = $store_info['store_id'];

        $goods_detail['store_info']['store_name'] = $store_info['store_name'];

        $goods_detail['store_info']['member_id'] = $store_info['member_id'];

        $goods_detail['store_info']['member_name'] = $store_info['member_name'];

        $goods_detail['store_info']['store_qq'] = $store_info['store_qq'];

        $goods_detail['store_info']['store_phone'] = $store_info['store_phone'];

        $goods_detail['store_info']['avatar'] = getMemberAvatarForID($store_info['member_id']);

        $goods_detail['store_info']['store_avatar'] = getStoreLogo($store_info['store_avatar']);

        $goods_detail['store_info']['goods_online'] = Model('goods')->getGoodsCommonOnlineCount(array('store_id' => $store_info['store_id']));

        $goods_detail['store_info']['fans'] = Model('favorites')->getStoreFavoritesCountByStoreId($store_info['store_id']);

        $goods_detail['store_info']['goods_count'] = $store_info['goods_count'];

        $map = Model()->table('store_map')->where(array('store_id'=>$store_info['store_id']))->order('map_id asc')->find();

        $goods_detail['store_info']['store_map'] = $map['address_info'];

        $goods_detail['store_info']['baidu_lng'] = $map['baidu_lng'];

        $goods_detail['store_info']['baidu_lat'] = $map['baidu_lat'];

        $goods_detail['store_info']['promise'] = UPLOAD_SITE_URL . '/' . (ATTACH_MOBILE . DS . $promise['value']);

        $goods_detail['store_info']['buy'] = UPLOAD_SITE_URL . '/' . (ATTACH_MOBILE . DS . $buy['value']);

        $goods_detail['store_info']['service'] = $service['value'];

        if ($store_info['is_own_shop']) {

            $goods_detail['store_info']['store_credit'] = array(

                'store_desccredit' => array(

                    'text' => '描述',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

                'store_servicecredit' => array(

                    'text' => '服务',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

                'store_deliverycredit' => array(

                    'text' => '物流',

                    'credit' => 5,

                    'percent' => '----',

                    'percent_class' => 'equal',

                    'percent_text' => '平',

                ),

            );

        } else {

            $storeCredit = array();

            $percentClassTextMap = array(

                'equal' => '平',

                'high' => '高',

                'low' => '低',

            );

            foreach ((array)$store_info['store_credit'] as $k => $v) {

                $v['percent_text'] = $percentClassTextMap[$v['percent_class']];

                $storeCredit[$k] = $v;

            }

            $goods_detail['store_info']['store_credit'] = $storeCredit;

        }


        //商品详细信息处理

        $goods_detail = $this->_goods_detail_extend($goods_detail);

//        $goods_detail['share_image'] = $share_image;


        // 如果已登录 判断该商品是否已被收藏

        if ($memberId = $this->getMemberIdIfExists()) {

            $c = (int)Model('favorites')->getGoodsFavoritesCountByGoodsId($goods_id, $memberId);

            $goods_detail['is_favorate'] = $c > 0;

            $goods_detail['cart_count'] = Model('cart')->countCartByMemberId($memberId);

        }
        $goods_detail['goods_info']['sx'] = [];
        if (!empty($goods_detail['goods_info']['category_id']) && !empty($goods_detail['goods_info']['kind_id']) &&!empty($goods_detail['goods_info']['texture_id'])){
            $systemCategoryModel = Model('systemcategory');
            $category = $systemCategoryModel::getCategoryText($goods_detail['goods_info']['category_id'], $goods_detail['goods_info']['kind_id'], $goods_detail['goods_info']['texture_id']);
            //$category = $systemCategoryModel::getSystemCategory();
//            if ($category['code'] == 1){
            if ($category){
                $goods_detail['goods_info']['sx'] = $category;
                if ($category['attribute'] == '其它'){
                    $goods_detail['goods_info']['sx']['attribute'] = $goods_detail['goods_info']['attribute'];
                }
                if ($category['texture'] == '其它'){
                    $goods_detail['goods_info']['sx']['texture'] = $goods_detail['goods_info']['texture'];
                }
            }
        }


        if ($goods_detail['goods_info']['goods_freight']){
            $content = '运费：'.$goods_detail['goods_info']['goods_freight'];
        } else {
            $content = '免运费';
        }
        if ($goods_detail['goods_info']['goods_storage']>0){
            //'库存：'.$goods_detail['goods_info']['goods_storage']
            $if_store_cn = '有货';
        } else {
            $if_store_cn = '无货';
        }

        $goods_detail['goods_hair_info'] = array('content' => $content, 'if_store_cn' => $if_store_cn, 'if_store' => true, 'area_name' => '全国');

        $goods_detail['goods_evaluate_info'] = array('good' => 0, 'normal' => 0, 'bad' => 0, 'all' => 0, 'img' => 0, 'good_percent' => 100, 'normal_percent' => 0, 'bad_percent' => 0, 'good_star' => 5, 'star_average' => 5);

        $goods_detail['goods_eval_list'] = '';

        $goods_commoninfo = $model_goods->getGoodsCommonInfoByID($goods_commonid,'_size');

        if ($goods_detail) {

            $model_goods_browse = Model('goods_browse')->addViewedGoods($goods_id, $memberId); //加入浏览历史数据库

//访问量+1
            Model('goods_common')->where('goods_commonid =' . $goods_commonid)->update(array('goods_click' => array('exp', 'goods_click + 1')));


//var_dump($goods_detail['goods_info']);
            if ($goods_detail['goods_info']['goods_price'] >= 1) {
                $goods_detail['goods_info']['goods_price'] = _formatPrice($goods_detail['goods_info']['goods_price']);
                $goods_detail['goods_info']['goods_marketprice'] = number_format(doubleval($goods_detail['goods_info']['goods_marketprice']));
                $goods_detail['goods_info']['goods_promotion_price'] = number_format(doubleval($goods_detail['goods_info']['goods_promotion_price']));
            } else {
                $goods_detail['goods_info']['goods_price'] = _formatPrice($goods_detail['goods_info']['goods_price']);
            }
            $order_id = Model('order_goods')->field('order_id')->where('goods_id = ' . $goods_id)->find();

            if ($order_id) {
                $pay_time = Model('orders')->field('payment_time,order_state')->where('order_id =' . $order_id['order_id'])->find();

                if ($pay_time['order_state'] >= 20) {
                    $goods_detail['goods_info']['payment_time'] = date('Y-m-d H:i', $pay_time['payment_time']);
                }
            }
            $goods_detail['goods_info']['_size'] = $goods_commoninfo['_size'];
            output_data($goods_detail);

        }

    }


    /**
     * 商品详细信息处理
     */

    private function _goods_detail_extend($goods_detail)
    {

        //整理商品规格

        unset($goods_detail['spec_list']);

        $goods_detail['spec_list'] = $goods_detail['spec_list_mobile'];

        unset($goods_detail['spec_list_mobile']);


        //整理商品图片

        unset($goods_detail['goods_image']);

        $goods_detail['goods_image'] = implode(',', $goods_detail['goods_image_mobile']);

        unset($goods_detail['goods_image_mobile']);


        //商品链接

        $goods_detail['goods_info']['goods_url'] = urlShop('goods', 'index', array('goods_id' => $goods_detail['goods_info']['goods_id']));


        //整理数据

        unset($goods_detail['goods_info']['goods_commonid']);
        unset($goods_detail['goods_info']['gc_id']);
        unset($goods_detail['goods_info']['gc_name']);
        unset($goods_detail['goods_info']['store_id']);
        unset($goods_detail['goods_info']['store_name']);
        unset($goods_detail['goods_info']['brand_id']);
        unset($goods_detail['goods_info']['brand_name']);
        unset($goods_detail['goods_info']['type_id']);
        unset($goods_detail['goods_info']['goods_image']);
        unset($goods_detail['goods_info']['goods_body']);
        unset($goods_detail['goods_info']['goods_state']);
        unset($goods_detail['goods_info']['goods_stateremark']);
        unset($goods_detail['goods_info']['goods_verify']);
        unset($goods_detail['goods_info']['goods_verifyremark']);
        unset($goods_detail['goods_info']['goods_lock']);
        unset($goods_detail['goods_info']['goods_addtime']);
        unset($goods_detail['goods_info']['goods_edittime']);
        unset($goods_detail['goods_info']['goods_selltime']);
        unset($goods_detail['goods_info']['goods_show']);
        unset($goods_detail['goods_info']['goods_commend']);
        unset($goods_detail['goods_info']['explain']);
        unset($goods_detail['goods_info']['buynow_text']);
        unset($goods_detail['groupbuy_info']);
        unset($goods_detail['xianshi_info']);


        return $goods_detail;

    }


    /**
     * 商品详细页
     */

    public function goods_bodyOp()
    {

        header("Access-Control-Allow-Origin:*");

        $goods_id = intval($_GET ['goods_id']);


        $model_goods = Model('goods');


        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_commonid');

        $goods_common_info = $model_goods->getGoodsCommonInfoByID($goods_info['goods_commonid']);

        if (empty($goods_common_info['goods_body'])){

            $images = Model('goods_images')->where(array('goods_commonid'=>$goods_info['goods_commonid']))->select();

            $goods_images = "";

            foreach ($images as $item){
                $item['goods_image'] = cthumb($item['goods_image'],1280,$item['store_id']);
                $goods_images .= "<img src=\"{$item['goods_image']}\" alt=\"image\">";
            }

            $goods_common_info['goods_body'] = $goods_images;
        }

        Tpl::output('web_seo', C('site_name'));

        Tpl::output('goods_id', $goods_id);

        Tpl::output('goods_common_info', $goods_common_info);

        Tpl::showpage('product_info');

    }


    public function auto_completeOp()
    {

        p(cookie('his_sh'));
        die;

        if ($_GET['term'] == '' && cookie('his_sh') != '') {

            $corrected = explode('~', cookie('his_sh'));

            if ($corrected != '' && count($corrected) !== 0) {

                $data = array();

                foreach ($corrected as $word) {

                    $row['id'] = $word;

                    $row['label'] = $word;

                    $row['value'] = $word;

                    $data[] = $row;

                }

                output_data($data);

            }

            return;

        }


        if (!C('fullindexer.open')) return;

        //output_error('1000');

        try {

            require(BASE_DATA_PATH . '/api/xs/lib/XS.php');

            $obj_doc = new XSDocument();

            $obj_xs = new XS(C('fullindexer.appname'));

            $obj_index = $obj_xs->index;

            $obj_search = $obj_xs->search;

            $obj_search->setCharset(CHARSET);

            $corrected = $obj_search->getExpandedQuery($_GET['term']);

            if (count($corrected) !== 0) {

                $data = array();

                foreach ($corrected as $word) {

                    $row['id'] = $word;

                    $row['label'] = $word;

                    $row['value'] = $word;

                    $data[] = $row;

                }

                output_data($data);

            }

        } catch (XSException $e) {

            if (is_object($obj_index)) {

                $obj_index->flushIndex();

            }

            output_error($e->getMessage());

            //             Log::record('search\auto_complete'.$e->getMessage(),Log::RUN);

        }


    }

    /**
     * 商品详细页运费显示
     *
     * @return unknown
     */

    public function calcOp()
    {

        $area_id = intval($_GET['area_id']);

        $goods_id = intval($_GET['goods_id']);

        output_data($this->_calc($area_id, $goods_id));

    }


    public function _calc($area_id, $goods_id)
    {

        $goods_info = Model('goods')->getGoodsInfo(array('goods_id' => $goods_id), 'transport_id,store_id,goods_freight');

        $store_info = Model('store')->getStoreInfoByID($goods_info['store_id']);

        if ($area_id <= 0) {

            if (strpos($store_info['deliver_region'], '|')) {

                $store_info['deliver_region'] = explode('|', $store_info['deliver_region']);

                $store_info['deliver_region_ids'] = explode(' ', $store_info['deliver_region'][0]);

            }

            $area_id = intval($store_info['deliver_region_ids'][1]);

            $area_name = $store_info['deliver_region'][1];

        }

        if ($goods_info['transport_id'] && $area_id > 0) {

            $freight_total = Model('transport')->calc_transport(intval($goods_info['transport_id']), $area_id);

            if ($freight_total > 0) {

                if ($store_info['store_free_price'] > 0) {

                    if ($freight_total >= $store_info['store_free_price']) {

                        $freight_total = '免运费';

                    } else {

                        $freight_total = '运费：' . $freight_total . ' 元，店铺满 ' . $store_info['store_free_price'] . ' 元 免运费';

                    }

                } else {

                    $freight_total = '运费：' . $freight_total . ' 元';

                }

            } else {

                if ($freight_total === false) {

                    $if_store = false;

                }

                $freight_total = '免运费';

            }

        } else {

            $freight_total = $goods_info['goods_freight'] > 0 ? '运费：' . $goods_info['goods_freight'] . ' 元' : '免运费';

        }


        return array('content' => $freight_total, 'if_store_cn' => $if_store === false ? '无货' : '有货', 'if_store' => $if_store === false ? false : true, 'area_name' => $area_name ? $area_name : '全国');

    }


    /*分店地址*/

    public function store_o2o_addrOp()
    {

        $store_id = intval($_GET ['store_id']);

        $model_store_map = Model('store_map');

        $addr_list_source = $model_store_map->getStoreMapList($store_id);

        foreach ($addr_list_source as $k => $v) {

            $addr_list_tmp = array();

            $addr_list_tmp['key'] = $k;

            $addr_list_tmp['map_id'] = $v['map_id'];

            $addr_list_tmp['name_info'] = $v['name_info'];

            $addr_list_tmp['address_info'] = $v['address_info'];

            $addr_list_tmp['phone_info'] = $v['phone_info'];

            $addr_list_tmp['bus_info'] = $v['bus_info'];

            $addr_list_tmp['province'] = $v['baidu_province'];

            $addr_list_tmp['city'] = $v['baidu_city'];

            $addr_list_tmp['district'] = $v['baidu_district'];

            $addr_list_tmp['street'] = $v['baidu_street'];

            $addr_list_tmp['lng'] = $v['baidu_lng'];

            $addr_list_tmp['lat'] = $v['baidu_lat'];

            $addr_list[] = $addr_list_tmp;

        }

        output_data(array('addr_list' => $addr_list));

    }


    /**
     * 商品评价视图
     */

    public function goods_evaluateOp()
    {

        Tpl::output('web_seo', C('site_name') . ' - ' . '商品评价');

        Tpl::showpage('product_eval_list');

    }


    /**
     * 商品评价
     */

    public function get_goods_evaluateOp()
    {

        $goods_id = intval($_GET['goods_id']);

        if ($goods_id <= 0) {

            output_error('产品不存在');

        }


        $goodsevallist = $this->_get_comments($goods_id, $_GET['type'], $this->page);

        $model_evaluate_goods = Model("evaluate_goods");

        $page_count = $model_evaluate_goods->gettotalpage();

        output_data(array('goods_eval_list' => $goodsevallist), mobile_page($page_count));


    }


    private function _get_comments($goods_id, $type, $page)
    {

        $condition = array();

        $condition['geval_goodsid'] = $goods_id;

        switch ($type) {

            case '1':

                $condition['geval_scores'] = array('in', '5,4');

                Tpl::output('type', '1');

                break;

            case '2':

                $condition['geval_scores'] = array('in', '3,2');

                Tpl::output('type', '2');

                break;

            case '3':

                $condition['geval_scores'] = array('in', '1');

                Tpl::output('type', '3');

                break;

        }


        //查询商品评分信息

        $model_evaluate_goods = Model("evaluate_goods");

        $goods_eval_list = $model_evaluate_goods->getEvaluateGoodsList($condition, 10);

        $goods_eval_list = Logic('member_evaluate')->evaluateListDity($goods_eval_list);

        foreach ($goods_eval_list as $key => $val) {

            $goods_eval_list[$key]['geval_addtime_date'] = date('Y-m-d', $val['geval_addtime']);

            if ($val['geval_isanonymous'] == 1) {

                $goods_eval_list[$key]['geval_frommembername'] = str_cut($val['geval_frommembername'], 2) . '***';

            }

            $image_array = explode(',', $val['geval_image']);

            foreach ($image_array as $k => $v) {

                $goods_eval_list[$key]['geval_image_240'][$k] = snsThumb($v, 240);

                $goods_eval_list[$key]['geval_image_1024'][$k] = snsThumb($v, 1024);

            }

        }

        return $goods_eval_list;

        //Tpl::output('goodsevallist',$goodsevallist);

        //Tpl::output('show_page',$model_evaluate_goods->showpage('5'));

    }

}

