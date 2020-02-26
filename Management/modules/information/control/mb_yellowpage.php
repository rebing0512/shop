<?php

/*
 *
 * 黄页
 *
 *
 * */


defined('TTShop') or exit('Access Invalid!');

class mb_yellowpageControl extends SystemControl {

    private $category = '';

    public function __construct()
    {
        parent::__construct();

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        foreach ($category['result']['category'] as $item){
            $categoryname[$item['id']] = $item['name'];
        }

        $this->category = $categoryname;

        Tpl::output('category',$category);

        $link = array(
            array('url'=>'con=mb_yellowpage&fun=index&sb_type=pt&type='.$_GET['type'],'text'=>'黄页信息'),
            array('url'=>'con=mb_yellowpage&fun=index&sb_type=new&type='.$_GET['type'],'text'=>'最新上线'),
            array('url'=>'con=mb_yellowpage&fun=index&sb_type=brand&type='.$_GET['type'],'text'=>'热门品牌'),
            array('url'=>'con=mb_yellowpage&fun=index&sb_type=category&type='.$_GET['type'],'text'=>'热点匠人'),
        );

        Tpl::output('link',$this->sublink($link,$_GET['sb_type']?:'pt'));

        Tpl::setDirquna('information');
    }

    //页面展示

    public function indexOp ()
    {
        Tpl::showpage('yellowpage_index');
    }

    //新增

