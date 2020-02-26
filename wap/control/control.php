<?php

/**
 * mobile父类
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');


/********************************** 前台control父类 **********************************************/
class mobileControl
{


    //客户端类型

    protected $client_type_array = array('android', 'wap', 'wechat', 'ios', 'windows');

    protected $userId = null;
    protected $user = [];
    protected $sso_token = null;

    public function judge_client()
    {
        if (preg_match('/mbcore/i', $_SERVER['HTTP_USER_AGENT'])) {
            //ios或者app
            return false;
        } else {
            //wap
            return true;
        }

    }

    public static function uploadToRemote($post_data, $path, $url = 'https://gateway.confolsc.com/files/upload', $timeout = 5)
    {
        $resource = [
            'file' => new CURLFile("$path"),
            'type' => 'avatar',
            'timestamp' => date('YmdHis')
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $resource);


        $response = curl_exec($ch);
        $errorCode = curl_errno($ch);
        curl_close($ch);

        $response = json_decode($response, 1);
        if (!$response || $response['code'] != 1) {
            throw new \Exception($response['result']['msg'] ?: 'unknown');
        }
        return $response['result']['serverId'];
    }

    public static function getPlatform()
    {
        /**
         * 验证平台
         */
        // 如果有platform参数
        $platform = preg_match('/mbcore/i', $_SERVER['HTTP_USER_AGENT']) && preg_match('/iphone/i', $_SERVER['HTTP_USER_AGENT']) ? 'ios' : null;

        // 如果UA中有mbcore字样
        if (!$platform)
            $platform = preg_match('/mbcore/i', $_SERVER['HTTP_USER_AGENT']) ? 'android' : null;

        // 判定微信环境
        if (!$platform)
            $platform = preg_match('/micromess/i', $_SERVER['HTTP_USER_AGENT']) ? 'wechat' : null;

        // 未来客户端
        if (!$platform)
            $platform = preg_match('/mbcclient/i', $_SERVER['HTTP_USER_AGENT']) ? 'client' : null;

        // 判定手机环境:android-wap
        if (!$platform)
            $platform = preg_match('/android/i', $_SERVER['HTTP_USER_AGENT']) ? 'android-wap' : null;
        // 判定手机环境:iphone-wap
        if (!$platform)
            $platform = preg_match('/iphone/i', $_SERVER['HTTP_USER_AGENT']) ? 'iphone-wap' : null;
        // 判定手机环境:ipad-wap
        if (!$platform)
            $platform = preg_match('/ipad/i', $_SERVER['HTTP_USER_AGENT']) ? 'ipad-wap' : null;

        // 否则为一般浏览器
        if (!$platform)
            $platform = 'pc';

        return $platform;
    }

