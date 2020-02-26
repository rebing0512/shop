<?php
/**
 * 文章管理
 *
 *
 *
 *
 */



defined('TTShop') or exit('Access Invalid!');
class article_commentControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('article');
    }

    public function indexOp() {
        $this->article_commentOp();
    }

    /**
     * 文章管理
     */
    public function article_commentOp(){
        //分类列表
        $model_class = Model('article_class');
        $parent_list = $model_class->getTreeClassList(2);
        if (is_array($parent_list)){
            $unset_sign = false;
            foreach ($parent_list as $k => $v){
                $parent_list[$k]['ac_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['ac_name'];
            }
        }
        Tpl::output('parent_list',$parent_list);
		    Tpl::setDirquna('system');
        Tpl::showpage('article_comment.index');
    }

    public function deleteOp() {
        $model_article = Model('article');
        if (preg_match('/^[\d,]+$/', $_GET['del_id'])) {
            $_GET['del_id'] = explode(',',trim($_GET['del_id'],','));
            foreach ($_GET['del_id'] as $k => $v){
                $v = intval($v);
                $model_article->delpl($v);
            }
            $this->log("文章评论删除".'[ID:'.implode(',',$_GET['del_id']).']',null);
            exit(json_encode(array('state'=>true,'msg'=>'删除成功')));
        } else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }

    /**
     * 异步调用文章列表
     */
    public function get_xmlOp(){
        $lang   = Language::getLangContent();
        $model_article = Model('article');
        $condition = array();

        if (!empty($_POST['sortname']) && in_array($_POST['sortorder'],array('asc','desc'))) {
            $condition['order'] = $_POST['sortname'].' '.$_POST['sortorder'];
        }
        $condition['order'] = ltrim($condition['order'].',s_comment_id desc',',');
        $page   = new Page();
        $page->setEachNum(intval($_POST['rp']));
        $page->setStyle('admin');
        $article_list = $model_article->getArticleCommentList($condition,$page);
      
        $data = array();
        $data['now_page'] = $page->get('now_page');
        $data['total_num'] = $page->get('total_num');
        if (is_array($article_list)){

            unset($condition['order']);


            foreach ($article_list as $k => $v){
                $list = array();
                $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['s_comment_id']})\"><i class='fa fa-trash-o'></i>删除</a>";
                $s_user_name = Model('member')->where(array('member_id'=>$v['s_conmmet_uid']))->find();
                $list['s_user_name'] = $s_user_name['member_name'];
                $infos = Model()->table('article')->where(array('article_id'=>$v['s_conmmet_article_id']))->find();
                $list['article_title'] = $infos['article_title'];
                $list['s_comment_content'] = $v['s_comment_content'];
                $list['s_comment_time'] = date('Y-m-d H:i:s',$v['s_comment_time']);
                $data['list'][$v['s_comment_id']] = $list;
            }
        }
        exit(Tpl::flexigridXML($data));
    }



    /**
     * ajax操作
     */
    public function ajaxOp(){
        switch ($_GET['branch']){
            /**
             * 删除文章图片
             */
            case 'del_file_upload':
                if (intval($_GET['file_id']) > 0){
                    $model_upload = Model('upload');
                    /**
                     * 删除图片
                     */
                    $file_array = $model_upload->getOneUpload(intval($_GET['file_id']));
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_array['file_name']);
                    /**
                     * 删除信息
                     */
                    $model_upload->del(intval($_GET['file_id']));
                    echo 'true';exit;
                }else {
                    echo 'false';exit;
                }
                break;
        }
    }
}