    public function addOp ()
    {
        //var_dump($_POST);exit;

        $model = Model('yellowpage');

        if ($_POST){

            $new_array = array();

            $new_array['name'] = trim($_POST['name']);

            $new_array['first_char'] = trim($_POST['first_char']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['type'] = trim($_GET['type']);

            $new_array['h_type'] = trim($_POST['h_type']);

            $new_array['sb_type'] = trim($_GET['sb_type']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['app_title'] = $_POST['app_title']?:0;

            $new_array['picture'] = trim($_POST['member_avatar']);

            $model->insert($new_array);

            Tpl::showpage('yellowpage_index');

        }

        Tpl::output('action','添加');

        Tpl::showpage('yellowpage_add');
    }

    //编辑

    public function editOp ()
    {
        $model = Model('yellowpage');

        $condetion = array();

        $condetion['id'] = trim($_GET['id']);

        $page = $model->where($condetion)->find();

        if ($_POST){

            $new_array = array();

            $new_array['id'] = trim($_POST['id']);

            $new_array['name'] = trim($_POST['name']);

            $new_array['first_char'] = trim($_POST['first_char']);

            $new_array['sort'] = trim($_POST['sort']);

            $new_array['type'] = trim($_GET['type']);

            $new_array['h_type'] = trim($_POST['h_type']);

            $new_array['url'] = trim($_POST['url']);

            $new_array['app_title'] = $_POST['app_title']?:0;

            $new_array['picture'] = trim($_POST['member_avatar']);

            $model->where('id = '.$new_array['id'])->update($new_array);

            Tpl::showpage('yellowpage_index');


        }

        Tpl::output('action','编辑');

        Tpl::output('page',$page);

        Tpl::showpage('yellowpage_add');
        //
    }

    //删除

    public function deleteOp ()
    {
        $model = Model('yellowpage');

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

    //ajax获取首页列表信息

    public function get_xmlOp(){

        $condition  = array();

        if (!empty($_POST['qtype'])&&!empty($_POST['query']))
        {
            $condition[$_POST['qtype']] = array('like','%'.$_POST['query'].'%');
        }

        if ($_POST['qtype']=='h_type'){
            foreach ($this->category as $key=>$value){
                if (stristr($value,$_POST['query'])){
                    $condition['h_type'] = $key;
                }
            }
        }

        $model_rec = Model('yellowpage');

        $page = new Page();

        $condition['sb_type'] = $_GET['sb_type'];
        $condition['type'] = $_GET['type'];
        $sort_fields = array('sort');
        $order = [];
        if ($_POST['sortorder'] != '' && in_array($_POST['sortname'],$sort_fields)) {
            $order['first_order'] = $_POST['sortname'].' '.$_POST['sortorder'];
        }
        $order['other_order'] = 'id desc';
        $order = implode(',', $order);
        $total_num = $model_rec->where($condition)->order($order)->page($_REQUEST['rp']?:10)->select();
        //$rec_list = $model_rec->getGoodsRecommendList($condition,$_POST['rp'],$order,'count(*) as rec_count,rec_gc_id,min(rec_gc_name) as rec_gc_name,min(rec_id) as rec_id','rec_gc_id','',$total_num);
        $data = array();
        $data['now_page'] = $model_rec->shownowpage();
        $data['total_num'] = $model_rec->gettotalnum();
        foreach ($total_num as $v) {
            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$v['id']})\"><i class='fa fa-trash-o'></i>删除</a><a class='btn blue' href='index.php?con=mb_yellowpage&fun=edit&id={$v['id']}&type={$_GET['type']}'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $list['name'] = $v['name'];
            $list['h_type'] = $this->category[$v['h_type']];
            $list['sort'] = $v['sort'];
            $list['url'] = $v['url'];
            $data['list'][$v['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }

    //hot_brand or hot_category

    public function hotOp()
    {
        $sb_type = $_GET['sb_type'];

        switch ($sb_type){
            case 'brand':
                $sb_type = '品牌';
                break;
            case 'category':
                $sb_type = '品类';
                break;
            default:
                $sb_type = '未配置';
                break;
        }

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();

        $condition = array();

        $condition['position'] = $_GET['sb_type'];

        foreach ($category['result']['category'] as $k=>$item){
            $condition['h_type'] = $item['id'];
            $category['result']['category'][$k]['count'] = Model('index_yellowpage')->where($condition)->count();//以后优化吧
        }

        Tpl::output('doc_list',$category['result']['category']);

        Tpl::output('sb_type',$sb_type);

        Tpl::showpage('hot_list');
    }

    /**
     * 保存
     */
    public function saveOp(){
        $gc_id = intval($_POST['gc_id']);
        if (!chksubmit() || $gc_id <= 0) {
            showMessage('非法提交');
        }
        $model_rec = Model('index_yellowpage');
        $del = $model_rec->where('h_type ='.$gc_id)->delete();
        if (!$del) {
            showMessage('保存失败');
        }
        //var_dump($_POST['goods_id_list']);exit;
        $data = array();
        if (is_array($_POST['goods_id_list'])) {
            foreach ($_POST['goods_id_list'] as $k => $goods_id) {
                $data[$k]['h_type'] = $_POST['gc_id'];
                $data[$k]['remark'] = rtrim($_POST['gc_name'],' >');
                $data[$k]['yellow_id'] = $goods_id;
                $data[$k]['position'] = $_GET['sb_type'];
            }
        }
        $insert = $model_rec->insertall($data);
        if ($insert) {
            header("location: ?con=mb_yellowpage&fun=hot&sb_type={$_GET['sb_type']}&type={$_GET['type']}");
            exit;
        }
    }

    public function hot_editOp(){

        $get = $_GET['sb_type'];
        switch ($get){
            case 'brand':
                $title = '品牌';
                break;
            case 'category':
                $title = '品类';
                break;
            default:
                $title = '未配置';
                break;
        }

        $rec_gc_id = intval($_GET['id']);

        $condition = array();
        $condition['h_type'] = $rec_gc_id;
        $condition['position'] = $_GET['sb_type'];
        $goods_list = array();
        if ($rec_gc_id > 0) {
            $rec_list = Model('index_yellowpage')->where($condition)->select();
            foreach ($rec_list as $item){
                $key[] = $item['yellow_id'];
            }
            if (!empty($rec_list)) {
                $goods_list = Model('yellowpage')->where(array('id'=>array('in',$key)))->select();
                if (!empty($goods_list)) {
                    foreach ($goods_list as $k => $v) {
                        $goods_list[$k]['goods_image'] = $v['picture'];
                    }
                }
            }
        }

        Tpl::output('goods_list_json',json_encode($goods_list));
        Tpl::output('goods_list', $goods_list);
        Tpl::output('rec_info', is_array($rec_list) ? current($rec_list) : array());

        $systemcategoryModel = Model('systemcategory');
        $category = $systemcategoryModel::getSystemCategory();
        Tpl::output('list',$category['result']['category']);
        Tpl::output('title',$title);
        Tpl::showpage('hot');

    }

    public function get_yellow_listOp(){

        $model_goods = Model('yellowpage');
        $condition = array();
        $condition['h_type'] = intval($_GET['gc_id']);
        if (!empty($_GET['goods_name'])) {
            $condition['name'] = array('like',"%{$_GET['goods_name']}%");
        }
        $page = new Page();
        $goods_list = $model_goods->where($condition)->page(8)->select();
        $html = "<ul class=\"dialog-goodslist-s2\">";
        foreach($goods_list as $v) {
            //$url = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
            $img = RESOURCE_SITE_URL.DS.contacts.DS.$v['picture'];
            $html .= <<<EOB
            <li>
            <div class="goods-pic" onclick="select_recommend_goods({$v['id']});">
            <span class="ac-ico"></span>
            <span class="thumb size-72x72">
            <i></i>
            <img width="72" src="{$img}" goods_name="{$v['name']}" goods_id="{$v['id']}" title="{$v['name']}">
            </span>
            </div>
            <div class="goods-name">
            <a target="_blank" href="javascript:void(0);">{$v['name']}</a>
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
}