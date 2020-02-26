<?php

/*
 *
 * 推荐
 *
 *
 * */


defined('TTShop') or exit('Access Invalid!');

class mb_recommendControl extends SystemControl
{

    public function __construct()
    {

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('category', $category['result']['category']);
		
		$category_name = array();
		foreach ($category['result']['category'] as $item){
            $category_name[$item['id']] =$item['name'];
        }
		Tpl::output('category_name', $category_name);
		
        parent::__construct();
        Tpl::setDirquna('information');
    }

    public function indexOp(){
        $model = Model('recommend_type');
        $type = $model->order('id asc')->select();
        Tpl::output('type',$type);
        Tpl::showpage('recommend_type');
    }
    /**
     * 删除分类
     */
    public function type_delOp(){
        if ($_GET['id'] != ''){
            $id = explode(',', $_GET['id']);
            //删除分类
            Model('recommend_type')->where(array('id'=>array('in',$id)))->delete();
            //$this->log(L('nc_delete,goods_class_index_class') . '[ID:' . $_GET['id'] . ']',1);
            exit(json_encode(array('state'=>true,'msg'=>'删除成功')));
        }else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }

    public function type_addOp(){
        $model = Model('recommend_type');
        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['h_type'] = trim($_POST['h_type']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $model->insert($new_array);

            $this->indexOp();

        }
        Tpl::showpage('recommend_type_add');
    }

    public function type_editOp(){
        $model = Model('recommend_type');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['h_type'] = trim($_POST['h_type']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['picture'] = trim($_POST['member_avatar']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            $this->indexOp();

        }

        Tpl::output('data',$page);
        Tpl::showpage('recommend_type_add');
    }
    public function tagOp(){
        Tpl::showpage('tag');
    }
    public function tag_addOp(){
        $model = Model('recommend_tag');

        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['type'] = trim($_GET['type']);

            $model->insert($new_array);

            Tpl::showpage('tag');

        }

        Tpl::showpage('tag_add');
    }
    public function tag_editOp(){
        $model = Model('recommend_tag');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['type'] = trim($_GET['type']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            Tpl::showpage('tag');


        }

        Tpl::output('data',$page);

        Tpl::showpage('tag_add');
    }
    public function tag_delOp(){
        $model = Model('recommend_tag');

        $condetion = array();

        $condetion['id'] = trim($_GET['del_id']);

        $handel = $model->where($condetion)->delete();

        if ($handel){
            $ret = array(
                'state' => 1,
                'msg' => '操作成功'
            );

            exit(json_encode($ret));
        }
    }
    public function tag_get_xmlOp(){

        $model_rec = Model('recommend_tag');

        $page = new Page();

        $condition  = array();
        $condition['type'] = $_GET['type'];
        $total_num = $model_rec->where($condition)->order('sort asc')->page($_REQUEST['rp']?:10)->select();
        //$rec_list = $model_rec->getGoodsRecommendList($condition,$_POST['rp'],$order,'count(*) as rec_count,rec_gc_id,min(rec_gc_name) as rec_gc_name,min(rec_id) as rec_id','rec_gc_id','',$total_num);
        $data = array();
        $data['now_page'] = $model_rec->shownowpage();
        $data['total_num'] = $model_rec->gettotalnum();
        foreach ($total_num as $v) {
            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['id']})\"><i class='fa fa-trash-o'></i>删除</a><span class=\"btn\">
                                <em>
                                    <i class=\"fa fa-cog\">

                                    </i>
                                    操作
                                    <i class=\"arrow\">

