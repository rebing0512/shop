<?php
/*
 * 平台购买须知
 * ***/
class mb_noticeControl extends SystemControl
{
    public function __construct()
    {
        parent::__construct();

    }
    public function indexOp(){
        $model = Model('setting');
        //$condition = array('name' => array('in','promise,buy,service'));
        $promise = $model->where('name = "promise"')->find();
        $buy = $model->where('name = "buy"')->find();
        $service = $model->where('name = "service"')->find();
        //var_dump($notice);
        Tpl::output('promise',$promise);
        Tpl::output('buy',$buy);
        Tpl::output('service',$service);
        $list_setting = $model->getListSetting();
        if (chksubmit()){
            $update_array = array();
            //上传网站Logo
            if (!empty($_FILES['promise']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_MOBILE);
                $result = $upload->upfile('promise');
                if ($result){
                    $_POST['promise'] = $upload->file_name;
                    $update_array['promise'] = $_POST['promise'];
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            if (!empty($_FILES['buy']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_MOBILE);
                $result = $upload->upfile('buy');
                if ($result){
                    $_POST['buy'] = $upload->file_name;
                    $update_array['buy'] = $_POST['buy'];
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            if (!empty($_POST['service'])){
                //var_dump($_POST['service']);exit;
                $update_array['service'] = $_POST['service'];
            }
            //$update_array['signin_isuse']   = $_POST['signin_isuse'];
            //$update_array['points_signin']   = $_POST['points_signin'];
            $result = $model->updateSetting($update_array);
            if ($result){

                //判断有没有之前的图片，如果有则删除
                if (!empty($_POST['buy'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_MOBILE.DS.$list_setting['buy']);
                }
                if (!empty($_POST['promise'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_MOBILE.DS.$list_setting['promise']);
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
        Tpl::showpage('mb_notice.index');
    }
}