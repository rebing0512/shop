<?php
/**
 * 菜单
 *
 */
defined('TTShop') or exit('Access Invalid!');
$_menu['information'] = array(
    'name' => '信息',
    'child' => array(
        array(
            'name' => '设置',
            'child' => array(
                'mb_appraisal' => '横图信息模式',
                'mb_collection' => '圆图信息模式',
                'mb_app_type' => '信息模式分类',
                'mb_yellowpage&sb_type=pt&type=dp' => '店铺黄页',
                'mb_yellowpage&sb_type=pt&type=qy' => '企业黄页',
                'mb_yellowpage&sb_type=pt&type=xx' => '新秀黄页',
                'mb_yellowpage&sb_type=pt&type=ds' => '大师黄页',
                'mb_indexconfig&fun=index&h_type=2' => '首页配置',
                'mb_recommend'=>'独立推荐',
                'mb_businesscard'=>'名片设置'

            )
        )
    )
);