    public function sss()
    {
        try {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => "https://mbcsc.confolsc.com/get_wechat_access_token.php?alias=" . C('app_alias'),
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 2,
            ]);
            $data = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($data, TRUE);
            return $data['result'];
        } catch (\Exception $e) {
            return false;
        }
    }

    //列表默认分页数

    protected $page = 5;


    public function __construct()
    {
        Language::read('mobile');

//        $_SESSION = [];
//        $_COOKIE = [];


        //分页数处理

        $page = intval($_GET['page']);
        if ($page > 0) {
            $this->page = $page;
        }

        Tpl::output('platform', self::getPlatform());

        $appid = C('app_alias');

        $bbs_url = "https://{$appid}bbs.confolsc.com";
        $discover = "https://{$appid}bbs.confolsc.com/discover";
        $develop_url = "https://{$appid}bbs.confolsc.com/developing";

        switch (C('app_alias')) {
            case 'guoshizhijia':
                $base_css = 'guoshi_base';
                $street_title = '艺术馆';
                $street_url = urlMobile('shop', 'store_street');
                $shop_name = '艺术馆';
                $chat_name = '消息';
                $faxian = '发现';
                $shop_index = urlMobile('shop', 'store_street');
                $top_nav = [
                    0 => [
                        'name' => '集市'
                    ],
                    1 => [
                        'name' => '拍卖',
                        'url' => "https://{$appid}paimai.confolsc.com/?row=1"
                        //urlMobile('shop', 'great_store')
                    ],
                    2 => [
                        'name' => '好店',
                        'url' => urlMobile('shop', 'great_store')
                    ],
                    3 => [
                        'name' => '',
                        'url' => ''
                    ]
                ];
                break;
            case 'hongmuzhijia':
                $base_css = 'hongmu_base';
                $street_title = '品牌街';
                $street_url = urlMobile('shop', 'store_street');
                $shop_name = '批发';
                $chat_name = '艺盟';
                $faxian = '帖吧';
                $shop_index = urlMobile('shop', 'store_street');
                $top_nav = [
                    0 => [
                        //'name' => '推客'
                        'name' => '集市'
                    ],
                    1 => [
                        'name' => '拍卖',
                        'url' => "https://{$appid}paimai.confolsc.com/?row=1"
//                        'name' => '好店',
//                        'url' => urlMobile('shop', 'great_store')
                    ]
                ];
                break;
            case 'ptgm':
                $base_css = 'hongmu_base';
                $street_title = '品牌街';
                $street_url = urlMobile('shop', 'store_street');
                $shop_name = '购物';
                $chat_name = '艺盟';
                $faxian = '帖吧';
                $shop_index = urlMobile('index');
                $top_nav = [
                    1 => [
                        'name' => '拍卖',
                        'url' => "https://{$appid}paimai.confolsc.com/recommend"
                    ]
                ];
                break;
            case 'zhile':
                $base_css = 'zhile_base';
                $street_title = '品牌街';
                $street_url = urlMobile('shop', 'store_street');
                $shop_name = '商城';
                $chat_name = '消息';
                $faxian = '帖吧';
                $shop_index = urlMobile('index');
                $top_nav = [
                    0 => [
                        'name' => '集市'
                    ],
                    1 => [
                        'name' => '拍卖',
                        'url' => "https://{$appid}paimai.confolsc.com/recommend"
                    ]
                ];
                break;
        }

        Tpl::output('client',$this->judge_client());
        Tpl::output('bbs_url', $bbs_url);
        Tpl::output('top_nav', $top_nav);
        Tpl::output('base_css', $base_css);
        Tpl::output('discover', $discover);
        Tpl::output('develop_url', $develop_url);
        Tpl::output('street_title', $street_title);
        Tpl::output('street_url', $street_url);
        Tpl::output('shop_name', $shop_name);
        Tpl::output('chat_name', $chat_name);
        Tpl::output('faxian', $faxian);
        Tpl::output('shop_index', $shop_index);


        $sso_token = $_GET['sso_token'];
        if (!$sso_token)
            $sso_token = $_SERVER['HTTP_X_AUTH_ACCESS_TOKEN'];
        if (!$sso_token)
            $sso_token = $_COOKIE['mbcore_sso_token'];

        if ($sso_token) {
            $this->sso_token = $sso_token;
        } else {
            $this->sso_token = null;
        }
        header("sso:{$this->sso_token}");
        Tpl::output('sso_token',$sso_token);
        if (!empty($sso_token) && $_GET['con'] !== 'auto') {
            require_once 'auto.php';
            $auto = new autoControl(true);
            $auto->checkAuthOp(false, $sso_token);
        }

        // 关联核心分类

        $chash = '';
        $__ccid = 1;
        # 如果URL中有__ccid查询数据库获取绑定关系
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        if (!empty($_GET['__ccid'])) {
            foreach ($category['result']['category'] as $key => $item) {
                if ($_GET['__ccid'] == $item['id']) {
                    $_SESSION['__ccid'] = $item['id'];
                    $_SESSION['__cname'] = $item['name'];
                }
            }
        } else if (empty($_SESSION['__ccid'])) {
            $_SESSION['__ccid'] = $category['result']['category'][0]['id'];
            $_SESSION['__cname'] = $category['result']['category'][0]['name'];
        }
        header("PCCID: " . $_SESSION['__ccid']);

    }


    /**
     * 输出会员等级
     * @param bool $is_return 是否返回会员信息，返回为true，输出会员信息为false
     */

    protected function getMemberAndGradeInfo($is_return = false)
    {

        $member_info = array();

        //会员详情及会员级别处理

        if ($_SESSION['member_id']) {

            $model_member = Model('member');

            $member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);

            if ($member_info) {

                $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));

                $member_info = array_merge($member_info, $member_gradeinfo);

                $member_info['security_level'] = $model_member->getMemberSecurityLevel($member_info);

            }

        }

        if ($is_return == true) {//返回会员信息

            return $member_info;

        } else {//输出会员信息

            Tpl::output('member_info', $member_info);

        }

    }

}


