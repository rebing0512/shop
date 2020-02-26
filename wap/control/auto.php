<?php

/**
 *微信相关接口功能
 **/
class autoControl extends mobileMemberControl
{

    public function __construct($a = false)
    {

        if ($a===false)
            parent::__construct();

        // $agent = $_SERVER['HTTP_USER_AGENT']; 

        // if (strpos($agent, "MicroMessenger") && $_GET["con"]=='auto') {

        // $this->appId ='wx2a28145f70593a59';

        // $this->appSecret = '332b5e040c4e966a0aab5a9c9a323e78';

        // }   

    }

    public function indexOp()
    {
        $this->loginOp();
    }

    /**
     * 页面
     * login
     */
    public function loginOp()
    {

        // p($_GET['ref']);die;
        if (strstr($_GET['ref'], 'register') || strstr($_GET['ref'], 'login')) {
            $_GET['ref'] = urlMobile('member_index');
        }

        if (!$_GET['ref'])
        {
            $_GET['ref'] = $_SERVER['HTTP_REFERER'];
        }

        //$redirect_uri = MOBILE_SITE_URL . "/index.php?con=auto&fun=checkAuth&ref=" . rawurlencode($_GET['ref']);
        // $code_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appId&redirect_uri=".urlencode($redirect_uri)."&response_type=code&scope=snsapi_base&state=123#wechat_redirect"; // 获取code
        // 弹出授权
        //$code_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appId&redirect_uri=" . rawurlencode($redirect_uri) . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect"; // 获取code
        $redirect_url = urlMobile('auto','checkAuth',['ref'=>$_GET['ref']]);

        $code_url = "https://gateway.confolsc.com/passport/login?appid=".C('app_alias')."&redirect=".rawurlencode($redirect_url);

            if (!empty($this->sso_token)){
                $code_url = urlMobile('auto','checkAuth',['ref'=>urlMobile('member','index')]);
            }
        if (!empty($_COOKIE['key']) && !empty($_COOKIE['new_cookie'])) { //已经登陆
            $ref = WAP_SITE_URL;
            $model_mb_user_token = Model('mb_user_token');
            $model_member = Model('member');
            $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($_COOKIE['key']);
            $member_info = $model_member->getMemberInfoByID($mb_user_token_info['member_id']);
            if (empty($member_info)) {
                setcookie('username', null, time() - 3600 * 24, '/');
                setcookie('key', null, time() - 3600 * 24, '/');
                setcookie('unionid', null, time() - 3600 * 24, '/');
                setcookie('new_cookie', null, time() - 3600 * 24, '/');
                header('Location:' . $code_url);
                exit;
            }

            // if(strstr($ref,'register_invite')){

            // $ref=WAP_SITE_URL;

            // }

            header('Location:' . $ref);
            exit;


        } else {
            // p($code_url);die;
            $_SESSION = NULL;
            header("location:" . $code_url);
            exit;

        }


    }


    private function a($code)
    {
        if (false)
            var_dump($code);

    }

