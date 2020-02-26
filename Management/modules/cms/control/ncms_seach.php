<?php
/**
 * 网站设置
 *
 *
 *
 *
 */



defined('TTShop') or exit('Access Invalid!');
class ncms_seachControl extends SystemControl{
    private $links = array(
        array('url'=>'con=ncms_seach&fun=base','lang'=>'seach_set'),
        array('url'=>'con=ncms_seach&fun=suo','lang'=>'suo_dump'),
        array('url'=>'con=ncms_seach&fun=keyword','lang'=>'suo_keyword'),

    );
    public function __construct(){
        parent::__construct();
        Language::read('cms,setting');
    }


    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 基本信息
     */
    public function baseOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
             
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            $update_array['seach_model'] = serialize($_POST['seach_model']);
           
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log(L('nc_edit,web_set'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                $this->log(L('nc_edit,web_set'),0);
                showMessage(L('nc_common_save_fail'));
            }
        }
        $ncms_model =  Model("ncms_model");
        $list =  (array)$ncms_model->getNcmsModelList(array('type'=>0),'*');
      
        Tpl::output('list',$list);

        $list_setting = $model_setting->getListSetting();

        $seach_model = unserialize($list_setting['seach_model']);

        Tpl::output('seach_model',$seach_model);

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'base'));

        Tpl::setDirquna('cms');
        Tpl::showpage('ncms_seach.base');
    }

    /**
     * 基本信息
     */
    public function keywordOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
             
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            $update_array['cms_keyword'] = $_POST['cms_keyword'];
           
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log(L('nc_edit,web_set'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                $this->log(L('nc_edit,web_set'),0);
                showMessage(L('nc_common_save_fail'));
            }
        }
       

        $list_setting = $model_setting->getListSetting();

        $cms_keyword = $list_setting['cms_keyword'];

        Tpl::output('cms_keyword',$cms_keyword);

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'keyword'));

        Tpl::setDirquna('cms');
        Tpl::showpage('ncms_seach.keyword');
    }

    /**
     * 防灌水设置
     */
    public function suoOp(){
 

                
                    if (isset($_GET['start'])) {

                        //每轮更新数
                        $pagesize = intval($_GET['pagesize'])?intval($_GET['pagesize']):0;
                        $_GET['pagesize'] = $pagesize = $pagesize > 1 ? $pagesize : 100;
                        //模型
                        $_GET['modelid'] = $modelid =intval($_GET['modelid'])?intval($_GET['modelid']):0;
                        //第几轮更新
                        $page = $_GET['start'] = intval($_GET['start'])?intval($_GET['start']):0;
                        //总共几轮
                        $pages = intval($_GET['pages'])?intval($_GET['pages']):0;
                        //信息总数
                        $total = intval($_GET['total'])?intval($_GET['total']):0;
                        $modedata = Model("ncms_model")->where(array("modelid" => $modelid))->find();

                        $modelname= 'ncms_'.$modedata['tablename'];
                        $list_setting = Model('setting')->getListSetting();

                        $seach_model = unserialize($list_setting['seach_model']);
                       
                        //如果是重建所有模型
                        if ($modelid) {
                            if (empty($modedata)) {
                                showMessage('该模型不存在！','','','error');
                            }

                            if (!in_array($modelid, $seach_model)) {
                                showMessage('该模型无需重建！','','','error');
                            }

                            //取得总数
                            if (!isset($_GET['total'])) {
                                $count =Model()->table("{$modelname}")->where("status = 1")->count();
                                //信息总数
                                $total = $_GET['total'] = $count;
                                //总共几轮
                                $pages = $_GET['pages'] = ceil($_GET['total'] / $pagesize);
                                //初始第一轮更新
                                $page = $_GET['start'] = 1;
                            }
                            $page = max(intval($page), 1);
                            $offset = $pagesize * ($page - 1);

                            $data = Model()->table("{$modelname}")->where("status = 1")->order(array("id" => "ASC"))->limit($offset . "," . $pagesize)->select();
                          
                            if (!$data) {
                                $data = array();
                            }
                            $dt = array();
                            // 数据处理
                            foreach ($data as $ky=>$r) {
                                if($r['status']){
                                    $dt[$ky]['id'] = $r['id'];
                                    $dt[$ky]['modelid'] = $modelid;
                                    $dt[$ky]['catid'] = $r['catid'];
                                    $dt[$ky]['adddate'] = time();
                                    $dt[$ky]['title'] = $r['title'];
                                    $dt[$ky]['style'] = $r['style'];
                                    $dt[$ky]['description'] = $r['description'];
                                    $dt[$ky]['thumb'] = $r['thumb'];
                                    $dt[$ky]['url'] = $r['url'];
                                    $dt[$ky]['islink'] = $r['islink'];
                                    $dt[$ky]['views'] = $r['views'];
                                    $dt[$ky]['zan'] = $r['zan'];
                                    $dt[$ky]['comment'] = $r['comment'];
                                    $dt[$ky]['inputtime'] = $r['inputtime'];  
                                    
                                }
                               

                                
                            }

                           
                            Model('ncms_search')->saveAll($dt);
                             
                            if ($pages == $page || $page > $pages) {
                                showMessage('更新完成！...',"index.php?con=ncms_seach&fun=suo",'','succ');
                                exit;
                            }
                         
                            if ($pages > $page) {
                                $page++;
                           
                                $_GET['start'] = $page;
                                $creatednum = $offset + count($data);
                                $percent = round($creatednum / $total, 2) * 100;
                                $message = "有 <font color=\"red\">{$total}</font> 条信息 - 已完成 <font color=\"red\">{$creatednum}</font> 条（<font color=\"red\">{$percent}%</font>）";
                              
                               
                                $url ="index.php?con=ncms_seach&fun=suo&start={$_GET['start']}&pagesize={$pagesize}&modelid={$modelid}&total={$total}&pages={$_GET['pages']}";
                             
                             
                                showMessage($message,$url,'','succ');
                                exit;
                            }
                       
                        } else {
                            //当没有选择模型更新时，进行全部可用模型数据更新
                           
                            $modelname= 'ncms_'.$modedata['tablename'];
                            $list_setting = Model('setting')->getListSetting();
                            $seach_model = unserialize($list_setting['seach_model']);
                            $autoid = intval($_GET['autoid'])?intval($_GET['autoid']):0;
                            $modedata = Model("ncms_model")->where(array("modelid" =>array('in',$seach_model)))->select();
                            if (!isset($seach_model[$autoid])) {
                                showMessage('更新完成！...',"index.php?con=ncms_seach&fun=suo",'','succ');
                                exit;
                            }
                            if(!empty($modedata) &&is_array($modedata) ){
                                foreach ($modedata as &$valt) {
                                    $modellist[$valt['modelid']] = $valt;
                                }
                            }
                            $modelid = $seach_model[$autoid];
                            $table_name = 'ncms_'.$modellist[$modelid]['tablename'];
                       
                            if (empty($table_name)) {
                                 showMessage('该模型不存在！',"index.php?con=ncms_seach&fun=suo",'','succ');
                    
                            }
                           
                            //取得总数
                            if (!isset($_GET['total'])) {
                                $count = Model()->table("{$table_name}")->where("status = 1")->count();
                                // p(Db::getLastSql());die;
                                //信息总数
                                $total = $_GET['total'] = $count;
                                //总共几轮
                                $pages = $_GET['pages'] = ceil($_GET['total'] / $pagesize);
                                //初始第一轮更新
                                $page = $_GET['start'] = 1;
                            }
                            $page = max(intval($page), 1);
                            $offset = $pagesize * ($page - 1);

                            $data = Model()->table("{$table_name}")->where("status = 1")->order(array("id" => "ASC"))->limit($offset . "," . $pagesize)->select();

                            if (!$data) {
                                $data = array();
                            }
                            //数据处理
                            $dt = array();
                            // 数据处理
                            foreach ($data as $ky=>$r) {
                                if($r['status']){
                                    $dt[$ky]['id'] = $r['id'];
                                    $dt[$ky]['modelid'] = $modelid;
                                    $dt[$ky]['catid'] = $r['catid'];
                                    $dt[$ky]['adddate'] = time();
                                    $dt[$ky]['title'] = $r['title'];
                                    $dt[$ky]['style'] = $r['style'];
                                    $dt[$ky]['description'] = $r['description'];
                                    $dt[$ky]['thumb'] = $r['thumb'];
                                    $dt[$ky]['url'] = $r['url'];
                                    $dt[$ky]['islink'] = $r['islink'];
                                    $dt[$ky]['views'] = $r['views'];
                                    $dt[$ky]['zan'] = $r['zan'];
                                    $dt[$ky]['comment'] = $r['comment'];
                                    $dt[$ky]['inputtime'] = $r['inputtime'];  
                                }
                            }

                           
                            Model('ncms_search')->saveAll($dt);
                             
                            if ($pages == $page || $page > $pages) {
                                $autoid++;
                                $_GET['autoid'] = $autoid;
                                unset($_GET['total']);
                                showMessage("模型【" . $modellist[$modelid]['name'] . "】更新完成 ...","index.php?con=ncms_seach&fun=suo&start={$_GET['start']}&pagesize={$pagesize}&modelid=0&autoid={$autoid}&pages={$_GET['pages']}",'','succ');
                                exit;
                            }

                            if ($pages > $page) {
                                $page++;
                                $_GET['start'] = $page;
                                $creatednum = $offset + count($data);
                                $percent = round($creatednum / $total, 2) * 100;
                                $message = "【" . $modellist[$modelid]['name'] . "】有 <font color=\"red\">{$total}</font> 条信息 - 已完成 <font color=\"red\">{$creatednum}</font> 条（<font color=\"red\">{$percent}%</font>）";
                                showMessage($message,"index.php?con=ncms_seach&fun=suo&start={$_GET['start']}&pagesize={$pagesize}&modelid=0&autoid={$autoid}&total={$total}&pages={$_GET['pages']}",'','succ');
                   
                                exit;
                            }
                        }
                    } else {

                        if (chksubmit()){
                            //每轮更新数
                            $pagesize = intval($_POST['pagesize']) ? intval($_POST['pagesize']): 100;
                            //模型
                            $modelid =  intval($_POST['modelid']) ? intval($_POST['modelid']): 0;
                            if ($modelid) {
                                //删除旧的搜索数据
                                Model('ncms_search')->drop(array("modelid" => $modelid));
                            } else {
                                //删除旧的搜索数据
                                Model('ncms_search')->emptyTable();
                            }
                            showMessage('开始进行索引重建...',"index.php?con=ncms_seach&fun=suo&start=1&pagesize={$pagesize}&modelid={$modelid}",'','succ');
                        
                        } else {

                           $ncms_model =  Model("ncms_model");
                            $list =  (array)$ncms_model->getNcmsModelList(array('type'=>0),'*');
                            Tpl::output('list',$list);
                            Tpl::output('top_link',$this->sublink($this->links,'suo'));
                            Tpl::setDirquna('cms');
                            Tpl::showpage('ncms_seach.suo');
                        }
                    }
                }
      
        
 


    
}
