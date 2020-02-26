<?php

/*
 *
 * 名片
 *
 *
 * */


defined('TTShop') or exit('Access Invalid!');

class mb_businesscardControl extends SystemControl {

    public $my_info_type = array();
    public $my_category = array();
    public function __construct()
    {

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('category',$category['result']['category']);

        $my_category = array();
        foreach ($category['result']['category'] as $item){
            $my_category[$item['id']] = $item['name'];
        }
        $this->my_category = $my_category;

        //进行模型选择输出
        $model = Model('app_type_list');
        $type = $model->where(array('info_type'=>1))->order('id asc')->select();
        $info_type = array();
        foreach($type as $val){
            $info_type[$val['id']] =  $val;
        }
        Tpl::output('info_type_data',$type);
        Tpl::output('info_type',$info_type);
        $this->my_info_type = $info_type;

        parent::__construct();
        Tpl::setDirquna('information');
    }

    //页面展示

    public function indexOp ()
    {
        Tpl::showpage('businesscard.index');
    }

    //新增

    public function addOp ()
    {
        $model = Model('businesscard');

        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['title'] = trim($_POST['title']);

            $new_array['company_name'] = trim($_POST['company_name']);

            $new_array['company_addr'] = trim($_POST['company_addr']);

            $new_array['phone'] = trim($_POST['phone']);

            $new_array['weixin'] = trim($_POST['weixin']);

            $new_array['store_name'] = trim($_POST['store_name']);

            $new_array['user_id'] = trim($_POST['user_id']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $new_array['main'] = trim($_POST['main']);

            $model->insert($new_array);

            Tpl::showpage('businesscard.index');

        }

        Tpl::output('action','添加');

        Tpl::showpage('businesscard.add');
    }

    //编辑

    public function editOp ()
    {
        $model = Model('businesscard');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['title'] = trim($_POST['title']);

            $new_array['company_name'] = trim($_POST['company_name']);

            $new_array['company_addr'] = trim($_POST['company_addr']);

            $new_array['phone'] = trim($_POST['phone']);

            $new_array['weixin'] = trim($_POST['weixin']);

            $new_array['store_name'] = trim($_POST['store_name']);

            $new_array['user_id'] = trim($_POST['user_id']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $new_array['main'] = trim($_POST['main']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            Tpl::showpage('businesscard.index');


        }

        Tpl::output('action','编辑');

        Tpl::output('page',$page);

        Tpl::showpage('businesscard.add');
    }

    //删除

    public function deleteOp ()
    {
        $model = Model('businesscard');

        $condetion = array();

        $condetion['id'] = trim($_GET['del_id']);

        $handel = $model->where($condetion)->delete();

        if ($handel){
            $ret = array(
                'state' => 1,
                'msg' => '操作成功'
            );

            exit(json_encode($ret));
        }
    }

    //ajax查询

    public function get_xmlOp()
    {
        $model_rec = Model('businesscard');

        $page = new Page();

        $condition  = array();
        $sort_fields = array('sort');
        if ($_POST['sortorder'] != '' && in_array($_POST['sortname'],$sort_fields)) {
            $order = $_POST['sortname'].' '.$_POST['sortorder'];
        }
        if ($_POST['query'] != '' && in_array($_POST['qtype'],array('name'))) {
            $condition[$_POST['qtype']] = array('like',"%{$_POST['query']}%");
        }
        $total_num = $model_rec->where($condition)->order('id desc')->page($_REQUEST['rp']?:10)->select();
        //$rec_list = $model_rec->getGoodsRecommendList($condition,$_POST['rp'],$order,'count(*) as rec_count,rec_gc_id,min(rec_gc_name) as rec_gc_name,min(rec_id) as rec_id','rec_gc_id','',$total_num);
        $data = array();
        $data['now_page'] = $model_rec->shownowpage();
        $data['total_num'] = $model_rec->gettotalnum();
        $base = MOBILE_SITE_URL;
        foreach ($total_num as $v) {
            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn blue' href='index.php?con=mb_businesscard&fun=edit&id={$v['id']}'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $list['id'] = $v['id'];
            $list['name'] = $v['name'];
            $list['sort'] = $v['sort'];
            $list['url'] = "<a href='{$base}/index.php?con=store&fun=store_card&id={$v['id']}' target='_blank'>{$base}/index.php?con=store&fun=store_card&id={$v['id']}</a>";
            $data['list'][$v['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }

}