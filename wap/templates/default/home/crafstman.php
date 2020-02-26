<?php defined('TTShop') or exit('Access Invalid!'); ?>
</head>
<body>
<?php if (!$output['client']): ?>
    <header id="header" class="fixed">

        <div class="header-wrap">

            <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

            <div class="header-title">

                <h1><?= $output['main']['web_title'] ?></h1>

            </div>

        </div>

    </header>
    <style>
        .section_nav_img1 {
            margin-top: 1.95rem;
        }
    </style>
<?php endif; ?>
<!--			<header class="head">-->
<!--			<div class="fanhui">-->
<!--				<a href="javascript:history.go(-1);"><img src="-->
<?php //echo MOBILE_TEMPLATES_URL;?><!--/images/crafstman/fanhui.png"></a>-->
<!--			</div>-->
<!--			<span class="span1">巧匠营</span>-->
<!--		</header>-->
<div class="section_nav_img1">
    <img src="<?= UPLOAD_SITE_URL . DS . ATTACH_AVATAR . DS . $output['main']['picture'] ?>">
</div>
<div class="clever_artisan_nav">
    <div class="clever_artisan_nav_hd" style="font-weight:bolder;">
        <span style="font-weight:bolder;">|</span><?= $output['main']['name'] ?>
    </div>
    <div class="clever_artisan_nav_bd">
        <?= $output['main']['intro'] ?>
    </div>
</div>
<?php if (!empty($output['mark'])): ?>
    <a href="<?= $output['mark']['url'] ?: 'javascript:;'; ?>">
        <div class="clever_artisan_head" style="padding-bottom: 0.8rem;">
            <img src="<?= UPLOAD_SITE_URL . DS . ATTACH_AVATAR . DS . $output['mark']['picture'] ?>">
            <p class="clever_artisan_head_txt"><?= $output['mark']['intro'] ?></p>
        </div>
    </a>
<?php endif; ?>
<div class="clever_artisan_body">
    <?php foreach ($output['information'] as $item): ?>
        <div class="section_nav_img2">
            <a href="javascript:;" data-url="<?= $item['url'] ?>" data-title="<?= $item['title'] ?>">
                <img src="<?= UPLOAD_SITE_URL . DS . ATTACH_AVATAR . DS . $item['picture'] ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="fix-block-share" style="bottom:0.6rem;">
    <a href="javascript:void(0);" class="" id="fullshare"><i></i></a>
</div>
</body>
</html>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/zepto.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/layer/layer.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<script>
    $('a[data-url]').on('click', function () {
        if ($(this).attr('data-url') != '') {
            window.MBC.openNew({
                url: $(this).attr('data-url') + '&domain=' + window.location.href,
                pageTitle: $(this).attr('data-title') || '<?=$output['main']['web_title']?>'
            });
            return false;
        }
    });
    $('.back').on('click', function () {
        window.MBC.back();
        return false;
    })
    $('#fullshare').click(function () {
        var scfg = {
            title: '<?=$output['title'] ?: '巧匠营'?>',
            image: '<?php echo MOBILE_TEMPLATES_URL; ?>/images/<?=C('app_alias')?>.jpg',
            url: get_share_url(window.location.href),
            description: '<?=$output['title'] ?: '巧匠营'?>首页',
            success: function (rd) {
                $('.share-mask').remove();
                try {
                    if (typeof(rd) !== 'object')
                        rd = JSON.parse(rd);
                    if (rd.code == 0) {
                        layer.open({
                            content: '分享失败',
                            time: 1.5
                        })
                        return false;
                    } else {
                        layer.open({
                            content: '分享成功',
                            time: 1.5
                        })
                    }
                } catch (e) {
                    layer.open({
                        content: '取消分享',
                        time: 1.5
                    })
                }
            }
        };

        window.MBC.share(scfg);
    })
</script>