<?php
/**
 * 菜单
 *
 */
defined('TTShop') or exit('Access Invalid!');
$_menu['mobile'] = array(
    'name' => $lang['nc_mobile'],
    'child' => array(
        array(
            'name' => '设置',
            'child' => array(
                'mb_setting' => '手机端设置',
                'mb_recommend' => '首页推荐设置',
                'mb_notice' => '购买须知设置',
                'mb_adv' => '店内统一广播',
                //'mb_special' => '模板设置',
                // 'mb_app' => '应用安装',
                //'mb_feedback' => $lang['nc_mobile_feedback'],
                //'mb_payment' => '手机支付',
                //'mb_wx' => '微信二维码',
                //'mb_connect' => '第三方登入',
                'index_goods_recommend' => '首页商品推荐',
                'index_store_recommend' => '好物推荐设置',
                'index_topslide_recommend' => '首页广告设置',
                'heigh_quality' => '优品推荐',

            )
        )
    )
); 