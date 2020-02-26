<?php
/**
 * 默认展示页面
 *
 *
 *
 */


defined('TTShop') or exit('Access Invalid!');
class mallControl extends BaseCmsControl{
    
    public function indexOp(){
        //新闻中心推荐三文章
       $news_top_three= Model('ncms_category')->getPncmslist('ncms_newsmodel',13,'recommend = 1 and status =1','id,title,islink,url,catid,description',3,'id DESC');
       Tpl::output('news_top_three',$news_top_three);

       //新闻中心推荐三文章
       $news_right_three= Model('ncms_category')->getPncmslist('ncms_newsmodel',13,'status =1','id,title,islink,url,catid,description,sthumb,views',3,'views DESC','sthumb');
       Tpl::output('news_right_three',$news_right_three);

        //招标信息推荐五文章
       $zbnews_left_five= Model('ncms_category')->getPncmslist('ncms_newsmodel',18,'recommend = 1 and status =1','id,title,islink,url,catid,description,sthumb,views',5,'views DESC','sthumb');
       Tpl::output('zbnews_left_five',$zbnews_left_five);
       //招标信息右侧列表
       $zbnews_right_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',18,'status =1','id,title,islink,url,catid',8,'views DESC');
       Tpl::output('zbnews_right_list',$zbnews_right_list);

       //供应求购
       $gyqg_left= Model('ncms_category')->getPncmslist('ncms_newsmodel',23,'status =1','id,title,islink,url,catid,description,sthumb,views,inputtime',14,'views DESC','sthumb');
       Tpl::output('gyqg_left',$gyqg_left);
        //企业名录最新加入
       $qyml_new= Model('ncms_category')->getncmsone('ncms_company',32,'status =1','id,title,islink,url,catid,description,sthumb,views,inputtime','views DESC','sthumb');
       Tpl::output('qyml_new',$qyml_new);
       //名优企业
        $qyml_my= Model('ncms_category')->getncmsone('ncms_company',33,'status =1','id,title,islink,url,catid,description,sthumb,views,inputtime','views DESC','sthumb');
       Tpl::output('qyml_my',$qyml_my);
       //推荐企业
       $qyml_tj= Model('ncms_category')->getPncmslist('ncms_company',34,'status =1','id,title,islink,url,catid,sthumb',3,'views DESC','sthumb');
       if(!empty($qyml_tj) && is_array($qyml_tj)){
        foreach($qyml_tj as &$vt){
             $address = Model()->table('ncms_company_data')->where("id = {$vt['id']}")->field('address')->find();
             $vt['address'] = $address['address'];
         }
       }
      
       Tpl::output('qyml_tj',$qyml_tj);
       //工程设计
       $gcsj_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',39,'status =1','id,title,islink,url,catid,description,sthumb,views,inputtime',6,'views DESC','sthumb');
       Tpl::output('gcsj_list',$gcsj_list);
       //案例展示
       $anli_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',37,'status =1','id,title,islink,url,catid,description,thumb,views,inputtime',3,'views DESC','thumb');
       Tpl::output('anli_list',$anli_list);
       //工程案例
       $gcal_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',26,'status =1','id,title,islink,url,catid,description,thumb,views,inputtime',4,'views DESC','thumb');
       Tpl::output('gcal_list',$gcal_list);
       //最新招聘
       $zxzp_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',43,'status =1','id,title,islink,url,catid,description,thumb,views,inputtime',4,'views DESC','thumb');
       Tpl::output('zxzp_list',$zxzp_list);
       //求职信息
       $qzzp_list= Model('ncms_category')->getPncmslist('ncms_newsmodel',44,'status =1','id,title,islink,url,catid,description,sthumb,views,inputtime',12,'views DESC','sthumb');
       Tpl::output('qzzp_list',$qzzp_list);


       
       Tpl::showpage('index');
    }


