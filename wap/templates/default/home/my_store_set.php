<?php defined('TTShop') or exit('Access Invalid!'); ?>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/jquery-weui.min.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/weui.min.css" />
<style type="text/css">
    .morenjinru {
        height: 2rem;
        line-height: 2rem;
        width: 100%;
        font-size:0.7rem;
        margin-left: 1rem;
        color: #6A938A;
        background-color: white;
    }
    .weui_panel_sz .weui_media_text {
        font-size: 0.8rem;
    }

    .weui_panel_sz .weui_media_text1 {
        font-size: 0.65rem;
        color: gray;
    }
    .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before {
        color: #1E7D67;
    }
    a.weui_media_box:active {
        background-color: rgba(0, 0, 0, 0);
    }

    .weui_panel_sz img {
        border-radius: 50%;
    }
.weui_cells_sz .weui_cell_bd p{
    font-size: 0.6rem;
}
    .weui_cells_checkbox .weui_icon_checked:before{
        font-size: 20px;
    }
</style>
</head>
<body>
<!--主体部分-->
<section>
    <div class="weui_panel weui_panel_sz weui_panel_access ste_white">
        <div class="weui_panel_bd">
            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_hd">
                    <img class="weui_media_appmsg_thumb" src="<?php echo MOBILE_TEMPLATES_URL;?>/images/pinglun_img.jpg" alt="">
                </div>
                <div class="weui_media_bd">
                    <p class="weui_media_text">明天你好</p>
                    <p class="weui_media_text1">拍卖设置中心</p>
                </div>

            </a>
        </div>
    </div>

    <div class="weui_cells weui_cells_sz weui_cells_checkbox">
        <!--点击我的商城默认进入-->
        <div class="morenjinru">
            点击“我的商城”默认进入
        </div>

        <label class="weui_cell weui_check_label" for="s11">
            <div class="weui_cell_hd">
                <input type="radio" class="weui_check" name="radio1" id="s11" checked="checked">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>默认为买家中心</p>
            </div>
        </label>

        <label class="weui_cell weui_check_label" for="s12">
            <div class="weui_cell_hd">
                <input type="radio" name="radio1" class="weui_check" id="s12">
                <i class="weui_icon_checked"></i>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>默认为卖家中心</p>
            </div>
        </label>
    </div>
</section>
</body>

</html>