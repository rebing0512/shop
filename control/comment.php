<?php
/**
 * CMS评论
 *
 *
 
 */



defined('TTShop') or exit('Access Invalid!');
class commentControl extends BaseCmsControl{

    public function __construct() {
        parent::__construct();
        //是否关闭投稿功能
        if(intval(C('cms_comment_flag')) !== 1) {
            showMessage(Language::get('comment_closed'),'','','error');
        }
    }

    /**
     * 评论保存
     **/
    public function comment_saveOp() {

        $data = array();
        $data['result'] = 'true';
        $comment_object_id = intval($_POST['comment_object_id']);
        $comment_object_catid = intval($_POST['comment_object_catid']);
        $model_name = '';

        //取得对应模型
        $category = getCategory($comment_object_catid);
        if (empty($category)) {
           $data['result'] = 'false';
            $data['message'] ='该栏目不存在！';
            self::echo_json($data);
        }
     //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        $model_name =  'ncms_'.$disabled['tablename'];



        if($comment_object_catid <= 0 || $comment_object_id <= 0 || empty($_POST['comment_message'])) {
            $data['result'] = 'false';
            $data['message'] = Language::get('wrong_argument');
            self::echo_json($data);
        }

        if(!empty($_SESSION['member_id'])) {

            $param = array();
           
            $param["comment_object_id"] = $comment_object_id;
            $param["comment_object_catid"] = $comment_object_catid;
            
            if (strtoupper(CHARSET) == 'GBK'){
                $param['comment_message'] = Language::getGBK(trim($_POST['comment_message']));
            } else {
                $param['comment_message'] = trim($_POST['comment_message']);
            }
            $param['comment_member_id'] = $_SESSION['member_id'];
            $param['comment_time'] = time();

            $model_comment = Model('ncms_comment');

            if(!empty($_POST['comment_id'])) {
                $comment_detail = $model_comment->getOne(array('comment_id'=>$_POST['comment_id']));
                if(empty($comment_detail['comment_quote'])) {
                    $param['comment_quote'] = $_POST['comment_id'];
                } else {
                    $param['comment_quote'] = $comment_detail['comment_quote'].','.$_POST['comment_id'];
                }
            } else {
                $param['comment_quote'] = '';
            }

            $result = $model_comment->save($param);
            if($result) {

                //评论计数加1
   
                $update = array();
                $update['comment'] = array('exp','comment+1');
                $condition = array();
                $condition['id'] = $comment_object_id;
                $condition['catid'] = $comment_object_catid;

                Model()->table("{$model_name}")->where($condition)->update($update);

                //返回信息
                $data['result'] = 'true';
                $data['message'] = Language::get('nc_common_save_succ');
                $data['member_name'] = $_SESSION['member_name'].Language::get('nc_colon');
                $data['member_avatar'] = getMemberAvatar($_SESSION['avatar']);
                // $data['member_link'] = SITEURL.DS.'index.php?con=member_snshome&mid='.$_SESSION['member_id'];
                $data['comment_message'] = parsesmiles(stripslashes($param['comment_message']));
                $data['comment_time'] = date('Y-m-d H:i:s',$param['comment_time']);
                $data['comment_id'] = $result;

            } else {
                $data['result'] = 'false';
                $data['message'] = Language::get('nc_common_save_fail');
            }
        } else {
            $data['result'] = 'false';
            $data['message'] = Language::get('no_login');
        }
        self::echo_json($data);
    }

