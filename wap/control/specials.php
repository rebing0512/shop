<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class specialsControl extends mobileHomeControl{

    public function activityOp(){
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);
        Tpl::showpage('mb_activity');
    }

    public function discoverOp()
    {
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);

        //var_dump(Model('article_class')->order('ac_sort asc')->select());exit;
        /**
        $arr = array();
        foreach (C('read') as $_ik=>$_ic) {
            $arr[] = "<a class='index-category' data-ik=\"{$_ik}\" href='javascript:void(0);'>{$_ic}</a>";
        }
        Tpl::output('read',implode('<span>|</span>', $arr));
         * **/

        $article_model = Model('article_class');

        $title = $article_model->where('ac_parent_id = 0')->order('ac_sort asc')->limit(3)->select();

        $titles = array();

        foreach ($title as $k => $v)
        {
            $titles[] = "<a class=\"index-category\" data-ik=\"{$v["ac_id"]}\" href=\"javascript:searchData({$v["ac_id"]},0)\" style=\"color: #525252;\">{$v['ac_name']}</a>";
        }

        $titles = implode("<span style=\"color: black;\">|</span>",$titles);

        Tpl::output('titles',$titles);

        Tpl::showpage('mb_discover');
    }
    public function investmentOp()
    {
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);
        Tpl::showpage('investment');
    }
    public function collectionOp()
    {
        $web_seo = C('site_name');
        Tpl::output('web_seo',$web_seo);
        Tpl::showpage('collection');
    }
    /*
     * 专家鉴定团
     */
    public function expert_showOp(){

        $id = trim($_GET['id']);

        $model = Model('appraisal');

        $detail = $model->field('detail,name')->where('id = '.$id)->find();


        $web_sec = C('site_name');

        Tpl::output('detail',$detail);

        Tpl::output('web_seo',$web_sec);
        Tpl::showpage('expert_show');
    }
}
