<?php
/**
 * 店铺消息
 *
 *
 *
 
 */



defined('TTShop') or exit ('Access Invalid!');
class store_newsControl extends BaseSellerControl {
     public function __construct() {
        parent::__construct();
        Language::read('member_store_album');
    }
    public function indexOp() {
        $this->news_listOp();
    }

    /**
     * 资讯列表
     */
    public function news_listOp() {
        $store_news = Model('store_news');
        $store_id = $_SESSION['store_id'];
        $page= new Page();
        $page->setEachNum(10);
        $news_list = $store_news->getStore_newsList(array(), $page);
        foreach ($news_list as &$value) {
            $catename = Model()->table('store_news_cate')->where("id ={$value['s_catid']} and store_id = {$store_id}")->find();
            $value['cate_name'] = $catename['cate_name'];
        }
  
        Tpl::output('news_list', $news_list);
        Tpl::output('show_page', $page->show());


        $this->profile_menu('news_list');
        Tpl::showpage('store_news.list');
    }


    /**
     * 资讯分类
     */
    public function news_cateOp() {
        $store_news_cate = Model();
        $store_id = $_SESSION['store_id'];
        $rs = Model()->table('store_news_cate')->where(array('store_id'=>$store_id))->select();
        Tpl::output('news_cate', $rs);
        $this->profile_menu('news_cate');
        Tpl::showpage('store_news.cate');
    }

    /**
     * 添加资讯
     */
    public function news_addOp() {
        $store_id = $_SESSION['store_id'];
        $catelist = Model()->table('store_news_cate')->where(array('store_id'=>$store_id))->select();
        Tpl::output('catelist', $catelist);
        // 小时分钟显示
        $hour_array = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
        Tpl::output('hour_array', $hour_array);
        $minute_array = array('05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55');
        Tpl::output('minute_array', $minute_array);

        $this->profile_menu('news_list');
        Tpl::showpage('store_news.add');
    }
    /*
    *news_edit 编辑资讯
    */
    public function news_editOp(){
        $id = intval($_GET['id']);
        $store_id = $_SESSION['store_id'];
        $catelist = Model()->table('store_news_cate')->where(array('store_id'=>$store_id))->select();
        Tpl::output('catelist', $catelist);
        //详情
        $store_id = $_SESSION['store_id'];
        $news_info = Model('store_news')->where(array('store_id' => $store_id,'id'=>$id))->find();
        if ( !file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $news_info['s_thumb']) ) {
             $news_info['s_thumb'] =  UPLOAD_SITE_URL.'/'.ATTACH_COMMON.'/'.C('default_goods_image');
        }else{
              $news_info['s_thumb'] = UPLOAD_SITE_URL . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $news_info['s_thumb'];
        }
        $datetime = date('Y-m-d',$news_info['s_time']);
        $dateHtime = date('H',$news_info['s_time']);
        $dateItime = date('i',$news_info['s_time']);

        Tpl::output('datetime', $datetime);
        Tpl::output('dateHtime', $dateHtime);
        Tpl::output('dateItime', $dateItime);

        Tpl::output('news_info', $news_info);

         // 小时分钟显示
        $hour_array = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
        Tpl::output('hour_array', $hour_array);
        $minute_array = array('05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55');
        Tpl::output('minute_array', $minute_array);

