<?php

class index_topslide_recommendControl extends SystemControl
{

    /**
     * @var array
     * @access private
     */
    private $type = array(
        'goods' => '商品',
        'store' => '店铺',
        'url' => '固定网址'
    );

    private $rtypes = array(
        'ad' => '模块一轮播广告',
        'middle' => '模块三轮播广告',
        'bottom' => '模块五轮播广告',
        'mo_two' => '模块二主图',
        'mo_two_pic' => '模块二小图',
        'mo_four' => '模块五主图',
        'mo_four_pic' => '模块五小图',
        'mo_five' => '模块四广告',
        'market' => '集市首页广告'
    );

    private $core_category = array();

    private function initialize()
    {
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

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
            Tpl::setDirquna('mobile');
        }
    }

    public function indexOp()
    {
        Tpl::showpage('index_topslide_recommend.index');
    }

    public function addOp()
    {
        $this->initialize();
        Tpl::showpage('index_topslide_recommend.edit');
    }

    public function editOp()
    {
        $this->initialize();
        $data = $this->only(array('id'));

        $data = Model('index_recommend_topslide')->where(array('id'=>$data['id']))->find();
        if (!$data)
        {
            showMessage('不存在的推荐设置','?con=index_topslide_recommend','html','error');
        }
        Tpl::setDirquna('mobile');

        Tpl::output('data',$data);

        Tpl::showpage('index_topslide_recommend.edit');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id','object','rtype','h_type', 'type','sort','name','price'
        ));

        if (!$data['rtype']) {
            showMessage('请填写推荐类型','','html','error');
        }

        if (!$data['h_type']) {
            showMessage('请填写核心分类','','html','error');
        }

        if (!preg_match('/^[a-zA-Z0-9_]{1,12}$/',$data['rtype'])) {
            showMessage('推荐类型规则错误','','html','error');
        }

        if (is_null($data['type']) || $data['type'] === '' || !in_array($data['type'],array_keys($this->type))) {
            showMessage('推荐类型设置错误','','html','error');
        }

        if (!$data['id']) {
            if (!$_FILES['link_pic'])
                showMessage('请上传图片','','html','error');
        }

        if ($_FILES['link_pic']['tmp_name']!='') {
            $upload = new UploadFile();
            $upload->set('ifremove',true);
            $upload->set("thumb_width",1000);
            $upload->set("thumb_height",700);
            $upload->set("thumb_ext",'_index_top_slide');
            $file = $upload->upfile('link_pic');
            if (!$file)
                showMessage($upload->error,'','html','error');
            $data['link_pic'] = $upload->thumb_image;
        }

        if ($data['id']&&$_FILES['link_pic']['tmp_name']!='')
        {
            $object = Model('index_recommend_topslide')->where(array(
                'id'=>$data['id']
            ))->find();
            @unlink(BASE_UPLOAD_PATH.DS.ATTACH_PATH.DS.$object['link_pic']);
        }

        $model = Model('index_recommend_topslide');
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

        showMessage('操作成功','index.php?con=index_topslide_recommend');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('index_recommend_topslide')->where(array(
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
        list($condition, $order) = $this->_get_condition($condition);
        $list = $model->table('index_recommend_topslide')->where($condition)->order($order)->page($_POST['rp']?:10)->select();

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
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red' href='?con=index_topslide_recommend&fun=edit&id={$info['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $list['id'] = $info['id'];
            $list['rtype'] = $this->rtypes[$info['rtype']];
            $list['type'] = $this->type[$info['type']];
            $list['sort'] = $info['sort'];
            $list['h_type'] = $category_name[$info['h_type']];
            $list['image'] = '<a href="'.UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.$info['link_pic'].'" target="_blank">点击查看图片</a>';
            $list['object'] = $info['object'];
            $data['list'][$info['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }



    /**
     * 封装公共代码
     */
    private function _get_condition($condition) {
        $sort_fields = array('id','sort','h_type');
        $order = array();
        if ($_REQUEST['sortorder'] != '' && in_array($_REQUEST['sortname'],$sort_fields)) {
            $order = ''.$_REQUEST['sortname'].' '.$_REQUEST['sortorder'];
        }

        if ($_POST['qtype'] == 'id' && $_POST['query']) {
            $condition['id'] = $_POST['query'];
        }

        if ($_POST['qtype'] == 'h_type' && $_POST['query']) {
            $h_type = [];
            $systemcategoryModel = Model('systemcategory');
            $category = $systemcategoryModel::getSystemCategory();
            foreach ($category['result']['category'] as $value){
                if (strstr($value['name'],$_POST['query'])){
                    array_push($h_type,$value['id']);
                }
            }
            $h_type = implode(',',$h_type);
            $condition['h_type'] = array('in',$h_type);
        }

        if ($_POST['qtype'] == 'rtype' && $_POST['query']) {
            $rtype = [];
            foreach ($this->rtypes as $key=>$value){
                if (strstr($value,$_POST['query'])){
                    array_push($rtype,$key);
                }
            }
            $rtype = implode(',',$rtype);
            $condition['rtype'] = array('in',$rtype);
        }
        return array($condition,$order);
    }
}