    /**
     * check auth callback
     * @param bool $redirect
     * @param null $sso_token
     * @return bool
     */
    public function checkAuthOp($redirect = true,$sso_token = null)
    {
        if ($redirect!==false){

            $ref = rawurldecode($_GET['ref']);
            if (empty($ref))
                $ref = WAP_SITE_URL;

            header("S-REF:{$ref}");

            $ref = str_replace('&amp;','&', $ref);
        }


        if (!empty($_COOKIE['sso_check']))
            return true;

        if ($sso_token != null){
            $asso_token = $sso_token;
        } else {
            $asso_token = $this->sso_token;
        }

        if (!empty($asso_token)) {
            $this->code = $asso_token;
            $url = "https://gateway.confolsc.com/passport/token?access_token={$asso_token}";
            $res = json_decode($this->httpGet($url), true);
            //$_SESSION = NULL;
            if (!$res || $res['code']!=1)
            {
                if ($redirect!==false) {
                    header('Location: https://gateway.confolsc.com/passport/login?appid='.C('app_alias').'&redirect='.urlencode($ref));
                    exit;
                }
            }
            setcookie('sso_check',1,600);

            // res.result.id
            $this->openid = $res['result']['id'];
            $_SESSION['openid'] = $res['result']['id'];

            $model_member = Model('member');
            $member_info = $model_member->getMemberInfo(array('weixin_unionid' => $this->openid));

            if (!empty($member_info)) {
                $model_member->editMember(array('weixin_unionid' => $this->openid), array('member_name' => $res['result']['name'],'hashkey'=>$res['result']['hashkey'],'login_mobile'=>$res['result']['mobile']));
                Model('store')->editStore(['member_name' => $res['result']['name'],'seller_name' => $res['result']['name']],['member_id'=>$member_info['member_id']]);
                $a = Model('seller')->editSeller([
                    'member_id'=>$member_info['member_id'],
                ],[
                    'seller_login_mobile' => $res['result']['mobile']
                ]);

                // 用户登录成功
                $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], 'wap');
                setcookie('username', $member_info["member_name"], time() + 3600 * 24, '/');
                setcookie('key', $token, time() + 3600 * 24, '/');
                setcookie('new_cookie', '100', time() + 3600 * 24, '/');
                $_SESSION['key'] = $token;
                $this->a($token);
                // 获取seller
                $sellerInfo = Model('seller')->getSellerInfo(['member_id'=>$member_info['member_id']]);
                // 获取store
                if (empty($sellerInfo)){

                    $newStore = [
                        'store_name' => $member_info['member_name'],
                        'grade_id' => '1',
                        'member_id' => $member_info['member_id'],
                        'member_name' => $member_info['member_name'],
                        'seller_name' => $member_info['member_name'],
                        'sc_id' => '0',
                        'store_state' => 1,
                        'store_time' => time(),
                        'is_own_shop'=>0
                    ];
                    $storeId = Model('store')->addStore($newStore);

                    #添加卖家信息
                    $newSeller = [
                        'seller_name' => $member_info['member_name'],
                        'member_id' => $member_info['member_id'],
                        'seller_group_id' => '0',
                        'seller_login_mobile' =>$member_info['login_mobile'],
                        'store_id' => $storeId,
                        'is_admin' => '1',
                        'seller_quicklink' => NULL,
                        'last_login_time' => time(),
                        'is_client' => 0,
                    ];
                    $sellerId = Model('seller')->addSeller($newSeller);
                }
                $storeInfo = Model('store')->getStoreInfo(['member_id'=>$member_info['member_id']]);
                $sellerToken = $this->_get_seller_token($sellerInfo['seller_id'],$sellerInfo['seller_name'],'wap');
                $_SESSION['sellerkey'] = $sellerToken;
                $this->setSession($member_info,$storeInfo,$sellerInfo);
                setcookie('sellerkey', $sellerToken, time() + 3600 * 24, '/');

                if (strstr($ref, 'register_invite'))
                    $ref = WAP_SITE_URL;
                if (strpos(rawurldecode($_GET['ref']),'gateway')){
                    $ref = urlMobile('member','index');
                }
                $this->a($_SESSION);
                if ($redirect!==false){
                    header('Location:' . $ref);
                    exit;
                }
            } else {
                if ($this->register($res['result'])) {
                    if ($redirect!==false){
                        if (strstr($ref, 'register_invite')) {
                            $ref = WAP_SITE_URL;
                        }
                        header('Location:' . $ref);
                        exit;
                    }
                }
            }
        } else {
            if ($redirect!==false){
                header("S:ForceRedirect[{$ref}]");
                header('Location:' . $ref);
                exit;
            }
        }
    }

    /**
     * 用户不存在自动注册
     * @param $user_info
     * @return bool
     */
    private function register($user_info)
    {
        $unionid = $user_info['id'];
        $nickname = $user_info['name'];
        $hashkey = $user_info['hashkey'];
        $mobile = $user_info['mobile'];
        if (!empty($unionid)) {
            $rand = rand(100, 899);
            if (empty($nickname)) $nickname = 'weixin_' . $rand;
            if (strlen($nickname) < 3) $nickname = $nickname . $rand;
            $member_name = $nickname;
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfo(array('member_name' => $member_name));
            $password = rand(100000, 999999);
            $member = array();
            $member['hashkey'] = $hashkey;
            $member['member_passwd'] = $password;
            $member['member_email'] = '';
            $member['weixin_unionid'] = $unionid;
            // $member['nickname'] = $nickname;
            // $member['openid'] = $user_info['openid'];
            $member['weixin_info'] = $user_info['weixin_info'];
            if ($_SESSION['rec']) {
                $rec_id = $_SESSION['rec'];
                $member_infos = $model_member->getMemberInfo(array('member_id' => $rec_id));
                $invite_one = $rec_id;
                $invite_two = $member_infos['invite_one'];
                $invite_three = $member_infos['invite_two'];
            } else {
                $invite_one = 0;
                $invite_two = 0;
                $invite_three = 0;
            }

            $member['invite_one'] = $invite_one;
            $member['invite_two'] = $invite_two;
            $member['invite_three'] = $invite_three;
            $member['login_mobile'] = $user_info['mobile'];

            if (empty($member_info)) {
                $member['member_name'] = $member_name;
                $member['hashkey'] = $hashkey;
                $member['login_mobile'] = $user_info['mobile'];
                $result = $model_member->addMember($member);
            } else {
                for ($i = 1; $i < 999; $i++) {
                    $rand += $i;
                    $member_name = $nickname . $rand;
                    $member_info = $model_member->getMemberInfo(array('member_name' => $member_name));
                    if (empty($member_info)) {//查询为空表示当前会员名可用
                        $member['member_name'] = $member_name;
                        $member['hashkey'] = $hashkey;
                        $member['login_mobile'] = $user_info['mobile'];
                        $result = $model_member->addMember($member);
                        break;
                    }
                }
            }

            //$headimgurl = $user_info['headimgurl'];//用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像）

            //$headimgurl = substr($headimgurl, 0, -1) . '132';

            //$avatar = @copy($headimgurl, BASE_UPLOAD_PATH . '/' . ATTACH_AVATAR . "/avatar_$result.jpg");

            //if ($avatar) {
            //    $model_member->editMember(array('member_id' => $result), array('member_avatar' => "avatar_$result.jpg"));
            //}

            $member = $model_member->getMemberInfo(array('member_name' => $member_name));
            $member_info = $model_member->getMemberInfo(array('member_name' => $member_name));

            if (!empty($member)) {
                if (!empty($member_info)) {
                    // $unionid = $member_info['unionid'];
                    $token = $this->_get_token($result, $member_name, 'wap');

                    // 用户登录成功
                    // 添加卖家用户
                    $sellerModel = Model('seller');
                    $storeModel = Model('store');

                    #添加店铺信息
                    $newStore = [
                        'store_name' => $member['member_name'],
                        'grade_id' => '1',
                        'member_id' => $member['member_id'],
                        'member_name' => $member['member_name'],
                        'seller_name' => $member['member_name'],
                        'sc_id' => '0',
                        'store_state' => 1,
                        'store_time' => time(),
                        'is_own_shop'=>0
                    ];
                    $storeId = $storeModel->addStore($newStore);

                    #添加卖家信息
                    $newSeller = [
                        'seller_name' => $member['member_name'],
                        'member_id' => $member['member_id'],
                        'seller_group_id' => '0',
                        'seller_login_mobile' =>$user_info['mobile'],
                        'store_id' => $storeId,
                        'is_admin' => '1',
                        'seller_quicklink' => NULL,
                        'last_login_time' => time(),
                        'is_client' => 0,
                    ];
                    $sellerId = $sellerModel->addSeller($newSeller);

                    # 获取seller_token
                    $sellerToken = $this->_get_seller_token($sellerId,$member['member_name'],'wap');
                    # 设置session
                    $_SESSION['sellerkey']  = $sellerToken;
                    $this->setSession($member_info,$storeModel->getStoreInfoByID($storeId),$sellerModel->getSellerInfo(['seller_id'=>$sellerId]));


                    setcookie('username', $member_name);
                    setcookie('key', $token);
                    setcookie('sellerkey', $sellerToken, time() + 3600 * 24, '/');
                    return true;
                } else {
                    return false;
                }
            }

        }

    }

    private function setSession($member_info,$store_info,$seller_info)
    {
        $_SESSION['is_login'] = '1';

        $_SESSION['member_id'] = $member_info['member_id'];

        $_SESSION['member_name'] = $member_info['member_name'];

        $_SESSION['member_email'] = $member_info['member_email'];

        $_SESSION['is_buy'] = $member_info['is_buy'];

        $_SESSION['avatar'] = $member_info['member_avatar'];



        $_SESSION['grade_id'] = $store_info['grade_id'];

        $_SESSION['seller_id'] = $seller_info['seller_id'];

        $_SESSION['seller_name'] = $seller_info['seller_name'];

        $_SESSION['seller_is_admin'] = intval($seller_info['is_admin']);

        $_SESSION['store_id'] = intval($seller_info['store_id']);

        $_SESSION['store_name'] = $store_info['store_name'];

        $_SESSION['store_avatar'] = $store_info['store_avatar'];

        $_SESSION['is_own_shop'] = (bool) $store_info['is_own_shop'];

        $_SESSION['bind_all_gc'] = (bool) $store_info['bind_all_gc'];

        $_SESSION['seller_limits'] = explode(',', $seller_group_info['limits']);

        $_SESSION['seller_group_id'] = $seller_info['seller_group_id'];

        $_SESSION['seller_gc_limits'] = $seller_group_info['gc_limits'];

        if($seller_info['is_admin']) {

            $_SESSION['seller_group_name'] = '管理员';

            $_SESSION['seller_smt_limits'] = false;

        } else {

            $_SESSION['seller_group_name'] = $seller_group_info['group_name'];

            $_SESSION['seller_smt_limits'] = explode(',', $seller_group_info['smt_limits']);

        }

        if(!$seller_info['last_login_time']) {

            $seller_info['last_login_time'] = TIMESTAMP;

        }

        $_SESSION['seller_last_login_time'] = date('Y-m-d H:i', $seller_info['last_login_time']);
    }



    private function _get_seller_token($seller_id, $seller_name, $client)
    {
        $model_mb_seller_token = Model('mb_seller_token');

        //重新登录后以前的令牌失效
        $condition = array();
        $condition['seller_id'] = $seller_id;
        $model_mb_seller_token->delSellerToken($condition);

        //生成新的token
        $mb_seller_token_info = array();
        $token = md5($seller_name. strval(TIMESTAMP) . strval(rand(0,999999)));
        $mb_seller_token_info['seller_id'] = $seller_id;
        $mb_seller_token_info['seller_name'] = $seller_name;
        $mb_seller_token_info['token'] = $token;
        $mb_seller_token_info['login_time'] = TIMESTAMP;
        $mb_seller_token_info['client_type'] = $client;
        $result = $model_mb_seller_token->addSellerToken($mb_seller_token_info);
        if($result) {
            return $token;
        } else {
            return null;
        }
    }
    /**
     * 登录生成token
     */
    private function _get_token($member_id, $member_name, $client)
    {

        $model_mb_user_token = Model('mb_user_token');

        // 生成新的token

        $mb_user_token_info = array();

        $token = md5($member_name . strval(TIMESTAMP) . strval(rand(0, 999999)));

        $mb_user_token_info['member_id'] = $member_id;

        $mb_user_token_info['member_name'] = $member_name;

        $mb_user_token_info['token'] = $token;

        $mb_user_token_info['login_time'] = TIMESTAMP;

        $mb_user_token_info['client_type'] = $client;


        $result = $model_mb_user_token->addMbUserToken($mb_user_token_info);

        if ($result) {

            return $token;

        } else {

            return null;

        }


    }


    // 校验AccessToken 是否可用及返回新的

    private function getAccessToken()
    {

        $url = 'https://mbcsc.confolsc.com/app_wechat_download_image.php?alias='.C('app_alias');

        $data = $this->httpGet($url);

        return json_decode($data,1)['result'];
        $data = json_decode(file_get_contents("../access_token.json"));

        $check_token_url = "https://api.weixin.qq.com/sns/auth?access_token=$data->access_token&openid=$this->appId";

        $check_res = json_decode($this->httpGet($check_token_url));

        if ($data->expire_time < time() || $cike_url->errcode > 0) {

            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";

            $res = json_decode($this->httpGet($url));

            $access_token = $res->access_token;

            if ($access_token) {

                $data->expire_time = time() + 6500;

                $data->access_token = $access_token;

                $fp = fopen("../access_token.json", "w");

                fwrite($fp, json_encode($data));

                fclose($fp);

            }

        } else {

            $access_token = $data->access_token;

        }

        return $access_token;

    }


    public function httpGet($url)
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_TIMEOUT, 500);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);

        curl_close($curl);

        return $res;

    }

}