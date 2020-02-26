<?php

/*
 *
 * 馆藏臻品
 *
 *
 * */


defined('TTShop') or exit('Access Invalid!');

class mb_collectionControl extends SystemControl {

    public $my_info_type = array();
    public $my_category = array();
    private $type = array(
        0 => '信息',
        1 => '主图',
        2 => '标头'
    );
    private $level = array(
        1 => '省级',
        2 => '国家级'
    );
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
        $type = $model->where(array('info_type'=>2))->order('id asc')->select();
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

    //查询

    public function indexOp()
    {
        //

        Tpl::showpage('collection_index');

    }

    //添加

    public function addOp()
    {
        //
        $model = Model('collection');

        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['web_title'] = trim($_POST['web_title']);

            $new_array['type'] = trim($_POST['type']);

            $new_array['level'] = trim($_POST['level']);

            $new_array['h_type'] = trim($_POST['h_type']);
            $new_array['info_type_id'] = trim($_POST['info_type_id']);

            $new_array['intro'] = trim($_POST['intro']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $new_array['detail'] = trim($_POST['detail']);

            $model->insert($new_array);

            Tpl::showpage('collection_index');

        }

        Tpl::output('level',$this->level);

        Tpl::output('type',$this->type);

        Tpl::output('action','添加');

        Tpl::showpage('collection_add');

    }

    //编辑

    public function editOp()
    {
        //
        $model = Model('collection');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['web_title'] = trim($_POST['web_title']);

            $new_array['intro'] = trim($_POST['intro']);

            $new_array['type'] = trim($_POST['type']);

            $new_array['level'] = trim($_POST['level']);

            $new_array['h_type'] = trim($_POST['h_type']);
            $new_array['info_type_id'] = trim($_POST['info_type_id']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $new_array['detail'] = trim($_POST['detail']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            Tpl::showpage('collection_index');


        }

        Tpl::output('level',$this->level);

        Tpl::output('type',$this->type);

        Tpl::output('action','编辑');

        Tpl::output('page',$page);

        Tpl::showpage('collection_add');

    }

    //删除

    public function deleteOp()
    {
        //
        $model = Model('collection');

        $condetion = array();

        $condetion['id'] = trim($_GET['del_id']);

        $handel = $model->where($condetion)->delete();

        if ($handel){
            Tpl::showpage('collection_index');
        }

    }

    //ajax查询

    public function get_xmlOp()
    {
        $str = ($_REQUEST['curpage']-1)*$_REQUEST['rp'];

        $page = new Page();
        //$end = ($_REQUEST['curpage'])*$_REQUEST['rp']-1;
//        var_dump($str);
//        var_dump($end);
        $model_rec = Model('collection');
        $condition  = array();
        $sort_fields = array('sort');
        if ($_POST['sortorder'] != '' && in_array($_POST['sortname'],$sort_fields)) {
            $order = $_POST['sortname'].' '.$_POST['sortorder'];
        }
        if ($_POST['query'] != '' && in_array($_POST['qtype'],array('name'))) {
            $condition[$_POST['qtype']] = array('like',"%{$_POST['query']}%");
        }
        $resources = $model_rec->where($condition)->order('id desc')->page($_REQUEST['rp']?:10)->select();
        $data = array();
        $data['now_page'] = $model_rec->shownowpage();
        $data['total_num'] = $model_rec->gettotalnum();
        //var_dump($data);exit;
        $data['list'] = [];
        foreach ($resources as $v) {
            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn blue' href='index.php?con=mb_collection&fun=edit&id={$v['id']}'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $list['name'] = $v['name'];
            $list['sort'] = $v['sort'];
            $list['level'] = $this->level[$v['level']];
            $list['h_type'] = $this->my_category[$v['h_type']];			
			$list['info_type'] = $this->my_info_type[$v['info_type_id']]['name'];
            $data['list'][$v['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }

}