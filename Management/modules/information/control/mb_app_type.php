<?php

/*
 *
 * 掌眼
 *
 *
 * */


defined('TTShop') or exit('Access Invalid!');

class mb_app_typeControl extends SystemControl {

    public function __construct()
    {

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('category',$category['result']['category']);
		
		$category_name = array();
		foreach ($category['result']['category'] as $item){
            $category_name[$item['id']] =$item['name'];
        }
		Tpl::output('category_name', $category_name);
		
		//分类的类型
		$arr_fenlei = array();
		$arr_fenlei[1] = array(
		                        'id'=>1,
								'name'=>'横图信息',
								'opname' => 'crafstman'
		                       );
		$arr_fenlei[2] = array(
		                        'id'=>2,
								'name'=>'圆图信息',
								'opname' => 'master'
		                       );
		Tpl::output('info_fenlei', $arr_fenlei);
		
		
        parent::__construct();
        Tpl::setDirquna('information');
    }
	
	
	//列表
	 public function indexOp(){
		 //增加表 app_type_list
        $model = Model('app_type_list');
        $type = $model->order('id asc')->select();
        Tpl::output('type',$type);
        Tpl::showpage('app_type_list');
    }
	
	//添加	
    public function type_addOp(){
        $model = Model('app_type_list');
        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['h_type'] = trim($_POST['h_type']);

            $new_array['info_type'] = trim($_POST['info_type']);

            $model->insert($new_array);

            $this->indexOp();

        }
        Tpl::showpage('app_type_add');
    }
	
	//编辑
    public function type_editOp(){
        $model = Model('app_type_list');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['h_type'] = trim($_POST['h_type']);
			
			$new_array['info_type'] = trim($_POST['info_type']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            $this->indexOp();

        }

        Tpl::output('data',$page);
        Tpl::showpage('app_type_add');
    }
	
	
	/**
     * 删除分类
     */
    public function type_delOp(){
        if ($_GET['id'] != ''){
            $id = explode(',', $_GET['id']);
            //删除分类
            Model('app_type_list')->where(array('id'=>array('in',$id)))->delete();
            //$this->log(L('nc_delete,goods_class_index_class') . '[ID:' . $_GET['id'] . ']',1);
            exit(json_encode(array('state'=>true,'msg'=>'删除成功')));
        }else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }
	
}