
var data = {
    status:'Y'
};

var page = pagesize;

var curpage = 1;

var hasmore = true;

var param = {};

var order = '';

function _formatPrice(price)
{
    if (price == 0.02) {
        return '非卖品';
    } else if(price==0.01) {
        return '私洽';
    } else {
        return parseInt(price);
    }
}


$(function(){

    $('section').on('click', '.focus', function () {
        var store_id = $(this).data('store_id');
        $.ajax({
            url: '/wap/index.php?con=member_favorites_store&fun=favorites_add',
            type: 'post',
            dataType: 'json',
            data: {
                store_id: store_id,
                type: 'follow'
            },
            success: function (data) {
                if (data.nologin) {
                    window.location.href = '/wap/index.php?con=auto&fun=login';
                    return false;
                }
                if (data.code != 200) {
                    layer.open({
                        content:data.datas.error,
                        time:1.5
                    })
                } else if (typeof data.datas == 'object' && typeof data.datas.error != 'undefined') {
                    layer.open({
                        content:data.datas.error,
                        time:1.5
                    })
                } else {
                    $('#gz').html('已关注');
                    $('#fans').html(data.datas+'粉丝');
                    layer.open({
                        content:'关注成功',
                        time:1.5
                    })
                }
            }
        });
    });

    /**
     * 店铺商品分类
     */
    // $.ajax({
    //     type:'post',
    //     url:ApiUrl+'/index.php?con=store&fun=sortselect',
    //     data:{
    //         store_id:store_id
    //     },
    //     dataType:'json',
    //     success:function (e) {
    //         $("#category-caizhi").html(e.datas.list);
    //         $("#category-shape").html(e.datas.style);
    //     }
    // });
    /**
     * 筛选按钮被点击
     */
    // $('.filter').on('click',function(){
    //     var filter_type = $(this).data('value');
    //     var current = $('#filter-'+filter_type);
    //     if (current.is(':visible'))
    //         current.hide();
    //     else
    //     {
    //         $('.filter-content').hide();
    //         current.show();
    //     }
    // });

    /**
     * 筛选内容被点击
     */
    $(document).on('click','.filter-item',function(){
        var value = $(this).data('value');
        var container = $(this).parents('div');
        var attribute_key = $(this).data('key');
        if (attribute_key!=undefined) {
            attribute = attribute_key;
        } else {
            attribute = container.attr('id').replace('filter-','');
        }

        $(this).parents('span').addClass('active').siblings().removeClass('active');

        data[attribute.toString()] = value;
        curpage=1;
        hasmore=true;
        $('#giftList').html('');
        get_list();
    });
});




function t() {
    //console.log(param);
    //console.log(data);
    param.store_id = store_id;
    curpage = 1;
    param.curpage = 0;
    hasmore = true;
    $.ajax({
        type:'post',
        url:ApiUrl+'/index.php?con=store&fun=sort',
        data:param,
        dataType:'json',
        success: function(t) {

            var e = t.datas;

            var s = e.store_info.store_name + " - 店铺首页";

            document.title = s;
            var pic = e.store_info.store_avatar;
            var insertText = "<h3>e.store_info.store_name</h3>";

            document.getElementById("log").setAttribute('src',pic);
            document.all.store.innerHTML=e.store_info.store_description;
            $("#left").src="e.store_info";
            var r = template.render("goods_list_tpl", e);

            $("#giftList").html('');




            if (e.store_info.is_favorate) {

                $("#store_notcollect").hide();

                $("#store_collected").show()

            } else {

                $("#store_notcollect").show();

                $("#store_collected").hide()

            }

            if (e.store_info.mb_title_img) {

                $(".store-top-bg .img").css("background-image", "url(" + e.store_info.mb_title_img + ")")

            } else {

                var a = [];

                a[0] = WapSiteUrl + "/images/store_h_bg_01.jpg";

                a[1] = WapSiteUrl + "/images/store_h_bg_02.jpg";

                a[2] = WapSiteUrl + "/images/store_h_bg_03.jpg";

                a[3] = WapSiteUrl + "/images/store_h_bg_04.jpg";

                a[4] = WapSiteUrl + "/images/store_h_bg_05.jpg";

                var i = Math.round(Math.random() * 4);

                $(".store-top-bg .img").css("background-image", "url(" + a[i] + ")")

            }

            if (e.store_info.mb_sliders.length > 0) {

                e.ApiUrl = ApiUrl;

                var r = template.render("store_sliders_tpl", e);

                $("#store_sliders").html(r);

                o()

            } else {

                $("#store_sliders").parent().hide()

            }

            // $("#store_kefu").click(function() {

            //     window.location.href = WapSiteUrl + "/tmpl/member/chat_info.html?t_id=" + t.datas.store_info.member_id

            // });
            $('#')
        }
    })
}


function tidyStoreNewGoodsData(t) {

    if (t.goods_list.length <= 0) {

        return t

    }

    var e = $("#newgoods").find('[addtimetext="' + t.goods_list[0].goods_addtime_text + '"]');

    var o = "";

    $.each(t.goods_list,

        function(s, r) {

            if (o != r.goods_addtime_text && e.html() == null) {

                t.goods_list[s].goods_addtime_text_show = r.goods_addtime_text;

                o = r.goods_addtime_text

            }

        });

    return t

}

