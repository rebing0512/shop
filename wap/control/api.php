<?php

/**
 * APP接口
 */

defined('TTShop') or exit('Access Invalid!');

class apiControl extends mobileHomeControl
{

    private $target = [
        'store', 'navigation', 'goods'
    ];

    public function __construct()
    {
        parent::__construct();

    }

    public function sendMessagesOp($seller_system_id, $buyer_system_id, $money, $order)
    {

        $send_url = 'https://gateway.confolsc.com/services/notification/send/messages';
        $content = '您有一笔￥' . $money . '的订单已经交易成功。';

        switch (C('app_alias')) {
            case 'guoshizhijia':
                $app_id_num = 3;
                $template_id = '';
                break;
            case 'hongmuzhijia':
                $app_id_num = 2;
                $template_id = 'JO6UasY4Jt950lYiGKl6Afj3wlpKY0yaK8S8AcGEX-c';
                break;
            case 'ptgm':
                $app_id_num = 4;
                $template_id = '';
                break;
            case 'zhile':
                $app_id_num = 5;
                $template_id = '';
                break;
            default:
                $app_id_num = null;
                $template_id = '';
        }

        @curlPost($send_url, [
            'type' => 1,//消息类型(1.系统消息3.支付消息)
            'from_uid' => '0',//发送人系统id(系统消息时可为空)
            'to_uid' => $buyer_system_id,//接收方系统id
            'timestamp' => date('Y-m-d H:i:s'),//时间
            'app_id' => $app_id_num,//appid(数字)
            'web_title' => '支付成功提醒',//网页标题
            'title' => '支付成功提醒',//信息标题
            'content' => $content,//信息内容
            'url_to' => urlMobile('member_order', 'index', ['data-state' => 'state_shipping']),//跳转网址
            'alias' => C('app_alias')//alias(appid字符串)(可不传)
        ]);
        curlPost($send_url, [
            'type' => 1,//消息类型(1.系统消息3.支付消息)
            'from_uid' => '0',//发送人系统id(系统消息时可为空)
            'to_uid' => $seller_system_id,//接收方系统id
            'timestamp' => date('Y-m-d H:i:s'),//时间
            'app_id' => $app_id_num,//appid(数字)
            'web_title' => '支付成功提醒',//网页标题
            'title' => '支付成功提醒',//信息标题
            'content' => $content,//信息内容
            'url_to' => urlMobile('seller_order', 'index', ['data-state' => 'state_pay']),//跳转网址
            'alias' => C('app_alias')//alias(appid字符串)(可不传)
        ]);
        $member_url = 'https://gateway.confolsc.com/services/user/get_app_bind_relation';
        $seller_info = json_decode(curlPost($member_url, [
            'appid' => C('app_alias'),
            'user_id' => $seller_system_id
        ]), 1);
        $buyer_info = json_decode(curlPost($member_url, [
            'appid' => C('app_alias'),
            'user_id' => $buyer_system_id
        ]), 1);

        $access_token_url = 'https://mbcsc.confolsc.com/get_wechat_access_token.php?alias=' . C('app_alias');

        $access_token = json_decode(curlGet($access_token_url), 1);

        $weixin_url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token['result'];

        if (!empty($access_token)) {

            if (!empty($seller_info['result']['users']) && $seller_info['code'] == 1) {

                //发送微信推送

                foreach ($seller_info['result']['users'] as $value) {
                    if (!empty($value['openid'])) {
                        curlPost($weixin_url, json_encode([
                            "touser" => $value['openid'],
                            "template_id" => $template_id,
                            "url" => urlMobile('seller_order', 'index', ['data-state' => 'state_pay']),
                            "data" => [
                                "first" => ['value' => "您有一笔成功的订单"],
                                "keyword1" => ['value' => '￥' . $money],
                                "keyword2" => ['value' => $order],
                                "Remark" => ['value' => '您好，顾客已经成功支付。' . date('Y-m-d H:i:s')]
                            ]
                        ]));
                    }
                }
            }
            if (!empty($buyer_info['result']['users']) && $buyer_info['code'] == 1) {
                foreach ($buyer_info['result']['users'] as $value) {
                    if (!empty($value['openid'])) {
                        curlPost($weixin_url, json_encode([
                            "touser" => $value['openid'],
                            "template_id" => $template_id,
                            "url" => urlMobile('member_order', 'index', ['data-state' => 'state_pay']),
                            "data" => [
                                "first" => ['value' => "您有一笔成功的订单"],
                                "keyword1" => ['value' => '￥' . $money],
                                "keyword2" => ['value' => $order],
                                "Remark" => ['value' => '您成功支付了一笔订单。' . date('Y-m-d H:i:s')]
                            ]
                        ]));
                    }
                }
            }
        }

    }

