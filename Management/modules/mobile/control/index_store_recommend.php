<?php

class index_store_recommendControl extends SystemControl
{

    private function initialize()
    {
    }

    public function __construct()
    {
        parent::__construct();

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        Tpl::output('category',$category);

        $fun = !empty($_GET['fun']) ? $_GET['fun'] : 'index';

        if (!in_array($fun,array('store','edit')))
        {
            Tpl::setDirquna('mobile');
        }
    }

    public function indexOp()
    {
        Tpl::showpage('index_store_recommend.index');
    }

    public function addOp()
    {
        $this->initialize();
        Tpl::showpage('index_store_recommend.edit');
    }

    public function editOp()
    {
        $this->initialize();
        $data = $this->only(array('id'));

        $data = Model('index_recommend_store')->where(array('id'=>$data['id']))->find();
        if (!$data)
        {
            showMessage('不存在的推荐设置','?con=index_store_recommend','html','error');
        }
        Tpl::setDirquna('mobile');

        Tpl::output('data',$data);

        Tpl::showpage('index_store_recommend.edit');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id','store_id','sort','h_type'
        ));



        if (!Model('store')->find($data['store_id']))
        {
            showMessage('选择的店铺不存在','','html','error');
        }

        $model = Model('index_recommend_store');
        if (empty($data['id'])) {
            unset($data['id']);
            $model->insert($data);
        } else {
            $id = $data['id'];
            unset($data['id']);
            $model->update($data,array(
                'where'=>array(
                    'id'=>$id
                )
            ));
        }

        showMessage('操作成功','index.php?con=index_store_recommend');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('index_recommend_store')->where(array(
            'id'=>$id
        ))->delete();

        $ret = array(
            'state' => 1,
            'msg' => '操作成功'
        );

        exit(json_encode($ret));
    }

    public function get_xmlOp()
    {
        $model = Model();

        $condition = array();

        list($condition, $order) = $this->_get_condition($condition);

        $list =
            $model->table('index_recommend_store,store')->join('left')->on('index_recommend_store.store_id=store.store_id')->field('index_recommend_store.*,store.store_name')->where($condition)->order($order)->page($_POST['rp']?:10)->select();

        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
        foreach ($list as $k => $info) {


            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red' href='?con=index_store_recommend&fun=edit&id={$info['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $list['id'] = $info['id'];
            $list['sort'] = $info['sort'];
            $list['store_name'] = $info['store_name'];
            $data['list'][$info['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }



    /**
     * 封装公共代码
     */
    private function _get_condition($condition) {
        $sort_fields = array('id','sort');
        $order = array();
        if ($_REQUEST['sortorder'] != '' && in_array($_REQUEST['sortname'],$sort_fields)) {
            $order = 'index_recommend_store.'.$_REQUEST['sortname'].' '.$_REQUEST['sortorder'];
        }
        return array(array(),$order);
    }
}