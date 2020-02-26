<?php defined('TTShop') or exit('Access Invalid!'); ?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="index.php?con=great_store" title="返回列表"><i
                    class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增/修改好店内容</h3>
            </div>
        </div>
    </div>

    <form id="form" method="post" action="index.php?con=great_store&fun=store" enctype="multipart/form-data">
        <input type="hidden" name="form_submit" value="ok"/>
        <input type="hidden" name="id" value="<?php echo $output['data']['id']; ?>"/>
        <div class="ncap-form-default">
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
                    <label for="sort"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="sort" id="sort" class="input-txt"
                           value="<?php echo $output['data']['sort']; ?>"/>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green"
                                id="submitBtn"><?php echo $lang['nc_submit']; ?></a></div>
        </div>
    </form>
</div>
<script>
    $(function () {

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
                store_id: {
                    required: true
                },
                sort: {
                    required: true
                }
            },
            messages: {

                store_id: {
                    required: '<i class="fa fa-exclamation-circle"></i>请填写店铺ID'
                },
                sort: {
                    required: '<i class="fa fa-exclamation-circle"></i>请填写排列顺序'
                }
            }
        });
    });
</script>