<?php

class store_streetControl extends SystemControl
{

    private $core_category = array();

    private function initialize()
    {
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        $class = Model('store_class')->select();

        $categories = [];

        foreach ($category['result']['category'] as $key=>$value){
            $categories[$value['id']] = $value['name'];
        }

        $store_class = [];

        foreach ($class as $item){
            $store_class[$item['sc_id']] = $categories[$item['core_category_id']].'-'.$item['sc_name'];
        }

        Tpl::output('store_class',$store_class);

        Tpl::output('rtypes',$this->rtypes);

        Tpl::output('category',$category['result']['category']);

        Tpl::output('type', $this->type);
    }

    public function __construct()
    {
        parent::__construct();

        $fun = !empty($_GET['fun']) ? $_GET['fun'] : 'index';

        if (!in_array($fun,array('store','edit')))
        {
            Tpl::setDirquna('shop');
        }
    }

    public function indexOp()
    {
        Tpl::showpage('store_street.index');
    }

    public function addOp()
    {
        $this->initialize();
        Tpl::showpage('store_street.edit');
    }

    public function editOp()
    {
        $this->initialize();
        $data = $this->only(array('id'));

        $data = Model('store_street')->where(array('id'=>$data['id']))->find();
        if (!$data)
        {
            showMessage('不存在的推荐设置','?con=store_street','html','error');
        }
        Tpl::setDirquna('shop');

        Tpl::output('data',$data);

        Tpl::showpage('store_street.edit');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id','name','class_id','store_id','logo','url','sort','is_open','alias'
        ));

        if (!$data['name']) {
            showMessage('请填写店铺名称','','html','error');
        }

        if (!$data['class_id']) {
            showMessage('请填写店铺分类','','html','error');
        }

        if (!$data['id']) {
            if (!$_FILES['logo'])
                showMessage('请上传图片','','html','error');
        }

        if ($_FILES['logo']['tmp_name']!='') {
            $upload = new UploadFile();
            $upload->set('ifremove',true);
            $upload->set("thumb_width",1000);
            $upload->set("thumb_height",1000);
            $upload->set("thumb_ext",'_store_street');
            $upload->set("default_dir",ATTACH_STORE);
            $file = $upload->upfile('logo');
            if (!$file)
                showMessage($upload->error,'','html','error');
            $data['logo'] = $upload->thumb_image;
        }

        if ($data['id']&&$_FILES['logo']['tmp_name']!='')
        {
            $object = Model('store_street')->where(array(
                'id'=>$data['id']
            ))->find();
            @unlink(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$object['logo']);
        }

        $model = Model('store_street');
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

        showMessage('操作成功','index.php?con=store_street');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('store_street')->where(array(
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
        $this->initialize();
        $model = Model();

        $condition = array();
        if (!empty($_POST['query'])){
            $condition[$_POST['qtype']] = array('LIKE',"%{$_POST['query']}%");
        }
        list($condition, $order) = $this->_get_condition($condition);
        $list = $model->table('store_street,store_class')->join('left')->on('store_street.class_id = store_class.sc_id')->where($condition)->order($order)->page($_POST['rp']?:10)->select();

        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
        $data['list'] = [];
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        foreach ($category['result']['category'] as $item){
            $category_name[$item['id']] = $item['name'];
        }
        foreach ($list as $k => $info) {

            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red' href='?con=store_street&fun=edit&id={$info['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $list['id'] = $info['id'];
            $list['name'] = $info['name'];
            $list['class'] = $category_name[$info['core_category_id']].'-'.$info['sc_name'];
            $list['sort'] = $info['sort'];
            $list['image'] = '<a href="'.UPLOAD_SITE_URL.DS.ATTACH_STORE.DS.$info['logo'].'" target="_blank">点击查看图片</a>';
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
            $order = ''.$_REQUEST['sortname'].' '.$_REQUEST['sortorder'];
        }

        if ($_POST['qtype'] == 'id' && $_POST['query']) {
            $condition['id'] = $_POST['query'];
        }
        return array($condition,$order);
    }
}