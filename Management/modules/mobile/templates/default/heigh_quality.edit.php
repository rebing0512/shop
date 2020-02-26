<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=heigh_quality&fun=index" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改优品推荐</h3>
                <h5>优品推荐维护</h5>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=heigh_quality&fun=store">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>" />
        <div class="ncap-form-default">

            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>商品ID</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="goods_id" id="goods_id" class="input-txt" value="<?php echo (int)$output['data']['goods_id']; ?>" />
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt" value="<?php echo (int)$output['data']['sort']?:255; ?>" />
                    <span class="err"></span>
                    <p class="notic">自然排序，数字越小越靠前</p>
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
                goods_id: {
                    required: true,
                    number: true
                },
                sort: {
                    required: true,
                    range: [0, 255]
                }
            },
            messages:{

                goods_id:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写商品ID',
                    number:'<i class="fa fa-exclamation-circle"></i>商品ID必须是数字'
                },
                sort:{
                    required:'<i class="fa fa-exclamation-circle"></i>请填写商品排序',
                    range:'<i class="fa fa-exclamation-circle"></i>请填写0-255的数字'
                }
            }
        });
    });
</script>