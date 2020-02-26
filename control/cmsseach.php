<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class cmsseachControl extends BaseCmsControl{
    
    public function indexOp(){
    	/**
         * 读取语言包
         */
        Language::read('home_article_index');
        $lang   = Language::getLangContent();
       

          
        $cms_model   = Model('ncms_search');
        $condition  = array();
        $condition['table']='ncms_search';
        $condition['like_title'] = trim($_REQUEST['keyword']);
        $page   = new Page();
        $page->setEachNum(5);
        $page->setStyle('admin');
        $list = @(array)$cms_model->getList($condition,$page);
 
        if(is_array($list) && !empty($list)){
        foreach($list as &$vhy){
                $classname =Model()->table('ncms_category')->where("catid = {$vhy['catid']}")->field('catname,image')->find();
                $vhy['classname'] = $classname['catname'];
                if ($classname['image']!= '') {
                   $vhy['image'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE_LOGO.DS.$classname['image'];
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
        //获取推荐商品
        $tuijian = Model('goods')->where(array("goods_state"=>1,"goods_verify"=>1))->limit(6)->Order("goods_salenum desc")->select();
        Tpl::output('tuijian',$tuijian);


        //获取最新文章
        $new_article_list  = Model()->table('ncms_search')->field('id,title,islink,url,catid')->limit(6)->select();
        // p($list);die;
        Tpl::output('article',$list);
        Tpl::output('show_page',$page->show());
        Tpl::output('new_article_list',$new_article_list);
        // Tpl::output('catelist',$catelist);  
        // Tpl::output('nav_link_list',$nav_link); 

        Tpl::showpage('cms_seach');
    }


  
}
