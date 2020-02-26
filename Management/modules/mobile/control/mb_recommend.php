<?php

class mb_recommendControl extends SystemControl
{

    public $my_category = array();
	
    private function initialize()
    {

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        Tpl::output('category',$category['result']['category']);
		
		
	   $my_category = array();
	   foreach ($category['result']['category'] as $item){
				  $my_category[$item['id']] = $item['name'];
		  }
		$this->my_category = $my_category;
		
		
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
        Tpl::showpage('mb_recommend');
    }

    public function addOp()
    {
        $this->initialize();
        Tpl::showpage('mb_recommend.index');
    }

    public function editOp()
    {
        $this->initialize();
        $data = $this->only(array('id'));

        $model_list = Model('setting')->getListSetting();
        $list = explode(',',$model_list['mb_recommend']);

        $data = Model('recommend')->where(array('id'=>$data['id']))->find();
        //var_dump($data);
        if (!$data)
        {
            showMessage('不存在的推荐设置','?con=recommend','html','error');
        }
        Tpl::setDirquna('mobile');

        Tpl::output('list',$list);

        Tpl::output('data',$data);

        Tpl::showpage('mb_recommend.index');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id','name','sort','h_type'
        ));


        $model = Model('recommend');
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

        showMessage('操作成功','index.php?con=mb_recommend');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('recommend')->where(array(
            'id'=>$id
        ))->delete();

        $ret = array(
            'state' => 1,
            'msg' => '操作成功'
        );

        exit(json_encode($ret));
        //var_dump($ret);
    }

    public function get_xmlOp()
    {
		
		$this->initialize();
		
        $model = Model();

        $condition = array();

        list($condition, $order) = $this->_get_condition($condition);

        //$condition = 'id = '.$_REQUEST['id'];

        $list =
            $model->table('recommend')->where($condition)->order($order)->page($_POST['rp']?:10)->select();
        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
		
		//var_dump($this->my_category);
		
        foreach ($list as $k => $info) {


            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red'  href='?con=mb_recommend&fun=edit&id={$info['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $list['id'] = $info['id'];
            $list['sort'] = $info['sort'];
			$list['h_type'] = $this->my_category[$info['h_type']];	//."--".$info['h_type']
            $list['goods_name'] = $info['name'];		
            //$list['type'] = tj($info['type']);
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
            $order = 's_recommend.'.$_REQUEST['sortname'].' '.$_REQUEST['sortorder'];
        }
        return array(array(),$order);
        //var_dump($order);
    }
}
/*
function tj ($n){
    $type = C('index_category');
    foreach ($type as $k => $v){
        if($k == $n){
            return $v;
        }
    }
}*/