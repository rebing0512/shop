<?php
/**
 * 手机端微信公众账号二维码设置
 *
 *
 *
 */



defined('TTShop') or exit('Access Invalid!');
class mb_reconmmendControl extends SystemControl{
    public function __construct(){
        parent::__construct();
//         Language::read('mobile');
    }

    public function indexOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
            $update_array['mb_recommend']   = $_POST['mb_recommend'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){
                showMessage('修改成功！');
            }else {
                showMessage('修改失败！');
            }
        }

        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        //var_dump($list_setting);
        //Tpl::output('mobile_wx',$mobile_wx);
        Tpl::setDirquna('mobile');
        Tpl::showpage('mb_recommend.index');
    }
}