$(function() {

    var t = getCookie("key");

    var e = getQueryString("store_id");

    if (!e) {

        window.location.href = WapSiteUrl;

    }

    $("#goods_search").attr("href", ApiUrl + "/index.php?con=store&fun=store_search&store_id=" + e);

    $("#store_categroy").attr("href", ApiUrl + "/index.php?con=store&fun=store_search&store_id=" + e);



    function o() {

        $("#store_sliders").each(function() {

            if ($(this).find(".item").length < 2) {

                return

            }

            Swipe(this, {

                startSlide: 2,

                speed: 400,

                auto: 3e3,

                continuous: true,

                disableScroll: false,

                stopPropagation: false,

                callback: function(t, e) {},

                transitionEnd: function(t, e) {}

            })

        })

    }
/**
    $.ajax({

        type: "post",

        url: ApiUrl + "/index.php?con=store&fun=store_info",

        data: {

            key: t,

            store_id: e

        },

        dataType: "json",

        success: function(t) {

            var e = t.datas;

            var s = e.store_info.store_name + " - 店铺首页";

            document.title = s;
            var pic = e.store_info.store_avatar;
            var insertText = "<h3>e.store_info.store_name</h3>";

            //document.getElementById("log").setAttribute('src',pic);
            //document.all.store.innerHTML=e.store_info.store_description;
            $("#left").src="e.store_info"
            var r = template.render("goods_list_tpl", e);

            //$('.left>span').html(e.store_info.store_name);
            //$('.store_title>span').html(e.store_info.store_name);

            $("#allgoods_con").html(r);


            if (e.store_info.inhref) {
                function escape2Html(str) {
                    var arrEntities={'lt':'<','gt':'>','nbsp':' ','amp':'&','quot':'"'};
                    return str.replace(/&(lt|gt|nbsp|amp|quot);/ig,function(all,t){return arrEntities[t];});
                }
                $('.right>a').html('详情 >>');
                $('.right>a').attr('href',escape2Html(e.store_info.inhref));
            }

            if (e.store_info.is_favorate) {

                $("#store_notcollect").hide();

                $("#store_collected").show()

            } else {

                $("#store_notcollect").show();

                $("#store_collected").hide()

            }

            if (e.store_info.mb_title_img) {

                $(".store-top-bg .img").css("background-image", "url(" + e.store_info.mb_title_img + ")")

            } else {

                var a = [];

                a[0] = WapSiteUrl + "/images/store_h_bg_01.jpg";

                a[1] = WapSiteUrl + "/images/store_h_bg_02.jpg";

                a[2] = WapSiteUrl + "/images/store_h_bg_03.jpg";

                a[3] = WapSiteUrl + "/images/store_h_bg_04.jpg";

                a[4] = WapSiteUrl + "/images/store_h_bg_05.jpg";

                var i = Math.round(Math.random() * 4);

                $(".store-top-bg .img").css("background-image", "url(" + a[i] + ")")

            }

            if (e.store_info.mb_sliders.length > 0) {

                e.ApiUrl = ApiUrl;

                var r = template.render("store_sliders_tpl", e);

                $("#store_sliders").html(r);

                o()

            } else {

                $("#store_sliders").parent().hide()

            }

            // $("#store_kefu").click(function() {

            //     window.location.href = WapSiteUrl + "/tmpl/member/chat_info.html?t_id=" + t.datas.store_info.member_id

            // });



        }

    });
**/
    $("#goods_rank_tab").find("a").click(function() {

        $("#goods_rank_tab").find("li").removeClass("selected");

        $(this).parent().addClass("selected").siblings().removeClass("selected");

        var t = $(this).attr("data-type");

        var o = t + "desc";

        var s = 3;

        $("[nc_type='goodsranklist']").hide();

        $("#goodsrank_" + t).show();

        if ($("#goodsrank_" + t).html()) {

            return

        }

        $.ajax({

            type: "post",

            url: ApiUrl + "/index.php?con=store&fun=store_goods_rank",

            data: {

                store_id: e,

                ordertype: o,

                num: s

            },

            dataType: "json",

            success: function(e) {

                if (e.code == 200) {

                    var o = template.render("goodsrank_" + t + "_tpl", e.datas);

                    $("#goodsrank_" + t).html(o)

                }

            }

        })

    });

    $("#goods_rank_tab").find("a[data-type='collect']").trigger("click");

    $("#nav_tab").waypoint(function() {

            $("#nav_tab_con").toggleClass("fixed")

        },

        {

            offset: "50"

        });

    function s() {

        var t = {};

        t.store_id = e;

        var o = new ncScrollLoad;

        o.loadInit({

            url: ApiUrl + "/index.php?con=store&fun=store_new_goods",

            getparam: t,

            tmplid: "newgoods_tpl",

            containerobj: $("#newgoods"),

            iIntervalId: true,

            resulthandle: "tidyStoreNewGoodsData"

        })





    }

    function r() {

        $.ajax({

            type: "post",

            url: ApiUrl + "/index.php?con=store&fun=store_promotion",

            data: {

                store_id: e

            },

            dataType: "json",

            success: function(t) {

                t.datas.store_id = e;

                var o = template.render("storeactivity_tpl", t.datas);

                $("#storeactivity_con").html(o)

            }

        })

    }

    $("#nav_tab").find("a").click(function() {

        $("#nav_tab").find("li").removeClass("selected");

        $(this).parent().addClass("selected").siblings().removeClass("selected");

        $("#storeindex_con,#allgoods_con,#newgoods_con,#storeactivity_con").hide();

        window.scrollTo(0, 0);

        var t = $(this).attr("data-type");

        switch (t) {

            case "storeindex":

                $("#storeindex_con").show();

                o();

                break;

            case "allgoods":

                if (!$("#allgoods_con").html()) {

                    $("#allgoods_con").load(ApiUrl + "/index.php?con=store&fun=store_goods_list",

                        function() {

                            $(".goods-search-list-nav").addClass("posr");

                            $(".goods-search-list-nav").css("top", "0");

                            $("#sort_inner").css("position", "static")

                        })

                }

                $("#allgoods_con").show();

                break;

            case "newgoods":

                if (!$("#newgoods").html()) {

                    s()

                }

                $("#newgoods_con").show();

                break;

            case "storeactivity":

                if (!$("#storeactivity_con").html()) {

                    r()

                }

                $("#storeactivity_con").show();

                break

        }

    });

    $("body").on("click","#store_voucher",function() {



        if (!$("#store_voucher_con").html()) {

            $.ajax({

                type: "post",

                url: ApiUrl + "/index.php?con=voucher&fun=voucher_tpl_list",

                data: {

                    store_id: e,

                    gettype: "free"

                },

                dataType: "json",

                async: false,

                success: function(t) {

                    if (t.code == 200) {

                        var e = template.render("store_voucher_con_tpl", t.datas);

                        $("#store_voucher_con").html(e)

                    }

                }

            })

        }

        $.animationUp({

            valve: ""

        })

    });

    $("#store_voucher_con").on("click", '[nc_type="getvoucher"]',

        function() {

            getFreeVoucher($(this).attr("data-tid"))

        });

    $("#store_notcollect").live("click",

        function() {

            var t = favoriteStore(e);

            if (t) {

                $("#store_notcollect").hide();

                $("#store_collected").show();

                var o;

                var s = (o = parseInt($("#store_favornum_hide").val())) > 0 ? o + 1 : 1;

                $("#store_favornum").html(s);

                $("#store_favornum_hide").val(s)

            }

        });

    $("#store_collected").live("click",

        function() {

            var t = dropFavoriteStore(e);

            if (t) {

                $("#store_collected").hide();

                $("#store_notcollect").show();

                var o;

                var s = (o = parseInt($("#store_favornum_hide").val())) > 1 ? o - 1 : 0;

                $("#store_favornum").html(s);

                $("#store_favornum_hide").val(s)

            }

        })

});









