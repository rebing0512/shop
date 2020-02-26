<?php defined('TTShop') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/rzxy.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_common.css">



</head>

<body>

<?php if (in_array($output['platform'], ['ios', 'android'])):?>
    <header id="header" class="fixed">

        <div class="header-wrap">

            <div class="header-l"><a href="javascript:history.go(-1)"><i class="back"></i></a></div>

            <div class="header-title">

                <h1>店铺资质信息</h1>

            </div>

            <!--   <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>-->

        </div>

        <?php include template('layout/seller_toptip');?>

    </header>
<?php else:?>
    <style>
        .nctouch-main-layout {
            margin-top: 0
        }
    </style>
<?php endif;?>

<div class="nctouch-main-layout fixed-Width">
<!--
<div class="alert">

    <h4>注意事项：</h4>

    以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。

</div>
-->
<div class="nctouch-home-block">

  <div class="tit-bar"><i style="background:#EC5464;"></i>店铺及联系人信息</div>

  <div class="input_box">

      <dl class="border_bottom">

          <dt><i>*</i>店主姓名</dt>

          <dd>

              <input id="contacts_name" name="contacts_name" value="<?=$output['info']['contacts_name']?>" type="text">

          </dd>

      </dl>

      <dl class="border_bottom">

          <dt><i>*</i>联系号码</dt>

          <dd>

              <input id="contacts_phone" name="contacts_phone" value="<?=$output['info']['contacts_phone']?>" type="text">

          </dd>

      </dl>

    <dl class="border_bottom">

        <dt><i>*</i>店铺名称</dt>

        <dd><input id="company_name" name="company_name" value="<?=$output['info']['company_name']?>" type="text"></dd>

    </dl>

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>店铺在地</dt>-->
<!---->
<!--          <dd>-->
<!---->
<!--              <input id="company_address" name="company_address" type="text" value="--><?//=$output['info']['company_address']?><!--"/>-->
<!---->
<!---->
<!---->
<!--          </dd>-->
<!---->
<!--      </dl>-->

      <dl class="border_bottom">

          <dt><i>*</i>店铺详细地址</dt>

          <dd>

              <input id="company_address_detail" name="company_address_detail" value="<?=$output['info']['company_address_detail']?>" type="text">

          </dd>

      </dl>

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>公司电话</dt>-->
<!---->
<!--          <dd><input id="company_phone" name="company_phone" value="--><?//=$output['info']['company_phone']?><!--" type="text"></dd>-->
<!---->
<!--      </dl>-->

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>员工数量</dt>-->
<!---->
<!--          <dd>-->
<!--              <input id="company_employee_count" name="company_employee_count" value="--><?//=$output['info']['company_employee_count']?><!--" type="text" style="width: 85%;">-->
<!--              <span style="float: right;">人</span>-->
<!--          </dd>-->
<!---->
<!--      </dl>-->

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>注册资金</dt>-->
<!---->
<!--          <dd>-->
<!--              <input id="company_registered_capital" name="company_registered_capital" value="--><?//=$output['info']['company_registered_capital']?><!--" type="text" style="width: 85%;">-->
<!--              <span style="float: right;">万元</span>-->
<!--          </dd>-->
<!---->
<!--      </dl>-->

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>营业执照号</dt>-->
<!---->
<!--          <dd><input id="business_licence_number" name="business_licence_number" value="--><?//=$output['info']['business_licence_number']?><!--" type="text"></dd>-->
<!---->
<!--      </dl>-->

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>营业执照所在地</dt>-->
<!---->
<!--          <dd><input id="business_licence_address" name="business_licence_address" value="--><?//=$output['info']['business_licence_address']?><!--" type="text"></dd>-->
<!---->
<!--      </dl>-->

<!--      <dl class="border_bottom">-->
<!---->
<!--          <dt><i>*</i>法定经营范围</dt>-->
<!---->
<!--          <dd><input id="business_sphere" name="business_sphere" value="--><?//=$output['info']['business_sphere']?><!--" type="text"></dd>-->
<!---->
<!--      </dl>-->

<!--    <dl class="border_bottom">-->
<!---->
<!--        <dt><i>*</i>电子邮箱</dt>-->
<!---->
<!--        <dd>-->
<!---->
<!--          <input id="contacts_email" name="contacts_email" value="--><?//=$output['info']['contacts_email']?><!--" type="text">-->
<!---->
<!--        </dd>-->
<!---->
<!--    </dl>-->

  </div>

</div>



<div class="nctouch-home-block mt5">

  <div class="tit-bar"><i style="background:#EC5464;"></i>营业执照信息（副本）</div>

  <div class="evaluation-upload-block" style="text-align: center;">

<!-- business_licence       <div class="tit"><i></i><p>添&nbsp;加</p></div>-->
      <img id="business_licence" src="<?= getStoreJoininImageUrl($output['info']['business_licence_number_elc']) ?>" data-id="<?= $output['info']['business_licence_number_elc'] ?>" alt="" style="width: 90%;margin: 0 5%;" />
