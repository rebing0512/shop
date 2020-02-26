<?php defined('TTShop') or exit('Access Invalid!'); ?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=store_street" title="返回列表"><i
                    class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改店铺街内容</h3>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=store_street&fun=store" enctype="multipart/form-data">
        <input type="hidden" name="form_submit" value="ok"/>
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>"/>
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>店铺分类</label>
                </dt>
                <dd class="opt">
                    <select name="class_id" id="class_id">

                        <?php foreach ($output['store_class'] as $k=>$v):?>
                            <option value="<?=$k?>" <?php if ($output['data']['class_id']==$k):echo 'selected';endif;?>><?=$v?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="is_open"><em>*</em>店铺状态</label>
                </dt>
                <dd class="opt">
                    <label>
                        <input type="radio" checked="checked" value="0" name="is_open" <?php if ($output['data']['is_open'] == 0){echo 'checked';}?>>
                        关闭</label>
                    <label>
                        <input type="radio" value="1" name="is_open" <?php if ($output['data']['is_open'] == 1){echo 'checked';}?>>
                        开启</label>
                    <span class="err"></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_id"><em>*</em>店铺ID</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="store_id" id="store_id" class="input-txt"
                           value="<?php echo $output['data']['store_id']; ?>"/>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="name" id="name" class="input-txt"
                           value="<?php echo $output['data']['name']; ?>"/>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="url"><em>*</em>url</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="url" id="url" class="input-txt"
                           value="<?php echo $output['data']['url']; ?>"/>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="sort"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt"
                           value="<?php echo $output['data']['sort']; ?>"/>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <input type="hidden" name="alias" id="alias" class="input-txt" value="<?=C('app_alias')?>"/>
            <dl class="row">
                <dt class="tit">
                    <label for="">显示图片</label>
                </dt>
                <dd class="opt">
                    <?php if ($output['data']['logo']): ?>
                        <p>
                            <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_STORE.DS.$output['data']['logo']; ?>" />
                        </p>
                    <?php endif; ?>
                    <div class="input-file-show">
                        <span class="show">
                            <a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL . DS . ATTACH_MOBILE . '/category/' . $output['link_array']['gc_thumb']; ?>">
                                <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL . DS . ATTACH_MOBILE . '/category/' . $output['link_array']['gc_thumb']; ?>>')" onMouseOut="toolTip()"></i>
                            </a>
                        </span>
                        <span class="type-file-box">
                            <input name="logo" type="file" class="type-file-file" id="logo" size="30" hidefocus="true" />
                        </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">已有图片的，如果不需要替换图片请勿上传</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green"
                                id="submitBtn"><?php echo $lang['nc_submit']; ?></a></div>
        </div>
    </form>
</div>
<script>
    $(function () {
        //图片上传
        var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />"
        $(textButton).insertBefore("#logo");
        $("#logo").change(function() {
            $("#textfield1").val($("#logo").val());
        });

        $('#submitBtn').on('click', function () {
            console.log($("#textfield1").val())
            if ($('#form').valid()) {
                $('#form').submit();
            }
        });
        $('#form').validate({
            errorPlacement: function (err, element) {
                var error_id = element.parent('dd').children('span.err');
                error_id.append(err);
            },
            rules: {
                rtype: {
                    required: true
                },
                type: {
                    required: true
                },
                h_type: {
                    required: true
                },
                object: {
                    required: true
                },
                sort: {
                    required: true
                }
            },
            messages: {

                rtype: {
                    required: '<i class="fa fa-exclamation-circle"></i>请填写推荐类型'
                },
                type: {
                    required: '<i class="fa fa-exclamation-circle"></i>请选择推荐类型'
                },
                h_type: {
                    required: '<i class="fa fa-exclamation-circle"></i>请选择核心分类'
                },
                object: {
                    required: '<i class="fa fa-exclamation-circle"></i>请填写商品ID'
                },
                sort: {
                    required: '<i class="fa fa-exclamation-circle"></i>请填写排列顺序'
                }
            }
        });
    });
</script>