<?php defined('TTShop') or exit('Access Invalid!'); ?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=index_topslide_recommend" title="返回列表"><i
                    class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改首页顶部幻灯广告</h3>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=index_topslide_recommend&fun=store" enctype="multipart/form-data">
        <input type="hidden" name="form_submit" value="ok"/>
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>"/>
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>推荐类型</label>
                </dt>
                <dd class="opt">
                    <select name="rtype" id="rtype">

                        <?php foreach ($output['rtypes'] as $k=>$v):?>
                            <option value="<?=$k?>" <?php if ($output['data']['rtype']==$k):echo 'selected';endif;?>><?=$v?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>关联核心分类</label>
                </dt>
                <dd class="opt">
                    <select class="input-txt" name="h_type" id="h_type">
                        <option value="">请选择</option>
                        <?php foreach ($output['category'] as $type_name): ?>
                            <option value="<?php echo $type_name['id']; ?>" <?php if (!is_null($output['data']['h_type']) && $type_name['id'] == $output['data']['h_type']) echo 'selected'; ?>><?php echo $type_name['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">选择核心分类</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>选择推荐类型</label>
                </dt>
                <dd class="opt">
                    <select class="input-txt" name="type" id="type">
                        <option value="">请选择</option>
                        <?php foreach ($output['type'] as $type_id => $type_name): ?>
                            <option
                                value="<?php echo $type_id; ?>" <?php if (!is_null($output['data']['type']) && $type_id == $output['data']['type']) echo 'selected'; ?>><?php echo $type_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">选择推荐类型</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>跳转对象</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="object" id="object" class="input-txt"
                           value="<?php echo $output['data']['object']; ?>"/>
                    <span class="err"></span>
                    <p class="notic">根据推荐类型填写，如：推荐类型商品此处填写商品SKU，推荐专题此处填写专题ID，固定网址此处填写网址</p>
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
                    <label for="ac_name"><em>*</em>价格/简介</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="price" id="price" class="input-txt"
                           value="<?php echo $output['data']['price']; ?>"/>
                    <span class="err"></span>
                    <p class="notic">如果填写价格，请在数字前添加"¥"</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="">显示图片</label>
                </dt>
                <dd class="opt">
                    <?php if ($output['data']['link_pic']): ?>
                    <p>
                        <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.$output['data']['link_pic']; ?>" />
                    </p>
                    <?php endif; ?>
                    <div class="input-file-show">
                        <span class="show">
                            <a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL . DS . ATTACH_MOBILE . '/category/' . $output['link_array']['gc_thumb']; ?>">
                                <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL . DS . ATTACH_MOBILE . '/category/' . $output['link_array']['gc_thumb']; ?>>')" onMouseOut="toolTip()"></i>
                            </a>
                        </span>
                        <span class="type-file-box">
                            <input name="link_pic" type="file" class="type-file-file" id="link_pic" size="30" hidefocus="true" />
                        </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">已有图片的，如果不需要替换图片请勿上传</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="ac_name"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt"
                           value="<?php echo (int)$output['data']['sort']; ?>"/>
                    <span class="err"></span>
                    <p class="notic">自然排序，数字越小越靠前</p>
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
        $(textButton).insertBefore("#link_pic");
        $("#link_pic").change(function() {
            $("#textfield1").val($("#link_pic").val());
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