<!--        <div class="nctouch-upload">-->
<!---->
<!--          <a href="javascript:void(0);">-->
<!---->
<!--            <span><input hidefocus="true" size="1" class="input-file" name="file" id="" type="file"></span>-->
<!---->
<!--            <p><i class="icon-upload"></i></p>-->
<!---->
<!--                  </a>-->
<!---->
<!--          <input name="business_licence_number_elc" value="" type="hidden">-->
<!---->
<!--        </div>-->

      

  </div>

</div>

    <!--

    <div class="nctouch-home-block mt5">

      <div class="tit-bar"><i style="background:#EC5464;"></i>组织机构代码证</div>

      <div class="evaluation-upload-block">

            <div class="tit"><i></i><p>添&nbsp;加</p></div>

            <div class="nctouch-upload">

              <a href="javascript:void(0);">

                <span><input hidefocus="true" size="1" class="input-file" name="file" id="" type="file"></span>

                <p><i class="icon-upload"></i></p>

                      </a>

              <input name="organization_code_electronic" value="" type="hidden">

            </div>

      </div>

    </div>





    <div class="nctouch-home-block mt5">

      <div class="tit-bar"><i style="background:#EC5464;"></i>结算账号信息</div>

      <div class="input_box">

        <dl class="border_bottom">

            <dt><i>*</i>银行开户名</dt>

            <dd><input id="bank_account_name" name="bank_account_name" value="" type="text"></dd>

        </dl>

         <dl class="border_bottom">

            <dt><i>*</i>公司银行账号</dt>

            <dd>

             <input id="bank_account_number" name="bank_account_number" value="" type="text">

            </dd>

        </dl>



      </div>

    </div>



    <div class="nctouch-home-block mt5">

      <div class="tit-bar"><i style="background:#EC5464;"></i>税务登记证</div>

      <div class="evaluation-upload-block">

            <div class="tit"><i></i><p>添&nbsp;加</p></div>

            <div class="nctouch-upload">

              <a href="javascript:void(0);">

                <span><input hidefocus="true" size="1" class="input-file" name="file" id="" type="file"></span>

                <p><i class="icon-upload"></i></p>

              </a>

              <input name="tax_registration_certif_elc" value="" type="hidden">

            </div>



      </div>

    </div>
    -->


<?php if ($output['store_info']['store_type']!=4):?>
    <a class="btn-l mt5 mb5" id="next_company_info">提交审核</a>
<?php endif;?>

</div>

<div class="fix-block-r">

  <a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>

</div>







<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script> 

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script> 

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script> 

