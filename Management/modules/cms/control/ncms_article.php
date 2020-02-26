<?php
/**
 * cms文章分类
 *
 *
 *
 ** 
 */
defined('TTShop') or exit('Access Invalid!');
class ncms_articleControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('cms');
    }

    
    //文章列表页
    public function indexOp() {
        $json = array();
        $categorys =Model()->table('ncms_category')->field('catid,parentid,catname')->limit(100)->select();
        foreach ($categorys as $rs) {
            $rs = getCategory($rs['catid']);
       
            $data = array(
                'catid' => $rs['catid'],
                'parentid' => $rs['parentid'],
                'catname' => $rs['catname'],
            
            );
            //终极栏目
            if ($rs['child'] == 0) {
                $data['target'] = 'right';
                $data['url'] = "index.php?con=ncms_article&fun=classlist&catid=".$rs['catid'];
                //设置图标 
                $data['icon'] = 'statics/js/zTree/zTreeStyle/img/diy/10.png';
            } else {
                $data['isParent'] = true;
            }
            
            $json[] = $data;
        }
     
        Tpl::output('json', json_encode($json));
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_article.list");
    }

  

    //栏目信息列表
    public function classlistOp() {

        $catid = intval($_GET['catid']);
        //当前栏目信息
        $catInfo = getCategory($catid);
        if (empty($catInfo)) {
            showMessage('该栏目不存在！','','','error');
        }
         import('function.statistics');
        import('function.datehelper');
        $model = Model('stat');
        //存储参数
        $this->search_arr = $_REQUEST;
       
      
        $this->search_arr = $model->dealwithSearchTime($this->search_arr);
        //获得系统年份
        $year_arr = getSystemYearArr();
        //获得系统月份
        $month_arr = getSystemMonthArr();
        //获得本月的周时间段
        $week_arr = getMonthWeekArr($this->search_arr['week']['current_year'], $this->search_arr['week']['current_month']);
        Tpl::output('year_arr', $year_arr);
        Tpl::output('month_arr', $month_arr);
        Tpl::output('week_arr', $week_arr);
        Tpl::output('search_arr', $this->search_arr);
        Tpl::output('catid', $catid);
        Tpl::setDirquna('cms');
        Tpl::showpage("ncms_article.classlist");
       //  //查询条件
       //  $where = array();
       //  $where['catid'] = array('EQ', $catid);
       //  $where['status'] = array('EQ', 99);
       //  //栏目所属模型
       //  $modelid = $catInfo['modelid'];
       //  //栏目扩展配置
       //  $setting = $catInfo['setting'];
         
       //  //检查模型是否被禁用
       //  $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
     
       //  if ($disabled['disabled']) {
       //      showMessage('模型被禁用！','','','error');
       //  }
             
       //  //实例化模型
       //  $model = Model('ncms_'.$disabled['tablename']);
      
       //  //数量统计
       //  $sum = $model->where($where)->count();
       
       //  $checkSum = $model->where(array_merge($where, array('status' => 1)))->count();
       // Tpl::output('sum',$sum);
       // Tpl::output('checkSum',$checkSum);
       
      

       //  //信息总数
  
       //  $count = $sum;
     
       //  $page = $this->page($count, 20);
       //  $data = $model->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("id" => "DESC"))->select();

       //  //模板处理
       //  $template = '';
       //  //自定义列表
       //  if (!empty($setting['list_customtemplate'])) {
       //      $template = "Listtemplate:{$setting['list_customtemplate']}";
       //  }
       //  Tpl::output($catInfo)
       //      ->assign('Page', $page->show())
       //      ->assign('catid', $this->catid)
       //      ->assign('count', $count)
       //      ->assign('data', $data);
       //  $this->display($template);
    }


    //获取栏目信息列表
    public function ncms_article_list_xmlOp(){
        $catid = intval($_GET['catid']);
        //当前栏目信息
        $catInfo = getCategory($catid);
        if (empty($catInfo)) {
            showMessage('该栏目不存在！','','','error');
        }
        $catidlist =  Model()->table('ncms_category')->where(array('parentid' => $catid))->field('catid')->select();
        $catidliststr = array();
        foreach ($catidlist as &$val) {
            $catidliststr[] = $val['catid'];
        }
        $catidliststr[] = $catid;
        
        //查询条件
        $where = array();
        $where['catid'] =array('IN',$catidliststr);
        $where['status'] = 1;
        //栏目所属模型
        $modelid = $catInfo['modelid'];
        //栏目扩展配置
        $setting = $catInfo['setting'];
         
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
    
     
        if ($disabled['disabled']) {
            showMessage('模型被禁用！','','','error');
        }
   
        //实例化模型
        $model = Model('ncms_'.$disabled['tablename']);
      
        //数量统计
        $sum = $model->where($where)->count();
       
        $checkSum = $model->where(array_merge($where, array('status' => 1)))->count();

        $page = $_POST['rp'];

        $list =  (array)Model()->table('ncms_'.$disabled['tablename'])->where($where)->page($page)->select();

        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();

        foreach ($list as $val) {
            $o = "<a class='btn red' href='javascript:;' data-j='drop' data-catid='{$val['catid']}'><i class='fa fa-trash-o'></i>删除</a>";
            $o .= "<a class='btn red' href='javascript:;' data-j='edit' data-catid='{$val['catid']}'><i class='fa fa-edit'></i>修改</a>";
            // $o .= '<a class="btn red" href="javascript:;" data-j="pl"><i class="fa fa-comments-o"></i>评论</a>';
          
            $i = array();
            $i['operation'] = $o;
            $i['id'] = $val['id'];
            $i['title'] = $val['title'];
            $i['views'] = $val['views'];
            $i['username'] = $val['username'];
            $i['updatetime'] = date('Y-m-d H:i:s',$val['updatetime']);
            $i['inputtime'] = date('Y-m-d H:i:s',$val['inputtime']);
            $v = "<span style='display: inline-block;' title='可编辑' ajax_branch='article_class_sort' datatype='number' fieldid='{$val['id']}' fieldcateid='{$val['catid']}' fieldname='listorder' nc_type='inline_edit' class='editable'>{$val['listorder']}</span>";
            $i['listorder'] = $v;
            $i['status'] = $val['status'] ==  '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $data['list'][$val['id']] = $i;
        }

        echo Tpl::flexigridXML($data);
        exit;
    }

      /**
     * ajax操作
     */
    public function ajaxOp(){
        $catid = intval($_GET['catid']);
        $id = intval($_GET['id']);
        //取得对应模型
        $category = getCategory($catid);
        if (empty($category)) {
            exit('false');
        }
        //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        $ncms_model_name =  'ncms_'.$disabled['tablename'];
        if ($disabled['disabled']) {
           exit('false');
        }
        switch ($_GET['column']) {
          
            case 'listorder':
                break;

            default:
                exit('false');
        }

        $model= Model();
        $update[$_GET['column']] = trim($_GET['value']);
        $condition['fieldid'] = intval($_GET['id']);
        $model->table($ncms_model_name)->where($condition)->update($update);
        echo 'true';die;
    }

    //添加文章
    public function ncms_article_addOp(){
            $catid = intval($_GET['catid']);
  
            //取得对应模型
            $category = getCategory($catid);
            if (empty($category)) {
               showMessage('该栏目不存在！','','','error');
            }
            //判断是否终极栏目
            // if ($category['child']) {
            //   showMessage('只有终极栏目可以发布文章！','','','error');
            //     $this->error('只有终极栏目可以发布文章！');
            // }
            
            //模型ID
            $modelid = $category['modelid'];
            //检查模型是否被禁用
            $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
            
            if ($disabled['disabled']) {
                showMessage('模型被禁用！','','','error');
            }
            include './Fields/content_form.class.php';
            //实例化表单类 传入 模型ID 栏目ID 栏目数组
            $content_form = new content_form($modelid, $catid);
            // p($content_form);die;
            //生成对应字段的输入表单
            $forminfos = $content_form->get();

            //生成对应的JS验证规则
            $formValidateRules = $content_form->formValidateRules;
            //js验证不通过提示语
            $formValidateMessages = $content_form->formValidateMessages;
            //js
            $formJavascript = $content_form->formJavascript;
            //取得当前栏目setting配置信息
            $setting = $category['setting'];
                     // p($formJavascript);die;
            Tpl::output("catid", $this->catid);
            Tpl::output("content_form", $content_form);
            Tpl::output("forminfos", $forminfos);
            Tpl::output("formValidateRules", $formValidateRules);
            Tpl::output("formValidateMessages", $formValidateMessages);
            Tpl::output("formJavascript", $formJavascript);
            Tpl::output("setting", $setting);
            Tpl::output("category", $category);

            Tpl::setDirquna('cms');
            Tpl::showpage("ncms_article.add");
           
    }

    //编辑文章
    public function ncms_article_editOp(){
            $catid = intval($_GET['catid']);
            $id = intval($_GET['id']);
            //取得对应模型
            $category = getCategory($catid);

            if (empty($category)) {
               showMessage('该栏目不存在！','','','error');
            }
            //判断是否终极栏目
            // if ($category['child']) {
            //   showMessage('只有终极栏目可以发布文章！','','','error');
            //     $this->error('只有终极栏目可以发布文章！');
            // }
            
            //模型ID
            $modelid = $category['modelid'];
            //检查模型是否被禁用
            $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        
            $ncms_model_name =  'ncms_'.$disabled['tablename'];
            $ncms_model_data_name =  'ncms_'.$disabled['tablename'].'_data';
            if ($disabled['disabled']) {
                showMessage('模型被禁用！','','','error');
            }
            $data = Model()->table("{$ncms_model_name},{$ncms_model_data_name}")->where("{$ncms_model_data_name}.id = {$ncms_model_name}.id and {$ncms_model_name}.id = {$id}")->find();
           
            if (!$data) {
                showMessage('编辑文章出错！','','','error');
            }
            include './Fields/content_form.class.php';
            //实例化表单类 传入 模型ID 栏目ID 栏目数组
            $content_form = new content_form($modelid, $catid);

            //生成对应字段的输入表单
            $forminfos = $content_form->get($data);
            //生成对应的JS验证规则
            $formValidateRules = $content_form->formValidateRules;
            //js验证不通过提示语
            $formValidateMessages = $content_form->formValidateMessages;
            //js
            $formJavascript = $content_form->formJavascript;
            //取得当前栏目setting配置信息
            $setting = $category['setting'];
            // $model->relation(true)->where(array("id" => $id))->find();
   
            Tpl::output("catid", $catid);
            Tpl::output("id", $id);
            Tpl::output("content_form", $content_form);
            Tpl::output("forminfos", $forminfos);
            Tpl::output("formValidateRules", $formValidateRules);
            Tpl::output("formValidateMessages", $formValidateMessages);
            Tpl::output("formJavascript", $formJavascript);
            Tpl::output("setting", $setting);
            Tpl::output("category", $category);
            Tpl::output("data", $data);
            Tpl::setDirquna('cms');
            Tpl::showpage("ncms_article.edit");
           
    }
   //保存文章
    public function ncms_article_saveOp(){
    
          $file = $_FILES;
          $filestr = '';
          foreach ($file as &$valt) {
               $filestr .=$valt['tmp_name'];
          }
        if($filestr){
                $upload     = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTICLE);
                foreach($file as $key=>$vt){
               
                  if($key ==='thumb' && $_FILES['thumb']['name']){
                    //生成两张缩略图，宽高分别为30,300 
                    $upload->set('thumb_width',  '140'); 
                    $upload->set('thumb_height', '90'); 
                    //缩略图名称后面分别追加 "_tiny","_mid" 
                    $upload->set('thumb_ext', '_thumb','_min'); 
                    //开始上传
                    $result = $upload->upfile('thumb');
                    if ($result){
                    //得到图片上传后的路径 
                    /* 获取缩略图：*/$img_path_thumb = $upload->getSysSetPath().$upload->thumb_image; 
                    /*获取原图：*/ $img_path = $upload->getSysSetPath().$upload->file_name; 
                    }
                    $_POST['thumb'] = $img_path;
                    $_POST['sthumb'] = $img_path_thumb;
                  
              }elseif($_FILES[$key]['name']){
                  $result = $upload->upfile($key);
                  if (!$result){
                      showMessage($upload->error,'','','error');
                  }
                  $_POST[$key] = $upload->file_name;
              }
            }

          }
          
      
          //栏目ID
          $catid = intval($_POST['info']['catid']);
          if (empty($catid)) {
             showMessage('请指定栏目ID！','','','error');
          }
          if (trim($_POST['info']['title']) == '') {
             showMessage('标题不能为空！','','','error');
          }
          //获取当前栏目配置
          $category = getCategory($catid);
       
          //模型ID
          $modelid = getCategory($catid, 'modelid');
          $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
          
          //检查模型是否被禁用
          if ($disabled['disabled'] == 1) {
              showMessage('模型被禁用！','','','error');
          }

          foreach($_POST as $key=>&$vs){
            if($key !='info'){
               $data[$key] = $vs;
            }else{
              foreach($_POST['info'] as $k=>&$vt){
                $data[$k] = $vt;
              }
            }
          }
          $status = $this->addcontent($data);
          if ($status) {
             showMessage('添加成功！','','');
          } else {
              
               showMessage('添加失败！','','','error');

          }
      

    }
    //添加文章
    public function addcontent($data){

       if (empty($data)) {
            if (!empty($data)) {
                // 重置数据
                $data = array();
            } else {
               showMessage('参数错误！','','','error');
               return false;
            }
        }
        $catid = (int)$data['catid'];
        $modelid = getCategory($catid, 'modelid');
        $ncms_model = Model('ncms_model')->where(array('modelid'=>$modelid))->find();
        $ncms_model_name =  'ncms_'.$ncms_model['tablename'];
        $ncms_model_data_name =  'ncms_'.$ncms_model['tablename'].'_data';

      
        //栏目数据
        $catidinfo = getCategory($data['catid']);

        if (empty($catidinfo)) {
            showMessage('获取不到栏目数据！','','','error');
            return false;
        }
        //setting配置
        $catidsetting = $catidinfo['setting'];
   
        $datas['status'] = 1;
        //添加用户名
        $admin_info = $this->getAdminInfo();
        $datas['username'] = $admin_info['name'];
        $datas['sysadd'] = 0;
         

        //检查真实发表时间，如果有时间转换为时间戳
        if ($data['inputtime'] && !is_numeric($data['inputtime'])) {
            $datas['inputtime'] = strtotime($data['inputtime']);

        } elseif (!$data['inputtime']) {
            $datas['inputtime'] = time();
        }
        //更新时间处理
        if ($data['updatetime'] && !is_numeric($data['updatetime'])) {
            $datas['updatetime'] = strtotime($data['updatetime']);
        } elseif (!$data['updatetime']) {
            $datas['updatetime'] = time();
        }
        $datas['catid'] = $data['catid'];
        $datas['title'] = $data['title'];
        if($data['style_color'] || $data['style_font_weight']){
           $datas['style'] = "color:{$data['style_color']};font-weight:{$data['style_font_weight']};";
          
        }
        unset($data['style_color']);
        unset($data['style_font_weight']);
        
        $datas['thumb'] = $data['thumb']?$data['thumb']:'';
        $datas['sthumb'] = $data['sthumb']?$data['sthumb']:'';
        $datas['description'] = $data['description'];
        $datas['islink'] = $data['islink'];
        $datas['url'] = $data['linkurl'];
        unset($data['linkurl']);
        unset($data['file']);
        $datas['views']  = intval($data['views']) ? intval($data['views']):0;
        $datas['tags']  = $data['tags'];
        $datas['listorder']  = $data['listorder'];
        $datas['content']  = $data['content'];
        $datas['allow_comment']  = $data['allow_comment'];
        $datas['attitude_flag'] = $data['attitude_flag'];
        $datas['recommend'] = $data['recommend'];
        $datas['comment'] = $data['comment'];
        $datas['zan'] = $data['zan'];
        //主表提交
         $other = array_diff_key($data,$datas);
         foreach($other as $keys=>$vs){

            if($this->is_date($vs)){

              $other[$keys] = strtotime($vs);
            }
         }
      
         //       p($data);
         // p($datas);
         // p($other);die;
          $upzb = Model($ncms_model_name)->insert($datas);
          // p(Db::getLastSql());die;
          $other['id'] = $upzb;
          $updata = Model($ncms_model_data_name)->insert($other);

        if($upzb && $updata){
           return true;
        }else{
           return false;
           
        }

        //附表提交
       
      
    }


    public function is_date($date){
       if($date == date('Y-m-d H:i:s',strtotime($date))){
        return true;
       }else{
        return false;
       }
    }

    //编辑文章
    public function ncms_article_updateOp(){
     

      $file = $_FILES;
      $filestr = '';
      foreach ($file as &$valt) {
           $filestr .=$valt['tmp_name'];
      }
     
      
       if($filestr){
                $upload     = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTICLE);
                foreach($file as $key=>$vt){
               
                  if($key ==='thumb' && $_FILES['thumb']['name']){
                    //生成两张缩略图，宽高分别为30,300 
                    $upload->set('thumb_width',  '140'); 
                    $upload->set('thumb_height', '90'); 
                    //缩略图名称后面分别追加 "_tiny","_mid" 
                    $upload->set('thumb_ext', '_thumb','_min'); 
                    //开始上传
                    $result = $upload->upfile('thumb');
                    if ($result){
                    //得到图片上传后的路径 
                    /* 获取缩略图：*/$img_path_thumb = $upload->getSysSetPath().$upload->thumb_image; 
                    /*获取原图：*/ $img_path = $upload->getSysSetPath().$upload->file_name; 
                    }
                    $_POST['thumb'] = $img_path;
                    $_POST['sthumb'] = $img_path_thumb;
                  
              }else{
                  if($_FILES[$key]['name']){
                    $result = $upload->upfile($key);
                    if (!$result){
                        showMessage($upload->error,'','','error');
                    }
                    $_POST[$key] = $upload->file_name;
                  }
                  
              }
            }

          }
          
            
          //栏目ID
          $catid = intval($_POST['info']['catid']);
          if (empty($catid)) {
             showMessage('请指定栏目ID！','','','error');
          }
          if (trim($_POST['info']['title']) == '') {
             showMessage('标题不能为空！','','','error');
          }
          //获取当前栏目配置
          $category = getCategory($catid);
       
          //模型ID
          $modelid = getCategory($catid, 'modelid');
          $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
          
          //检查模型是否被禁用
          if ($disabled['disabled'] == 1) {
              showMessage('模型被禁用！','','','error');
          }

          foreach($_POST as $key=>&$vs){
            if($key !='info'){
               $data[$key] = $vs;
            }else{
              foreach($_POST['info'] as $k=>&$vt){
                $data[$k] = $vt;
              }
              foreach ($_POST['file'] as $y=>&$ve) {
                  if(!$data[$y]){
                      $data[$y] = $ve;
                  }
              }
            }
           
          }
          unset($data['file']);
       


          $status = $this->editcontent($data);
          if ($status) {
             showMessage('编辑成功！','','');
          } else {
              
               showMessage('编辑失败！','','','error');

          }
    }


     //添加文章
    public function editcontent($data){

       if (empty($data)) {
            if (!empty($data)) {
                // 重置数据
                $data = array();
            } else {
               showMessage('参数错误！','','','error');
               return false;
            }
        }
        $catid = (int)$data['catid'];
        $id = (int)$data['id'];
        $modelid = getCategory($catid, 'modelid');
        $ncms_model = Model('ncms_model')->where(array('modelid'=>$modelid))->find();
        $ncms_model_name =  'ncms_'.$ncms_model['tablename'];
        $ncms_model_data_name =  'ncms_'.$ncms_model['tablename'].'_data';

      
        //栏目数据
        $catidinfo = getCategory($data['catid']);

        if (empty($catidinfo)) {
            showMessage('获取不到栏目数据！','','','error');
            return false;
        }
        //setting配置
        $catidsetting = $catidinfo['setting'];
   
        $datas['status'] = 1;
        //添加用户名
        $admin_info = $this->getAdminInfo();
        $datas['username'] = $admin_info['name'];
        $datas['sysadd'] = 0;
         

        //检查真实发表时间，如果有时间转换为时间戳
        if ($data['inputtime'] && !is_numeric($data['inputtime'])) {
            $datas['inputtime'] = strtotime($data['inputtime']);

        } elseif (!$data['inputtime']) {
            $datas['inputtime'] = time();
        }
        //更新时间处理
        if ($data['updatetime'] && !is_numeric($data['updatetime'])) {
            $datas['updatetime'] = strtotime($data['updatetime']);
        } elseif (!$data['updatetime']) {
            $datas['updatetime'] = time();
        }
        $datas['catid'] = $data['catid'];
        $datas['title'] = $data['title'];
        if($data['style_color'] || $data['style_font_weight']){
           $datas['style'] = "color:{$data['style_color']};font-weight:{$data['style_font_weight']};";
          
        }
        unset($data['style_color']);
        unset($data['style_font_weight']);
        $datas['thumb'] = $data['thumb']?$data['thumb']:'';
        $datas['sthumb'] = $data['sthumb']?$data['sthumb']:'';
        $datas['description'] = $data['description'];
        $datas['islink'] = $data['islink'];
        $datas['url'] = $data['linkurl'];
         unset($data['linkurl']);
        $datas['views']  = intval($data['views']) ? intval($data['views']):0;
        $datas['tags']  = $data['tags'];
        $datas['listorder']  = $data['listorder'];
        $datas['content']  = $data['content'];
        $datas['allow_comment']  = $data['allow_comment'];
        $datas['attitude_flag'] = $data['attitude_flag'];
        $datas['recommend'] = $data['recommend'];
        $datas['comment'] = $data['comment'];
        $datas['zan'] = $data['zan'];
       
        //主表提交
         $other = array_diff_key($data,$datas);

         foreach($other as $keys=>$vs){
            if($this->is_date($vs)){

              $other[$keys] = strtotime($vs);
            }
         }
          $upzb = Model($ncms_model_name)->where(array('id'=>$id))->update($datas);

          $updata = Model($ncms_model_data_name)->where(array('id'=>$id))->update($other);
           // p(Db::getLastSql());die;
        if($upzb && $updata){
           return true;
        }else{
           return false;
           
        }


       
      
    }

    /**
    *文章删除
    */
    public function ncms_article_dropOp(){
        $catid = intval($_GET['catid']);
        $id = intval($_GET['id']);
        //取得对应模型
        $category = getCategory($catid);
        if (empty($category)) {
           showMessage('该栏目不存在！','','','error');
        }
        //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        $ncms_model_name =  'ncms_'.$disabled['tablename'];
        $ncms_model_data_name =  'ncms_'.$disabled['tablename'].'_data';
  
        if ($disabled['disabled']) {
            showMessage('模型被禁用！','','','error');
        }
        //删除主表数据
        $delete1 = Model()->table("{$ncms_model_name}")->where("id = {$id}")->delete();
        //删除附表数据
        $delete2 = Model()->table("{$ncms_model_data_name}")->where("id = {$id}")->delete();
     
        if($delete1 && $delete2) {
            $this->log('删除文章成功-'.$id, 1);
            showMessage('文章删除成功!','');
        } else {
            $this->log('删除文章失败-'.$id, 0);
            showMessage('文章删除失败!','','','error');
        }

    }


    //文章批量删除
    public function deleteOp() {

        $model_article = Model('article');
         $catid = intval($_GET['catid']);
         //取得对应模型
        $category = getCategory($catid);
        if (empty($category)) {
           showMessage('该栏目不存在！','','','error');
        }
        //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
        $ncms_model_name =  'ncms_'.$disabled['tablename'];
        $ncms_model_data_name =  'ncms_'.$disabled['tablename'].'_data';
  
        if ($disabled['disabled']) {
          exit(json_encode(array('state'=>false,'msg'=>'模型被禁用！')));
       
        }
        if (preg_match('/^[\d,]+$/', $_GET['del_id'])) {
            $_GET['del_id'] = explode(',',trim($_GET['del_id'],','));   
            $model_upload = Model('upload');
            foreach ($_GET['del_id'] as $k => $v){
                $v = intval($v);
                //删除主表数据
                $delete1 = Model()->table("{$ncms_model_name}")->where("id = {$v}")->delete();
                //删除附表数据
                $delete2 = Model()->table("{$ncms_model_data_name}")->where("id = {$v}")->delete();
            }
            $this->log(L('cms_article_index_del_succ').'[ID:'.implode(',',$_GET['del_id']).']',null);
            exit(json_encode(array('state'=>true,'msg'=>'删除成功')));
        } else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }



}
