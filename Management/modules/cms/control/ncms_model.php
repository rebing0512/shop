<?php
/**
 * ncms 模型
 *
 *
 *
 ** 
 */



defined('TTShop') or exit('Access Invalid!');
class ncms_modelControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('cms');
    }
    //模型列表
    public function indexOp(){

        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_model.list");
    }
    //获取模型列表数据
    public function ncms_model_list_xmlOp(){
        $page = $_POST['rp'];
        $ncms_model =  Model("ncms_model");
        $list =  (array)$ncms_model->getNcmsModelList(array('type'=>0),'*',$page);
        $data = array();
        $data['now_page'] = $ncms_model->shownowpage();
        $data['total_num'] = $ncms_model->gettotalnum();
        foreach ($list as $val) {
            $o = '<a class="btn red" href="javascript:;" data-j="drop"><i class="fa fa-trash-o"></i>删除</a>';
            $o .= '<a class="btn red" href="javascript:;" data-j="edit"><i class="fa fa-edit"></i>修改</a>';
            $o .= '<span class="btn"><em><i class="fa fa-cog"></i>设置<i class="arrow"></i></em><ul>';
            $o .= '<li><a href="javascript:;" data-j="field_manage">字段管理</a></li>';
            if($val['disabled']){
                $o .= "<li><a href='javascript:;' data-j='disabled' data-val='0'>启用</a></li>";
            }else{
                $o .= "<li><a href='javascript:;' data-j='disabled' data-val='1'>禁用</a></li>";
            }
            $o .= '<li><a href="javascript:;" data-j="export">导出模型</a></li>';
            $o .= '</ul></span>';
            $i = array();
            $i['operation'] = $o;
            $i['modelid'] = $val['modelid'];
            $i['name'] = $val['name'];
            $i['tablename'] = $val['tablename'];
            $i['description'] = $val['description'];
            $i['items'] = $val['items'];
            $i['addtime'] = date('Y-m-d H:i:s',$val['addtime']);
            $i['disabled'] = $val['disabled'] == 0
                ? '<span class="yes"><i class="fa fa-check-circle"></i>开启</span>'
                : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
          
            $data['list'][$val['modelid']] = $i;
        }

        echo Tpl::flexigridXML($data);
        exit;
    }

    /**
     * cms模型添加
     **/
    public function ncms_model_addOp() {
        $this->show_menu('add');
        Tpl::setDirquna('cms');
        Tpl::showpage('ncms_model.add');
    }
     /**
     * cms模型修改
     **/
    public function ncms_model_editOp() {
        $this->show_menu('add');
        $modelid =intval($_GET['modelid']);
        $data = Model('ncms_model')->where(array("modelid" => $modelid))->find();
        Tpl::output("data", $data);
        Tpl::setDirquna('cms');
        Tpl::showpage('ncms_model.edit');
    }
    //添加模型操作
    public function ncms_model_saveOp() {
       $obj_validate = new Validate();
        $validate_array = array(
            array('input'=>$_POST['name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('ncms_model_error')),
            array('input'=>$_POST['tablename'],'require'=>'english','message'=>Language::get('ncms_model_table_error')),
        );
        $obj_validate->validateparam = $validate_array;
        $error = $obj_validate->validate();
        if ($error != ''){
            showMessage(Language::get('error').$error,'','','error');
        }

        $param = array();
        $param['name'] = trim($_POST['name']);
        $param['tablename'] = trim($_POST['tablename']);
        $param['description'] = trim($_POST['description']);
        $param['addtime'] = time();
        $model_class = Model('ncms_model');
        $result = $model_class->addModel($param);
        if($result) {
            $this->log(Language::get('cms_log_ncms_model_save').$result, 1);
            showMessage(Language::get('ncms_model_success'),'index.php?con=ncms_model&fun=cncms_model_list');
        } else {
            $this->log(Language::get('cms_log_ncms_model_save').$result, 0);
            showMessage(Language::get('ncms_model_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
        }
      
    }
    //模型修改操作
    public function ncms_model_updateOp(){
        $obj_validate = new Validate();
        $validate_array = array(
            array('input'=>$_POST['name'],'require'=>'true',"validator"=>"Length","min"=>"1","max"=>"10",'message'=>Language::get('ncms_model_error')),
            array('input'=>$_POST['tablename'],'require'=>'english','message'=>Language::get('ncms_model_table_error')),
        );
        $obj_validate->validateparam = $validate_array;
        $error = $obj_validate->validate();
        if ($error != ''){
            showMessage(Language::get('error').$error,'','','error');
        }
        $modelid = intval($_POST['modelid']);
        $param = array();
        $param['name'] = trim($_POST['name']);
        $param['tablename'] = trim($_POST['tablename']);
        $param['description'] = trim($_POST['description']);
   
        $ncms_model = Model('ncms_model');
        $result = $ncms_model->editModel($param,$modelid);
        if($result) {
            $this->log(Language::get('cms_log_ncms_model_update').$result, 1);
            showMessage(Language::get('ncms_model_success'),'index.php?con=ncms_model&fun=cncms_model_list');
        } else {
            $this->log(Language::get('cms_log_ncms_model_update').$result, 0);
            showMessage(Language::get('ncms_model_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
        }
    }

     /**
     * 删除表
     * $table 不带表前缀
     */
    public function deleteTable($table) {
        if ($this->table_exists($table)) {
            $this->drop_table($table);
        }
        return true;
    }

    /**
    *删除模型
    */
    public function ncms_model_dropOp(){

        $modelid = trim($_REQUEST['modelid']);
          //检查该模型是否已经被使用
        // $count = Model("ncms_category")->where(array("modelid" => $modelid))->count();
        // if ($count) {
        //      showMessage('该模型已经在使用中，请删除栏目后再进行删除！','','','error');
        // }
 
        $ncms_model = Model('ncms_model');
        $result = $ncms_model->deleteModel($modelid);
        if($result) {
            $this->log(Language::get('cms_log_ncms_model_drop').$_REQUEST['modelid'], 1);
            showMessage(Language::get('ncms_model_drop_success'),'');
        } else {
            $this->log(Language::get('cms_log_ncms_model_drop').$_REQUEST['modelid'], 0);
            showMessage(Language::get('ncms_model_drop_fail'),'','','error');
        }

      

    
    }
    //模型导入视图
    public function  ncms_model_importOp() {
        Tpl::setDirquna('cms');
        Tpl::showpage('ncms_model.import');

    }
      //模型导入操作
    public function ncms_model_runimportOp() {
            
            if (empty($_FILES['file'])) {
                showMessage(Language::get('ncms_model_import_fail_select'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            }
            $filename = $_FILES['file']['tmp_name'];
            if (strtolower(substr($_FILES['file']['name'], -3, 3)) != 'txt') {
                 showMessage(Language::get('ncms_model_import_fail_type'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            }
            //读取文件
            $data = file_get_contents($filename);
            
            //删除
            @unlink($filename);
            //模型名称
            $name = trim($_POST['name']);
            //模型表键名
            $tablename = trim($_POST['tablename']);
            //导入
            $status = Model('ncms_model')->import($data, $tablename, $name);
            if ($status) {
                 showMessage(Language::get('ncms_model_import_success'),'index.php?con=ncms_model&fun=ncms_model_list','','succ');
            } else {
                showMessage(Language::get('ncms_model_import_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');

            }
       
    }

   //模型导出
    public function ncms_model_exportOp() {
        //需要导出的模型ID
        $modelid = intval($_GET['modelid']);
        if (empty($modelid)) {
            showMessage(Language::get('ncms_model_zd_export_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            
        }

        //导出模型
        $status = Model('ncms_model')->export($modelid);
        if ($status) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=s_ncms_model_" . $modelid . '.txt');
            echo $status;
            $this->log(Language::get('cms_log_ncms_model_import').$_REQUEST['modelid'], 0);
        } else {
            $this->error('模型导出失败！');
        }
    }

 
       /**
     * ajax操作
     */
    public function ajaxOp(){
        if (intval($_GET['id']) < 1) {
            exit('false');
        }

        switch ($_GET['column']) {
            case 'disabled':
           
                break;

            default:
                exit('false');
        }

        $model= Model('ncms_model');
        $update[$_GET['column']] = trim($_GET['value']);
        $condition['modelid'] = intval($_GET['id']);
        $model->where($condition)->update($update);
       

        echo 'true';die;
    }

    private function show_menu($menu_key) {
        $menu_array = array(
            'list'=>array('menu_type'=>'link','menu_name'=>Language::get('nc_list'),'menu_url'=>'index.php?con=ncms_model&fun=ncms_model_list'),
            'add'=>array('menu_type'=>'link','menu_name'=>Language::get('nc_new'),'menu_url'=>'index.php?con=ncms_model&fun=ncms_model_add'),
        );
        $menu_array[$menu_key]['menu_type'] = 'text';
        Tpl::output('menu',$menu_array);
    }



}