<script type="text/javascript">

  $(function(){
      $('.back').on('click',function () {
          window.MBC.back()
          return false;
      })
      $('#business_licence').on('click', function (event) {
          console.log(111);
          event.stopPropagation();
          // var uploadedCount = $(this).length;
          // if (1-uploadedCount<=0) {
          //     layer.open({
          //         content:'最多只能选择1张图片',
          //         time:1.5
          //     });
          //     //$.toptip('最多只能选择9张图片',800,'error');
          //     return false;
          // }
          window.MBC.chooseImage({
              count: 1,
              success: function (data) {
                  layer.close();
                  //$.hideLoading();
                  if (data.code === 2) {
                      //$.toast('已取消','forbidden');
                      return false;
                  } else if (data.code === 3) {
                      layer.open({
                          content: '正在上传图片',
                          time: 1.5
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
                          url = "https://gateway.confolsc.com/files/image/" + data.ids[i] + "?redirect=1";
                          //var html = '<li data-rid="__id__" id="upload" style="margin-top: 0.5rem;" class="weui_uploader_file uploadedFile" ><img class="img1" src="__url__"/><img class="img2" src=""></li>'.replace('__id__',data.ids[i]);
                          //var html = '<img id="image" data-id="__id__" src="__url__" height="140" width="140">';
//                                html = html.replace('__id__',data.ids[i]);
//                                html = html.replace('__url__',url);
                          $('#business_licence').attr('src', url)
                          $('#business_licence').attr('data-id', data.ids[i]);
                          //$(html).insertBefore('#upload');
                      }
                  }
              }
          });
      });
    // $('input[name="file"]').ajaxUploadImage({
    //
    //   url: ApiUrl + "/index.php?con=sns_album&fun=file_upload_rz",
    //
    //
    //
    //   start: function(e) {
    //
    //     e.parent().after('<div class="upload-loading"><i></i></div>');
    //
    //     e.parent().siblings(".pic-thumb").remove()
    //
    //   },
    //
    //   success: function(e, a) {
    //
    //     if (a.datas.error) {
    //
    //       e.parent().siblings(".upload-loading").remove();
    //
    //       layer.open({
    //
    //         content:'图片尺寸过大！',
    //
    //         time:1.5
    //
    //       });
    //
    //       return false
    //
    //     }
    //
    //     e.parent().after('<div class="pic-thumb"><img src="' + a.datas.file_url + '"/></div>');
    //
    //     e.parent().siblings(".upload-loading").remove();
    //
    //     e.parents("a").next().val(a.datas.file_name)
    //
    //   }
    //
    // });



    // $("#company_address").on("click",
    //
    // function() {
    //
    //     $.areaSelected({
    //
    //         success: function(a) {
    //
    //             $("#company_address").val(a.area_info).attr({
    //
    //                 "data-areaid": a.area_id,
    //
    //                 "data-areaid2": a.area_id_2 == 0 ? a.area_id_1: a.area_id_2
    //
    //             })
    //
    //         }
    //
    //     })
    //
    // })

      $("#business_licence_address").on("click",

          function() {

              $.areaSelected({

                  success: function(a) {

                      $("#business_licence_address").val(a.area_info).attr({

                          "data-areaid": a.area_id,

                          "data-areaid2": a.area_id_2 == 0 ? a.area_id_1: a.area_id_2

                      })

                  }

              })

          })

    $("#next_company_info").click(function(){

        <?php if ($output['store_info']['store_type'] == 1):?>
        layer.open({
            content:'正在审核中无法修改提交资料',
            time:1.5
        })
        return false;
        <?php elseif ($output['store_info']['store_type'] >= 2):?>
        layer.open({
            content:'您已经开通店铺',
            time:1.5
        })
        return false;
        <?php endif;?>

       var data={

       'company_name':$("#company_name").val(),

       // 'company_phone':$("#company_phone").val(),

       // 'company_employee_count':$("#company_employee_count").val(),

       // 'company_registered_capital':$("#company_registered_capital").val(),

       // 'business_licence_number':$("#business_licence_number").val(),

       // 'business_licence_address':$("#business_licence_address").val(),

       // 'business_sphere':$("#business_sphere").val(),

       // 'company_address':$("#company_address").val(),

       'company_address_detail':$("#company_address_detail").val(),

       'contacts_name':$("#contacts_name").val(),

       'contacts_phone': $("#contacts_phone").val(),

       // 'contacts_email':$("#contacts_email").val(),

       'business_licence_number_elc':$("#business_licence").attr('data-id')

       // 'organization_code_electronic':$("input[name='organization_code_electronic']").val(),

       // 'bank_account_name':$("#bank_account_name").val(),

       // 'bank_account_number':$("#bank_account_number").val(),

       // 'tax_registration_certif_elc':$("input[name='tax_registration_certif_elc']").val()

      };

       if(data['company_name']==''){

          layer.open({content:'店铺名称不得为空!'});

       }

        // if(data['company_phone']==''){
        //
        //     layer.open({content:'公司电话不得为空!'});
        //
        // }

        // if(data['company_employee_count']==''){
        //
        //     layer.open({content:'员工数量不得为空!'});
        //
        // }

        // if(data['company_registered_capital']==''){
        //
        //     layer.open({content:'注册资金不得为空!'});
        //
        // }

        // if(data['business_licence_number']==''){
        //
        //     layer.open({content:'营业执照号不得为空!'});
        //
        // }

        // if(data['business_licence_address']==''){
        //
        //     layer.open({content:'营业执照所在地不得为空!'});
        //
        // }

        // if(data['business_sphere']==''){
        //
        //     layer.open({content:'法定经营范围不得为空!'});
        //
        // }

       //  if(data['company_address']==''){
       //
       //    layer.open({content:'店铺所在地不得为空!'});
       //
       // }

        if(data['company_address_detail']==''){

          layer.open({content:'店铺地址详情不得为空!'});

       }

        if(data['contacts_name']==''){

          layer.open({content:'店主姓名不得为空!'});

       }

//        if(data['business_licence_number_elc']==''){
//
//          layer.open({content:'请上传营业执照信息副本!'});
//
//       }
//
//        if(data['organization_code_electronic']==''){
//
//          layer.open({content:'请上传组织机构代码证!'});
//
//       }
//
//        if(data['tax_registration_certif_elc']==''){
//
//          layer.open({content:'请上传税务登记证!'});
//
//       }

       var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 

        if(data['contacts_phone']=='' && !reg.test(data['contacts_phone'])){

          layer.open({content:'联系号码格式不正确!'});

       }

       // var regemail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       //
       //  if(data['contacts_email']=='' && !regemail.test(data['contacts_email'])){
       //
       //    layer.open({content:'邮箱格式不正确!'});
       //
       // }

//        if(data['bank_account_name']==''){
//
//          layer.open({content:'银行开户名不得为空!'});
//
//       }

//        if(data['bank_account_number']==''){
//
//          layer.open({content:'公司银行账号不得为空!'});
//
//       }

    

       $.ajax({

        type: "post",

        url: ApiUrl + "/index.php?con=store_joinin&fun=savestep",

        data: data,

        dataType: "json",

        async: false,

        success: function(e) {

            if (e.code == 200) {

               setTimeout(function () {

                    window.location.href = e.datas.url;   

                }, 1000); 

            } else {

         

                   layer.open({

                    content:e.datas.error,

                    time:1.5

                 })

              





               

            }

        }

    });

      

    })



  })

</script>

