<?php
/**
 * cms文章心情
 *
 *
 
 */



defined('TTShop') or exit('Access Invalid!');
class attitudeControl extends BaseCmsControl{

    public function __construct() {
        parent::__construct();
    }

    /**
     * 文章心情
     */
    public function article_attitudeOp() {
    
        $article_id = intval($_GET['id']);
        $catid = intval($_GET['catid']);
        $article_attitude = intval($_GET['article_attitude']);
         if(empty($article_id) || empty($article_attitude)) {
            $data['result'] = 'false';
            $data['message'] = Language::get('wrong_argument');
            self::echo_json($data);
        }
        //取得对应模型
        $category = getCategory($catid);
        if (empty($category)) {
           $data['result'] = 'false';
            $data['message'] = '该栏目不存在!';
            self::echo_json($data);
        }
     //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
    
        $ncms_model_name =  'ncms_'.$disabled['tablename'];
       
        if ($disabled['disabled']) {
           $data['result'] = 'false';
            $data['message'] = Language::get('wrong_argument');
            self::echo_json($data);
        }


       

        if(!empty($_SESSION['member_id'])) {
            $model_attitude = Model('ncms_attitude');
            $param = array();
            $param['attitude_article_id'] = $article_id;
            $param['attitude_cate_id'] = $catid;
            $param['attitude_member_id'] = $_SESSION['member_id'];
            $exist = $model_attitude->isExist($param);
            if(!$exist) {
                $param['attitude_time'] = time();
                $result = $model_attitude->save($param);
                if($result) {

                    //评论计数加1
                  
                    $update = array();
                    $update['attitude_'.$article_attitude] = array('exp','attitude_'.$article_attitude.'+1');
                    $condition = array();
                    $condition['id'] = $article_id;
                    $condition['catid'] = $catid;
                    Model()->table("{$ncms_model_name}")->where($condition)->update($update);

                    //返回信息
                    $data['result'] = 'true';

                } else {
                    $data['result'] = 'false';
                    $data['message'] = Language::get('nc_common_save_fail');
                }
            } else {
                $data['result'] = 'false';
                $data['message'] = Language::get('attitude_published');
            }
        } else {
            $data['result'] = 'false';
            $data['message'] = Language::get('no_login');
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
