<?php
/**
 * 手机端微信公众账号二维码设置
 *
 *
 *
 */



defined('TTShop') or exit('Access Invalid!');
class mb_settingControl extends SystemControl{
    public function __construct(){
        parent::__construct();
//         Language::read('mobile');
    }

    public function indexOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
                //上传网站Logo
            if (!empty($_FILES['mobile_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_MOBILE);
                $result = $upload->upfile('mobile_logo');
                if ($result){
                    $_POST['mobile_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
             if (!empty($_POST['mobile_logo'])){
                $update_array['mobile_logo'] = $_POST['mobile_logo'];
            }
            $update_array['signin_isuse']   = $_POST['signin_isuse'];
            $update_array['points_signin']   = $_POST['points_signin'];
            $update_array['instruction']   = $_POST['instruction'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){

                //判断有没有之前的图片，如果有则删除
                if (!empty($list_setting['mobile_logo']) && !empty($_POST['mobile_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_MOBILE.DS.$list_setting['mobile_logo']);
                }

                $this->log(L('nc_edit,web_set'),1);
                showMessage(L('nc_common_save_succ'));

                $this->log('编辑账号同步，微信登录设置');
                showMessage(Language::get('nc_common_save_succ'));
            }else {
                showMessage(Language::get('nc_common_save_fail'));
            }
        }

        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        Tpl::output('mobile_wx',$mobile_wx);
        Tpl::setDirquna('mobile');
        Tpl::showpage('mb_setting.index');
    }
}
