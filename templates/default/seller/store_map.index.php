<?php defined('TTShop') or exit('Access Invalid!'); ?>

<!--<div class="tabmenu">-->
<!--  --><?php //if (is_array($output['map_list']) && count($output['map_list']) < 20) { ?>
<!--  <a class="ncbtn ncbtn-mint" nc_type="dialog" dialog_title="添加地址" dialog_id="add_map" dialog_width="480" uri="--><?php //echo urlShop('store_map', 'add_map');?><!--"><i class="icon-plus-sign"></i>添加地址</a>-->
<!--  --><?php //} ?>
<!--</div>-->

<div class="col-md-6">
    <div class="form-group">
        <h6>快捷搜索</h6>
        <input class="form-control address" placeholder="输入地址进行搜索" id="address" name="address" type="text">
        <a class="ncbtn ncbtn-mint search" type="button">搜索</a>
    </div>
    <div class="help-block">
        当前选定位置：<span id="selected-location">尚未选择任何位置</span>
    </div>
    <div id="map" style="height:400px;width: 400px;border:1px solid gray"></div>
    <p>点击地图获得经纬度信息</p>
    <div class="eject_con" style="top: 131px;width: 500px;position: absolute;margin-left: 410px;">
        <div id="warning" class="alert alert-error"></div>
        <form id="post_form" method="post" action="index.php?con=store_map&fun=edit_map">
            <input type="hidden" name="form_submit" value="ok"/>
            <input type="hidden" name="lat" class="lat" id="lat">
            <input type="hidden" name="lng" class="lng" id="lng">
            <dl>
                <dt><i class="required">*</i>实体店铺名称<?php echo $lang['nc_colon']; ?></dt>
                <dd>
                    <input class="text w200" type="text" name="name_info"
                           value="<?php echo $output['map']['name_info']; ?>"/>
                    <p class="hint">不同地址建议使用不同名称以示区别，如“山西面馆(水游城店)”。</p>
                </dd>
            </dl>
            <dl>
                <dt><i class="required">*</i>详细地址<?php echo $lang['nc_colon']; ?></dt>
                <dd>
                    <input class="text w200" type="text" name="address_info" id="address_info"
                           value="<?php echo $output['map']['address_info']; ?>"/>
                    <p class="hint">为了准确定位建议地址加上所在城区名字，如“红桥区大丰路18号水游城”。</p>
                </dd>
            </dl>
            <dl>
                <dt>联系电话<?php echo $lang['nc_colon']; ?></dt>
                <dd>
                    <input class="text w200" type="text" name="phone_info"
                           value="<?php echo $output['map']['phone_info']; ?>"/>
                </dd>
            </dl>
            <dl>
                <dt>公交信息<?php echo $lang['nc_colon']; ?></dt>
                <dd>
                    <textarea name="bus_info" rows="2"
                              class="textarea w300"><?php echo $output['map']['bus_info']; ?></textarea>
                </dd>
            </dl>
            <div class="bottom">
                <label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_ok']; ?>"/></label>
            </div>
        </form>
    </div>
</div>
<script src="https://<?= C('app_alias') ?>bbs.confolsc.com/assets/js/MBCoreMap.js?_=<?= uniqid() ?>"></script>
<script type="text/javascript"
        src="https://map.qq.com/api/js?v=2.exp&key=PMDBZ-G3LH4-KEPUP-XNDEB-DQCH7-JGBWR&callback=initmap"></script>
<script type="text/javascript">
    $(function () {
        $('#post_form').validate({
            errorLabelContainer: $('#warning'),
            invalidHandler: function (form, validator) {
                $('#warning').show();
            },
            submitHandler: function (form) {
                ajaxpost('post_form', '', '', 'onerror');
            },
            rules: {
                name_info: {
                    required: true
                },
                address_info: {
                    required: true
                }
            },
            messages: {
                name_info: {
                    required: '<i class="icon-exclamation-sign"></i>实体店铺名称不能为空'
                },
                address_info: {
                    required: '<i class="icon-exclamation-sign"></i>详细地址不能为空'
                }
            }
        });
    });
</script>