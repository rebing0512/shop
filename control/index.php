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
        header('Location:index.php?con=seller_login&fun=show_login');exit;
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
		$model_area	= Model('flea_area');
		$area_array			= $model_area->getListArea(array('flea_area_parent_id'=>intval($_GET['area_id'])),'flea_area_sort desc');
		$array	= array();
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
		$model_class		= Model('flea_class');
		$goods_class		= $model_class->getClassList(array('gc_parent_id'=>intval($_GET['gc_id'])));
		$array				= array();
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
