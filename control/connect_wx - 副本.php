<?php
/**
 * 微信登录
 *
 *
 
 */



defined('TTShop') or exit('Access Invalid!');

class connect_wxControl extends BaseLoginControl{
    public function __construct(){
        parent::__construct();
        Language::read("home_login_register,home_login_index");
        Tpl::output('hidden_login', 1);
    }
    /**
     * 微信登录
     */
    public function indexOp(){
        if(empty($_GET['code'])) {
            Tpl::showpage('connect_wx.index','null_layout');
        } else {
            $this->get_infoOp();
        }
        
    }
    /**
     * 微信注册后修改密码
     */
    public function edit_infoOp(){
        if (chksubmit()) {
             Language::read("home_login_register,home_login_index");
            $unionid = $_SESSION['wx_user_info']['unionid'];
            
             $obj_validate = new Validate();
            $user_name = $_POST['user'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $unionid = $_SESSION['wx_user_info']['unionid'];
            $weixin_info = $_SESSION['wx_user_info']['weixin_info'];
            $obj_validate->validateparam = array(
                array("input"=>$user_name,     "require"=>"true", "message"=>$lang['login_index_username_isnull']),
                array("input"=>$password,      "require"=>"true", "message"=>$lang['login_index_password_isnull']),
                array("input"=>$email,      "require"=>"email", "message"=>$lang['login_index_password_isnull']),
            );
            if(empty($unionid) && empty($weixin_info)){
                 showDialog('授权信息有误!','','error',$script);
           
            }
            $error = $obj_validate->validate();
            if ($error != ''){
                showDialog('用户名或密码格式错误!','','error',$script);
            }
            if(!empty($unionid)) {
         
           
                $model_member = Model('member');
                $member_info = $model_member->getMemberInfo(array('member_name'=> $member_name));
            
                $result = $model_member->addMember($member);
                $headimgurl = $user_info['headimgurl'];//用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像）
                $headimgurl = substr($headimgurl, 0, -1).'132';
                $avatar = @copy($headimgurl,BASE_UPLOAD_PATH.'/'.ATTACH_AVATAR."/avatar_$result.jpg");
                if($avatar) {
                    $model_member->editMember(array('member_id'=> $result),array('member_avatar'=> "avatar_$result.jpg"));
                }
                $member = $model_member->getMemberInfo(array('member_name'=> $member_name));
                if(!empty($member)) {
                    $model_member->createSession($member,true);//自动登录
                    Tpl::output('user_info',$user_info);
                    Tpl::output('headimgurl',$headimgurl);
                    Tpl::output('password',$password);
                    Tpl::showpage('connect_wx.register');
                }
            }
            $model_member = Model('member');
            $member = array();
            $member['member_passwd'] = md5($_POST["password"]);
            if(!empty($_POST["email"])) {
                $member['member_email']= $_POST["email"];
                $_SESSION['member_email']= $_POST["email"];
            }
            $model_member->editMember(array('member_id'=> $_SESSION['member_id']),$member);
            showDialog(Language::get('nc_common_save_succ'),urlShop('member', 'home'),'succ');
        }
    }
    /**
     * 回调获取信息
     */
    public function get_infoOp(){
        $code = $_GET['code'];
        if(!empty($code)) {
            $user_info = $this->get_user_info($code);
            if(!empty($user_info['unionid'])) {
                $unionid = $user_info['unionid'];
                $model_member = Model('member');
                $member = $model_member->getMemberInfo(array('weixin_unionid'=> $unionid));
                if(!empty($member)) {//会员信息存在时自动登录
                    $model_member->createSession($member);
                    showDialog('登录成功',urlShop('member', 'home'),'succ');
                }
                if(!empty($_SESSION['member_id'])) {//已登录时绑定微信
                    $member_id = $_SESSION['member_id'];
                    $member = array();
                    $member['weixin_unionid'] = $unionid;
                    $member['weixin_info'] = $user_info['weixin_info'];
                    $model_member->editMember(array('member_id'=> $member_id),$member);
                    showDialog('微信绑定成功',urlShop('member', 'home'),'succ');
                } else {//自动注册会员并登录
                    $this->register($user_info);
                    exit;
                }
            }
        }
        showDialog('微信登录失败',urlLogin('login', 'index'),'succ');
         // $user_info = $this->get_user_info($code);
         // $this->register($user_info);
        
    }
    public function register($user_info){
        $_SESSION['wx_user_info'] = '';
        $_SESSION['wx_user_info'] = $user_info; 
        Tpl::output('user_info',$user_info);
        Tpl::showpage('connect_wx.register');
    }
    /**
    *注册绑定
    */
    public function regbindwxOp(){
        $obj_validate = new Validate();
        $user_name = $_POST['user'];
        $password = $_POST['password'];
        $unionid = $_SESSION['wx_user_info']['unionid'];
        $weixin_info = $_SESSION['wx_user_info']['weixin_info'];
        $obj_validate->validateparam = array(
            array("input"=>$user_name,     "require"=>"true", "message"=>$lang['login_index_username_isnull']),
            array("input"=>$password,      "require"=>"true", "message"=>$lang['login_index_password_isnull']),
        );
        if(empty($unionid) && empty($weixin_info)){
             showDialog('授权信息有误!','','error',$script);
       
        }
        $error = $obj_validate->validate();
        if ($error != ''){
            showDialog('用户名或密码格式错误!','','error',$script);
        }
         $model_member  = Model('member');
        $condition = array();
        $condition['member_name'] = $user_name;
        $condition['member_passwd'] = md5($password);
        $member_info = $model_member->getMemberInfo($condition);

        if(!$member_info){
            showDialog('你所绑定的帐号不存在!',urlshop(''),'error',$script);
        }else{
            $update_info['weixin_unionid'] = $unionid;
            $update_info['weixin_info'] = $weixin_info;
            $isbind = $model_member->editMember(array('member_id'=>$member_info['member_id']),$update_info);
            if($isbind){
                 $_SESSION['wx_user_info'] = '';
                 unset($_SESSION['wx_user_info']);
                 $model_member->createSession($member_info);//自动登录
                  showDialog('绑定成功!',urlShop('member', 'home'),'succ');
            }else{
                $_SESSION['wx_user_info'] = '';
                unset($_SESSION['wx_user_info']);
                 showDialog('绑定失败!',urlLogin('login', 'index'),'succ');
            }
           
        }
    }
    /**
     * 注册
     */

    /**
     * 获取用户个人信息
     */
    public function get_user_info($code){
        $weixin_appid = C('weixin_appid');
        $weixin_secret = C('weixin_secret');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$weixin_appid.'&secret='.$weixin_secret.
            '&code='.$code.'&grant_type=authorization_code';
        $access_token = $this->get_url_contents($url);//通过code获取access_token
        $code_info = json_decode($access_token, true);
        $user_info = array();
        if(!empty($code_info['access_token'])) {
            $token = $code_info['access_token'];
            $openid = $code_info['openid'];
            $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid;
            $result = $this->get_url_contents($url);//获取用户个人信息
            $user_info = json_decode($result, true);
            $weixin_info = array();
            $weixin_info['unionid'] = $user_info['unionid'];
            $weixin_info['nickname'] = $user_info['nickname'];
            $weixin_info['openid'] = $user_info['openid'];
            $user_info['weixin_info'] = serialize($weixin_info);
        }
        return $user_info;
    }
    /**
     * OAuth2.0授权认证
     */
    public function get_url_contents($url){
        if (ini_get("allow_url_fopen") == "1") {
            return file_get_contents($url);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
    }
}