                                    </i>
                                </em><ul>
              <li><a href=\"index.php?con=mb_recommend&fun=tag_edit&type={$_GET['type']}&id={$v['id']}\">编辑标签信息</a></li>
              <li><a href=\"index.php?con=mb_recommend&fun=goods_edit&tag={$v['id']} \">编辑推荐商品</a></li>
            </ul>";
            $list['name'] = $v['name'];
            $list['sort'] = $v['sort'];
            $list['url'] = $v['url'];
            $data['list'][$v['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }
    public function get_goods_listOp(){
        $model_goods = Model('goods');
        $condition = array();
        $tag = intval($_GET['gc_id']);
        $type = Model('recommend_tag')->where('id ='.$tag)->find();
        $cate = Model('recommend_type')->where('id ='.$type['type'])->find();
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
//        foreach ($category['result']['category'] as $item){
//            if ($item['id'] == $cate['h_type']){
//                $condition['category_id'] = $item['id'];
//            }
//        }
        //category查询
        if (!empty($_GET['goods_name'])) {
            $condition['goods_name'] = array('like',"%{$_GET['goods_name']}%");
        }
        $goods_list = $model_goods->getGoodsOnlineList($condition,'*',8);
        $html = "<ul class=\"dialog-goodslist-s2\">";
        foreach($goods_list as $v) {
            $url = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
            $img = thumb($v,240);
            $html .= <<<EOB
            <li>
            <div class="goods-pic" onclick="select_recommend_goods({$v['goods_id']});">
            <span class="ac-ico"></span>
            <span class="thumb size-72x72">
            <i></i>
            <img width="72" src="{$img}" goods_name="{$v['goods_name']}" goods_id="{$v['goods_id']}" title="{$v['goods_name']}">
            </span>
            </div>
            <div class="goods-name">
            <a target="_blank" href="{$url}">{$v['goods_name']}</a>
            </div>
            </li>
EOB;
        }
        $admin_tpl_url = ADMIN_TEMPLATES_URL;
        $html .= '<div class="clear"></div></ul><div id="pagination" class="pagination">'.$model_goods->showpage(1).'</div><div class="clear"></div>';
        $html .= <<<EOB
        <script>
        $('#pagination').find('.demo').ajaxContent({
                event:'click',
                loaderType:"img",
                loadingMsg:"{$admin_tpl_url}/images/transparent.gif",
                target:'#show_recommend_goods_list'
            });
        </script>
EOB;
        echo $html;
    }
    public function goods_editOp(){
        $rec_gc_id = intval($_GET['tag']);
        $goods_list = array();
        if ($rec_gc_id > 0) {
            $rec_list = Model('recommend_goods')->getGoodsRecommendList(array('rec_gc_id'=>$rec_gc_id),'','','*','','rec_goods_id');
            if (!empty($rec_list)) {
                $goods_list = Model('goods')->getGoodsOnlineList(array('goods_id'=>array('in',array_keys($rec_list))),'goods_name,goods_id,goods_image');
                if (!empty($goods_list)) {
                    foreach ($goods_list as $k => $v) {
                        $goods_list[$k]['goods_image'] = thumb($v,240);
                    }
                }
            }
        }
        Tpl::output('goods_list_json',json_encode($goods_list));
        Tpl::output('goods_list', $goods_list);
        Tpl::output('rec_info', is_array($rec_list) ? current($rec_list) : array());

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('category',$category);
        Tpl::showpage('goods_edit');
    }

    /**
     * 保存
     */
    public function saveOp(){
        $gc_id = intval($_POST['gc_id']);
        if (!chksubmit() || $gc_id <= 0) {
            showMessage('非法提交');
        }
        $model_rec = Model('recommend_goods');
        $han = $model_rec->where(array('rec_gc_id' => $gc_id))->select();
        $del = $model_rec->delGoodsRecommend(array('rec_gc_id' => $gc_id));
        if (!$del) {
            showMessage('保存失败');
        }
        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        $data = array();
        if (is_array($_POST['goods_id_list'])) {
            foreach ($_POST['goods_id_list'] as $k => $goods_id) {
                $data[$k]['rec_gc_id'] = $_POST['gc_id'];
                $data[$k]['rec_gc_name'] = rtrim($_POST['gc_name'],' >');
                $data[$k]['rec_goods_id'] = $goods_id;
                $data[$k]['h_type'] = $_POST['gc_id'];
                foreach ($category['result']['category'] as $item){
                    if ($item['id'] == $_POST['gc_id']){
                        $data[$k]['rec_gc_name'] = $item['name'];
                    }
                }
            }
        }
        $insert = $model_rec->addGoodsRecommend($data);
        if ($insert) {
            $id = Model('recommend_tag')->where('id ='.$gc_id)->find();

            header('location:index.php?con=mb_recommend&fun=tag&type='.$id['type']);
        }
    }
}
