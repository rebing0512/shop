<?php
/**
 * ncms 模型
 *
 *
 *
 ** 
 */



defined('TTShop') or exit('Access Invalid!');
class ncms_categoryControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('cms');
    }
    //模型列表
    public function indexOp(){
        $ncms_category =  Model("ncms_category");
        $ncms_category_data=$ncms_category->field('catid,parentid')->order('catid ASC')->limit(100)->select();
        $modelst = array();
        $models = Model('ncms_model')->select();
         foreach ($models as &$value) {
            $modelst[$value['modelid']] = $value;
         }

         if (!empty($ncms_category_data)) {

            foreach ($ncms_category_data as $r) {
                $r = getCategory($r['catid']);
                $r['modelname'] = $modelst[$r['modelid']]['name'];

                $r['str_manage'] = '';
                $r['str_manage'] .= '<a class="btn red" href="javascript:;" data-j="add"><i class="fa fa-plus"></i>添加子栏目</a>';
                $r['str_manage'] .= '<a class="btn red" href="javascript:;" data-j="edit"><i class="fa fa-edit"></i>修改</a> <a class="btn red" href="javascript:;" data-j="drop"><i class="fa fa-trash-o" ></i>刪除</a>';
                

                $r['help'] = '';
                $setting = $r['setting'];
                if ($r['url']) {
                    
                    $r['url'] = "<a href='" . $r['url'] . "' target='_blank'>访问</a>";
                } 
                $categorys[$r['catid']] = $r;
            }
        }

           $str = "<tr data-id=\$id>
    <td class='handle' >\$str_manage</td>
    <td align='center'><font color='\$yesadd'>\$id</font></td>
    <td align='center'><span style='display: inline-block;' title='可编辑' ajax_branch='article_class_sort' datatype='number' column_id='\$id' fieldname='listorder' nc_type='inline_edit' class='editable'>\$listorder</span></td>
    <td >\$spacer\$catname\$display_icon</td>
    <td>\$modelname</td>
    <td align='center'>\$url</td>
    <td align='center'>\$help</td>
    </tr>";

        if (!empty($categorys) && is_array($categorys)) {
             include './class/Tree.class.php';
             $tree = new Tree();
            $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
            $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
            $tree->init($categorys);
            $categorydata = $tree->get_tree(0, $str);
        } else {
            $categorydata = '';
        }
       
        Tpl::output('categorydata',$categorydata);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_category.list");
    }
   
   //分类添加
    public function ncms_category_addOp(){
         $parentid = $_GET['parentid'] ? intval($_GET['parentid']):0;

            if (!empty($parentid)) {
                $Ca = getCategory($parentid);

                if (empty($Ca)) {
                     showMessage('父栏目不存在！','','','error');
                }
                if ($Ca['child'] == '0') {
                    showMessage('终极栏目不能添加子栏目！','','','error');
                }
            }

            //输出可用模型
            $modelsdata = Model()->table('ncms_model')->select();

            $models = array();
            foreach ($modelsdata as $v) {
                if ($v['disabled'] == 0 && $v['type'] == 0) {
                    $models[] = $v;
                }
            }

            //栏目列表 可以用缓存的方式
            $arrays= Model()->table('ncms_category')->field('catid,parentid')->select();
            $array = array();
            foreach($arrays as &$v){
                $array[$v['catid']] = $v;
             
            }

            foreach ($array as $k => $v) {

                $array[$v['catid']] = getCategory($v['catid']);
                if ($v['child'] == '0') {
                    $array[$k]['disabled'] = "disabled";
                } else {
                    $array[$k]['disabled'] = "";
                }
            }
                include './class/Tree.class.php';
                $tree = new Tree();
              
              if (!empty($array) && is_array($array)) {
                $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
                $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
                $str = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
                $tree->init($array);
                
                $categorydata = $tree->get_tree(0, $str, $parentid);
            } else {
                $categorydata = '';
            }

       
            Tpl::output('parentid_modelid', $Ca['modelid']);
            Tpl::output("category", $categorydata);
            Tpl::output("models", $models);


          
         
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_category.add");
    }

    public function ncms_category_editOp(){
         $catid = intval($_GET['catid']);

           $arrays= Model()->table('ncms_category')->field('catid,parentid')->select();
            $array = array();
            foreach($arrays as &$v){
                $array[$v['catid']] = $v;
             
            }
            foreach ($array as $k => $v) {
                $array[$k] = getCategory($v['catid']);
                if ($v['child'] == "0") {
                    $array[$k]['disabled'] = "disabled";
                } else {
                    $array[$k]['disabled'] = "";
                }
            }


            $data = getCategory($catid);
            $setting = $data['setting'];
            //输出可用模型
            $modelsdata = Model('ncms_model')->select();

            $models = array();
            foreach ($modelsdata as $v) {
                if ($v['disabled'] == 0 && $v['type'] == 0) {
                    $models[] = $v;
                }
            }
            include './class/Tree.class.php';
            $tree = new Tree();
            if (!empty($array) && is_array($array)) {
                $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
                $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
                 $str = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
                $tree->init($array);
                
                $categorydata = $tree->get_tree(0, $str, $data['parentid']);
            } else {
                $categorydata = '';
            }
           // p($data);die;
            Tpl::output('categorydata',$categorydata);
            Tpl::output('catid',$catid);
            Tpl::output("category", $categorydata);
            Tpl::output("models", $models);
            Tpl::output("data", $data);
           
           
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_category.edit");
    }
    //保存分类添加
    public function ncms_category_saveOp(){
  
             $Category = Model('ncms_category');

            //批量添加
            $isbatch = $_POST['isbatch'] ? intval($_POST['isbatch']):0;
                     //上传网站Logo

            if (!empty($_FILES['image']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTICLE_LOGO);
                $result = $upload->upfile('image');
                if ($result){
                    $_POST['image'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }

            if ($isbatch) {
                $post = $_POST;
                unset($post['isbatch'], $post['info']['catname'], $post['info']['catdir']);
                //需要批量添加的栏目
                $batch_add = explode("\n", $_POST['batch_add']);
                if (empty($batch_add) || empty($_POST['batch_add'])) {
                    showMessage('请填写需要添加的栏目！','','','error');

                }
                foreach ($batch_add as $rs) {
                    $cat = explode('|', $rs, 2);
                    if ($cat[0] && $cat[1]) {
                        $post['info']['catname'] = $cat[0];
                        $post['info']['catdir'] = $cat[1];
                        $catid = $Category->addCategory($post);
                     
                    }
                }
                showMessage('添加成功！','','');
      
            } else {
                $catid = $Category->addCategory($_POST);
                if ($catid) {
                   showMessage('添加成功！','','');
                    $this->success("添加成功！", U("Category/index"));
                } else {
                   showMessage('栏目添加失败！','','');
                }
            }
    }

    //分类编辑保存
    public function  ncms_category_updateOp(){
                 // p($_POST);die;
         $catid = intval($_POST['catid']);
           if (!empty($_FILES['image']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTICLE_LOGO);
                $result = $upload->upfile('image');
                if ($result){
                    $_POST['image'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }else{
                 $_POST['image'] = $_POST['yimg'];
            }


            if (empty($catid)) {
                showMessage('请选择需要修改的栏目！','','','error');
            }
            $ncms_category = Model('ncms_category');
            $status = $ncms_category->editCategory($_POST,$catid);
            if ($status) {
                showMessage('更新成功！','','');
            } else {
                showMessage('栏目修改失败！','','','error');
            }
    }
    //删除栏目 
    public function ncms_category_dropOp() {
        $catid = intval($_GET['catid']);
        if (!$catid) {
            showMessage('请指定需要删除的栏目！','','','error');
        }
        if (false == Model('ncms_category')->deleteCatid($catid)) {
            showMessage('栏目删除失败，错误原因可能是栏目下存在信息，无法删除！','','','error');
            
        }
        showMessage('栏目删除成功！','','');

    }

       /**
     * ajax操作  
     */
    public function ajaxOp(){
        if (intval($_GET['id']) < 1) {
            exit('false');
        }
       
        $model= Model('ncms_category');
        $update[$_GET['branch']] = trim($_GET['value']);

        $condition['catid'] = intval($_GET['id']);
        $up = $model->where($condition)->update($update);
        if($up){
           echo json_encode(array('result'=>1));
        }else{
          echo json_encode(array('result'=>0));
        }
       
    }



}