        $this->profile_menu('news_list');
        Tpl::showpage('store_news.edit');
    }

    /**
     * 添加资讯分类
     */
    public function news_cateaddOp() {

        $this->profile_menu('news_list');
        Tpl::showpage('store_news.cateadd');
    }

     /**
     * 编辑资讯分类
     */
    public function news_cateeditOp() {
        $id = intval($_GET['id']);
        $store_id = $_SESSION['store_id'];
        $store_news_cate = Model();
        $rs = $store_news_cate->table('store_news_cate')->where("id = {$id} and store_id ={$store_id}")->find();
        $this->profile_menu('news_list');
        Tpl::output('data', $rs);

        Tpl::showpage('store_news.cateedit');
    }

    /**
     * 添加资讯分类添加保存
     */
    public function news_catesaveOp(){
            $store_news_cate = Model();
            $_POST['store_id'] = $_SESSION['store_id'];
            $rs = $store_news_cate->table('store_news_cate')->insert($_POST);
            
            if ($rs){

                showMessage('资讯分类添加成功！','index.php?con=store_news&fun=news_cate ', 'html', 'success');
            }else {
                 showMessage('资讯分类添加失败！','index.php?con=store_news&fun=news_cateadd', 'html', 'error');
            }
    }

      //资讯分类修改保存
    public function news_cateupdateOp(){
        $store_news_cate = Model();
        $id = intval($_POST['id']);
        $store_id = $_SESSION['store_id'];
        $rs = $store_news_cate->table('store_news_cate')->where("id ={$id} and store_id ={$store_id}")->update($_POST);
       
        if ($rs){
            showMessage('资讯分类保存成功！','index.php?con=store_news&fun=news_cate', 'html', 'success');
        }else {
             showMessage('资讯分类保存失败！',"index.php?con=store_news&fun=news_cateedit&id={$id}", 'html', 'error');
        }
    }

      //资讯分类删除
    public function news_catedropOp(){
        $store_news_cate = Model();
        $id = intval($_GET['id']);
        $store_id = $_SESSION['store_id'];
        $rs = $store_news_cate->table('store_news_cate')->where("id = {$id} and store_id = {$store_id}")->delete();

        if ($rs){
            showDialog('资讯分类删除成功！', 'reload', 'succ');
        }else {
            showDialog('资讯分类删除失败！');
        }
         
    }


    //资讯添加保存
    public function news_saveOp(){
            $store_news = Model('store_news');
              
            if($_POST['g_state'] == 0){
                
                $_POST['s_time'] = strtotime($_POST['starttime'].' '. $_POST['starttime_H'].':'. $_POST['starttime_i']);
                unset($_POST['starttime']);
                unset($_POST['starttime_H']);
                unset($_POST['starttime_i']);
            }else{
                 $_POST['s_time'] = time();
            }
            $_POST['s_thumb'] = $_POST['image_path'];
            $_POST['store_id'] = $_SESSION['store_id'];
            $_POST['s_author'] = $_SESSION['seller_name'];
            // unset($_POST['g_state']);
            unset($_POST['image_path']);
              
            $rs = $store_news->add($_POST);

            if ($rs){

                showMessage('资讯添加成功！','index.php?con=store_news', 'html', 'success');
            }else {
                 showMessage('资讯添加失败！','index.php?con=store_news&fun=add', 'html', 'error');
            }
    }

    //资讯编辑保存
    public function news_updateOp(){
        
            $store_news = Model('store_news');
              
            if($_POST['g_state'] == 0){
                
                $_POST['s_time'] = strtotime($_POST['starttime'].' '. $_POST['starttime_H'].':'. $_POST['starttime_i']);
                unset($_POST['starttime']);
                unset($_POST['starttime_H']);
                unset($_POST['starttime_i']);
            }else{
                 $_POST['s_time'] = time();
            }
            $_POST['s_thumb'] = $_POST['image_path'];
            $_POST['store_id'] = $_SESSION['store_id'];
            $_POST['s_author'] = $_SESSION['seller_name'];
            // unset($_POST['g_state']);
            unset($_POST['image_path']);
              // p($_POST);die;
            $rs = $store_news->updates($_POST);

            if ($rs){

                showMessage('资讯更新成功！','index.php?con=store_news', 'html', 'success');
            }else {
                 showMessage('资讯更新失败！','index.php?con=store_news&fun=edit&id='.$_POST['id'], 'html', 'error');
            }
    }


      //资讯删除
    public function news_dropOp(){

        $model = Model('store_news');
        $id = intval($_GET['id']);
        $rs = $model->where("id IN({$id})")->delete();

        if ($rs){
            showDialog('资讯删除成功！', 'reload', 'succ');
        }else {
            showDialog('资讯删除失败！');
        }
         
    }


     /**
     * 上传图片
     */
    public function thumb_uploadOp() {
        $store_id = $_SESSION['store_id'];
        $id = intval($_POST['id']);
        if(!empty($id)){
            $model_news = Model('store_news');
            $s_thumb = $model_news->where(array('store_id' => $store_id, 's_status' => 1,'id'=>$id))->find();
            $url = BASE_UPLOAD_PATH . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $s_thumb['s_thumb'];
             if ( !file_exists($url)) {
                 unlink($url);
              }
        }
        
        // 上传图片
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_ARTICLE_LIST . DS . $store_id . DS . $upload->getSysSetPath());
        $upload->set('max_size', C('image_max_filesize'));

        $upload->set('thumb_width', 640);
        $upload->set('thumb_height', 410);
        $upload->set('thumb_ext', ATTACH_IMAGES_EXT);
        $upload->set('fprefix', $store_id);
        $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
        $result = $upload->upfile($_POST['name'],true);

        if (!$result) {
           
            echo json_encode(array('error' => $upload->error));die;
        }
        $img_path = $upload->getSysSetPath() . $upload->file_name;
          // 本地存储时，增加判断文件是否存在，用默认图代替
        if ( !file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $img_path) ) {
            $imgsrc =  UPLOAD_SITE_URL.'/'.ATTACH_COMMON.'/'.C('default_goods_image');
        }else{
             $imgsrc = UPLOAD_SITE_URL . '/' . ATTACH_ARTICLE_LIST . '/' . $store_id . '/' . $img_path;
        }
        $data = array ();

        $data ['thumb_name'] =$imgsrc;
        $data ['name']      = $img_path;
        echo json_encode($data);die;
    }


    /**
     * 相册分类列表
     *
     */
    public function album_cateOp(){
        $model_album = Model('store_album');

        /**
         * 验证是否存在默认相册
         */
        $return = $model_album->checkAlbum(array('album_aclass.store_id'=>$_SESSION['store_id'],'is_default'=>'1'));
        if(!$return){
            $album_arr = array();
            $album_arr['aclass_name'] = Language::get('album_default_album');
            $album_arr['store_id'] = $_SESSION['store_id'];
            $album_arr['aclass_des'] = '';
            $album_arr['aclass_sort'] = '255';
            $album_arr['aclass_cover'] = '';
            $album_arr['upload_time'] = time();
            $album_arr['is_default'] = '1';
            $model_album->addClass($album_arr);
        }

        /**
         * 相册分类
         */
        $param = array();
        $param['album_aclass.store_id'] = $_SESSION['store_id'];
        $param['order']                 = 'aclass_sort desc';
        if($_GET['sort'] != ''){
            switch ($_GET['sort']){
                case '0':
                    $param['order']     = 'upload_time desc';
                    break;
                case '1':
                    $param['order']     = 'upload_time asc';
                    break;
                case '2':
                    $param['order']     = 'aclass_name desc';
                    break;
                case '3':
                    $param['order']     = 'aclass_name asc';
                    break;
                case '4':
                    $param['order']     = 'aclass_sort desc';
                    break;
                case '5':
                    $param['order']     = 'aclass_sort asc';
                    break;
            }
        }
        $aclass_info = $model_album->getClassList($param,$page);
        Tpl::output('aclass_info',$aclass_info);
     // Tpl::output('show_page',$page->show());

        Tpl::output('PHPSESSID',session_id());
        self::profile_menu('news_album','news_album');
        Tpl::showpage('store_news.album');
    }

     /**
     * 相册分类添加
     *
     */
    public function album_addOp(){
        /**
         * 实例化相册模型
         */
        $model_album = Model('store_album');
        $class_count = $model_album->countClass($_SESSION['store_id']);
        Tpl::output('class_count',$class_count['count']);
        Tpl::showpage('store_news.class_add','null_layout');
    }
    /**
     * 相册保存
     *
     */
    public function album_add_saveOp(){
        if (chksubmit()){
            /**
             * 实例化相册模型
             */
            $model_album = Model('store_album');
            $class_count = $model_album->countClass($_SESSION['store_id']);
            if($class_count['count'] >= 20){
                showDialog(Language::get('album_class_save_max_20'),'index.php?con=store_news&fun=album_cate','error',empty($_GET['inajax'])?'':'CUR_DIALOG.close();');
            }
            /**
             * 实例化相册模型
             */
            $param = array();
            $param['aclass_name']   = $_POST['name'];
            $param['store_id']      = $_SESSION['store_id'];
            $param['aclass_des']    = $_POST['description'];
            $param['aclass_sort']   = intval($_POST['sort']);
            $param['upload_time']   = time();

            $return = $model_album->addClass($param);
            if($return){
                showDialog(Language::get('album_class_save_succeed'),'index.php?con=store_news&fun=album_cate','succ',empty($_GET['inajax'])?'':'CUR_DIALOG.close();');
            }
        }
        showDialog(Language::get('album_class_save_lose'));
    }
    /**
     * 相册分类编辑
     */
    public function album_editOp(){
        if(empty($_GET['id'])){
            echo Language::get('album_parameter_error');exit;
        }
        /**
         * 实例化相册模型
         */
        $model_album = Model('store_album');
        $param = array();
        $param['field']     = array('aclass_id','store_id');
        $param['value']     = array(intval($_GET['id']),$_SESSION['store_id']);
        $class_info = $model_album->getOneClass($param);
        Tpl::output('class_info',$class_info);

        Tpl::showpage('store_news.class_edit','null_layout');
    }
    /**
     * 相册分类编辑保存
     */
    public function album_edit_saveOp(){
        $param = array();
        $param['aclass_name']   = $_POST['name'];
        $param['aclass_des']    = $_POST['description'];
        $param['aclass_sort']   = intval($_POST['sort']);


        /**
         * 实例化相册模型
         */
        $model_album = Model('store_album');
        /**
         * 验证
         */
        $return = $model_album->checkAlbum(array('album_aclass.store_id'=>$_SESSION['store_id'],'album_aclass.aclass_id'=>intval($_POST['id'])));
        if($return){
            /**
             * 更新
             */
            $re = $model_album->updateClass($param,intval($_POST['id']));
            if($re){
                showDialog(Language::get('album_class_edit_succeed'),'index.php?con=store_news&fun=album_cate','succ',empty($_GET['inajax'])?'':'CUR_DIALOG.close();');
            }
        }else{
            showDialog(Language::get('album_class_edit_lose'));
        }
    }
    /**
     * 相册删除
     */
    public function album_delOp(){
        if(empty($_GET['id'])){
            showMessage(Language::get('album_parameter_error'),'','html','error');
        }
        /**
         * 实例化相册模型
         */
        $model_album = Model('store_album');

        /**
         * 验证
         */
        $return = $model_album->checkAlbum(array('album_aclass.store_id'=>$_SESSION['store_id'],'album_aclass.aclass_id'=>intval($_GET['id']),'is_default'=>'0'));
        if(!$return){
            showDialog(Language::get('album_class_file_del_lose'));
        }
        /**
         * 删除分类
         */
        $return = $model_album->delClass(intval($_GET['id']));
        if(!$return){
            showDialog(Language::get('album_class_file_del_lose'));
        }
        /**
         * 更新图片分类
         */
        $param = array();
        $param['field']     = array('is_default','store_id');
        $param['value']     = array('1',$_SESSION['store_id']);
        $class_info = $model_album->getOneClass($param);
        $param = array();
        $param['aclass_id'] = $class_info['aclass_id'];
        $return = $model_album->updatePic($param,array('aclass_id'=>intval($_GET['id'])));
        if($return){
            showDialog(Language::get('album_class_file_del_succeed'),'index.php?con=store_news&fun=album_cate','succ');
        }else{
            showDialog(Language::get('album_class_file_del_lose'));
        }
    }
    /**
     * 图片列表
     */
    public function album_pic_listOp(){
        if(empty($_GET['id'])) {
            showMessage(Language::get('album_parameter_error'),'','html','error');
        }

        /**
         * 分页类
         */
        $page   = new Page();
        $page->setEachNum(15);
        $page->setStyle('admin');

        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');

        $param = array();
        $param['aclass_id'] = intval($_GET['id']);
        $param['album_pic.store_id']    = $_SESSION['store_id'];
        if($_GET['sort'] != ''){
            switch ($_GET['sort']){
                case '0':
                    $param['order']     = 'upload_time desc';
                    break;
                case '1':
                    $param['order']     = 'upload_time asc';
                    break;
                case '2':
                    $param['order']     = 'apic_size desc';
                    break;
                case '3':
                    $param['order']     = 'apic_size asc';
                    break;
                case '4':
                    $param['order']     = 'apic_name desc';
                    break;
                case '5':
                    $param['order']     = 'apic_name asc';
                    break;
            }
        }
        $pic_list = $model_album->getPicList($param,$page);
        Tpl::output('pic_list',$pic_list);
        Tpl::output('show_page',$page->show());

        /**
         * 相册列表，移动
         */
        $param = array();
        $param['album_class.un_aclass_id']  = intval($_GET['id']);
        $param['album_aclass.store_id'] = $_SESSION['store_id'];
        $class_list = $model_album->getClassList($param);
        Tpl::output('class_list',$class_list);
        /**
         * 相册信息
         */
        $param = array();
        $param['field']     = array('aclass_id','store_id');
        $param['value']     = array(intval($_GET['id']),$_SESSION['store_id']);
        $class_info         = $model_album->getOneClass($param);

        Tpl::output('class_info',$class_info);

        Tpl::output('PHPSESSID',session_id());
          self::profile_menu('news_album','news_album');
        Tpl::showpage('store_news.pic_list');
    }
    /**
     * 图片列表，外部调用
     */
    public function pic_listOp(){

        /**
         * 分页类
         */
        $page   = new Page();
        if(in_array($_GET['item'] , array('goods_image'))) {
            $page->setEachNum(12);
        } else {
            $page->setEachNum(14);
        }
        $page->setStyle('admin');

        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');
        /**
         * 图片列表
         */
        $param = array();
        $param['album_pic.store_id']    = $_SESSION['store_id'];
        if(!empty($_GET) && $_GET['id'] != '0'){
            $param['aclass_id'] = intval($_GET['id']);
            /**
             * 分类列表
             */
            $cparam = array();
            $cparam['field']        = array('aclass_id','store_id');
            $cparam['value']        = array(intval($_GET['id']),$_SESSION['store_id']);
            $cinfo          = $model_album->getOneClass($cparam);
            Tpl::output('class_name',$cinfo['aclass_name']);
        }
        $pic_list = $model_album->getPicList($param,$page);
        Tpl::output('pic_list',$pic_list);
        Tpl::output('show_page',$page->show());
        /**
         * 分类列表
         */
        $param = array();
        $param['album_aclass.store_id'] = $_SESSION['store_id'];
        $class_info         = $model_album->getClassList($param);
        Tpl::output('class_list',$class_info);

        switch($_GET['item']) {
        case 'goods':
            Tpl::showpage('store_goods_add.step2_master_image','null_layout');
            break;
        case 'des':
            Tpl::showpage('store_goods_add.step2_desc_image','null_layout');
            break;
        case 'groupbuy':
            Tpl::showpage('store_groupbuy.album','null_layout');
            break;
        case 'store_sns_normal':
            Tpl::showpage('store_sns_add.album', 'null_layout');
            break;
        case 'goods_image':
            Tpl::output('color_id', $_GET['color_id']);
            Tpl::showpage('store_goods_add.step3_goods_image', 'null_layout');
            break;
        case 'mobile':
            Tpl::output('type', $_GET['type']);
            Tpl::showpage('store_goods_add.step2_mobile_image', 'null_layout');
            break;
        }
    }
    /**
     * 修改相册封面
     */
    public function change_album_coverOp(){
        if(empty($_GET['id'])) {
            showDialog(Language::get('nc_common_op_fail'));
        }
        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');
        /**
         * 图片信息
         */
        $param = array();
        $param['field']     = array('apic_id','store_id');
        $param['value']     = array(intval($_GET['id']),$_SESSION['store_id']);
        $pic_info           = $model_album->getOnePicById($param);
        $return = $model_album->checkAlbum(array('album_aclass.store_id'=>$_SESSION['store_id'],'album_aclass.aclass_id'=>$pic_info['aclass_id']));
        if($return){
            $re = $model_album->updateClass(array('aclass_cover'=>$pic_info['apic_cover']),$pic_info['aclass_id']);
            if($re){
                showDialog(Language::get('nc_common_op_succ'),'reload','succ');
            }
        }else{
            showDialog(Language::get('nc_common_op_fail'));
        }
    }
    /**
     * ajax修改图名称
     */
    public function change_pic_nameOp(){
        if(empty($_POST['id']) && empty($_POST['name'])){
            echo 'false';
        }
        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');

        /**
         * 更新图片名称
         */
        if(strtoupper(CHARSET) == 'GBK'){
            $_POST['name'] = Language::getGBK($_POST['name']);
        }
        $return = $model_album->updatePic(array('apic_name'=>$_POST['name']),array('apic_id'=>intval($_POST['id'])));
        if($return){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    /**
     * 图片详细页
     */
    public function album_pic_infoOp(){
        if(empty($_GET['class_id']) && empty($_GET['id'])){
            showMessage(Language::get('album_parameter_error'),'','html','error');
        }
        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');

        /**
         * 验证
         */
        $return = $model_album->checkAlbum(array('album_pic.store_id'=>$_SESSION['store_id'],'album_pic.apic_id'=>intval($_GET['id'])));
        if(!$return){
            showMessage(Language::get('album_parameter_error'),'','html','error');
        }

        /**
         * 图片列表
         */
        $param = array();
        $param['aclass_id']         = intval($_GET['class_id']);
        $param['store_id']          = $_SESSION['store_id'];
        $page   = new Page();
        $each_num = 9;
        $page->setEachNum($each_num);
        $pic_list                   = $model_album->getPicList($param,$page);
        Tpl::output('pic_list',$pic_list);

        $curpage = intval($_GET['curpage']);
        if (empty($curpage)) $curpage = 1;
        $total_page = (ceil($page->get('total_num')/$each_num));

        Tpl::output('total_page',$total_page);
        Tpl::output('curpage',$curpage);

        $curpage = intval($_GET['curpage']);
        if (empty($curpage)) $curpage = 1;
        $tatal_page = (ceil($page->get('total_num')/$each_num));
        Tpl::output('tatal_page',$tatal_page);
        Tpl::output('curpage',$curpage);


        /**
         * 相册信息
         */
        $param = array();
        $param['field']     = array('aclass_id','store_id');
        $param['value']     = array(intval($_GET['class_id']),$_SESSION['store_id']);
        $class_info         = $model_album->getOneClass($param);
        Tpl::output('class_info',$class_info);

        /**
         * 图片信息
         */
        $param = array();
        $param['field']     = array('apic_id','store_id');
        $param['value']     = array(intval($_GET['id']),$_SESSION['store_id']);
        $pic_info           = $model_album->getOnePicById($param);
        $pic_info['apic_size'] = sprintf('%.2f',intval($pic_info['apic_size'])/1024);
        Tpl::output('pic_info',$pic_info);

        self::profile_menu('news_album','news_album');
        Tpl::showpage('store_news.pic_info');
    }

    /**
     * 图片 ajax
     */
    public function album_ad_ajaxOp(){
        if(empty($_GET['class_id']) && empty($_GET['id'])){
            exit();
        }

        $model_album = Model('store_album');

        $return = $model_album->checkAlbum(array('album_pic.store_id'=>$_SESSION['store_id'],'album_pic.apic_id'=>intval($_GET['id'])));
        if(!$return){
            exit();
        }

        /**
         * 图片列表
         */
        $param = array();
        $param['aclass_id']         = intval($_GET['class_id']);
        $param['store_id']          = $_SESSION['store_id'];
        $page   = new Page();
        $each_num = 9;
        $page->setEachNum($each_num);
        $pic_list                   = $model_album->getPicList($param,$page);
        Tpl::output('pic_list',$pic_list);

        Tpl::showpage('store_news.pic_scroll_ajax','null_layout');
    }

    /**
     * 图片删除
     */
    public function album_pic_delOp(){
        if (empty($_POST)) $_POST = $_GET;
        if(empty($_POST['id'])) {
            showDialog(Language::get('album_parameter_error'));
        }
        $model_album = Model('store_album');
        if(!empty($_POST['id']) && is_array($_POST['id'])){
            $id = "'".implode("','", $_POST['id'])."'";
        }else{
            $id = "'".intval($_POST['id'])."'";
        }

        $return = $model_album->checkAlbum(array('album_pic.store_id'=>$_SESSION['store_id'],'in_apic_id'=>$id));
        if(!$return){
            showDialog(Language::get('album_class_pic_del_lose'));
        }

        //删除图片
        $return = $model_album->delPic($id, $_SESSION['store_id']);
        if($return){
            showDialog(Language::get('album_class_pic_del_succeed'),'reload','succ');
        }else{
            showDialog(Language::get('album_class_pic_del_lose'));
        }
    }

    /**
     * 移动相册
     */
    public function album_pic_moveOp(){
        /**
         * 实例化相册类
         */
        $model_album = Model('store_album');
        if(chksubmit()){
            if(empty($_REQUEST['id'])){
                showDialog(Language::get('album_parameter_error'));
            }
            if(!empty($_REQUEST['id']) && is_array($_REQUEST['id'])){
                $_REQUEST['id'] = trim(implode("','", $_REQUEST['id']),',');
            }

                /**
                 * 验证封面图片
                 */
                $param = array();
                $param['in_apic_id'] = "'".$_REQUEST['id']."'";
                $list_pic = $model_album->getClassList($param);
                $class_cover = $list_pic['0']['aclass_cover'];
                $class_id    = $list_pic['0']['aclass_id'];
                unset($list_pic);
                if($class_cover != ''){
                    $list_pic = $model_album->getPicList($param);
                    foreach ($list_pic as $val){
                        if(str_ireplace('.', '_small.', $val['apic_cover']) == $class_cover){
                            $model_album->updateClass(array('aclass_cover'=>''),$class_id);
                            break;
                        }
                    }
                }

            $param = array();
            $param['aclass_id'] = $_REQUEST['cid'];
            $return = $model_album->updatePic($param,array('in_apic_id'=>"'".$_REQUEST['id']."'"));
            if($return){
                showDialog(Language::get('album_class_pic_move_succeed'),'reload','succ');
            }else{
                showDialog(Language::get('album_class_pic_move_lose'));
            }
        }
        $param = array();
        $param['album_class.un_aclass_id']  = $_GET['cid'];
        $param['album_aclass.store_id'] = $_SESSION['store_id'];
        $class_list = $model_album->getClassList($param);

        if(isset($_GET['id']) && !empty($_GET['id'])){
            Tpl::output('id',$_GET['id']);
        }
        Tpl::output('class_list',$class_list);
        Tpl::showpage('store_album.move','null_layout');
    }

    
    /**
     * 替换图片
     */
    public function replace_image_uploadOp() {
        $file = $_GET['id'];
        $tpl_array = explode('_', $file);
        $id = intval(end($tpl_array));
        $model_album = Model('store_album');
        $param = array();
        $param['field'] = array('apic_id', 'store_id');
        $param['value'] = array($id, $_SESSION['store_id']);
        $apic_info = $model_album->getOnePicById($param);

        if (substr(strrchr($apic_info['apic_cover'], "."), 1) != substr(strrchr($_FILES[$file]["name"], "."), 1)) {
            // 后缀名必须相同
            $error = L('album_replace_same_type');
            if (strtoupper(CHARSET) == 'GBK') {
                $error = Language::getUTF8($error);
            }
            echo json_encode( array('state' => 'false', 'message' => $error) );
            exit();
        }
        $pic_cover = implode(DS, explode(DS, $apic_info['apic_cover'], -1)); // 文件路径
        $tmpvar = explode(DS, $apic_info['apic_cover']);
        $pic_name = end($tmpvar); // 文件名称
        /**
         * 上传图片
         */
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_ARTICLE_ALBUM . DS . $_SESSION['store_id'] . DS . $pic_cover);
        $upload->set('max_size', C('image_max_filesize'));
        $upload->set('thumb_width', ALBUM_IMAGES_WIDTH);
        $upload->set('thumb_height', ALBUM_IMAGES_HEIGHT);
        $upload->set('thumb_ext', ALBUM_IMAGES_EXT);
        $upload->set('file_name', $pic_name);
        $return = $upload->upfile($file,true);
         
        if (!$return) {
            // 后缀名必须相同、
            if (strtoupper(CHARSET) == 'GBK') {
                $error = Language::getUTF8($upload->error);
            }
            echo json_encode( array('state' => 'false', 'message' => $upload->error) );
            exit();
        }
        /**
         * 取得图像大小
         */
        // 取得图像大小
        if (!C('oss.open')) {
            list($width, $height, $type, $attr) = getimagesize(BASE_UPLOAD_PATH . DS . ATTACH_ARTICLE_ALBUM . DS . $_SESSION['store_id'] . DS . $apic_info['apic_cover']);
        } else {
            list($width, $height, $type, $attr) = getimagesize(C('oss.img_url') . '/' . ATTACH_ARTICLE_ALBUM . '/' . $_SESSION['store_id'] . DS . $apic_info['apic_cover']);
        }
        /**
         * 更新图片分类
         */
        $param = array();
        $param['apic_size'] = intval($_FILES[$file]['size']);
        $param['apic_spec'] = $width . 'x' . $height;
        $return = $model_album->updatePic($param, array('apic_id' => $id));

        echo json_encode( array('state' => 'true', 'id' => $id) );
        exit();
    }

    
    /**
     * 上传图片
     *
     */
    public function image_uploadOp() {
        $store_id = $_SESSION ['store_id'];
        if (! empty ( $_POST ['category_id'] )) {
            $category_id = intval ( $_POST ['category_id'] );
        } else {
            $error = '上传 图片失败';
            if (strtoupper ( CHARSET ) == 'GBK') {
                $error = Language::getUTF8($error);
            }
            $data['state'] = 'false';
            $data['message'] = $error;
            $data['origin_file_name'] = $_FILES["file"]["name"];
            echo json_encode($data);
            exit();
        }
        // 判断图片数量是否超限
        $album_limit = $this->store_grade['sg_album_limit'];
        if ($album_limit > 0) {
            $album_count = Model('store_album')->getCount(array('store_id' => $store_id));
            if ($album_count >= $album_limit) {
                // 目前并不出该提示，而是提示上传0张图片
                $error = L('store_goods_album_climit');
                if (strtoupper ( CHARSET ) == 'GBK') {
                    $error = Language::getUTF8($error);
                }
                $data['state'] = 'false';
                $data['message'] = $error;
                $data['origin_file_name'] = $_FILES["file"]["name"];
                $data['state'] = 'true';
                echo json_encode($data);
                exit();
            }
        }

       
        /**
         * 上传图片
         */
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_ARTICLE_ALBUM . DS . $store_id . DS . $upload->getSysSetPath());
        $upload->set('max_size', C('image_max_filesize'));
        $upload->set('thumb_width', ALBUM_IMAGES_WIDTH);
        $upload->set('thumb_height', ALBUM_IMAGES_HEIGHT);
        $upload->set('thumb_ext', ALBUM_IMAGES_EXT);
        $upload->set('fprefix', $store_id);
        $result = $upload->upfile('file',true);
        if ($result) {
            $pic = $upload->getSysSetPath() . $upload->file_name;
            $pic_thumb = $upload->getSysSetPath() . $upload->thumb_image;
        } else {
            // 目前并不出该提示
            $error = $upload->error;
            if (strtoupper(CHARSET) == 'GBK') {
                $error = Language::getUTF8($error);
            }
            $data['state'] = 'false';
            $data['message'] = $error;
            $data['origin_file_name'] = $_FILES["file"]["name"];
            echo json_encode($data);
            exit();
        }

        // 取得图像大小
        if (!C('oss.open')) {
            list($width, $height, $type, $attr) = getimagesize(BASE_UPLOAD_PATH . '/' . ATTACH_ARTICLE_ALBUM . '/' . $store_id . DS . $pic);
        } else {
            list($width, $height, $type, $attr) = getimagesize(C('oss.img_url') . '/' . ATTACH_ARTICLE_ALBUM . '/' . $store_id . DS . $pic);
        }
        $image = explode('.', $_FILES["file"]["name"]);
        if (strtoupper(CHARSET) == 'GBK') {
            $image['0'] = Language::getGBK($image['0']);
        }
        $insert_array = array();
        $insert_array['apic_name'] = $image['0'];
        $insert_array['apic_tag'] = '';
        $insert_array['aclass_id'] = $category_id;
        $insert_array['apic_cover'] = $pic;
        $insert_array['apic_size'] = intval($_FILES['file']['size']);
        $insert_array['apic_spec'] = $width . 'x' . $height;
        $insert_array['upload_time'] = time();
        $insert_array['store_id'] = $store_id;
        $result = Model('store_upload_album')->add($insert_array);

        $data = array ();
        $data['file_id'] = $result;
        $data['file_name'] = $pic;
        $data['origin_file_name'] = $_FILES["file"]["name"];
        $data['file_path'] = $pic;
        $data['instance'] = $_GET['instance'];
        $data['state'] = 'true';
        /**
         * 整理为json格式
         */
        $output = json_encode ( $data );
        echo $output;
    }

        /**
     * ajax返回图片信息
     */
    public function ajax_change_imgmessageOp(){
        $str_array = explode('/', $_GET['url']);
        $str = array_pop($str_array);
        $str = explode('.', $str);
        /**
         * 实例化图片模型
         */
        $model_album = Model('store_album');
        $param = array();
        $search = explode(',', ALBUM_IMAGES_EXT);
        $param['like_cover']    = str_ireplace($search, '', $str['0']);
        $pic_info = $model_album->getPicList($param);

        /**
         * 小图尺寸
         */
        list($width, $height, $type, $attr) = getimagesize(BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE_ALBUM.DS.$_SESSION['store_id'].DS.$pic_info['0']['apic_cover']);
        if(strtoupper(CHARSET) == 'GBK'){
            $pic_info['0']['apic_name'] = Language::getUTF8($pic_info['0']['apic_name']);
        }
        echo json_encode(array(
                'img_name'=>$pic_info['0']['apic_name'],
                'default_size'=>sprintf('%.2f',intval($pic_info['0']['apic_size'])/1024),
                'default_spec'=>$pic_info['0']['apic_spec'],
                'upload_time'=>date('Y-m-d',$pic_info['0']['upload_time']),
                'small_spec'=>$width.'x'.$height
            ));
    }

     /**
         * ajax验证名称时候重复
         */
        public function ajax_check_class_nameOp(){
            $ac_name    = trim($_GET['ac_name']);
            if($ac_name == ''){
                echo 'true';die;
            }
            $model_album    = Model('store_album');
            $param = array();
            $param['field']     = array('aclass_name','store_id');
            $param['value']     = array($ac_name,$_SESSION['store_id']);
            $class_info = $model_album->getOneClass($param);
            if(!empty($class_info)){
                echo 'false';die;
            }else{
                echo 'true';die;
            }
        }


