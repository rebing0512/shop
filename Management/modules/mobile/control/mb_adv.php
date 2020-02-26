<?php
/*
 * 集市首页广告
 * ***/
class mb_advControl extends SystemControl
{
    public function __construct()
    {
        parent::__construct();

    }
    public function indexOp(){
        $model = Model('setting');
        $adv_picture = $model->where('name = "adv_picture"')->find();
        $adv_url = $model->where('name = "adv_url"')->find();
        $adv_url = explode('|||',$adv_url['value']);
        //var_dump($notice);
        Tpl::output('adv_picture',$adv_picture);
        Tpl::output('adv_url',$adv_url);
        $list_setting = $model->getListSetting();
        if (chksubmit()){
            $update_array = array();
            //上传网站Logo
            if (!empty($_FILES['picture']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_MOBILE);
                $result = $upload->upfile('picture');
                if ($result){
                    $_POST['picture'] = $upload->file_name;
                    $update_array['adv_picture'] = $_POST['picture'];
                }else {
                    var_dump(111);exit;
                    showMessage($upload->error,'','','error');
                }
            }
                $update_array['adv_url'] = $_POST['title'].'|||'.$_POST['description'].'|||'.$_POST['url'];

            $result = $model->updateSetting($update_array);
            if ($result){
                //判断有没有之前的图片，如果有则删除
                if (!empty($_POST['adv_picture'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_MOBILE.DS.$list_setting['adv_picture']);
                }
                $this->log(L('nc_edit,web_set'),1);
                showMessage(L('nc_common_save_succ'));

                $this->log('编辑账号同步，微信登录设置');
                showMessage(Language::get('nc_common_save_succ'));
            }else {
                showMessage(Language::get('nc_common_save_fail'));
            }
        }

        Tpl::setDirquna('mobile');
        Tpl::showpage('mb_adv.index');
    }
}