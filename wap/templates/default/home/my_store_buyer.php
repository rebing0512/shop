<?php defined( 'TTShop') or exit( 'Access Invalid!');?>
		<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/jquery-weui.min.css" />
		<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/weui.min.css" />
<style type="text/css">
    .weui_panel_sq {
        background-color: rgba(0, 0, 0, 0);
    }


    .weui_panel_sq .weui_media_hd img {
        border-radius: 50%;
    }

    .weui_panel_sq .weui_media_bd span {
        font-size: 1.2rem;
        color: gray;
    }

    .weui_panel_sq .weui_media_ft img {
        width: 1rem;
    }

    .weui-row {
        text-align: center;
        background-color: white;
    }
    .weui-row_padding{
        padding: 0.7rem 0rem;
    }
    .weui-row1 {
        background-color: rgba(0, 0, 0, 0.2);
    }
    .weui_panel_sq .weui_media_box {
        padding: 2.1rem;
        padding-left: 0.6rem;
    }
    .section_bady_nav_sq .nav_gengduo{
        float: right;
        margin-right: 0.5rem;
    }
    .weui_panel_sq .weui_media_text {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .weui_panel_sq .weui_media_text1 {
        font-size: 0.65rem;
    }

    .weui-row1 a {
        color: white;
        font-size: 0.7rem;

    }

    .weui-row1 .weui-col-33 {
        border-right: 1px solid gainsboro;
    }

    .weui-row1 .weui-col-33:nth-child(3n) {
        border-right: none;
    }

    .section_body_sq {
        margin: 0.7rem auto;
        width: 100%;
    }

    .section_body_sq .weui_btn_default {
        padding: 0.25rem 0rem;
        border-radius: 0px;
        background-color: white;
        color: #6C958D;
        font-size: 0.61rem;
    }
    .weui-row_sq{
        padding: 0.7rem 0rem;
    }
    .weui-row_sq .weui-col-33 em {
        font-size: 1rem;
        font-family: "微软雅黑";
        font-style: normal;
        display: block;
        color: gray;
    }

    .weui-row_sq .weui-col-33 img {
        width: 1.8rem;
    }

    .weui_cells_checkbox .weui_check:checked+.weui_icon_checked:before {
        color: #1E7D67;
    }
   .weui_panel_sq .weui_media_box.weui_media_appmsg .weui_media_hd {
        margin-right: .8em;
        width: 70px;
        height: 70px;
        line-height: 70px;
        text-align: center;
    }
    .weui_panel_sq .weui-row.weui-no-gutter .weui-col-33 {
        width: 33.333333333333336%;
        margin: 0.2rem 0rem;
    }
    a.weui_media_box:active {
        background-color: rgba(0, 0, 0, 0);
    }

    .weui_panel_sz img {
        border-radius: 50%;
    }

    .weui_panel_sz .weui_media_text {
        font-size: 1.2rem;
    }

    .weui_panel_sz .weui_media_text1 {
        font-size: 1rem;
        color: gray;
    }

    .weui-row_sq .weui-col-20 em {
        font-size: 0.6rem;
        font-family: "微软雅黑";
        font-style: normal;
        display: block;
        color: gray;
    }

    .weui-row_sq .weui-col-20 img {
        width: 1rem;
    }

    .section_bady_nav_sq {
        height: 2rem;
        font-size: 0.61rem;
        padding-left: 1rem;
        line-height: 2rem;
        color: black;
        background-color: white;
        border-bottom: 1px solid #E6E6E6;
    }

    .section_bady_nav_sq img {
        width: 1rem;
        vertical-align: middle;
    }

</style>
	</head>

	<body>
		<section>
			<div class="weui_panel_img">
			<div class="weui_panel weui_panel_sq weui_panel_access">
				<div class="weui_panel_bd">
					<a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
						<div class="weui_media_hd">
							<img class="weui_media_appmsg_thumb" src="<?php echo MOBILE_TEMPLATES_URL;?>/images/pinglun_img.jpg" alt="">
						</div>
						<div class="weui_media_bd">
							<p class="weui_media_text">明天你好</p>
						    <p class="weui_media_text1">买家中心</p>
						</div>
						<div class="weui_media_ft"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/set.png"></div>
					</a>
				</div>
			</div>
			<div class="weui-row weui-row1 weui-no-gutter">
				<div class="weui-col-33">
					<a href="javascript:;">
						<p>7</p>
						<p>等级</p>
					</a>
				</div>
				<div class="weui-col-33">
					<a href="javascript:;">
						<p>0</p>
						<p>关注</p>
					</a>
				</div>
				<div class="weui-col-33">
					<a href="javascript:;">
						<p>0</p>
						<p>粉丝</p>
					</a>
				</div>
			</div>
			</div>
			<!--切换至卖家中心-->
			<div class="section_body section_body_sq">
				<a href="my_store_seller.php" class="weui_btn weui_btn_disabled weui_btn_default">至卖家中心</a>
			</div>
			<!--全部订单-->
			
				<div class="secction_body">
				<div class="section_bady_nav section_bady_nav_sq">
					<!--<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/myshop.png">-->
					全部订单
					<span class="nav_gengduo"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/arrow.png"></span>
				</div>

				<div class="weui-row weui-no-gutter weui-row_sq weui-row_padding">
					<div class="weui-col-20">
						<a href="JavaScript:;">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/paymoney.png">
							<em>待付款</em>
						</a>
					</div>
					<div class="weui-col-20">
						<a href="JavaScript:;">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/sendpro.png">
							<em>待发货</em>
						</a>
					</div>
					<div class="weui-col-20">
						<a href="JavaScript:;">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/daishouhuo.png">
							<em>待收货</em>
						</a>
					</div>
					<div class="weui-col-20">
						<a href="JavaScript:;">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/yishouhuo.png">
							<em>已收货</em>
						</a>
					</div>
					<div class="weui-col-20">
						<a href="JavaScript:;">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/my_img/6.png">
							<em>退款/退货</em>
						</a>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-2.1.0.js" ></script>
		 <script type="text/javascript">
		    	$(".weui_media_ft").click(function(){
		    		location.href="my_store_set.html";
		    	})
		    </script>
	</body>

</html>