class mobileHomeControl extends mobileControl
{

    public function __construct()
    {

        parent::__construct();

        //输出会员信息

        $this->getMemberAndGradeInfo(false);

        Tpl::setDir('home');

        Tpl::setLayout('home_layout');

        if (!C('site_status')) halt(C('closed_reason'));

    }


    protected function getMemberIdIfExists()

    {

        $key = $_POST['key'];

        if (empty($key)) {

            $key = $_GET['key'];

        }


        $model_mb_user_token = Model('mb_user_token');

        $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);

        if (empty($mb_user_token_info)) {

            return 0;

        }


        return $mb_user_token_info['member_id'];

    }

    /**
     * 取出字符串首字母(包括汉字)
     */
    protected function getFirstChar($string)
    {
        if (ord($string) >= "1" && ord($string) <= ord("z")) {
            return strtoupper($string);
        }
        $s = iconv("UTF-8", "gb2312", $string);
        //$s=$string;//无需转换的情况
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 and $asc <= -20284) return "A";
        if ($asc >= -20283 and $asc <= -19776) return "B";
        if ($asc >= -19775 and $asc <= -19219) return "C";
        if ($asc >= -19218 and $asc <= -18711) return "D";
        if ($asc >= -18710 and $asc <= -18527) return "E";
        if ($asc >= -18526 and $asc <= -18240) return "F";
        if ($asc >= -18239 and $asc <= -17923) return "G";
        if ($asc >= -17922 and $asc <= -17418) return "H";
        if ($asc >= -17417 and $asc <= -16475) return "J";
        if ($asc >= -16474 and $asc <= -16213) return "K";
        if ($asc >= -16212 and $asc <= -15641) return "L";
        if ($asc >= -15640 and $asc <= -15166) return "M";
        if ($asc >= -15165 and $asc <= -14923) return "N";
        if ($asc >= -14922 and $asc <= -14915) return "O";
        if ($asc >= -14914 and $asc <= -14631) return "P";
        if ($asc >= -14630 and $asc <= -14150) return "Q";
        if ($asc >= -14149 and $asc <= -14091) return "R";
        if ($asc >= -14090 and $asc <= -13319) return "S";
        if ($asc >= -13318 and $asc <= -12839) return "T";
        if ($asc >= -12838 and $asc <= -12557) return "W";
        if ($asc >= -12556 and $asc <= -11848) return "X";
        if ($asc >= -11847 and $asc <= -11056) return "Y";
        if ($asc >= -11055 and $asc <= -10247) return "Z";
        return 0;
    }

}


class BaseLoginControl extends mobileControl
{

    /**
     * 构造函数
     */

    public function __construct()
    {


        if (!C('site_status')) halt(C('closed_reason'));

        Tpl::setDir('member');

        Tpl::setLayout('login_layout');

    }


}


class mobileMemberControl extends mobileControl
{


    protected $member_info = array();


