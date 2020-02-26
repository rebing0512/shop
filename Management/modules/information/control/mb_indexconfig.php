<?php
/**
 * 首页配置
 *
 *
 *
 *
 */



defined('TTShop') or exit('Access Invalid!');
class mb_indexconfigControl extends SystemControl
{

    public function __construct()
    {
        parent::__construct();
        Tpl::setDirquna('information');
    }

    /**
     * 首页配置列表
     */
    public function indexOp()
    {
        $link = array();

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        foreach ($category['result']['category'] as $item){
            $link[] = array('url'=>'con=mb_indexconfig&fun=index&h_type='.$item['id'],'text'=>$item['name']);
        }
//var_dump($link);exit;
        $condition = array();
        $condition['h_type'] = $_GET['h_type']?:$category['result']['category'][0]['id'];

        $model_doc = Model('indexconfig');
        $doc_list = $model_doc->where($condition)->select();

        //$active = (($_GET['h_type']?:$_GET['fun']));
        //var_dump($active);exit;
        Tpl::output('top_link',$this->sublink($link,$_GET['h_type']));

        Tpl::output('doc_list', $doc_list);
        Tpl::showpage('indexconfig');
    }

    //编辑

    public function editOp ()
    {
        $model = Model('indexconfig');

        $condetion = array();

        $condetion['id'] = trim($_GET['doc_id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['store_id'] = trim($_POST['store_id']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            $this->indexOp();


        }

        Tpl::output('page',$page);

        Tpl::showpage('indexconfig.edit');
        //
    }

}