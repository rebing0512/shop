<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=index_goods_recommend&fun=index" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改微信端店铺推荐</h3>
                <h5>微信端店铺推荐维护</h5>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=index_store_recommend&fun=store">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>" />
        <div class="ncap-form-default">

            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt" value="<?php echo (int)$output['data']['sort']; ?>" />
                    <span class="err"></span>
                    <p class="notic">自然排序，数字越小越靠前</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>店铺ID</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="store_id" id="store_id" class="input-txt" value="<?php echo $output['data']['store_id']; ?>" />
                    <span class="err"></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="type"><em>*</em>核心分类</label>
                </dt>
                <dd class="opt">
                    <select id="h_type" name="h_type" >
                        <?php foreach ($output['category']['result']['category'] as $k=>$v):?>
                            <option value="<?=$v['id']?>" <?php if ($output['data']['h_type']==$v['id']):echo 'selected';endif;?>><?=$v['name']?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#submitBtn').on('click',function(){
            if($('#form').valid())
            {
                $('#form').submit();
            }
        });
        $('#form').validate({
            errorPlacement:function(err,element){
                var error_id = element.parent('dd').children('span.err');
                error_id.append(err);
            },
            rules: {
                store_id: {
                    required: true
                },
                sort: {
                    required: true
                },
                h_type:{
                    required:true
                }
            },
            messages:{

                store_id:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写店铺ID'
                },
                sort:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写排列顺序'
                },
                h_type:{
                    required:'<i class="fa fa-exclamation-circle"></i>请选择核心分类'
                }
            }
        });
    });
</script>