    /**
     * IM中发布商品返回接口
     */

    public function getMyGoodsListOp()
    {
        $hash_key = trim($_POST['hash_key']);
        $model = Model();
//        echo json_encode([
//            'code' => 0,
//            'result' => json_decode(file_get_contents('php://input'), true)
//        ]);
//        exit;
        if (empty($hash_key)) {
            $data = json_decode(file_get_contents('php://input'), true);
            $_GET['curpage'] = intval($data['page']);
            $condition['hashkey'] = $data['hash_key'];
            $page = $data['page'];
            if (empty($data['hash_key'])) {
                echo json_encode([
                    'code' => 0,
                    'result' => [
                        'msg' => '参数异常，hash_key为空'
                    ]
                ]);
                exit;
            }
        } else {
            $_GET['curpage'] = intval($_POST['page']);
            $condition['hashkey'] = $hash_key;
            $page = $_POST['page'];
            $fields = 'member.hashkey,member.member_name,store.store_id,store.store_name,store.store_avatar,goods.goods_id,goods.goods_name,goods.goods_image,goods.goods_price,goods.goods_jingle';
//            $goods_list = $model->table('member,store,goods')->join('right')->on('member.member_id=store.member_id,store.store_id=goods.store_id')
//                ->where($condition)->field($fields)->order('goods_addtime desc')->page(10)->select();
        }
        $store_info = $model->table('member,store')->join('left')->on('member.member_id=store.member_id')
            ->where($condition)
            ->field('store.store_id,store.store_name,store.store_avatar')->find();

        if (empty($store_info)) {
            echo json_encode([
                'code' => 0,
                'result' => ['msg' => '用户未开通店铺']
            ]);
            exit;
        }

        $store_info['store_avatar'] = getStoreLogo($store_info['store_avatar']);

        $goods_model = Model('goods');

        $map = [
            'store_id' => $store_info['store_id'],
            'goods_state' => 1
        ];

        $goods_list = $goods_model->where($map)->order('goods_addtime desc')
            ->page(10)->select();

        if (empty($goods_list)) {
            echo json_encode([
                'code' => 0,
                'result' => ['msg' => '店铺内未上传商品']
            ]);
            exit;
        }

        $allpage = $goods_model->gettotalpage();
        if (!empty($goods_list)) {
            foreach ($goods_list as $key => $value) {
                $goods_list[$key]['goods_image'] = cthumb($value['goods_image'], 360, $value['store_id']);
                $goods_list[$key]['goods_price'] = _formatPrice($value['goods_price'], '￥');
                $goods_list[$key]['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $value['goods_id']]);
                $goods_list[$key]['goods_jingle'] = $value['goods_jingle'] ?: '店主很懒，没有留下任何商品信息...';
            }
            $store_info = [
                'store_id' => $store_info['store_id'],
                'store_name' => $store_info['store_name'],
                'store_avatar' => getStoreLogo($store_info['store_avatar'])
            ];
            echo json_encode([
                'code' => 1,
                'result' => [
                    'page' => $page,
                    'page_total' => mobile_page($allpage),
                    'store_info' => $store_info,
                    'goods_list' => $goods_list
                ]
            ]);
            exit;
        }
    }

    public function hot_goodsOp()
    {
        $_GET['curpage'] = intval($_REQUEST['page']);
        $model = Model();
        $data = $model->table('recommend')->where('h_type=10086')->order('id desc')->find();
        $fields = 'goods.goods_name,goods.goods_image,goods.goods_price,goods.store_name,goods.goods_id,goods.store_id';
        $goods_list = $model->table('index_recommend_goods,goods')->join('right')->on('index_recommend_goods.rec_goods_id=goods.goods_id')->field($fields)->where('index_recommend_goods.rec_gc_id =' . $data['id'])->page(10)->order('index_recommend_goods.sort asc')->select();


        if ($goods_list) {
            if (!empty($goods_list)) {
                $allpage = $model->gettotalpage();

                if ($_GET['curpage'] > $allpage) {
                    echo json_encode([
                        'code' => 0,
                        'result' => ['msg' => '没有更多数据']
                    ]);
                    exit;
                }

                foreach ($goods_list as $k => $v) {
                    if (!isset($goods_list[$k]['goods_id'])) {
                        unset($goods_list[$k]);
                    } else {
                        $goods_list[$k]['goods_image'] = cthumb($v['goods_image'], 360, $v['store_id']);
                        $goods_list[$k]['price'] = _formatPrice($v['goods_price'], '￥');
                        $goods_list[$k]['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $v['goods_id']]);
                    }
                }
                echo json_encode([
                    'code' => 1,
                    'result' => [
                        'page' => $_GET['curpage'],
                        'page_total' => mobile_page($allpage),
                        'goods_list' => $goods_list
                    ]
                ]);
                exit;
            } else {
                echo json_encode([
                    'code' => 0,
                    'result' => ['msg' => '商品推荐列表为空...']
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'code' => 400,
                'result' => ['msg' => '网络请求失败']
            ]);
            exit;
        }

    }

    /*
     * 中心支付通知接收
     */

    public function notifyOp()
    {
        if (!empty($_POST['order_id'])) {
            //支付成功,处理订单状态，最后返回success
            $order_id = $_POST['order_id'];
            //订单信息查询
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => "https://gateway.confolsc.com/payment/order/query?trade_no={$order_id}",
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT => 10
            ]);
            $resource = curl_exec($ch);

            curl_close($ch);
            $resource = json_decode($resource, true);
            if ($resource['code'] == 1) {

                $appid = C('app_alias');

                curlPost("https://{$appid}bbs.confolsc.com/api/newTask", [
                    'user_id' => $resource['result']['user_id'],
                    'param' => 'buyGoods'
                ]);

                $order = Model('order')->getOrderInfo(['p_trade_no' => $resource['result']['p_trade_no']]);

                if (!empty($order['store_id']))
                    $store_info = Model('store')->getStoreInfo(['store_id' => $order['store_id']]);

                if (!empty($store_info))
                    $seller = Model('member')->getMemberInfoByID($store_info['member_id']);

//                $seller = Model()->table('member,store')->join('right')->on('member.member_id = store.member_id')->where('store.store_id =' . $order['store_id'])->find();
                //syslog(LOG_ERR,$seller);

                @$this->sendMessagesOp($seller['weixin_unionid'], $resource['result']['user_id'], $order['order_amount'], $order['order_sn']);

                $resource = $resource['result'];

                if ($resource['status'] == 2) {
                    $payment_channel = $resource['payment_channel'];
                    switch ($payment_channel) {
                        case 'weixin':
                            $payment_channel = 'online';
                            break;
                    }
                    $update_order = array();
                    $update_order['order_state'] = ORDER_STATE_PAY;
                    $update_order['payment_time'] = $resource['paid_dateline'] ? $resource['paid_dateline'] : TIMESTAMP;
                    //$update_order['payment_code'] = $payment_channel;
                    $update_order['trade_no'] = $order_id;
                    $update = Model('order')->editOrder($update_order, array('order_sn' => $resource['out_trade_no'], 'order_state' => ORDER_STATE_NEW));
                    if (!$update) {
                        throw new Exception(L('nc_common_save_fail'));
                    } else {
                        echo 'success';
                    }
                }
            }

        }
    }

    /*
     * MiniProgram 订单支付成功通知接收
     */
    public function pmcore_notifyOp()
    {
        if ($_POST['hash']){
            $model = Model('order');
            if ($_POST['status'] == 2){
                $update = [
                    'order_state' => ORDER_STATE_PAY,
                    'payment_time' => $_POST['paid_dateline']
                ];
                $model->editOrder($update,['order_sn' => $_POST['out_trade_no'], 'order_state' => ORDER_STATE_NEW]);
            }
        }
    }

    //文章特殊样式插入
    public function remote_singleOp()
    {
        $target = trim($_REQUEST['target']);
        $model = Model();
        if (!in_array($target, $this->target)) {
            echo json_encode([
                'code' => 0,
                'result' => '参数无效'
            ]);
            exit;
        } else {
            switch ($target) {
                case 'store':
                    $where = [];
                    if (isset($_REQUEST['store_id']) && !empty($_REQUEST['store_id'])) {
                        $where['store_id'] = ['in', explode(',', trim($_REQUEST['store_id']))];
                        $store = Model()->table('store')->where($where)->select();
                        $favorites = Model('favorites');
                        if (!empty($store)) {
                            $store_info = null;
                            foreach ($store as $k => $v) {
                                $store_info[$k]['app_alias'] = C('app_alias');
                                $store_info[$k]['follow_store_url'] = urlMobile('api', 'favorites_store_add');
                                $store_info[$k]['store_id'] = $v['store_id'];
                                $store_info[$k]['store_name'] = $v['store_name'];
                                $store_info[$k]['store_avatar'] = getStoreLogo($v['store_avatar']);
                                $store_info[$k]['store_url'] = urlMobile('store', 'index', ['store_id' => $v['store_id']]);
                                $store_info[$k]['store_collect'] = $v['store_collect'];
                                $store_info[$k]['store_talk'] = $v['talk'];
                                $store_info[$k]['store_follow'] = $favorites->getStoreFavoritesCountByStoreId('', $v['member_id']);
                            }
                            echo json_encode([
                                'code' => 1,
                                'result' => $store_info
                            ]);
                            exit;
                        } else {
                            echo json_encode([
                                'code' => 0,
                                'result' => '目标数据不存在'
                            ]);
                            exit;
                        }
                    } else {
                        echo json_encode([
                            'code' => 0,
                            'result' => '参数存在未知问题'
                        ]);
                        exit;
                    }
                    break;
                case 'goods':
                    $where = [];
                    if (isset($_REQUEST['goods_id']) && !empty($_REQUEST['goods_id'])) {
                        $where['goods_id'] = ['in', explode(',', trim($_REQUEST['goods_id']))];
                        $goods = Model()->table('goods')->where($where)->select();
                        if (!empty($goods)) {
                            $goods_info = null;
                            foreach ($goods as $k => $v) {
                                $goods_info[$k]['goods_id'] = $v['goods_id'];
                                $goods_info[$k]['goods_name'] = trim($v['goods_name']);
                                $goods_info[$k]['goods_image'] = cthumb($v['goods_image'], 360, $v['store_id']);
                                $goods_info[$k]['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $v['goods_id']]);
                                $goods_info[$k]['sm_goods_url'] = C('app_alias').'/goods/'.$v['goods_id'];
                                $goods_info[$k]['goods_price'] = trim(_out_formatPrice($v['goods_price'], '￥'));
                                // //替换回车换行
                                $goods_info[$k]['goods_jingle'] =  str_replace(array("\r", "\n", "\r\n"), "",$v['goods_jingle']);
                                $goods_info[$k]['store_name'] = trim($v['store_name']);
                                $goods_info[$k]['goods_storage'] = $v['goods_storage'];
                                $goods_info[$k]['goods_state'] = $v['goods_state'];
                            }
                            echo json_encode([
                                'code' => 1,
                                'result' => $goods_info
                            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
                            exit;
                        } else {
                            echo json_encode([
                                'code' => 0,
                                'result' => '目标数据不存在'
                            ]);
                            exit;
                        }
                    } else {
                        echo json_encode([
                            'code' => 0,
                            'result' => '参数存在未知问题'
                        ]);
                        exit;
                    }
                    break;
                default:
                    $template = "";
                    break;
            }
            exit;
        }
    }

    public function hot_goods_recommendOp()
    {
        //推荐店铺（后台）
        $stores = Model()->table('index_recommend_store,store')->join('left')->on('index_recommend_store.store_id=store.store_id')->order('index_recommend_store.sort asc')->select();
        //推荐商品（商户中心）
        $recommend_goods = Model()->table('hot_goods_recommend,goods')->join('left')->on('hot_goods_recommend.goods_id=goods.goods_id')->where('goods.goods_state=1')->order('sort asc,id desc')->select();
        $recommend_stores = [];
        if (!empty($stores) && !empty($recommend_goods)) {
            foreach ($stores as $item) {
                $recommend_stores[$item['store_id']]['store_info'] = [
                    'store_url' => urlMobile('store', 'index', ['store_id' => $item['store_id']]),
                    'recommend_pic' => getStoreLogo($item['recommend_pic'])
                ];
                foreach ($recommend_goods as $k => $v) {
                    if ($item['store_id'] == $v['store_id'] && count($recommend_stores[$item['store_id']]['goods_list']) < 7) {
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['goods_id'] = $v['goods_id'];
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['goods_name'] = $v['goods_name'];
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['goods_price'] = _formatPrice($v['goods_price'], '￥');
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['goods_img'] = cthumb($v['goods_image'], 360, $v['store_id']);
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['store_name'] = $v['store_name'];
                        $recommend_stores[$item['store_id']]['goods_list'][$k]['goods_url'] = urlMobile('goods', 'detail', ['goods_id' => $v['goods_id']]);
                    }
                }
            }
        }
        if (!empty($recommend_stores)) {
            echo json_encode([
                'code' => 1,
                'result' => $recommend_stores
            ]);
        } else {
            echo json_encode([
                'code' => 0,
                'result' => [
                    'msg' => '尚无推荐商品'
                ]
            ]);
        }
    }

    //
    public function favorites_store_addOp()
    {
        $fav_id = intval($_POST['store_id']);

        if ($fav_id <= 0) {

            output_error('参数错误');

        }


        $favorites_model = Model('favorites');


        //判断是否已经收藏

        $favorites_info = $favorites_model->getOneFavorites(array(

            'fav_id' => $fav_id,

            'fav_type' => 'store',

            'member_id' => $_POST['member_id'],

        ));

        if (!empty($favorites_info)) {

            output_error('您已经关注了该店铺');

        }


        //判断店铺是否为当前会员所有

        $seller_info = Model('seller')->getSellerInfo(array('member_id' => $_POST['member_id']));

        if ($fav_id == $seller_info['store_id']) {

            output_error('您不能关注自己的店铺');

        }


        //添加收藏

        $insert_arr = array();

        $insert_arr['member_id'] = $_POST['member_id'];

        $insert_arr['member_name'] = $_POST['member_name'];

        $insert_arr['fav_id'] = $fav_id;

        $insert_arr['fav_type'] = 'store';

        $insert_arr['fav_time'] = time();

        $result = $favorites_model->addFavorites($insert_arr);


        if ($result) {

            //增加收藏数量

            $store_model = Model('store');

            $store_model->editStore(array('store_collect' => array('exp', 'store_collect+1')), array('store_id' => $fav_id));

            $condition['store_id'] = $fav_id;

            $store_info = $store_model->getStoreInfo($condition);

            $appid = C('app_alias');

            @curlPost("https://{$appid}bbs.confolsc.com/api/newTask", [
                'user_id' => $this->member_info['weixin_unionid'],
                'param' => 'collectionShop'
            ]);

            output_data($store_info['store_collect']);

        } else {

            output_error('收藏失败');

        }
    }

    public function follow_listOp()
    {
        $system_id = intval($_REQUEST['system_id']);
        if ($system_id) {
            $field = 'member_id';
            $member = Model('member')->getMemberInfo(['weixin_unionid' => $system_id], $field);
            $list = Model('favorites')->getFavoritesList(['member_id' => $member['member_id'], 'fav_type' => 'store'], 'store_id');
            echo json_encode($list);
        } else {
            return NULL;
        }
    }

    public function shareOp()
    {
        $redirect = urldecode($_GET['redirect_url']);
        $redirect = str_replace('&amp;', '&', $redirect);
        redirect($redirect);
    }

    /**
     * 用户商城店铺认证状态 >=2 为已经认证（2，3认证，4高级）
     */

    public function check_statuOp()
    {
        list($system_id, $appid) = [intval($_REQUEST['id']), $_REQUEST['appid']];
        switch ($appid)
        {
            case 'guoshizhijia':
                break;
            case 'hongmuzhijia':
                break;
            case 'ptgm':
                break;
            case 'zhile':
                break;
            default:
                break;
        }
        if ($system_id)
        {
            try{
                $member_info = Model('member')->getMemberInfo(['weixin_unionid' => $system_id]);
            } catch (\Exception $exception) {
                echo json_encode([
                    'code' => 0,
                    'result' => [
                        'msg' => '服务器内部错误'
                    ]
                ]);
                exit;
            }
            if ($member_info)
            {
                $store_info = Model('store')->getStoreInfo(['member_id' => $member_info['member_id']]);
                if ($store_info)
                {
                    echo json_encode([
                        'code' => 1,
                        'result' => [
                            'data' => [
                                'type' => $store_info['store_type']
                            ]
                        ]
                    ]);
                    exit;
                } else {
                    echo json_encode([
                        'code' => 0,
                        'result' => [
                            'msg' => '未找到该会员拥有的店铺信息'
                        ]
                    ]);
                }
            } else {
                echo json_encode([
                    'code' => 0,
                    'result' => [
                        'msg' => '未查询到该会员'
                    ]
                ]);
            }
        } else {
            echo json_encode([
                'code' => 0,
                'result' => [
                    'msg' => '缺少关键参数'
                ]
            ]);
        }
    }

    /**
     * 获取用户发布商品数量
     */

    public function goods_publishedOp()
    {
        list($system_id, $appid) = [intval($_REQUEST['id']), $_REQUEST['appid']];
        switch ($appid)
        {
            case 'guoshizhijia':
                break;
            case 'hongmuzhijia':
                break;
            case 'ptgm':
                break;
            case 'zhile':
                break;
            default:
                break;
        }
        if ($system_id)
        {
            //全局id存在 member,store,goods
            try {
                $model = Model();
                $condition = [
                    'member.weixin_unionid' => $system_id
                ];
                $status = $model->table('member,store,goods')->join('left')->on('member.member_id=store.member_id,store.store_id=goods.store_id')->where($condition)->count();
            } catch (\Exception $e) {
                echo json_encode([
                    'code' => 0,
                    'result' => [
                        'msg' => '服务器内部错误'
                    ]
                ]);
                exit;
            }
            echo json_encode([
                'code' => 1,
                'result' => [
                    'data' => [
                        'statu' => $status ? 1 : 0
                    ]
                ]
            ]);
        } else {
            echo json_encode([
                'code' => 0,
                'result' => [
                    'msg' => '缺少关键参数'
                ]
            ]);
        }
    }

    public function new_uploadOp()
    {
        header("Access-Control-Allow-Origin: *");

        $condition = [];

        $order = 'goods_addtime desc';

        $model = Model()->table('goods');

        $condition['goods_state'] = 1;

        $data = $model->where($condition)->limit(100)->field('goods_id,goods_image,goods_name,store_id,goods_price')->order($order)->select();

        if (!$data) {
            echo json_encode([
                'code' => 1,
                'result' => [
                    'data' => [],
                    'info' => [
                        'href' => urlMobile('goods', 'supermarket'),
                        'id' => 4,
                        'isShowTitle' => true,
                        'openNew' => true,
                        'removeHeader' => true,
                        'title' => '推客-转转赚',
                        'tplDefaultTag' => '点击进入',
                        'tplname' => 'scrollCardCutBgNew'
                    ]
                ]
            ]);
        } else {
            if (count($data)>0){
                $new_data = [];
                foreach ($data as $index => $item) {
                    $new_data[$index]['count'] = 0;
                    $new_data[$index]['href'] = urlMobile('goods', 'tk', ['goods_id' => $item['goods_id']]);
                    $new_data[$index]['goods_price'] = _formatPrice($item['goods_price'], '¥');
                    $new_data[$index]['id'] = $item['goods_id'];
                    $new_data[$index]['describe'] = "分享返利15%";
                    $new_data[$index]['img'] = cthumb($item['goods_image'], 360, $item['store_id']);
                    $new_data[$index]['openNew'] = true;
                    $new_data[$index]['removeHeader'] = true;
                    $new_data[$index]['title'] = $item['goods_name'];
                }
                echo json_encode([
                    'code' => 1,
                    'result' => [
                        'data' => $new_data,
                        'info' => [
                            'href' => urlMobile('goods', 'supermarket'),
                            'id' => 4,
                            'isShowTitle' => true,
                            'openNew' => true,
                            'removeHeader' => false,
                            'title' => '推客-转转赚（自用省钱，转发赚钱）',
                            'tplDefaultTag' => '点击进入',
                            'tplname' => 'scrollCardCutBgNew'
                        ]
                    ]
                ]);
            }
        }
    }
}