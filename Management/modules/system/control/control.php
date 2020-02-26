<?php


defined('TTShop') or exit('Access Invalid!');
class controlControl extends SystemControl{
	 private $links = array(
	    // array('url'=>'con=control&fun=base','lang'=>'control_set'),
        array('url'=>'con=control&fun=banner','lang'=>'top_set'),
        array('url'=>'con=control&fun=lc','lang'=>'lc_set'),
		array('url'=>'con=control&fun=sms','lang'=>'sms_set'),
        array('url'=>'con=control&fun=rc','lang'=>'rc_set'),
        
    );
	public function __construct(){
		parent::__construct();
		Language::read('control,setting');
	}
	    public function indexOp() {
        $this->bannerOp();
    }
		 /**
     * 基本信息
     */
    public function baseOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            $update_array['control_stitle'] = $_POST['control_stitle'];
            $update_array['control_phone'] = $_POST['control_phone'];
            $update_array['control_time'] = $_POST['control_time'];
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log(L('nc_edit,control_set'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                $this->log(L('nc_edit,control_set'),0);
                showMessage(L('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();

        Tpl::output('list_setting',$list_setting);

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'base'));
		
		Tpl::setDirquna('system');
        Tpl::showpage('control.base');
    }
	 /**
     * 顶部广告信息
     */
    public function bannerOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
			 if (!empty($_FILES['control_top_banner_pic']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_COMMON);
                $result = $upload->upfile('control_top_banner_pic');
                if ($result){
                    $_POST['control_top_banner_pic'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            $update_array['control_top_banner_name'] = $_POST['top_banner_name'];
            $update_array['control_top_banner_url'] = $_POST['top_banner_url'];
            $update_array['control_top_banner_color'] = $_POST['top_banner_color'];
            $update_array['control_top_banner_status'] = $_POST['top_banner_status'];
			if (!empty($_POST['control_top_banner_pic'])){
                $update_array['control_top_banner_pic'] = $_POST['control_top_banner_pic'];
            }
            $result = $model_setting->updateSetting($update_array);
			if ($result === true){
                //判断有没有之前的图片，如果有则删除
                if (!empty($list_setting['control_top_banner_pic']) && !empty($_POST['control_top_banner_pic'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['control_top_banner_pic']);
                }
                $this->log(L('nc_edit,top_set'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                $this->log(L('nc_edit,top_set'),0);
                showMessage(L('nc_common_save_fail'));
            }
        }
         
        $list_setting = $model_setting->getListSetting();

        Tpl::output('list_setting',$list_setting);

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'banner'));
		
		Tpl::setDirquna('system');
        Tpl::showpage('control.banner');
    }
	
	 /**
     * 楼层广告词
     */
    public function lcOp() {
        $model_setting = Model('setting');
        $lc_info = $model_setting->getRowSetting('control_lc');
        if ($lc_info !== false) {
            $lc_list = @unserialize($lc_info['value']);
        }
        if (!$lc_list && !is_array($lc_list)) {
            $lc_list = array();
        }
        Tpl::output('lc_list',$lc_list);
        Tpl::output('top_link',$this->sublink($this->links,'lc'));
		Tpl::setDirquna('system');
        Tpl::showpage('control.lc');
    }
/**
     * 楼层广告词添加
     */
    public function rc_addOp() {
        $model_setting = Model('setting');
        $rc_info = $model_setting->getRowSetting('control_rc');
        if ($rc_info !== false) {
            $rc_list = @unserialize($rc_info['value']);
        }
        if (!$rc_list && !is_array($rc_list)) {
            $rc_list = array();
        }
        if (chksubmit()) {
            if (count($rc_list) >= 8) {
                showMessage('最多可设置8个楼层','index.php?con=control&fun=rc');
            }
            if ($_POST['rc_name'] != '' && $_POST['rc_value'] != '' && $_POST['rc_blod'] != '') {
                $data = array('name'=>stripslashes($_POST['rc_name']),'value'=>stripslashes($_POST['rc_value']),'is_blod'=>stripslashes($_POST['rc_blod']));
                array_unshift($rc_list, $data);
            }
            $result = $model_setting->updateSetting(array('control_rc'=>serialize($rc_list)));
            if ($result){
                showMessage('保存成功','index.php?con=control&fun=rc');
            }else {
                showMessage('保存失败');
            }
        }
        Tpl::setDirquna('system');

        Tpl::showpage('control.rc_add');
    }

     /**
     * 删除
     */
    public function rc_delOp() {
        $model_setting = Model('setting');
        $rc_info = $model_setting->getRowSetting('control_rc');
        if ($rc_info !== false) {
            $rc_list = @unserialize($rc_info['value']);
        }
        if (!empty($rc_list) && is_array($rc_list) && intval($_GET['id']) >= 0) {
            unset($rc_list[intval($_GET['id'])]);
        }
        if (!is_array($rc_list)) {
            $rc_list = array();
        }
        $result = $model_setting->updateSetting(array('control_rc'=>serialize(array_values($rc_list))));
        if ($result){
            showMessage('删除成功');
        }
        showMessage('删除失败');
    }

    /**
     * 编辑
     */
    public function rc_editOp() {
        $model_setting = Model('setting');
        $rc_info = $model_setting->getRowSetting('control_rc');
        if ($rc_info !== false) {
            $rc_list = @unserialize($rc_info['value']);
        }
        if (!is_array($rc_list)) {
            $rc_list = array();
        }
        if (!chksubmit()) {
            if (!empty($rc_list) && is_array($rc_list) && intval($_GET['id']) >= 0) {
                $current_info = $rc_list[intval($_GET['id'])];
            }
            Tpl::output('current_info',is_array($current_info) ? $current_info : array());
            Tpl::setDirquna('system');
            Tpl::showpage('control.rc_add');
        } else {
            if ($_POST['rc_name'] != '' && $_POST['rc_value'] != '' && $_POST['rc_blod'] != '' && $_POST['id'] != '' && intval($_POST['id']) >= 0) {
                $rc_list[intval($_POST['id'])] = array('name'=>stripslashes($_POST['rc_name']),'value'=>stripslashes($_POST['rc_value']),'is_blod'=>stripslashes($_POST['rc_blod']));
            }
            $result = $model_setting->updateSetting(array('control_rc'=>serialize($rc_list)));
            if ($result){
                showMessage('编辑成功','index.php?con=control&fun=rc');
            }
            showMessage('编辑失败');
        }


    }
    /**
     * 楼层快速直达添加
     */
    public function lc_addOp() {
        $model_setting = Model('setting');
        $lc_info = $model_setting->getRowSetting('control_lc');
        if ($lc_info !== false) {
            $lc_list = @unserialize($lc_info['value']);
        }
        if (!$lc_list && !is_array($lc_list)) {
            $lc_list = array();
        }
        if (chksubmit()) {
            if (count($lc_list) >= 8) {
                showMessage('最多可设置8个楼层','index.php?con=control&fun=lc');
            }
            if ($_POST['lc_name'] != '' && $_POST['lc_value'] != '') {
                $data = array('name'=>stripslashes($_POST['lc_name']),'value'=>stripslashes($_POST['lc_value']));
                array_unshift($lc_list, $data);
            }
            $result = $model_setting->updateSetting(array('control_lc'=>serialize($lc_list)));
            if ($result){
                showMessage('保存成功','index.php?con=control&fun=lc');
            }else {
                showMessage('保存失败');
            }
        }
		Tpl::setDirquna('system');

        Tpl::showpage('control.lc_add');
    }
  

    /**
     * 首页热门关键词链接
     */
    public function rcOp() {
        $model_setting = Model('setting');
        $rc_info = $model_setting->getRowSetting('control_rc');
        if ($rc_info !== false) {
            $rc_list = @unserialize($rc_info['value']);
        }
        if (!$rc_list && !is_array($rc_list)) {
            $rc_list = array();
        }
        Tpl::output('rc_list',$rc_list);
        Tpl::output('top_link',$this->sublink($this->links,'rc'));
        Tpl::setDirquna('system');
        Tpl::showpage('control.rc');
    }

    /**
     * 删除
     */
    public function lc_delOp() {
        $model_setting = Model('setting');
        $lc_info = $model_setting->getRowSetting('control_lc');
        if ($lc_info !== false) {
            $lc_list = @unserialize($lc_info['value']);
        }
        if (!empty($lc_list) && is_array($lc_list) && intval($_GET['id']) >= 0) {
            unset($lc_list[intval($_GET['id'])]);
        }
        if (!is_array($lc_list)) {
            $lc_list = array();
        }
        $result = $model_setting->updateSetting(array('control_lc'=>serialize(array_values($lc_list))));
        if ($result){
            showMessage('删除成功');
        }
        showMessage('删除失败');
    }

    /**
     * 编辑
     */
    public function lc_editOp() {
        $model_setting = Model('setting');
        $lc_info = $model_setting->getRowSetting('control_lc');
        if ($lc_info !== false) {
            $lc_list = @unserialize($lc_info['value']);
        }
        if (!is_array($lc_list)) {
            $lc_list = array();
        }
        if (!chksubmit()) {
            if (!empty($lc_list) && is_array($lc_list) && intval($_GET['id']) >= 0) {
                $current_info = $lc_list[intval($_GET['id'])];
            }
            Tpl::output('current_info',is_array($current_info) ? $current_info : array());
			Tpl::setDirquna('system');
            Tpl::showpage('control.lc_add');
        } else {
            if ($_POST['lc_name'] != '' && $_POST['lc_value'] != '' && $_POST['id'] != '' && intval($_POST['id']) >= 0) {
                $lc_list[intval($_POST['id'])] = array('name'=>stripslashes($_POST['lc_name']),'value'=>stripslashes($_POST['lc_value']));
            }
            $result = $model_setting->updateSetting(array('control_lc'=>serialize($lc_list)));
            if ($result){
                showMessage('编辑成功','index.php?con=control&fun=lc');
            }
            showMessage('编辑失败');
        }


    }
		/**
	 * 短信平台设置 
	 */
	public function smsOp(){
		$model_setting = Model('setting');
		if (chksubmit()){
			$update_array = array();
			$update_array['control_sms_type'] 	= $_POST['control_sms_type'];
			$update_array['control_sms_tgs'] 	= $_POST['control_sms_tgs'];
			$update_array['control_sms_zh'] 	= $_POST['control_sms_zh'];
			$update_array['control_sms_pw'] 	= $_POST['control_sms_pw'];
			$update_array['control_sms_key'] 	= $_POST['control_sms_key'];
			$update_array['control_sms_signature'] 		= $_POST['control_sms_signature'];
			$update_array['control_sms_bz'] 	= $_POST['control_sms_bz'];
			$result = $model_setting->updateSetting($update_array);
			if ($result === true){
				$this->log(L('nc_edit,sms_set'),1);
				showMessage(L('nc_common_save_succ'));
			}else {
				$this->log(L('nc_edit,sms_set'),0);
				showMessage(L('nc_common_save_fail'));
			}
		}
		$list_setting = $model_setting->getListSetting();
		Tpl::output('list_setting',$list_setting);
		
        Tpl::output('top_link',$this->sublink($this->links,'sms'));
		Tpl::setDirquna('system');
        Tpl::showpage('control.sms');
	}
}