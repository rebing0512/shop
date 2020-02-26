<?php
/**
 * 首页好物推荐

 */



defined('TTShop') or exit('Access Invalid!');
class hot_goods_recommendControl extends BaseSellerControl {
    public function __construct() {
        parent::__construct();
        //检查是否开启
//        if (intval(C('promotion_allow')) !== 1) {
//            showMessage(Language::get('promotion_unavailable'), urlShop('seller_center', 'index'),'','error');
//        }
    }

    public function indexOp() {
        $this->hot_goods_listOp();
    }

    public function hot_goods_listOp() {
        $model_recommend = Model('hot_goods_recommend');
        $hasList = true;
//        if (checkPlatformStore()) {
//            Tpl::output('isOwnShop', true);
//            $hasList = true;
//        } else {
//            // 检查是否已购买套餐
//            $where = array();
//            $where['store_id'] = $_SESSION['store_id'];
//            $fcode_quota = $model_fcode->getFCodeQuotaInfo($where);
//            Tpl::output('fcode_quota', $fcode_quota);
//            if (!empty($fcode_quota)) {
//                $hasList = true;
//            }
//        }

        if ($hasList) {
            $goods_list = $model_recommend->getHotGoodsList(array('hot_goods_recommend.store_id' => $_SESSION['store_id']), '*', null);
            if (!empty($goods_list)) {
                $gcid_array = array();  // 商品分类id
                foreach ($goods_list as $key => $val) {
                    $gcid_array[] = $val['gc_id'];
                    $goods_list[$key]['goods_image'] = thumb($val);
                    $goods_list[$key]['url'] = urlShop('goods', 'index', array('goods_id' => $val['goods_id']));
                }
                $goodsclass_list = Model('goods_class')->getGoodsClassListByIds($gcid_array);
                $goodsclass_list = array_under_reset($goodsclass_list, 'gc_id');

                Tpl::output('goods_list', $goods_list);
                Tpl::output('goodsclass_list', $goodsclass_list);
            }
        }

        $this->profile_menu('fcode_goods_list', 'fcode_goods_list');
        Tpl::showpage('hot_goods_recommend.goods_list');
    }

    /**
     * 选择商品
     */
    public function hot_select_goodsOp() {
        $model_goods = Model('goods');
        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        $condition['is_recommend'] = 0;
        if ($_GET['goods_name'] != '') {
            $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        }
        $goods_list = $model_goods->getGeneralGoodsList($condition, '*', 10);

        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('hot_goods_recommend.select_goods', 'null_layout');
    }

    /**
     * 选择商品
     */
    public function choosed_goodsOp() {
        $model_fcode = Model('hot_goods_recommend');
        $gid = intval($_REQUEST['gid']);
        if ($gid <= 0) {
            if ($_GET['inajax']) {
                showDialog('参数错误', '', 'succ', 'CUR_DIALOG.close();');
            }
            Tpl::output('error', '参数错误');
        }

        $model_goods = Model('goods');
        // 验证商品是否存在
        $goods_info = $model_goods->getGoodsInfoByID($gid);
        if (empty($goods_info) || $goods_info['store_id'] != $_SESSION['store_id']) {
            if ($_GET['inajax']) {
                showDialog('参数错误，或该商品已经添加过活动', '', 'succ', 'CUR_DIALOG.close();');
            }
            Tpl::output('error', '参数错误，或该商品已经添加过活动');
        }
        if (chksubmit()) {
            $rs = Model('hot_goods_recommend')->addHotGoodsByGoodsId($goods_info,intval($_REQUEST['g_sort']));
            if ($rs) {
                // 生成F码
//                QueueClient::push('createGoodsFCode', array('goods_id' => $gid, 'fc_count' => intval($_POST['g_fccount']), 'fc_prefix' => $_POST['g_fcprefix']));

                $goodsclass_info = Model('goods_class')->getGoodsClassInfoById($goods_info['gc_id']);
                $goods_info['gc_name'] = $goodsclass_info['gc_name'];
                $goods_info['goods_image'] = thumb($goods_info, '60');
                $goods_info['url'] = urlShop('goods', 'index', array('goods_id' => $goods_info['goods_id']));
                $this->recordSellerLog('添加好物推荐商品，商品id：'.$gid);
                showDialog('操作成功', '', 'succ', 'CUR_DIALOG.close();choose_goods('.json_encode($goods_info).')');
            } else {
                showDialog('操作失败', '', 'succ', 'CUR_DIALOG.close();');
            }
        }
//        Tpl::output('fcode_info', $fcode_info);


        $goodscommon_info = $model_goods->getGoodsCommonInfoByID($goods_info['goods_commonid'], 'spec_name,store_id');
        $spec_name = array_values((array)unserialize($goodscommon_info['spec_name']));
        $goods_spec = array_values((array)unserialize($goods_info['goods_spec']));
        Tpl::output('goods_spec', $goods_spec);
        Tpl::output('spec_name', $spec_name);
        Tpl::output('goods_info', $goods_info);
        Tpl::showpage('hot_goods_recommend.choosed_goods', 'null_layout');
    }

    /**
     * 删除选择商品
     */
    public function del_choosed_goodsOp() {
        $gid = intval($_GET['gid']);
        if ($gid <= 0) {
            $data = array('result' => 'false', 'msg' => '参数错误');
            $this->_echoJson($data);
        }

        // 验证商品是否存在
        $goods_info = Model('goods')->getGoodsInfoByID($gid);
        if (empty($goods_info) || $goods_info['store_id'] != $_SESSION['store_id']) {
            $data = array('result' => 'false', 'msg' => '参数错误');
            $this->_echoJson($data);
        }

        $result = Model('hot_goods_recommend')->delHotGoodsByGoodsId($gid);
        if ($result) {
            $this->recordSellerLog('删除好物推荐商品，商品id：'.$gid);
            $data = array('result' => 'true');
        } else {
            $data = array('result' => 'false', 'msg' => '删除失败');
        }
        $this->_echoJson($data);
    }

    /**
     * 输出JSON
     * @param array $data
     */
    private function _echoJson($data) {
        if (strtoupper(CHARSET) == 'GBK'){
            $data = Language::getUTF8($data);//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        }
        echo json_encode($data);exit();
    }


    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_type,$menu_key='') {
        $menu_array = array();
        switch ($menu_type) {
            case 'fcode_goods_list':
                $menu_array = array(
                    1=>array('menu_key'=>'fcode_goods_list', 'menu_name'=>'商品列表', 'menu_url'=>urlShop('hot_goods_recommend', 'fcode_goods_list'))
                );
                break;
            case 'fcode_quota_add':
                $menu_array = array(
                    1=>array('menu_key'=>'fcode_goods_list', 'menu_name'=>'商品列表', 'menu_url'=>urlShop('hot_goods_recommend', 'fcode_goods_list')),
                    2=>array('menu_key'=>'fcode_quota_add', 'menu_name'=>'购买套餐', 'menu_url'=>urlShop('hot_goods_recommend', 'fcode_quota_add'))
                );
                break;
            case 'fcode_renew':
                $menu_array = array(
                    1=>array('menu_key'=>'fcode_goods_list', 'menu_name'=>'商品列表', 'menu_url'=>urlShop('hot_goods_recommend', 'fcode_goods_list')),
                    2=>array('menu_key'=>'fcode_renew', 'menu_name'=>'套餐续费', 'menu_url'=>urlShop('hot_goods_recommend', 'fcode_renew'))
                );
                break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