   //json输出商品分类
    public function josn_classOp() {
        /**
         * 实例化商品分类模型
         */
        $model_class        = Model('goods_class');
        $goods_class        = $model_class->getGoodsClassListByParentId(intval($_GET['gc_id']));
        $array              = array();
        if(is_array($goods_class) and count($goods_class)>0) {
            foreach ($goods_class as $val) {
                $array[$val['gc_id']] = array('gc_id'=>$val['gc_id'],'gc_name'=>htmlspecialchars($val['gc_name']),'gc_parent_id'=>$val['gc_parent_id'],'commis_rate'=>$val['commis_rate'],'gc_sort'=>$val['gc_sort']);
            }
        }
        /**
         * 转码
         */
        if (strtoupper(CHARSET) == 'GBK'){
            $array = Language::getUTF8(array_values($array));//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        } else {
            $array = array_values($array);
        }
        echo $_GET['callback'].'('.json_encode($array).')';
    }
    //闲置物品地区json输出
    public function flea_areaOp() {
        if(intval($_GET['check']) > 0) {
            $_GET['area_id'] = $_GET['region_id'];
        }
        if(intval($_GET['area_id']) == 0) {
            return ;
        }
        $model_area = Model('flea_area');
        $area_array         = $model_area->getListArea(array('flea_area_parent_id'=>intval($_GET['area_id'])),'flea_area_sort desc');
        $array  = array();
        if(is_array($area_array) and count($area_array)>0) {
            foreach ($area_array as $val) {
                $array[$val['flea_area_id']] = array('flea_area_id'=>$val['flea_area_id'],'flea_area_name'=>htmlspecialchars($val['flea_area_name']),'flea_area_parent_id'=>$val['flea_area_parent_id'],'flea_area_sort'=>$val['flea_area_sort']);
            }
            /**
             * 转码
             */
            if (strtoupper(CHARSET) == 'GBK'){
                $array = Language::getUTF8(array_values($array));//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
            } else {
                $array = array_values($array);
            }
        }
        if(intval($_GET['check']) > 0) {//判断当前地区是否为最后一级
            if(!empty($array) && is_array($array)) {
                echo 'false';
            } else {
                echo 'true';
            }
        } else {
            echo json_encode($array);
        }
    }

    //json输出闲置物品分类
    public function josn_flea_classOp() {
        /**
         * 实例化商品分类模型
         */
        $model_class        = Model('flea_class');
        $goods_class        = $model_class->getClassList(array('gc_parent_id'=>intval($_GET['gc_id'])));
        $array              = array();
        if(is_array($goods_class) and count($goods_class)>0) {
            foreach ($goods_class as $val) {
                $array[$val['gc_id']] = array('gc_id'=>$val['gc_id'],'gc_name'=>htmlspecialchars($val['gc_name']),'gc_parent_id'=>$val['gc_parent_id'],'gc_sort'=>$val['gc_sort']);
            }
        }
        /**
         * 转码
         */
        if (strtoupper(CHARSET) == 'GBK'){
            $array = Language::getUTF8(array_values($array));//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        } else {
            $array = array_values($array);
        }
        echo json_encode($array);
    }


    /**
     * json输出地址数组 原data/resource/js/area_array.js
     */
    public function json_areaOp()
    {
        $_GET['src'] = $_GET['src'] != 'db' ? 'cache' : 'db';
        echo $_GET['callback'].'('.json_encode(Model('area')->getAreaArrayForJson($_GET['src'])).')';
    }

    /**
     * 根据ID返回所有父级地区名称
     */
    public function json_area_showOp()
    {
        $area_info['text'] = Model('area')->getTopAreaName(intval($_GET['area_id']));
        echo $_GET['callback'].'('.json_encode($area_info).')';
    }

    //判断是否登录
    public function loginOp(){
        echo ($_SESSION['is_login'] == '1')? '1':'0';
    }

    /**
     * 头部最近浏览的商品
     */
    public function viewed_infoOp(){
        $info = array();
        if ($_SESSION['is_login'] == '1') {
            $member_id = $_SESSION['member_id'];
            $info['m_id'] = $member_id;
            if (C('voucher_allow') == 1) {
                $time_to = time();//当前日期
                $info['voucher'] = Model()->table('voucher')->where(array('voucher_owner_id'=> $member_id,'voucher_state'=> 1,
                'voucher_start_date'=> array('elt',$time_to),'voucher_end_date'=> array('egt',$time_to)))->count();
            }
            $time_to = strtotime(date('Y-m-d'));//当前日期
            $time_from = date('Y-m-d',($time_to-60*60*24*7));//7天前
            $info['consult'] = Model()->table('consult')->where(array('member_id'=> $member_id,
            'consult_reply_time'=> array(array('gt',strtotime($time_from)),array('lt',$time_to+60*60*24),'and')))->count();
        }
        $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],5);
        if(is_array($goods_list) && !empty($goods_list)) {
            $viewed_goods = array();
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = urlShop('goods', 'index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 60);
                $viewed_goods[$goods_id] = $val;
            }
            $info['viewed_goods'] = $viewed_goods;
        }
        if (strtoupper(CHARSET) == 'GBK'){
            $info = Language::getUTF8($info);
        }
        echo json_encode($info);
    }
    /**
     * 查询每月的周数组
     */
    public function getweekofmonthOp(){
        import('function.datehelper');
        $year = $_GET['y'];
        $month = $_GET['m'];
        $week_arr = getMonthWeekArr($year, $month);
        echo json_encode($week_arr);
        die;
    }



  
}