var ajax_running = false;

$(function() {
    curpage=1;
    //get_list('0');
    get_list();
    $(window).scroll(function() {

        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {

            get_list();
        }

    });



});
function init_get_list(e) {

    order = e;

    curpage = 1;

    hasmore = true;

    $("#allgoods_con").html("");

    get_list()

}
function get_list() {
    //type = type||'';

    //param = {};

    if (ajax_running){
        return false;
    } else {
        ajax_running = true;
    }

    if(!hasmore){
        return false;
    }
    param.page = page;
    param.curpage = curpage;
    param.order = order;
    //console.log(param);
    //console.log(data);
    param.store_id = store_id;
    param = $.extend(data,param);


    $.getJSON(ApiUrl + "/index.php?con=store&fun=sort", param, function(e) {
        if (!e) {
            e = [];
            e.datas = [];
            e.datas.goods_list = [];
            e.datas.search_list_goods = [];
        }



        curpage++;
        hasmore = e.hasmore;


        template.helper('formatnum', function(str) {
            return parseInt(str);
        });

        //$('.pre-loading').hide();

        e.datas.ApiUrl = ApiUrl;

        var html = template.render('goods_list_tpl',e.datas);
        $('.final').append(html);
        var main_padding = 10;
        var one_padding = 4;

        var swidth = $(window).width();
        var item_pic_list_li = swidth - 2*main_padding - one_padding;//单个li宽度
        var item_pic_list_li_width = parseInt(item_pic_list_li / 2);
        //console.log(item_pic_list_li_width);
        $(".liwidth").css('width',item_pic_list_li_width);
        ajax_running = false;
        $('a[data-url]').on('click',function () {
            window.MBC.openNew({
                url:$(this).attr('data-url'),
                pageTitle:$(this).attr('data-title'),
                removeHeader:true
            })
            return false;
        })
        $('.back').on('click',function () {
            window.MBC.back()
            return false;
        })
    })

}




function zhencu(a,b){
    var z=a%b;
    if(z == 0){
        return true;
    }else{
        return false;
    }
}