    /**
     * 评论列表
     **/
    public function comment_listOp() {
        $page_count = 5;
        $order = 'comment_id desc';
        if($_GET['comment_all'] === 'all') {
            $page_count = 10;
            $order = 'comment_up desc, comment_id desc';
        }
        $comment_object_id = intval($_GET['comment_object_id']);
        $comment_object_catid = intval($_GET['comment_object_catid']);
      

        if($comment_object_id > 0) {
            $condition = array();
            $condition["comment_object_id"] = $comment_object_id;
            $condition["comment_object_catid"] = $comment_object_catid;
            $model_cms_comment = Model('ncms_comment');
            $comment_list = $model_cms_comment->getListWithUserInfo($condition, $page_count, $order);

            Tpl::output('comment_list', $comment_list);
              $model_name = '';

            //取得对应模型
            $category = getCategory($comment_object_id);
            if (empty($category)) {
               $data['result'] = 'false';
                $data['message'] ='该栏目不存在！';
                self::echo_json($data);
            }
         //模型ID
            $modelid = $category['modelid'];
            //检查模型是否被禁用
            $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
            $model_name =  'ncms_'.$disabled['tablename'];
            if($_GET['comment_all'] === 'all') {
                Tpl::output('show_page', $model_cms_comment->showpage(2));
            }

            $comment_quote_id = '';
            $comment_quote_list = array();
            if(!empty($comment_list)) {
                foreach ($comment_list as $value) {
                    if(!empty($value['comment_quote'])) {
                        $comment_quote_id .= $value['comment_quote'].',';
                    }
                }
            }
       
            if(!empty($comment_quote_id)) {
                $comment_quote_list = $model_cms_comment->getListWithUserInfo(array('comment_id'=>array('in', $comment_quote_id)));
            }
            if(!empty($comment_quote_list)) {
                $comment_quote_list = array_under_reset($comment_quote_list, 'comment_id');
            }

            Tpl::output('comment_quote_list', $comment_quote_list);
            Tpl::showpage('comment_list','null_layout');
        }
    }

    /**
     * 评论删除
     **/
    public function comment_dropOp() {
        $data['result'] = 'false';
        $data['message'] = Language::get('nc_common_del_fail');
        $comment_id = intval($_POST['comment_id']);
        $comment_object_id = intval($_POST['comment_object_id']);
        $comment_object_catid = intval($_POST['comment_object_catid']);
        $model_name = '';

         //取得对应模型
        $category = getCategory($comment_object_catid);
        if (empty($category)) {
           $data['result'] = 'false';
            $data['message'] ='该栏目不存在！';
            self::echo_json($data);
        }
     //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        $model_name =  'ncms_'.$disabled['tablename'];

        if($comment_id > 0) {
            $model_comment = Model('ncms_comment');
            $comment_info = $model_comment->getOne(array('comment_id'=>$comment_id));
            if($comment_info['comment_member_id'] == $_SESSION['member_id']) {
                $result = $model_comment->drop(array('comment_id'=>$comment_id));
                if($result) {

                   

                    //评论计数减1
                   
                    $update = array();
                    $update['comment'] = array('exp','comment-1');
                    $condition = array();
                    $condition['id'] = $comment_object_id;
                    $condition['catid'] = $comment_object_catid;
                    Model()->table("{$model_name}")->where($condition)->update($update);
                    

                    $data['result'] = 'true';
                    $data['message'] = Language::get('nc_common_del_succ');
                }
            }
        }
        self::echo_json($data);
    }

    /**
     * 评论顶
     **/
    public function comment_upOp() {

        $data = array();
        $data['result'] = 'true';

        $comment_id = intval($_POST['comment_id']);
        if($comment_id > 0) {
            $model_comment_up = Model('ncms_comment_up');
            $param = array();
            $param['comment_id'] = $comment_id;
            $param['up_member_id'] = $_SESSION['member_id'];
            $is_exist = $model_comment_up->isExist($param);
            if(!$is_exist) {
                $param['up_time'] = time();
                $model_comment_up->save($param);

                $model_comment = Model('ncms_comment');
                $model_comment->modify(array('comment_up'=>array('exp', 'comment_up+1')), array('comment_id'=>$comment_id));
            } else {
                $data['result'] = 'false';
                $data['message'] = '顶过了';
            }
        } else {
            $data['result'] = 'false';
            $data['message'] = Language::get('wrong_argument');
        }
        self::echo_json($data);
    }

     private function return_json($message,$result='true') {
        $data = array();
        $data['result'] = $result;
        $data['message'] = $message;
        self::echo_json($data);
    }

    private function echo_json($data) {
        if (strtoupper(CHARSET) == 'GBK'){
            $data = Language::getUTF8($data);//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        }
        echo json_encode($data);die;
    }

}
