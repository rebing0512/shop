<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class cms_indexControl extends BaseCmsControl{
    

    //文章列表页
    public function listOp(){
        /**
         * 读取语言包
         */
        Language::read('home_article_index');
        $lang   = Language::getLangContent();
        $catid =intval($_GET['catid']);
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
        if ($disabled['disabled']) {
            showMessage('模型被禁用！','','','error');
        }
        //获取文章分类
        $categorys =Model()->table('ncms_category')->field('catid,parentid,catname,image')->limit('100')->select();

        $plist = category::getParents($categorys,$catid);
    
        $clist = category::getChildsId($categorys,$catid);
        $catelist = category::getChilds($categorys,$catid);
        $clist[] = $catid;

        if(is_array($plist) && !empty($plist)){ 
            foreach($plist as $vt){
                $vtlist .= $vt['catid'].',';
            }
        }
      

        $nav_link = array();
        $nav_link[0]['title'] = $lang['homepage'] ;
        $nav_link[0]['link'] = SHOP_SITE_URL ;
        $arrparentid = array_filter(explode(',', rtrim($vtlist))); 

        $count = count($arrparentid);

        $i =0; 
        if(is_array($arrparentid) && !empty($arrparentid)){ 
        foreach ($arrparentid as $key=>$cid) {
            $i++; 
            
            if($i == $count){
                $nav_link[$i]['title'] =  getCategory($cid,'catname')  ;
                
                $nav_title = '<a href="' . urlShop('cms_index','list',array('catid'=>$cid)) . '"><i class="zxun"></i>' . getCategory($cid,'catname') . '</a>';
            }else{
                 $nav_link[$i]['title'] =  getCategory($cid,'catname');
                $nav_link[$i]['link'] = urlShop('cms_index','list',array('catid'=>$cid)) ;
            }
           
            
            
        } 
       }
        $nav_link[$i+1]['title'] =  str_cut($data['title'],50);

        //获取推荐商品
        $tuijian = Model('goods')->where(array("goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_salenum desc")->select();

        Tpl::output('tuijian',$tuijian);
        $ac_ids = implode(',', $clist);
       //获取最新文章
        $new_article_list  = Model()->table("{$ncms_model_name}")->where("catid IN ({$ac_ids})")->field('id,title,islink,url,catid')->limit(6)->select();

        $article_model   = Model('ncms_model');
        $condition  = array();
        $condition['ac_ids']    = $ac_ids;
        $condition['status']  = '1';
        $condition['field'] = "id,catid,title,style,thumb,description,url,islink,inputtime,views,zan,comment";
        $page   = new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
    
        $article_list = @(array)$article_model->getNcmsList($ncms_model_name,$condition,$page);
 
        if(is_array($article_list) && !empty($article_list)){
        foreach($article_list as &$vhy){
                $vhy['classname'] = getCategory($catid,'catname');
                $icoimg = getCategory($catid,'image');
                if ($icoimg!= '') {
                   $vhy['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE_LOGO.DS.$icoimg;
                }else{
                   $vhy['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_classico.png';
                }
                if ($vhy['thumb']!= '') {
                   $vhy['thumb'] = UPLOAD_SITE_URL."/".ATTACH_ARTICLE."/".$vhy['thumb'];
                }else{
                   $vhy['thumb'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_article.png';
                }
         }
        }
        foreach ($catelist as &$vc) {
             if ($vc['image']!= '') {
               $vc['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE_LOGO.DS.$vc['image'];
            }else{
               $vc['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_classico.png';
            }
        }        
        Tpl::output('html_title',getCategory($catid,'catname') .'-'. C('site_name'));
        Tpl::output('seo_keywords',C('cms_seo_keywords') .'-'. C('site_name'));
        Tpl::output('seo_description',C('cms_seo_description') .'-'. C('site_name'));
        Tpl::output('class_name',getCategory($cid,'catname'));
        Tpl::output('article',$article_list);
        Tpl::output('show_page',$page->show());
        Tpl::output('new_article_list',$new_article_list);
        Tpl::output('catelist',$catelist);  
        Tpl::output('nav_link_list',$nav_link); 
        Tpl::showpage('list');
    }
    // 文章详情页
    public function detailsOp(){
    	/**
		 * 读取语言包
		 */
		Language::read('home_article_index,cms');
		$lang	= Language::getLangContent();

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
        $data = Model()->table("{$ncms_model_name},{$ncms_model_data_name}")->where("{$ncms_model_data_name}.id = {$ncms_model_name}.id and {$ncms_model_name}.id = {$id}")->find();
       	$data['catename'] = $disabled['name'];

     	//获取文章分类
     	$categorys =Model()->table('ncms_category')->field('catid,parentid,catname,image')->limit('100')->select();
        
     	$plist = category::getParents($categorys,$catid);
        $clist = category::getChildsId($categorys,$catid);

        $clist[] = $catid;
     	foreach($plist as $vt){
     		$vtlist .= $vt['catid'].',';
     	}
     	

     	$nav_link = array();
     	$nav_link[0]['title'] = $lang['homepage'] ;
     	$nav_link[0]['link'] = SHOP_SITE_URL ;
     	$arrparentid = array_filter(explode(',', rtrim($vtlist))); 

     	$count = count($arrparentid);
       $i = 0;
     	foreach ($arrparentid as $key=>$cid) {
                $i++;
     		    $nav_link[$i]['image'] =  getCategory($cid,'image')  ;
                $nav_link[$i]['title'] =  getCategory($cid,'catname')  ;
                $nav_link[$i]['link'] = urlShop('cms_index','list',array('catid'=>$cid)) ;
     
			
     	} 

     	$nav_link[$i+1]['title'] =  str_cut($data['title'],50);

     	//获取推荐商品
		$tuijian = Model('goods')->where(array("goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_salenum desc")->select();

		Tpl::output('tuijian',$tuijian);

		//获取分类导航
		$catelist = Model()->table('ncms_category')->where(array('parentid'=>$category['parentid']))->field('catid,parentid,catname,image')->select();
		//获取最新文章
		$new_article_list  = Model()->table("{$ncms_model_name}")->where("catid = {$catid}")->field('id,title,islink,url,catid')->limit(6)->select();
		//获得相关文章
        $xgwz =  Model()->table("{$ncms_model_name}")->where("catid = {$catid}")->field('id,title,islink,url,catid')->limit(10)->order("id asc")->select();
        Tpl::output('xgwz',$xgwz);

        
        /**
         * 寻找上一篇与下一篇
         */
        $article_model   = Model('ncms_model');
        $condition  = array();
        $condition['ac_ids']    = implode(',', $clist);
        $condition['status']  = '1';
        $condition['field'] = "id,catid,title,style,sthumb,description,url,islink,inputtime,views,zan,comment";
      
    
        $article_list = @(array)$article_model->getNcmsList($ncms_model_name,$condition);

        $pre_article    = $next_article = array();
        if(!empty($article_list) && is_array($article_list)){
            $pos    = 0;
            foreach ($article_list as $k=>$v){
                if($v['id'] == $data['id']){
                    $pos    = $k;
                    break;
                }
            }
            if($pos>0 && is_array($article_list[$pos-1])){
                $pre_article    = $article_list[$pos-1];
            }
            if($pos<count($article_list)-1 and is_array($article_list[$pos+1])){
                $next_article   = $article_list[$pos+1];
            }
        }
         //计数加1
        Model()->table("{$ncms_model_name}")->where(array('id'=>$id,'catid'=>$catid))->update(array('views'=>array('exp','views+1')));

        //文章心情
        $article_attitude_list = array();
        $article_attitude_list[1] = Language::get('attitude1');
        $article_attitude_list[2] = Language::get('attitude2');
        $article_attitude_list[3] = Language::get('attitude3');
        $article_attitude_list[4] = Language::get('attitude4');
        $article_attitude_list[5] = Language::get('attitude5');
        $article_attitude_list[6] = Language::get('attitude6');
      foreach ($catelist as &$vc) {
            if ($vc['image']!= '') {
               $vc['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE_LOGO.DS.$vc['image'];
            }else{
               $vc['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_classico.png';
            }
        } 
        Tpl::output('html_title',$data['title'] .'-'. C('site_name'));
        Tpl::output('seo_keywords',C('cms_seo_keywords') .'-'. C('site_name'));
        Tpl::output('seo_description',C('cms_seo_description') .'-'. C('site_name'));   
        Tpl::output('detail_object_id', $id);
        Tpl::output('detail_object_catid', $catid);
        // Tpl::output('comment_all', 'all');
        Tpl::output('article_attitude_list', $article_attitude_list);
        Tpl::output('pre_article',$pre_article);
        Tpl::output('next_article',$next_article);
		Tpl::output('new_article_list',$new_article_list);
		Tpl::output('catelist',$catelist);	
		Tpl::output('nav_link_list',$nav_link);	
  	   	Tpl::output('nav_title',$nav_link[count($nav_link)-2]['title']);
        Tpl::output('nav_ico',$nav_link[count($nav_link)-2]['imgae']?UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE_LOGO.DS.$nav_link[count($nav_link)-2]['imgae']:UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/default_classico.png');
        Tpl::output('data',$data);
        Tpl::showpage('details');
    }

        /**
    *ajax_zan ajax赞
    */
    public function ajax_zanOp(){
        $newsId = intval($_POST['newsId']);
        $catid = intval($_POST['catid']);

        //取得对应模型
        $category = getCategory($catid);
        if (empty($category)) {
            echo json_encode(array('status'=>0,'info'=>'点赞失败'));
        }
         //模型ID
        $modelid = $category['modelid'];
        //检查模型是否被禁用
        $disabled =Model('ncms_model')->where(array('modelid' => $modelid))->find();
    
        $ncms_model_name =  'ncms_'.$disabled['tablename'];
        if ($disabled['disabled']) {
             echo json_encode(array('status'=>0,'info'=>'点赞失败'));
        }

        if(!empty($newsId)){

            $up =Model()->table("{$ncms_model_name}")->where(array('id'=> $newsId,'catid'=>$catid))->update(array('zan'=>array('exp', 'zan + 1')));

            if($up){
                  echo json_encode(array('status'=>1));
            }else{
                 echo json_encode(array('status'=>0,'info'=>'点赞失败'));
            }
        }else{
             echo json_encode(array('status'=>0,'info'=>'点赞失败'));
        }
    }

    // 文章详情评论
     /**
     * 文章评论
     */
    public function comment_detailOp() {
        /**
         * 读取语言包
         */
        Language::read('home_article_index,cms');
        $lang   = Language::getLangContent();

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
        $data = Model()->table("{$ncms_model_name},{$ncms_model_data_name}")->where("{$ncms_model_data_name}.id = {$ncms_model_name}.id and {$ncms_model_name}.id = {$id}")->find();
        $data['catename'] = $disabled['name'];
        //获取文章分类
        $categorys =Model()->table('ncms_category')->field('catid,parentid,catname')->select();
        $plist = category::getParents($categorys,$catid);
        $clist = category::getChildsId($categorys,$catid);
        $clist[] = $catid;
        foreach($plist as $vt){
            $vtlist .= $vt['catid'].',';
        }
        

        $nav_link = array();
        $nav_link[0]['title'] = $lang['homepage'] ;
        $nav_link[0]['link'] = SHOP_SITE_URL ;
        $arrparentid = array_filter(explode(',', rtrim($vtlist))); 
        $count = count($arrparentid);

        foreach ($arrparentid as $key=>$cid) {
        
            
           
                $nav_link[$i]['title'] =  getCategory($cid,'catname')  ;
                $nav_link[$i]['link'] = urlShop('cms_index','list',array('catid'=>$cid)) ;

            
            
            
        } 
        $nav_link[$i+1]['title'] =  str_cut($data['title'],50);

       

        // //获取分类导航
        // $catelist = Model()->table('ncms_category')->where(array('parentid'=>$category['parentid']))->field('catid,parentid,catname,image')->select();
        //获取最新文章
        $new_article_list  = Model()->table("{$ncms_model_name}")->where("catid = {$catid}")->field('id,title,islink,url,catid')->limit(6)->select();
        
        //获取热门评论文章
        $hot_article_list  = Model()->table("{$ncms_model_name}")->field('id,title,islink,url,catid,comment')->order('comment desc')->limit(6)->select();
        //获取精彩推荐文章
        $tj_article_list  = Model()->table("{$ncms_model_name},ncms_category")->where("{$ncms_model_name}.catid = ncms_category.catid")->order('views desc')->limit(6)->select();

        //获取推荐商品
        $tuijian = Model('goods')->where(array("goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_salenum desc")->select();
        Tpl::output('tuijian',$tuijian);
        
        /**
         * 寻找上一篇与下一篇
         */
        $article_model   = Model('ncms_model');
        $condition  = array();
        $condition['ac_ids']    = implode(',', $clist);
        $condition['status']  = '1';
        $condition['field'] = "id,catid,title,style,sthumb,description,url,islink,inputtime,views,zan,comment";
      
    
        $article_list = @(array)$article_model->getNcmsList($ncms_model_name,$condition);

        $pre_article    = $next_article = array();
        if(!empty($article_list) && is_array($article_list)){
            $pos    = 0;
            foreach ($article_list as $k=>$v){
                if($v['id'] == $data['id']){
                    $pos    = $k;
                    break;
                }
            }
            if($pos>0 && is_array($article_list[$pos-1])){
                $pre_article    = $article_list[$pos-1];
            }
            if($pos<count($article_list)-1 and is_array($article_list[$pos+1])){
                $next_article   = $article_list[$pos+1];
            }
        }
         //计数加1
        Model()->table("{$ncms_model_name}")->where(array('id'=>$id,'catid'=>$catid))->update(array('views'=>array('exp','views+1')));


         Tpl::output('html_title',C('cms_seo_title') .'-'. C('site_name'));
        Tpl::output('seo_keywords',C('cms_seo_keywords') .'-'. C('site_name'));
        Tpl::output('seo_description',C('cms_seo_description') .'-'. C('site_name'));
        Tpl::output('detail_object_id', $id);
        Tpl::output('detail_object_catid', $catid);
        // Tpl::output('comment_all', 'all');

        Tpl::output('pre_article',$pre_article);
        Tpl::output('next_article',$next_article);
        Tpl::output('new_article_list',$new_article_list);
        Tpl::output('hot_article_list',$hot_article_list);
        Tpl::output('tj_article_list',$tj_article_list);
        // Tpl::output('catelist',$catelist);  
        Tpl::output('nav_link_list',$nav_link); 
        Tpl::output('nav_title',$nav_title);
        Tpl::output('data',$data);
        Tpl::output('comment_all', 'all');

        Tpl::showpage('comment_detail');
    }


  
}
