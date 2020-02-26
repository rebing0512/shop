<?php
/**
 * 好物推荐
 *
 *
 *

 */
defined('TTShop') or exit('Access Invalid!');

class hot_goods_recommendModel extends Model {
    const STATE1 = 1;       // 开启
    const STATE0 = 0;       // 关闭

    public function __construct() {
        parent::__construct('hot_goods_recommend');
    }

    /**
     * 好物推荐商品列表
     * @param unknown $condition
     * @param string $field
     */
    public function getHotGoodsList($condition, $field = '*', $page = 10, $order = 'sort asc') {
        return Model()->table('goods,hot_goods_recommend')->join('right')->on('goods.goods_id=hot_goods_recommend.goods_id')->where($condition)->field($field)->page($page)->order($order)->select();
    }

    /**
     * 删除好物推荐商品
     * @param int $goods_id
     */
    public function delHotGoodsByGoodsId($goods_id) {
        $update = array();
        $update['is_recommend'] = 0;
        $result = Model('goods')->editGoodsById($update, $goods_id);
        $result2 = $this-> where('goods_id='.$goods_id)->delete();
        if ($result&&$result2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 添加好物推荐商品
     * @param int $goods_id
     * @return boolean
     */
    public function addHotGoodsByGoodsId($goods_info,$sort) {
        $update = array();
        $update['is_recommend'] = 1;
        $result = Model('goods')->editGoodsById($update, $goods_info['goods_id']);
        $insert = [
            'goods_id' => $goods_info['goods_id'],
            'store_id' => $goods_info['store_id'],
            'store_name' => $goods_info['store_name'],
            'sort' => $sort
        ];
        $result2 = $this->insert($insert);
        if ($result&&$result2) {
            return true;
        } else {
            return false;
        }
    }
}
