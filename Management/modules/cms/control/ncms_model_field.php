<?php
/**
 * ncms 模型
 *
 *
 *
 ** 
 */
defined('TTShop') or exit('Access Invalid!');
class ncms_model_fieldControl extends SystemControl{
    private $modelfield, $fields;
    public function __construct(){
        parent::__construct();
        Language::read('cms');
        $this->fields = BASE_PATH .'/modules/'.MODULE_NAME .'/Fields/';
    }
    //模型列表
    public function indexOp(){
        $modelid = intval($_GET['modelid']);
        Tpl::output('modelid',$modelid);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_model_field.list");
    }
    //模型添加
    public function ncms_model_field_addOp(){
        $modelid = intval($_GET['modelid']);
        $ncms_model_field = Model('ncms_model_field');
        $ncms_list = $ncms_model_field->getFieldTypeList();
       
          //字段类型过滤
        foreach ($ncms_list as $formtype => $name) {
            if (!$ncms_model_field->isAddField($formtype, $formtype, $modelid)) {
                continue;
            }
            $all_field[$formtype] = $name;
        }

        //不允许删除的字段，这些字段讲不会在字段添加处显示
       Tpl::output("not_allow_fields", $ncms_model_field->not_allow_fields);
        //允许添加但必须唯一的字段
        Tpl::output("unique_fields", $ncms_model_field->unique_fields);
        //禁止被禁用的字段列表
        Tpl::output("forbid_fields", $ncms_model_field->forbid_fields);
        //禁止被删除的字段列表
        Tpl::output("forbid_delete", $ncms_model_field->forbid_delete);
        //可以追加 JS和CSS 的字段
        Tpl::output("att_css_js", $ncms_model_field->att_css_js);
        //可使用字段类型
        Tpl::output("all_field", $all_field);
        //模型数据
        Tpl::output("modelinfo", Model("ncms_model")->where(array("modelid" => $modelid))->find());
        Tpl::output("modelid", $modelid);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_model_field.add");
    }

    //模型列表
    public function ncms_model_field_editOp(){
        $modelid = intval($_GET['modelid']);
        $fieldid = intval($_GET['fieldid']);
         if (empty($modelid)) {
            showMessage('模型ID不能为空！','','','error');
        }

     //模型信息
        $modedata = Model("ncms_model")->where(array("modelid" => $modelid))->find();
        
        if (empty($modedata)) {
            showMessage('该模型不存在！','','','error');
        }
        $modelfield = Model('ncms_model_field');
        //字段信息
        $fieldData = $modelfield->where(array("fieldid" => $fieldid, "modelid" => $modelid))->find();


        if (empty($fieldData)) {
            showMessage('该字段信息不存在！','','','error');
        }
        //字段路径
        $fiepath = $this->fields . "{$fieldData['formtype']}/";
        //======获取字段类型的表单编辑界面===========
        //字段扩展配置
        $setting = unserialize($fieldData['setting']);
        //打开缓冲区
        ob_start();
        @include $fiepath . 'field_edit_form.inc.php';
        $form_data = ob_get_contents();
        //关闭缓冲
        ob_end_clean();
        //======获取字段类型的表单编辑界面===END====
        //字段类型过滤
        $all_field = array();
        foreach ($modelfield->getFieldTypeList() as $formtype => $name) {
            if (!$modelfield->isEditField($formtype)) {
                continue;
            }
            $all_field[$formtype] = $name;
        }
        //不允许删除的字段，这些字段讲不会在字段添加处显示
        Tpl::output("not_allow_fields", $modelfield->not_allow_fields);
        //允许添加但必须唯一的字段
        Tpl::output("unique_fields", $modelfield->unique_fields);
        //禁止被禁用的字段列表
        Tpl::output("forbid_fields", $modelfield->forbid_fields);
        //禁止被删除的字段列表
        Tpl::output("forbid_delete", $modelfield->forbid_delete);
        //可以追加 JS和CSS 的字段
        Tpl::output("att_css_js", $modelfield->att_css_js);
        //允许使用的字段类型
        Tpl::output("all_field", $all_field);
        //当前字段是否允许编辑
        Tpl::output('isEditField', $modelfield->isEditField($fieldData['field']));

        //附加属性
        Tpl::output("form_data", $form_data);
        Tpl::output("modelid", $modelid);
        Tpl::output("fieldid", $fieldid);
        Tpl::output("setting", $setting);
                // p($setting);

        //字段信息分配到模板
        Tpl::output("data", $fieldData);
        Tpl::output("modelinfo", $modedata);

        Tpl::output('modelid',$modelid);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_model_field.edit");
    }

