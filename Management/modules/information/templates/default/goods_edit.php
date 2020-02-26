<?php defined('TTShop') or exit('Access Invalid!');?>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.go(-1);" title="返回商品分类推荐列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>商品推荐 - <?php echo $_GET['rec_gc_id'] ? '编辑“'.$output['rec_info']['rec_gc_name'].'"下的推荐商品' : '新增分类推荐商品';?></h3>
                <h5>商品列表页面推荐商品管理</h5>
            </div>
        </div>
    </div>
    <form id="goods_form" method="post" action='index.php?con=mb_recommend&fun=save'>
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="gc_id" value="<?=$output['rec_info']['rec_gc_id']>0?$output['rec_info']['rec_gc_id']:$_GET['tag'];?>" />
        <div class="ncap-form-default" id="explanation">
            <dl class="row">
                <dt class="tit">
                    <label><em>*</em>商品推荐</label>
                </dt>
                <dd class="opt">
                    <input type="text" placeholder="搜索商品名称" value="" name="goods_name" id="goods_name" maxlength="20" class="input-txt">
                    <a id="goods_search" href="JavaScript:void(0);" class="ncap-btn mr5"><?php echo $lang['nc_search'];?></a></dd>
            </dl>
            <dl class="row" id="selected_goods_list">
                <dt class="tit">已推荐商品</dt>
                <dd class="opt">
                    <input type="hidden" name="valid_recommend" id="valid_recommend" value="">
                    <span class="err"></span>
                    <ul class="dialog-goodslist-s1 goods-list scrollbar-box">
                    </ul>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">选择要推荐的商品</dt>
                <dd class="opt">
                    <div id="show_recommend_goods_list" class="show-recommend-goods-list scrollbar-box"></div>
                    <!--<p class="notic">最多可推荐4个商品</p>-->
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
        </div>
    </form>
</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
<script>
    $(function(){

        var gc = $('#gc_id').val();

        $("#submitBtn").click(function(){
            if ($('input[name="goods_id_list[]"]').size() == 0) {
                $('#valid_recommend').rules('add',{
                    required: true,
                    messages: {required : '<i class="fa fa-exclamation-circle"></i>请选择推荐商品'}
                });
            }else{
                $('#valid_recommend').rules('remove');
            }

            if($("#goods_form").valid()){

                $("#goods_form").submit();
            }
        });
        var gc_id = <?php echo $_GET['tag']?>;
        $('#goods_search').on('click',function(){
            $('#valid_recommend').rules('remove');
            if($("#goods_form").valid()){
                $('#show_recommend_goods_list').load('index.php?con=mb_recommend&fun=get_goods_list&gc_id='+gc_id+'&goods_name='+$('#goods_name').val());
            }
        });

        //表单验证
        $('#goods_form').validate({
            errorPlacement: function(error, element){
                var error_td = element.parent('dd').children('span.err');
                error_td.append(error);
            }
        });

    });
    function select_recommend_goods(goods_id) {
        if (typeof goods_id == 'object') {
            var goods_name = goods_id['goods_name'];
            var goods_pic = goods_id['goods_image'];
            var goods_id = goods_id['goods_id'];
        } else {
            var goods = $("#show_recommend_goods_list img[goods_id='"+goods_id+"']");
            var goods_pic = goods.attr("src");
            var goods_name = goods.attr("goods_name");
        }
        var obj = $("#selected_goods_list");
        if(obj.find("img[goods_id='"+goods_id+"']").size()>0) return;//避免重复
        /*if(obj.find("ul>li").size()>=4){
            alert('最多可推荐4个商品');
            return false;
        }*/
        var text_append = '';
        text_append += '<div onclick="del_recommend_goods(this,'+goods_id+');" class="goods-pic">';
        text_append += '<span class="ac-ico"></span>';
        text_append += '<span class="thumb size-72x72">';
        text_append += '<i></i>';
        text_append += '<img width="72" goods_id="'+goods_id+'" title="'+goods_name+'" goods_name="'+goods_name+'" src="'+goods_pic+'" />';
        text_append += '</span></div>';
        text_append += '<div class="goods-name">';
        text_append += '<a href="<?php echo SHOP_SITE_URL?>/index.php?con=goods&goods_id='+goods_id+'" target="_blank">';
        text_append += goods_name+'</a>';
        text_append += '</div>';
        text_append += '<input name="goods_id_list[]" value="'+goods_id+'" type="hidden">';
        obj.find("ul").append('<li>'+text_append+'</li>');
        <?php if (!$_GET['rec_gc_id']) { ?>
        $('#gc_id').val($('#gcategory').children('select').last().val());
        <?php } ?>
    }
    function del_recommend_goods(obj,goods_id) {
        $(obj).parent().remove();
    }

    var goods_list_json = $.parseJSON('<?php echo $output['goods_list_json'];?>');
    $.each(goods_list_json,function(k,v){
        select_recommend_goods(v);
    });
</script>
