<?php

class great_storeControl extends SystemControl
{
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
        Tpl::showpage('great_store.index');
    }

    public function addOp()
    {
        Tpl::showpage('great_store.edit');
    }

    public function editOp()
    {
        $data = $this->only(array('id'));

        $data = Model('great_store')->where(array('id'=>$data['id']))->find();
        if (!$data)
        {
            showMessage('不存在的推荐设置','?con=great_store','html','error');
        }
        Tpl::setDirquna('shop');

        Tpl::output('data',$data);

        Tpl::showpage('great_store.edit');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id','store_id','sort'
        ));

        if (!$data['store_id']) {
            showMessage('请填写店铺ID','','html','error');
        }

//        if ($_FILES['logo']['tmp_name']!='') {
//            $upload = new UploadFile();
//            $upload->set('ifremove',true);
//            $upload->set("thumb_width",1000);
//            $upload->set("thumb_height",1000);
//            $upload->set("thumb_ext",'_store_street');
//            $upload->set("default_dir",ATTACH_STORE);
//            $file = $upload->upfile('logo');
//            if (!$file)
//                showMessage($upload->error,'','html','error');
//            $data['logo'] = $upload->thumb_image;
//        }
//
//        if ($data['id']&&$_FILES['logo']['tmp_name']!='')
//        {
//            $object = Model('store_street')->where(array(
//                'id'=>$data['id']
//            ))->find();
//            @unlink(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$object['logo']);
//        }

        $model = Model('great_store');
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

        showMessage('操作成功','index.php?con=great_store');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('great_store')->where(array(
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
        if (!empty($_POST['query'])){
            $condition[$_POST['qtype']] = array('LIKE',"%{$_POST['query']}%");
        }
        $list = $model->table('great_store,store')->join('left')->on('great_store.store_id = store.store_id')->where($condition)->order('id desc')->page($_POST['rp']?:10)->select();

        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
        foreach ($list as $k => $info) {

            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red' href='?con=great_store&fun=edit&id={$info['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $list['id'] = $info['id'];
            $list['store_name'] = $info['store_name'];
            $list['sort'] = $info['sort'];
            $data['list'][$info['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }

}