<?php defined('TTShop') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/cropper.css">
</head>

<body>

<?php if (in_array($output['platform'], ['android', 'ios'])) : ?>

    <header id="header">

        <div class="header-wrap">

            <div class="header-l"> <a href="javascript:;"> <i class="back"></i> </a> </div>

            <div class="header-title">

                <h1>保存店铺头像</h1>

            </div>

            <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>

        </div>

        <?php include template('layout/toptip');?>





    </header>

<?php endif;?>

<div class="nctouch-main-layout">

  <div class="tx-box">

 <div class="tx-toux update-touxiang"><img id="image" data-id="<?=$output['store_ava']?>" src="<?php echo $output['store_avatar'];?>" height="140" width="140"></div>

    <div id="update-touxiang" class="update-touxiang">保存头像</div>

    <script>
        var uploadApiUrl = '<?=urlMobile('member_account','ajax_update_img')?>'
        $(function () {
            $('#image').on('click', function (event) {
                console.log(111);
                event.stopPropagation();
                var uploadedCount = $('#images').find('.image').length;
                if (1-uploadedCount<=0) {
                    layer.open({
                        content:'最多只能选择9张图片',
                        time:1.5
                    });
                    //$.toptip('最多只能选择9张图片',800,'error');
                    return false;
                }
                window.MBC.chooseImage({
                    count: 1 - uploadedCount,
                    success: function (data) {
                        layer.close();
                        //$.hideLoading();
                        if (data.code === 2) {
                            //$.toast('已取消','forbidden');
                            return false;
                        } else if (data.code === 3) {
                            layer.open({
                                content:'正在上传图片',
                                time:1.5
                            });
                            //$.showLoading('正在上传图片');
                            return false;
                        } else if (data.code === 4) {
                            // 上传过程已经全部结束
                            layer.close();
                            //$.hideLoading();
                            return false;
                        } else if (data.code === 5) {
                            // 已完成 N 张
                            // todo 待处理
                            return false;
                        } else if (data.code === 6) {
                            // 正在上传第 X 张
                            // todo 待处理
                            return false;
                        }
                        var url = "";
                        if (url.length <= 1) {
                            for (var i in data.ids) {
                                url = "https://gateway.confolsc.com/files/image/" + data.ids[i] + "?redirect=1&size=200,200";
                                //var html = '<li data-rid="__id__" id="upload" style="margin-top: 0.5rem;" class="weui_uploader_file uploadedFile" ><img class="img1" src="__url__"/><img class="img2" src=""></li>'.replace('__id__',data.ids[i]);
                                //var html = '<img id="image" data-id="__id__" src="__url__" height="140" width="140">';
//                                html = html.replace('__id__',data.ids[i]);
//                                html = html.replace('__url__',url);
                                $('#image').attr('src',url)
                                $('#image').attr('data-id',data.ids[i]);
                                //$(html).insertBefore('#upload');
                            }
                        }
                    }
                });
            });
            $('#update-touxiang').click(function () {
                $.ajax({
                    url:'<?=urlMobile('member_account','update_img')?>',
                    type:'post',
                    data:{
                        'touxiang':$('#image').attr('data-id')
                    },
                    dataType:'json',
                    success:function (data) {
                        if (data.code == 1){
                            layer.open({
                                content:'头像上传成功',
                                time:1.5
                            })
                            setTimeout(function () {
                                window.MBC.back();
                                return false;
                            },1500)
                        } else {
                            layer.open({
                                content:'头像上传失败',
                                time:1.5
                            })
                        }
                    }
                })
            })
        })

//        $(function(){
//
//          $("#header .top_home").on("click", function () { $("#header .home_menu").toggle(); });
//        })
//         function lackBack(){
//                layer.closeAll();
//        }

        //更换头像

//        function upload_img() {
//            $("#vip-file").click();
//        }



        //图像压缩

//        function upload(the) {
//            lrz(the.files[0], { width: 640 })
//                .then(function (rst) {
//                    // 把处理的好的图片给用户看看呗
//                    var img = new Image();
//                    img.src = rst.base64;
//                    img.onload = function () {
//                        var load = layer.open({
//                            type: 1,
//                            shadeClose: false,
//                             content: '<div class="container" style="width:100%; overflow:hidden"><div class="tx-head"><a href="#" id="img-save" style="float:right; font-size:16px; margin-right:15px; border:1px solid #5f5d5d; line-height:25px; padding:1px 8px; margin-top:8px;  border-radius:3px;">保存</a><a href="javascript:lackBack();"  class="new-a-back" id="backUrl"><span></span></a></div><img id="base64" src="' + rst.base64 + '"></div>',
//                            style: 'width:100%; height:' + document.documentElement.clientHeight + 'px; background-color:#F2F2F2; border:none; overflow:hidden'
//                        });
//
//                        //裁剪框比例
//                        $('#base64').cropper({
//                            aspectRatio: 1 / 1,
//                            crop: function (data) {
//                            },
//                            guides: false,  //是否在剪裁框上显示虚线
//                            movable: false,  //是否允许移动剪裁框
//                            resizable: false,  //是否允许改变剪裁框的大小
//                            dragCrop: false,  //是否允许移除当前的剪裁框，并通过拖动来新建一个剪裁框区域
//                            minContainerWidth: 300,  //容器的最小宽度
//                            minContainerHeight: 300  //容器的最小高度
//                        })
//
//
//
//                        //保存裁剪图片
//
//                        $("#img-save").click(function () {
//                            var touxiang = $('#base64').cropper('getCroppedCanvas', { width: 300, height: 300 }).toDataURL("image/jpeg", 0.9);
//                            var loading = layer.open({
//                                type: 2,
//                                shadeClose:false
//                            });
//                            console.log(touxiang);
//                            // 这里该上传给后端啦
//                            $.ajax({
//                                url: ApiUrl+"/index.php?con=member_account&fun=ajax_update_img",
//                                type: "post",
//                                data: { img: touxiang},//base64数据
//                                dataType: "json",
//                                success: function (data) {
//                                    layer.close(loading);
//                                    layer.open({
//                                        content: '头像上传成功！',
//                                        time: 1.5
//                                    });
//                                    setTimeout(function () { window.location.href="<?php //echo urlMobile('member_account','upload_img');?>//"},1500);
//                                },error:function(data){
//                                      layer.open({
//                                        content: '头像上传失败！',
//                                        time: 1.5
//                                    });
//                                }
//                            });
//
//                        })
//
//                    };
//
//                })
//
//                .catch(function (err) {
//                    // 万一出错了，这里可以捕捉到错误信息
//                    // 而且以上的then都不会执行
//                    layer.open({
//                        content: err,
//                        time: 2
//                    });
//                })
//                .always(function () {
//                    // 不管是成功失败，这里都会执行
//
//                });
//
//        };



    </script>



</div>



</div>
<script>
    $(function () {
        $('.back').parent().click(function () {
            window.MBC.back();
            return false;
        })
    })
</script>