/**
     * 添加水印
     */
    public function album_pic_watermarkOp(){
        if(empty($_POST['id']) && !is_array($_POST['id'])) {
            showDialog(Language::get('album_parameter_error'));
        }

        $id = trim(implode(',', $_POST['id']),',');

        /**
         * 实例化图片模型
         */
        $model_album = Model('store_album');
        $param['in_apic_id']    = $id;
        $param['store_id']      = $_SESSION['store_id'];
        $wm_list = $model_album->getPicList($param);
        $model_store_wm = Model('store_watermark');
        $store_wm_info = $model_store_wm->getOneStoreWMByStoreId($_SESSION['store_id']);
        if ($store_wm_info['wm_image_name'] == '' && $store_wm_info['wm_text'] == ''){
            showDialog(Language::get('album_class_setting_wm'),"index.php?con=store_album&fun=store_watermark",'error','CUR_DIALOG.close();');//"请先设置水印"
        }
        import('libraries.gdimage');
        $gd_image = new GdImage();
        $gd_image->setWatermark($store_wm_info);

        foreach ($wm_list as $v) {
            $gd_image->create(BASE_UPLOAD_PATH.DS.ATTACH_GOODS.DS.$_SESSION['store_id'].DS.str_ireplace('.', '_1280.', $v['apic_cover']));//生成有水印的大图
        }
        showDialog(Language::get('album_pic_plus_wm_succeed'),'reload','succ');
    }
    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_key   当前导航的menu_key
     * @param array     $array      附加菜单
     * @return
     */
    private function profile_menu($menu_key='') {
        $menu_array = array();
        $menu_array = array(
            array('menu_key'=>'news_list',   'menu_name'=>'资讯列表',    'menu_url'=>urlShop('store_news', 'index')),
            array('menu_key'=>'news_cate',   'menu_name'=>'分类列表',    'menu_url'=>urlShop('store_news', 'news_cate')),
            array('menu_key'=>'news_album',  'menu_name'=>'相册展示',  'menu_url'=>urlShop('store_news', 'album_cate')),
        );
        
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
