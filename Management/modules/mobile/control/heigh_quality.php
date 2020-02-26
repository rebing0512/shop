<?php

/**
 * Created by PhpStorm.
 * User: mr_l
 * Date: 2017/12/13
 * Time: 下午3:19
 */
class heigh_qualityControl extends SystemControl
{

    private $fields = 'heigh_quality.id,heigh_quality.goods_id,heigh_quality.sort,goods.goods_name';

    public function __construct()
    {
        parent::__construct();

        $fun = !empty($_GET['fun']) ? $_GET['fun'] : 'index';

        if (!in_array($fun, array('store', 'edit'))) {
            Tpl::setDirquna('mobile');
        }
    }

    public function indexOp()
    {
        Tpl::showpage('heigh_quality.index');
    }

    public function addOp()
    {
        Tpl::showpage('heigh_quality.edit');
    }

    public function editOp()
    {
        $data = $this->only(['id']);

        $data = Model('heigh_quality')->where($data)->find();
        //var_dump($data);
        if (!$data) {
            showMessage('不存在的数据，请勿篡改', '?con=heigh_quality', 'html', 'error');
        }
        Tpl::setDirquna('mobile');

        Tpl::output('data', $data);

        Tpl::showpage('heigh_quality.edit');
    }

    public function storeOp()
    {
        $data = $this->only(array(
            'id', 'goods_id', 'sort'
        ));

        $validate = Model('goods')->where(['goods_id' => $data['goods_id'], 'goods_state' => 1])->find();

        if (!$validate)
        {
            showMessage('商品不存在或商品状态不正常', '?con=heigh_quality', 'html', 'error');
        }

        $model = Model('heigh_quality');
        if (empty($data['id'])) {
            unset($data['id']);
            $model->insert($data);
        } else {
            $id = $data['id'];
            unset($data['id']);
            $model->update($data, array(
                'where' => array(
                    'id' => $id
                )
            ));
        }

        showMessage('操作成功', 'index.php?con=heigh_quality');
    }

    public function deleteOp()
    {
        $data = $this->only(array(
            'del_id'
        ));
        $id = intval($data['del_id']);

        Model('heigh_quality')->where(array(
            'id' => $id
        ))->delete();

        $ret = array(
            'state' => 1,
            'msg' => '操作成功'
        );

        exit(json_encode($ret));
        //var_dump($ret);
    }

    public function get_xmlOp()
    {
        $model = Model();
        $condition = [];
        list($condition, $order) = $this->_get_condition($condition);

        $list = $model->table('heigh_quality,goods')->join('left')->on('heigh_quality.goods_id=goods.goods_id')->where($condition)->order($order)->field($this->fields)->page($_POST['rp']?:10)->select();

        $data = [];
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();

        foreach ($list as $k => $v) {
            $info = [];
            $info['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn red'  href='?con=heigh_quality&fun=edit&id={$v['id']}'><i class='fa fa-edit'></i>编辑</a>";
            $info['id'] = $v['id'];
            $info['goods_id'] = $v['goods_id'];
            $info['goods_name'] = $v['goods_name'];
            $info['sort'] = $v['sort'];

            $data['list'][$v['id']] = $info;
        }
        exit(Tpl::flexigridXML($data));
    }

    /**
     * 封装公共代码
     */
    private function _get_condition($condition)
    {
        $sort_fields = array('id', 'sort');
        $order = array();
        if ($_REQUEST['sortorder'] != '' && in_array($_REQUEST['sortname'], $sort_fields)) {
            $order = 'heigh_quality.' . $_REQUEST['sortname'] . ' ' . $_REQUEST['sortorder'];
        }
        return array(array(), $order);
        //var_dump($order);
    }
}