    public function __construct()
    {
        parent::__construct();

        if (!C('site_status')) halt(C('closed_reason'));
        Tpl::setDir('member');
        Tpl::setLayout('member_layout');

        $agent = $_SERVER['HTTP_USER_AGENT'];


        if ($_GET["con"] != 'auto') {
            $model_mb_user_token = Model('mb_user_token');
            $key1 = $_SESSION['key'];
            $key2 = $_COOKIE["key"] ? $_COOKIE["key"] : $_GET['key'];
            if (!empty($key1)) {
                $key = $key1;
            } else {
                $key = $key2;
            }
            $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);

            @header("UK:" . $key);
            if (empty($mb_user_token_info)) {
                session_destroy();
                unset($_COOKIE);
                //showMessage('请登录',urlMobile('login'),'html','error');
                if (IS_AJAX) {
                    echo json_encode([
                        'nologin' => 1,
                        'login' => 0,
                        'datas' => [
                            'errors' => '请登录'
                        ]
                    ]);
                    exit;
                } else {
                    $login_url = urlMobile('auto', 'login', ['a' => 'b']);
                    @header("Location:$login_url");
                }
            }

            $model_member = Model('member');
            $this->member_info = $model_member->getMemberInfoByID($mb_user_token_info['member_id']);

            if (empty($this->member_info)) {
                @session_destroy();
                unset($_COOKIE);
                //showMessage('请登录',urlMobile('login'),'html','error');
                if (IS_AJAX) {
                    echo json_encode([
                        'nologin' => 1,
                        'login' => 0,
                        'datas' => [
                            'error' => '请登录'
                        ]
                    ]);
                    exit;
                } else {
                    $login_url = urlMobile('login', 'index', ['c' => 'd']);
                    @header("Location:$login_url");
                }
            } else {
                if (empty($_SESSION['is_login'])) {
                    $model_member->createSession($this->member_info);
                    $_SESSION['key'] = $key;
                }

                //输出会员信息
                $this->getMemberAndGradeInfo(false);
                $this->member_info['client_type'] = $mb_user_token_info['client_type'];
                $this->member_info['openid'] = $mb_user_token_info['openid'];
                $this->member_info['token'] = $mb_user_token_info['token'];
                $this->level_name = $model_member->getOneMemberGrade($this->member_info['member_exppoints'], 'true');
                $this->member_info['level_name'] = $this->level_name['level_name'];
                //读取卖家信息
                $seller_info = Model('seller')->getSellerInfo(array('member_id' => $this->member_info['member_id']));
                $this->member_info['store_id'] = $seller_info['store_id'];
            }

        }


    }


    public function getOpenId()
    {
        return $this->member_info['openid'];
    }

    public function setOpenId($openId)
    {
        $this->member_info['openid'] = $openId;
        Model('mb_user_token')->updateMemberOpenId($this->member_info['token'], $openId);
    }

}


class mobileSellerControl extends mobileControl
{


    protected $seller_info = array();
    protected $seller_group_info = array();
    protected $member_info = array();
    protected $store_info = array();
    protected $store_grade = array();

    public function __construct()
    {
        parent::__construct();

        if (!C('site_status')) halt(C('closed_reason'));

        Tpl::setDir('seller');
        Tpl::setLayout('seller_layout');

        $model_mb_seller_token = Model('mb_seller_token');
        $key1 = $_SESSION['sellerkey'];
        if (!$key1)
            $key1 = $_COOKIE['sellerkey'];

        if (!empty($key1)) {
            $key = $key1;
        }

        @header("SK:" . ($key ? $key : 'ERROR'));

        if (empty($key)) {
            @header('Location:' . urlMobile('seller_login'));
            exit;
            //showMessage('请登录1', urlMobile('seller_login'), 'html', 'error');
        }


//        $mb_seller_token_info = $model_mb_seller_token->getSellerTokenInfoByToken($key);
//
//        if (empty($mb_seller_token_info)) {
//            showMessage('请登录2', urlMobile('seller_login'), 'html', 'error');
//        }


        $model_seller = Model('seller');
        $model_member = Model('member');
        $model_store = Model('store');
        $model_seller_group = Model('seller_group');

        $this->seller_info = $model_seller->getSellerInfo(array('member_id' => $_SESSION['member_id']));
//        $this->seller_info = $model_seller->getSellerInfo(array('seller_id' => $mb_seller_token_info['seller_id']));
        $this->member_info = $model_member->getMemberInfoByID($this->seller_info['member_id']);
        $this->store_info = $model_store->getStoreInfoByID($this->seller_info['store_id']);
        $this->seller_group_info = $model_seller_group->getSellerGroupInfo(array('group_id' => $this->seller_info['seller_group_id']));


        // 店铺等级
        if (intval($this->store_info['is_own_shop']) === 1) {
            $this->store_grade = array(
                'sg_id' => '0',
                'sg_name' => '自营店铺',
                'sg_goods_limit' => '0',
                'sg_album_limit' => '0',
                'sg_space_limit' => '999999999',
                'sg_template_number' => '6',
                'sg_price' => '0.00',
                'sg_description' => '',
                'sg_function' => 'editor_multimedia',
                'sg_sort' => '0',
            );
        } else {
            $store_grade = rkcache('store_grade', true);
            $this->store_grade = $store_grade[$this->store_info['grade_id']];
        }


        if (empty($this->member_info)) {
            output_error('请登录', array('login' => '0'));
        } else {
            $this->seller_info['client_type'] = $mb_seller_token_info['client_type'];
        }

    }

