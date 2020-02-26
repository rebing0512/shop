<?php
//?act=zhengshu&op=search

defined('TTShop') or exit('Access Invalid!');


class zhengshuControl extends mobileHomeControl{

    public $config_app = array(
        'defaule' => array('logo'=>'zs/logo.jpg','qr'=>'zs/qr.jpg','head_show'=>true),
        'qtsdcyj'=> array('logo'=>'zs/qtsdcyj_logo.jpg','qr'=>'zs/qtsdcyj_qr.jpg','head_show'=>false)
    );

    public function __construct(){
        parent::__construct();

        //检测是否是特有App
        $mb_config = array();
        $mb_app = trim($_GET['mb_app']);
        if(isset($mb_app) && !empty($mb_app) && isset($this->config_app[$mb_app])){
            $mb_config = $this->config_app[$mb_app];
            $mb_config['tag'] = '&mb_app='.$mb_app;
            $mb_config['tag_name'] = 'mb_app';
            $mb_config['tag_val'] = $mb_app;
        }else{
            $mb_config = $this->config_app['defaule'];
        }
        //var_dump($mb_config);
        Tpl::output('MBC',$mb_config);
        //die();

    }

    //搜索
    public function searchOp(){

        //js
        //$inc_file_wx_jssdk =  BASE_TPL_PATH.'/wap/inc/wx_jssdk/jssdk.php';
        //require_once $inc_file_wx_jssdk;
        //$jssdk = new JSSDK(AppID, AppSecret);

        //$signPackage = $jssdk->GetSignPackage();
        //Tpl::output('signPackage',$signPackage);

        //重写兼容App
        $platform = self::getPlatform();
        Tpl::output('platform',$platform);
        //die($platform);

        //Tpl::output('admin_list',$admin_list);
        Tpl::showpage('qr_search');
    }

    //信息显示
    public function qtviewOp(){

        //【*】验证信息是否未空
        if(empty($_GET["keyword"])){
            $this->showMsg("商标号不能为空！","./index.php?con=zhengshu&fun=search" );
        }

        //服务器数据同步方式
        $inc_file_1 = BASE_PATH.'/control/simple_html_dom.php';
        $inc_file_2 = BASE_PATH.'/control/api_csharp_get.php';
        //die($inc_file);
        include_once($inc_file_1);
        include_once($inc_file_2);

        $this_data = get_shidiao_arr();
        //var_dump($this_data);
        //die();

        //【*】查询信息 为空  和不为空
        if(empty($this_data)){
            $this->showMsg("商标号信息不存在！","./index.php?con=zhengshu&fun=search" );
        }

        Tpl::output('this_data',$this_data);

        Tpl::output('web_seo',$this_data["Title"]["value"]);

        Tpl::showpage('qtview');
    }


    public function showMsg($msg,$href){
        Tpl::output('msg',$msg);
        Tpl::output('href',$href );
        Tpl::showpage('msg');
        die();
    }

}