    //获取模型列表数据
    public function ncms_model_field_list_xmlOp(){

        $modelid = intval($_POST['query']);
        if (!$modelid) {
            showMessage(Language::get('param_error'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
        }
        $ncms_model =  Model("ncms_model");
        $ncms_model_data =$ncms_model->where(array("modelid" => $modelid))->select();
        if (empty($ncms_model_data)) {
            showMessage(Language::get('ncms_model_failexit'),'index.php?con=ncms_model&fun=ncms_model_list','','error');

        }
     
       $ncms_model_field = Model('ncms_model_field');
       $condition['modelid'] = $modelid;
        //根据模型读取字段列表
       
        $page = $_POST['rp'];
        $list = $ncms_model_field->getNcmsModelFieldList($condition,'*',$page,'listorder asc');
      
         //不允许删除的字段，这些字段讲不会在字段添加处显示
        $not_allow_fields = $ncms_model_field->not_allow_fields;
        //允许添加但必须唯一的字段
        $unique_fields = $ncms_model_field->unique_fields;
        //禁止被禁用的字段列表
        $forbid_fields =  $ncms_model_field->forbid_fields;
        //禁止被删除的字段列表
        $forbid_delete =  $ncms_model_field->forbid_delete;

       
        $data = array();
        $data['now_page'] = $ncms_model_field->shownowpage();
        $data['total_num'] = $ncms_model_field->gettotalnum();

        foreach ($list as $val) {
            $o = '<a class="btn red" href="javascript:;" data-j="edit"><i class="fa fa-edit"></i>修改</a>';
            if(in_array($val['field'],$forbid_fields)){
                $o .= '<a class="btn" href="javascript:;" style="background:#bbb;color:#fff;" ><i class="fa  fa-file-o"></i>隐藏</a>';
            }else{
                if($val['disabled'] == 0){
                     $o .= '<a class="btn red" href="javascript:;" data-j="disabled" data-val="1"><i class="fa  fa-file-o"></i>隐藏</a>';
                }else{
                     $o .= '<a class="btn red" href="javascript:;" data-j="disabled" data-val="0" style="background:#e44d4d;color:#fff"><i class="fa  fa-file-o"></i>显示</a>';
                }
            }
            if(in_array($val['field'],$forbid_delete)){
                 $o .= '<a class="btn" href="javascript:;" style="background:#bbb;color:#fff;" ><i class="fa  fa-file-o"></i>删除</a>';
            }else{
                $o .= '<a class="btn red" href="javascript:;" data-j="drop"><i class="fa fa-trash-o"></i>删除</a>';
            }
            $i = array();
            $i['operation'] = $o;
            $i['field'] = $val['field'];
            $i['name'] = $val['name'];
            $i['formtype'] = $val['formtype'];
            $v = "<span style='display: inline-block;' title='可编辑' ajax_branch='article_class_sort' datatype='number' fieldid='{$val['fieldid']}' fieldname='listorder' nc_type='inline_edit' class='editable'>{$val['listorder']}</span>";
            $i['listorder'] = $v;
            $i['issystem'] = $val['issystem'] == 1?'<span class="yes"><i class="fa fa-check-circle"></i>开启</span>'
                : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
            $i['minlength'] = $val['minlength'] == 1?'<span class="yes"><i class="fa fa-check-circle"></i>开启</span>'
                : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
       
            $i['isorder'] = $val['isorder'] == 1?'<span class="yes"><i class="fa fa-check-circle"></i>开启</span>'
                : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
            $i['isadd'] = $val['isadd'] == 1?'<span class="yes"><i class="fa fa-check-circle"></i>开启</span>'
                : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
            $data['list'][$val['fieldid']] = $i;
        }
        echo Tpl::flexigridXML($data);
        exit;
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
            case 'listorder':
                break;

            default:
                exit('false');
        }

        $model= Model('ncms_model_field');
        $update[$_GET['column']] = trim($_GET['value']);
        $condition['fieldid'] = intval($_GET['id']);
        $model->where($condition)->update($update);
        echo 'true';die;
    }

    /**
    *删除模型
    */
    public function ncms_model_field_dropOp(){
        $fieldid = trim($_REQUEST['field']);
        $ncms_model_field = Model('ncms_model_field');
          //字段ID
      
        if (empty($fieldid)) {
            showMessage('字段ID不能为空！','','','error');
        }
        $result =$ncms_model_field->deleteField($fieldid);
        if($result) {
            $this->log('字段删除失败,字段id'.$fieldid, 1);
            showMessage('字段删除成功！','');
        } else {
            $this->log('字段删除失败,字段id'.$fieldid, 0);
            showMessage('字段删除失败！','','','error');

        }
    }

   //字段属性配置
    public function public_field_settingOp() {
        //字段类型
        $fieldtype = $_REQUEST['fieldtype'];

        $fiepath = $this->fields . $fieldtype . '/';
        //载入对应字段配置文件 config.inc.php 
        include $fiepath . 'config.inc.php';
        ob_start();
        include $fiepath . "field_add_form.inc.php";
        $data_setting = ob_get_contents();
        ob_end_clean();
        $settings = array('field_basic_table' => $field_basic_table, 'field_minlength' => $field_minlength, 'field_maxlength' => $field_maxlength, 'field_allow_search' => $field_allow_search, 'field_allow_fulltext' => $field_allow_fulltext, 'field_allow_isunique' => $field_allow_isunique, 'setting' => $data_setting);
        echo json_encode($settings);
        return true;
    }
    //字段属性保存
    public function ncms_model_field_saveOp(){
            $modelfield = Model('ncms_model_field');
            $post = $_POST;
            $modelid = intval($_POST['modelid']);
            if (empty($post)) {
                showMessage('数据不能为空！','','','error');
            }
            if ($modelfield->addField($post)) {
                $this->log('字段添加成功,字段id'.$modelid, 0);
                showMessage('添加成功！');
            } else {
                $this->log('字段删除失败,字段id'.$modelid, 0);
                showMessage('删除失败！','','','error');
            }
    }

   //字段属性更新
    public function ncms_model_field_updateOp(){
            $modelfield = Model('ncms_model_field');
            $post = $_POST;
            $modelid = intval($_POST['modelid']);
            
            if (empty($post)) {
                showMessage('数据不能为空！','','','error');
            }
            if ($modelfield->editField($post,$fieldid)) {
                $this->log('字段更新成功,字段id'.$modelid, 0);
                showMessage('更新成功！');
            } else {
                $this->log('字段更新失败,字段id'.$modelid, 0);
                showMessage('更新失败！','','','error');
            }

    }

   


   //模型预览
    public function ncms_model_field_previewOp() {
        //模型ID
        $modelid = intval($_GET['modelid']);
        if (empty($modelid)) {
            showMessage('请指定模型！','','','error');
        }
        include './Fields/content_form.class.php';
     
        $content_form = new content_form($modelid);
        //生成对应字段的输入表单
        $forminfos = $content_form->get();

        //生成对应的JS验证规则
        $formValidateRules = $content_form->formValidateRules;
        //js验证不通过提示语
        $formValidateMessages = $content_form->formValidateMessages;
        //js
        $formJavascript = $content_form->formJavascript;
        // p($forminfos);
        // //获取当前模型信息
        // $r = M("Model")->where(array("modelid" => $modelid))->find();
        // $this->assign("r", $r);
        Tpl::output("forminfos", $forminfos);
        // $this->assign("formValidateRules", $formValidateRules);
        // $this->assign("formValidateMessages", $formValidateMessages);
        // $this->assign("formJavascript", $formJavascript);
        Tpl::output('modelid',$modelid);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_model_field.priview");
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
