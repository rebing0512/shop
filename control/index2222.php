<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class indexControl extends BaseHomeControl{
    public function indexOp(){
        Language::read('home_index_index');
        Tpl::output('index_sign','index');

        //特卖专区
        Language::read('member_groupbuy');
        $model_groupbuy = Model('groupbuy');
        $group_list = $model_groupbuy->getGroupbuyCommendedList(4);
        Tpl::output('group_list', $group_list);
        //限时折扣
        $model_xianshi_goods = Model('p_xianshi_goods');
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(6);
        Tpl::output('xianshi_item', $xianshi_item);

        //评价信息
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsList(8);
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);

        //板块信息
        // $model_web_config = Model('web_config');
        // $web_html = $model_web_config->getWebHtml('index');
        // Tpl::output('web_html',$web_html);

        $code_list = Model('web_config')->getCodeList(array('web_id'=>101,'code_id'=>620));
        if(!empty($code_list) && is_array($code_list)) {
                 
            foreach ($code_list as &$vals) {
                $vals['code_info'] = Model('web_config')->get_array($vals['code_info'],'array');
            }
        }
        Tpl::output('zom_list',$code_list);
        //首页推荐词链接
         if (C('control_rc') != '') {
            $rc_list = @unserialize(C('control_rc'));
        }
        Tpl::output('rc_list',is_array($rc_list) ? $rc_list : array());
        /*自定义方法*/

        $model_class = Model('goods_class');
        $goods_class = $model_class->get_all_category();
        foreach($goods_class as &$val){

                $val['g_tuijian_list'] = Model('goods')->where(array("gc_id_1"=>$val['gc_id'],'tag'=>3))->limit(6)->select();


                $val['g_hotlist'] = Model('goods')->where(array("gc_id_1"=>$val['gc_id'],'tag'=>6))->limit(5)->select();

                $val['g_brand']  = Model('brand')->where(array("class_id"=>$val['gc_id']))->limit(4)->select();//取分类下的推荐品牌
        }


        Tpl::output('goods_class',$goods_class);//商品分类

        Tpl::output('nav_link_list',$nav_link);
//获取热卖商品
        $remai = Model('goods')->where(array('tag'=>5))->limit(6)->Order("goods_edittime desc")->select();

        Tpl::output('remai',$remai);
//获取特卖商品
        $temai = Model('goods')->where(array('tag'=>4))->limit(6)->Order("goods_edittime desc")->select();

        Tpl::output('temai',$temai);
//获取口碑商品
        $koubei = Model('goods')->where(array('tag'=>8))->limit(6)->Order("goods_edittime desc")->select();

        Tpl::output('koubei',$koubei);
//获取推荐商品
        $tuijian = Model('goods')->where(array('tag'=>3))->limit(6)->Order("goods_edittime desc")->select();

        Tpl::output('tuijian',$tuijian);//商品分类
//获取最新商品
        $newgoods = Model('goods')->where(array('tag'=>2))->limit(4)->Order("goods_edittime desc")->select();

        Tpl::output('newgoods',$newgoods);
//获取特价商品
        $tjgoods = Model('goods')->where(array('tag'=>4))->limit(4)->Order("goods_edittime desc")->select();

        Tpl::output('tjgoods',$tjgoods);
//获取疯抢商品
        $fqgoods = Model('goods')->where(array('tag'=>5))->limit(4)->Order("goods_edittime desc")->select();

        Tpl::output('fqgoods',$fqgoods);

//获得推荐品牌
        
        $brand_r_list = Model('brand')->getBrandPassedList(array('brand_recommend'=>1) ,'brand_id,brand_name,brand_pic,brand_bigpic,brand_introduction', 0, 'brand_sort asc, brand_id desc', 4);
        // p($brand_r_list);
        Tpl::output('brand_r',$brand_r_list);


/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/  
//获取行业资讯
        $caigou = Model()->table('article')->where("ac_id = 9")->limit('6')->order("article_id desc")->select();
        
        Tpl::output('dongtai',$caigou);
//产品供应
        $gongying = Model()->table('article')->where("ac_id = 10")->limit('7')->order("article_id desc")->select();
        foreach($gongying as &$vhy){
            $vhy['thub'] = getpic($vhy['article_content']);
        }

        Tpl::output('gongying',$gongying);
//行业采购
        $dongtai = Model()->table('article')->where("ac_id = 11")->limit('10')->order("article_id desc")->select();

        Tpl::output('caigou',$dongtai);

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
        //抢购专区
        Language::read('member_groupbuy');
        $model_groupbuy = Model('groupbuy');
        $group_list = $model_groupbuy->getGroupbuyCommendedList(4);
        Tpl::output('group_list', $group_list);
//友情链接
        $model_link = Model('link');
        $link_list = $model_link->getLinkList($condition,$page);
        /**
         * 整理图片链接
         */
        if (is_array($link_list)){
            foreach ($link_list as $k => $v){
                if (!empty($v['link_pic'])){
                    $link_list[$k]['link_pic'] = UPLOAD_SITE_URL.'/'.ATTACH_PATH.'/common/'.DS.$v['link_pic'];
                }
            }
        }
        Tpl::output('link_list',$link_list);

        //限时折扣
        $model_xianshi_goods = Model('p_xianshi_goods');
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(4);
        Tpl::output('xianshi_item', $xianshi_item);


        //获取推荐店铺
        $store_list = Model('store')->where("store_recommend = 1")->field("store_name,store_label,store_id,store_domain,store_avatar")->limit(10)->select();
      
        Tpl::output('store_list',$store_list);
        //获取线上团推荐

        $groupbuy = $model_groupbuy->getGroupbuyOnlineList(array(
            'recommended' => 1,
            'is_vr' => 0,
        ), 4);

        Tpl::output('groupbuy', $groupbuy);
        //板块信息
        $model_web_config = Model('web_config');
        $web_html = $model_web_config->getWebHtml('index');

        Tpl::output('web_html',$web_html);
            //获取top6
        $bdnew = Model()->table('article')->limit('5')->order("article_id desc")->select();
        Tpl::output('bdnew',$bdnew);

        Model('seo')->type('index')->show();
        Tpl::showpage('index');
    }

    
}