    /**
     * 记录卖家日志
     *
     * @param $content 日志内容
     * @param $state 1成功 0失败
     */

    protected function recordSellerLog($content = '', $state = 1)
    {

        $seller_info = array();

        $seller_info['log_content'] = $content;

        $seller_info['log_time'] = TIMESTAMP;

        $seller_info['log_seller_id'] = $_SESSION['seller_id'];

        $seller_info['log_seller_name'] = $_SESSION['seller_name'];

        $seller_info['log_store_id'] = $_SESSION['store_id'];

        $seller_info['log_seller_ip'] = getIp();

        $seller_info['log_url'] = $_GET['con'] . '&' . $_GET['fun'];

        $seller_info['log_state'] = $state;

        $model_seller_log = Model('seller_log');

        $model_seller_log->addSellerLog($seller_info);

    }

}

/********************************** 前台control父类 **********************************************/


/**
 * 积分中心control父类
 */
class BasePointShopControl extends mobileControl
{

    protected $member_info;

    public function __construct()
    {

        Language::read('common,home_layout');


        //输出会员信息

        $this->member_info = $this->getMemberAndGradeInfo(true);

        Tpl::output('member_info', $this->member_info);


        Tpl::setDir('home');

        Tpl::setLayout('home_layout');


        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK') {

            $_GET = Language::getGBK($_GET);

        }

        if (!C('site_status')) halt(C('closed_reason'));


        //判断系统是否开启积分和积分中心功能

        if (C('points_isuse') != 1 || C('pointshop_isuse') != 1) {

            showMessage(Language::get('pointshop_unavailable'), urlShop('index', 'index'), 'html', 'error');

        }

        Tpl::output('index_sign', 'pointshop');

    }

    /**
     * 获得积分中心会员信息包括会员名、ID、会员头像、会员等级、经验值、等级进度、积分、已领代金券、已兑换礼品、礼品购物车
     */

    public function pointshopMInfo($is_return = false)
    {

        if ($_SESSION['is_login'] == '1') {

            $model_member = Model('member');

            if (!$this->member_info) {

                //查询会员信息

                $member_infotmp = $model_member->getMemberInfoByID($_SESSION['member_id']);

            } else {

                $member_infotmp = $this->member_info;

            }

            $member_infotmp['member_exppoints'] = intval($member_infotmp['member_exppoints']);


            //当前登录会员等级信息

            $membergrade_info = $model_member->getOneMemberGrade($member_infotmp['member_exppoints'], true);

            $member_info = array_merge($member_infotmp, $membergrade_info);

            Tpl::output('member_info', $member_info);


            //查询已兑换并可以使用的代金券数量

            $model_voucher = Model('voucher');

            $vouchercount = $model_voucher->getCurrentAvailableVoucherCount($_SESSION['member_id']);

            Tpl::output('vouchercount', $vouchercount);


            //购物车兑换商品数

            $pointcart_count = Model('pointcart')->countPointCart($_SESSION['member_id']);

            Tpl::output('pointcart_count', $pointcart_count);


            //查询已兑换商品数(未取消订单)

            $pointordercount = Model('pointorder')->getMemberPointsOrderGoodsCount($_SESSION['member_id']);

            Tpl::output('pointordercount', $pointordercount);

            if ($is_return) {

                return array('member_info' => $member_info, 'vouchercount' => $vouchercount, 'pointcart_count' => $pointcart_count, 'pointordercount' => $pointordercount);

            }

        }

    }

}

