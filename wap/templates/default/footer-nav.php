

    <div class="foot-nav nav_body"
         style="display: block; transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <div class="foot-nav-body">
            <a href="<?= $output['discover'] ?>"><i class="home"></i><span class="home">首页</span></a>
            <a href="<?= $output['bbs_url'] ?>"><i class="cate"></i><span class="cate"><?= $output['faxian'] ?></span></a>
                <a href="<?= $output['shop_index'] ?>" style="position: relative;bottom: 4px;">
                <i style="background-position: -58px -2px;background-size: 151px 64px;width: 36px;height: 36px;"></i><span
                            style="top: -6px;" class="weui-row_active"><?= $output['shop_name'] ?></span>
                    <div class="huomiao">
                        <div class="huomiao_a"></div>
                    </div>
            </a>
            <a href="<?= $output['develop_url'] ?>"><i class="cart"></i><span
                        class="cart"><?= $output['chat_name'] ?></span></a>
<!--            --><?php //else: ?>
<!--                <a href="--><?//= $output['develop_url'] ?><!--" style="position: relative;bottom: 4px;">-->
<!--                    <i style="background-position: -58px -2px;background-size: 151px 64px;width: 36px;height: 36px;"></i><span-->
<!--                            style="top: -6px;" class="weui-row_active">艺盟</span>-->
<!--                    <div class="huomiao">-->
<!--                        <div class="huomiao_a"></div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="--><?//= $output['shop_index'] ?><!--"><i class="cart"></i><span-->
<!--                            class="cart weui-row_active">--><?//= $output['shop_name'] ?><!--</span></a>-->
<!--            --><?php //endif; ?>
            <!--
        <a href="<?php //echo urlMOBILE('goods_class');?>"><i style="background-position: -72px 0;"></i><span>品类</span></a>
        -->
            <a href="https://gateway.confolsc.com/passport/home?appid=<?= C('app_alias') ?>"><i class="user"></i><span
                        class="user">我的</span></a>
        </div>
    </div>


