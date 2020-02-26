<?php

/**

 * 商家入住

 *

 */

defined('TTShop') or exit('Access Invalid!');



class store_joinin_c2cControl extends mobileHomeControl {



    private $joinin_detail = NULL;



	public function __construct() {

		parent::__construct();



		Tpl::setDir('seller');

        Tpl::setLayout('seller_layout');

        $model_mb_user_token = Model('mb_user_token');
            $key1 = $_SESSION['key'];
            $key2 = $_COOKIE["key"]?$_COOKIE["key"]:$_GET['key'];
            if(!empty($key1)) {
                $key = $key1;
            }else{
                $key =  $key2;
            }
            $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);
            if(empty($mb_user_token_info)) {
                session_destroy();
                unset($_COOKIE);
                
                if(IS_AJAX){
                    echo json_encode(array('nologin'=>1));exit;
                }else{
                   $login_url = urlMobile('login');
                   showMessage('请登录会员,再入住!',$login_url,'html','error');
                   
                }
            }

      



        $model_seller = Model('seller');

        $seller_info = $model_seller->getSellerInfo(array('member_id' => $_SESSION['member_id']));

		if(!empty($seller_info)) {

            @header('location: index.php?con=seller_login');

		}



        if($_GET['fun'] != 'check_seller_name_exist' && $_GET['fun'] != 'checkname') {

            $this->check_joinin_state();

        }

      

	}



    private function check_joinin_state() {

        $model_store_joinin = Model('store_joinin');

        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_SESSION['member_id']));

        if(!empty($joinin_detail)) {

            $this->joinin_detail = $joinin_detail;

            switch (intval($joinin_detail['joinin_state'])) {

                case STORE_JOIN_STATE_NEW:

                    $this->step4();

                    $this->show_join_message('入驻申请已经提交，请等待管理员审核', FALSE, '3');

                    break;

                case STORE_JOIN_STATE_PAY:

                     $this->endjoinOp();

                    $this->show_join_message('已经提交，请等待管理员核对后为您开通店铺', FALSE, '4');

                    break;

                case STORE_JOIN_STATE_VERIFY_SUCCESS:

                    if(!in_array($_GET['fun'], array('pay', 'pay_save'))) {

                        $this->payOp();

                    }

                    break;

                case STORE_JOIN_STATE_VERIFY_FAIL:

                    if(!in_array($_GET['fun'], array('step1', 'step2', 'step3', 'step4'))) {

                        $this->show_join_message('审核失败:'.$joinin_detail['joinin_message'], MOBILE_SITE_URL.DS.'index.php?con=store_joinin_c2c&fun=step1');

                    }

                    break;

                case STORE_JOIN_STATE_PAY_FAIL:

                    if(!in_array($_GET['fun'], array('pay', 'pay_save'))) {

                        $this->show_join_message('付款审核失败:'.$joinin_detail['joinin_message'], MOBILE_SITE_URL.DS.'index.php?con=store_joinin_c2c&fun=pay');

                    }

                    break;

                case STORE_JOIN_STATE_FINAL:

                    @header('location: index.php?con=seller_login');

                    break;

            }

        }

    }



	public function indexOp() {

        $this->step0Op();

	}



    public function step0Op() {

        $model_document = Model('document');

        $document_info = $model_document->getOneByCode('open_store');

        Tpl::output('agreement', $document_info['doc_content']);

        Tpl::output('step', 'step1');

        Tpl::output('sub_step', 'step0');

        Tpl::showpage('store_joinin_c2c_apply');

    }



	public function step1Op() {

        Tpl::output('step', 'step2');

        Tpl::output('sub_step', 'step1');

        Tpl::showpage('store_joinin_c2c_apply');

    }

    public function step2Op() {

               //商品分类

        $gc = Model('goods_class');

        $gc_list    = $gc->getGoodsClassListByParentId(0);

        Tpl::output('gc_list',$gc_list);



        //店铺等级

        $grade_list = rkcache('store_grade',true);

        //附加功能

        if(!empty($grade_list) && is_array($grade_list)){

            foreach($grade_list as $key=>$grade){

                $sg_function = explode('|',$grade['sg_function']);

                if (!empty($sg_function[0]) && is_array($sg_function)){

                    foreach ($sg_function as $key1=>$value){

                        if ($value == 'editor_multimedia'){

                            $grade_list[$key]['function_str'] .= '富文本编辑器';

                        }

                    }

                }else {

                    $grade_list[$key]['function_str'] = '无';

                }

            }

        }

        Tpl::output('grade_list', $grade_list);



        //店铺分类

        $model_store = Model('store_class');

        $store_class = $model_store->getStoreClassList(array(),'',false);

        Tpl::output('store_class', $store_class);

        

        Tpl::showpage('step2');

        exit;

    }



      //最后审核

    public function endjoinOp(){

        Tpl::output('sub_step', 'end');

        Tpl::showpage('store_joinin_apply');

        exit;

    }

    public function savesetepOp(){

        if(!empty($_POST)) {

            $param = array();

            $param['member_name'] = $_SESSION['member_name'];   

            $param['company_name'] = $_POST['company_name'];

            $param['company_address'] = $_POST['company_address'];

            $param['company_address_detail'] = $_POST['company_address_detail'];

            $param['contacts_name'] = $_POST['contacts_name'];

            $param['contacts_phone'] = $_POST['contacts_phone'];

            $param['contacts_email'] = $_POST['contacts_email'];

            $param['business_licence_number'] = $_POST['business_licence_number'];

            $param['business_sphere'] = $_POST['business_sphere'];

            $param['business_licence_number_elc'] =$_POST['business_licence_number_electronic'];

            $param['settlement_bank_account_name'] = $_POST['settlement_bank_account_name'];

            $param['settlement_bank_account_number']= $_POST['settlement_bank_account_number'];



            $this->step2_save_valid($param);



            $model_store_joinin = Model('store_joinin');

            $joinin_info = $model_store_joinin->getOne(array('member_id' => $_SESSION['member_id']));

            if(empty($joinin_info)) {

                $param['member_id'] = $_SESSION['member_id'];

                $model_store_joinin->save($param);

                output_data(array('url'=>urlMobile('store_joinin_c2c','step2')));

            } else {

                $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

                 output_data(array('url'=>urlMobile('store_joinin_c2c')));

            }

        }

          

    }

    private function step2_save_valid($param) {

        $obj_validate = new Validate();

        $obj_validate->validateparam = array(

            array("input"=>$param['company_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"店铺名称不能为空且必须小于50个字"),

            array("input"=>$param['company_address'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"所在地不能为空且必须小于50个字"),

            array("input"=>$param['company_address_detail'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"详细地址不能为空且必须小于50个字"),

            array("input"=>$param['contacts_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人姓名不能为空且必须小于20个字"),

            array("input"=>$param['contacts_phone'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人电话不能为空"),

            array("input"=>$param['contacts_email'], "require"=>"true","validator"=>"email","message"=>"电子邮箱不能为空"),

            array("input"=>$param['business_licence_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"身份证号不能为空且必须小于20个字"),

            array("input"=>$param['business_sphere'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"500","message"=>"姓名不能为空且必须小于50个字"),

            array("input"=>$param['business_licence_number_elc'], "require"=>"true","message"=>"身份证扫描件不能为空"),

            array("input"=>$param['settlement_bank_account_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"支付宝不能为空且必须小于50个字"),

            array("input"=>$param['settlement_bank_account_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"支付宝账号不能为空且必须小于20个字"),



        );

        $error = $obj_validate->validate();

        if ($error != ''){

            output_error($error);

        }

    }

 

    public function check_seller_name_existOp() {

        $condition = array();

        $condition['seller_name'] = $_GET['seller_name'];



        $model_seller = Model('seller');

        $result = $model_seller->isSellerExist($condition);



        if($result) {

            echo 'true';

        } else {

            echo 'false';

        }

    }





    public function savestep1Op() {

        $store_class_ids = array();

        $store_class_names = array();

        if(!empty($_POST['store_class_ids'])) {

              $store_class_ids = explode(',',ltrim($_POST['store_class_ids'],','));

        }

        if(!empty($_POST['store_class_names'])) {

           $store_class_names= explode(',',ltrim($_POST['store_class_names'],','));; 

           

        }

      

        //取最小级分类最新分佣比例

      

        if (!empty($store_class_ids)) {

            $store_class_commis_rates = array();

            $goods_class_list = Model('goods_class')->getGoodsClassListByIds($store_class_ids);



            if (!empty($goods_class_list) && is_array($goods_class_list)) {

               

                foreach ($goods_class_list as $v) {

                    $store_class_commis_rates[] = $v['commis_rate'];

                }

            }

        }

        $param = array();

        $param['seller_name'] = $_POST['seller_name'];

        $param['store_name'] = $_POST['store_name'];

        $param['store_class_ids'] = serialize($store_class_ids);

        $param['store_class_names'] = serialize($store_class_names);

        $param['joinin_year'] = intval($_POST['joinin_year']);

        $param['joinin_state'] = STORE_JOIN_STATE_NEW;

        $param['store_class_commis_rates'] = implode(',', $store_class_commis_rates);

        

        //取店铺等级信息

        $grade_list = rkcache('store_grade',true);

        if (!empty($grade_list[$_POST['sg_id']])) {

            $param['sg_id'] = $_POST['sg_id'];

            $param['sg_name'] = $grade_list[$_POST['sg_id']]['sg_name'];

            $param['sg_info'] = serialize(array('sg_price' => $grade_list[$_POST['sg_id']]['sg_price']));

        }



        //取最新店铺分类信息

        $store_class_info = Model('store_class')->getStoreClassInfo(array('sc_id'=>intval($_POST['sc_id'])));

        if ($store_class_info) {

            $param['sc_id'] = $store_class_info['sc_id'];

            $param['sc_name'] = $store_class_info['sc_name'];

            $param['sc_bail'] = $store_class_info['sc_bail'];

        }



        //店铺应付款

        $param['paying_amount'] = floatval($grade_list[$_POST['sg_id']]['sg_price'])*$param['joinin_year']+floatval($param['sc_bail']);

      

        $this->step4_save_valid($param);

   

        $model_store_joinin = Model('store_joinin');

        $up = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

        if($up){

              output_data(array('url'=>urlMobile('store_joinin_c2c')));

        }else{

             output_error('提交失败!');

        }

        



    }



    private function step4_save_valid($param) {

        $obj_validate = new Validate();

        $obj_validate->validateparam = array(

            array("input"=>$param['store_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"店铺名称不能为空且必须小于50个字"),

            array("input"=>$param['sg_id'], "require"=>"true","message"=>"店铺等级不能为空"),

            array("input"=>$param['sc_id'], "require"=>"true","message"=>"店铺分类不能为空"),

        );

        $error = $obj_validate->validate();

        if ($error != ''){

            output_error($error);

        }

    }



    public function payOp() {

        if (!empty($this->joinin_detail['sg_info'])) {

            $store_grade_info = Model('store_grade')->getOneGrade($this->joinin_detail['sg_id']);

            $this->joinin_detail['sg_price'] = $store_grade_info['sg_price'];

        } else {

            $this->joinin_detail['sg_info'] = @unserialize($this->joinin_detail['sg_info']);

            if (is_array($this->joinin_detail['sg_info'])) {

                $this->joinin_detail['sg_price'] = $this->joinin_detail['sg_info']['sg_price'];

            }

        }

        Tpl::output('joinin_detail', $this->joinin_detail);

        Tpl::output('step', '4');

        Tpl::output('sub_step', 'pay');



        Tpl::showpage('store_joinin_c2c_apply');

	    exit;

    }



    public function pay_saveOp() {

        $param = array();

        $param['paying_money_certificate'] =$_POST['paying_money_certificate'];

        $param['paying_money_certif_exp'] = $_POST['paying_money_certif_exp'];

        $param['joinin_state'] = STORE_JOIN_STATE_PAY;



        if(empty($param['paying_money_certificate'])) {

            output_error('请上传付款凭证');

        }



        $model_store_joinin = Model('store_joinin');

        $up = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

        if($up){

              output_data(array('url'=>urlMobile('store_joinin_c2c')));

        }else{

             output_error('提交失败!');

        }

       

    }

    private function step4() {

        $model_store_joinin = Model('store_joinin');

        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_SESSION['member_id']));

        $joinin_detail['store_class_ids'] = unserialize($joinin_detail['store_class_ids']);

        $joinin_detail['store_class_names'] = unserialize($joinin_detail['store_class_names']);

        $joinin_detail['store_class_commis_rates'] = explode(',', $joinin_detail['store_class_commis_rates']);

        $joinin_detail['sg_info'] = unserialize($joinin_detail['sg_info']);

        Tpl::output('joinin_detail',$joinin_detail);

    }



    private function show_join_message($message, $btn_next = FALSE, $step = 'step2') {

        Tpl::output('joinin_message', $message);

        Tpl::output('btn_next', $btn_next);

        Tpl::output('step', $step);

        Tpl::output('sub_step', 'step5');

        Tpl::showpage('store_joinin_c2c_apply');

 	exit;

    }



    private function upload_image($file) {

        $pic_name = '';

        $upload = new UploadFile();

        $uploaddir = ATTACH_PATH.DS.'store_joinin'.DS;

        $upload->set('default_dir',$uploaddir);

        $upload->set('allow_type',array('jpg','jpeg','gif','png'));

        if (!empty($_FILES[$file]['name'])){

            $result = $upload->upfile($file);

            if ($result){

                $pic_name = $upload->file_name;

                $upload->file_name = '';

            }

        }

        return $pic_name;

    }



	/**

	 * 检查店铺名称是否存在

	 *

	 * @param 

	 * @return 

	 */

	public function checknameOp() {

		/**

		 * 实例化卖家模型

		 */

		$model_store	= Model('store');

		$store_name = $_GET['store_name'];

		$store_info = $model_store->getStoreInfo(array('store_name'=>$store_name));

		if(!empty($store_info['store_name']) && $store_info['member_id'] != $_SESSION['member_id']) {

			echo 'false';

		} else {

			echo 'true';

		}

	}

}

