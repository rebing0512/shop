var page = pagesize;
var curpage = 1;
var hasmore = true;
var footer = false;
var keyword = decodeURIComponent(getQueryString("keyword"));
var gc_id = getQueryString("gc_id");
var b_id = getQueryString("b_id");
var key = getQueryString("key");
var order = getQueryString("order");
var area_id = getQueryString("area_id");
var price_from = getQueryString("price_from");
var price_to = getQueryString("price_to");
var own_shop = getQueryString("own_shop");
var gift = getQueryString("gift");
var groupbuy = getQueryString("groupbuy");
var xianshi = getQueryString("xianshi");
var stone = getQueryString("stone");
var carve = getQueryString("carve");

var category_id = getQueryString("category_id");
var attribute_id = getQueryString("attribute_id");
var texture_id = getQueryString("texture_id");



// var virtual = getQueryString("virtual");

var ci = getQueryString("ci");

var tag = getQueryString("tag");

var myDate = new Date;

var searchTimes = myDate.getTime();

$(function() {

    // $.animationLeft({
    //
    //     valve: "#search_adv",
    //
    //     wrapper: ".nctouch-full-mask",
    //
    //     scroll: "#list-items-scroll"
    //
    // });
    $('#search_adv').click(function () {
        location.href = ApiUrl+'/index.php?con=category&fun=screen'+'&__ccid='+category_id
    });


    $("#header").on("click", ".header-inp",

    function() {

        location.href = ApiUrl + "/index.php?con=goods&fun=search&keyword=" + keyword

    });

    if (keyword != "") {

        $("#keyword").html(keyword)

    }

    $("#show_style").click(function() {

        if ($("#product_list").hasClass("grid")) {

            $(this).find("span").removeClass("browse-list").addClass("browse-grid");

            $("#product_list").removeClass("grid").addClass("list")

        } else {

            $(this).find("span").addClass("browse-list").removeClass("browse-grid");

            $("#product_list").addClass("grid").removeClass("list")

        }

    });

    $("#sort_default").click(function() {

        if ($("#sort_inner").hasClass("hide")) {

            $("#sort_inner").removeClass("hide");

            $('#ud_price').addClass('hide');

        } else {

            $("#sort_inner").addClass("hide")

        }

    });
    $("#price").click(function() {

        if ($("#ud_price").hasClass("hide")) {

            $("#ud_price").removeClass("hide")

        } else {

            $("#ud_price").addClass("hide")

        }

    });

    $("#nav_ul").find("a").click(function() {

        $(this).addClass("current").parent().siblings().find("a").removeClass("current");

        if (!$("#sort_inner").hasClass("hide") && $(this).parent().index() > 0) {

            $("#sort_inner").addClass("hide")

        }

    });

    $("#sort_inner").find("a").click(function() {

        $("#sort_inner").addClass("hide").find("a").removeClass("cur");

        var e = $(this).addClass("cur").text();

        $("#sort_default").html(e + "<i></i>")

    });

    $("#ud_price").find("a").click(function() {

        $("#ud_price").addClass("hide").find("a").removeClass("cur");

        var e = $(this).addClass("cur").text();

        $("#price").html(e + "<i></i>")

    });

    $("#product_list").on("click", ".goods-store a",

    function() {

        var e = $(this);

        var r = $(this).attr("data-id");

        var i = $(this).text();

        $.getJSON(ApiUrl + "/index.php?con=store&fun=store_credit", {

            store_id: r

        },

        function(t) {

            var a = "<dl>" + '<dt><a href='+ApiUrl+'/index.php?con=store&store_id=' + r + '>' + i + '<span class="arrow-r"></span></a></dt>' + '<dd class="' + t.datas.store_credit.store_desccredit.percent_class + '">描述相符：<em>' + t.datas.store_credit.store_desccredit.credit + "</em><i></i></dd>" + '<dd class="' + t.datas.store_credit.store_servicecredit.percent_class + '">服务态度：<em>' + t.datas.store_credit.store_servicecredit.credit + "</em><i></i></dd>" + '<dd class="' + t.datas.store_credit.store_deliverycredit.percent_class + '">发货速度：<em>' + t.datas.store_credit.store_deliverycredit.credit + "</em><i></i></dd>" + "</dl>";

            e.next().html(a).show()

        })

    }).on("click", ".sotre-creidt-layout",

    function() {

        $(this).hide()

    });

    get_list();

    $(window).scroll(function() {

        if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {

            get_list()

        }

    });

    search_adv()

});

function get_list() {



    if (!hasmore) {

        return false

    }

    hasmore = false;

    param = {};

    param.page = page;

    param.curpage = curpage;

    if (category_id != "") {

        param.category_id = category_id

    }

    if (attribute_id != "") {

        param.attribute_id = attribute_id

    }

    if (texture_id != "") {

        param.texture_id = texture_id

    }
//console.log(param);
    if (gc_id != "") {

        param.gc_id = gc_id

    } else if (keyword != "") {

        param.keyword = keyword

    } else if (b_id != "") {

        param.b_id = b_id

    }

    if (stone != "") {
        param.stone = stone
    }

    if (carve != "") {
        param.carve = carve
    }

    if (key != "") {

        param.key = key

    }

    if (order != "") {

        param.order  = order

    }

    if (area_id != "") {

        param.area_id  = area_id

    }

     if (price_from != "") {

        param.price_from  = price_from

    }

     if (price_to != "") {

        param.price_to  = price_to

    }

     if (own_shop != "") {

        param.own_shop  = own_shop

    }

     if (tag != "") {

        param.tag  = tag

    }

     if (gift != "") {

        param.gift  = 1

    }



     if (groupbuy != "") {

        param.groupbuy  = 1

    }

     if (xianshi != "") {

        param.xianshi  = 1

    }

    //  if (virtual != "") {

    //     param.virtual  = 1

    // }

     if (ci != "") {

        param.virtual  = ci

    }     

    $.getJSON(ApiUrl + "/index.php?con=goods&fun=goods_list", param,

    function(e) {

        if (!e) {

            e = [];

            e.datas = [];

            e.datas.goods_list = [];



        }

           $.each(e.datas, function(k, v) {



                $.each(v, function(kk, vv) {

                  

                            vv.url = buildUrl('goods', vv.goods_id);

            



                    });

                });

        

      

        curpage++;

        $('.pre-loading').hide();

        $('.loading').remove();

        var r = template.render("home_body", e);

        $("#product_list .goods-secrch-list").append(r);

        hasmore = e.hasmore

    })
    $('#product_list').on('click','li[data-url]',function () {
        window.MBC.openNew({
            url:$(this).attr('data-url'),
            pageTitle:$(this).attr('data-title'),
            removeHeader:true
        })
        return false;
    })

}

function search_adv() {

    $.getJSON(ApiUrl + "/index.php?con=index&fun=search_adv",

    function(e) {

        var r = e.datas;

        $("#list-items-scroll").html(template.render("search_items", r));

        if (area_id) {

            $("#area_id").val(area_id)

        }



        if (price_from) {

            $("#price_from").val(price_from)

        }

        if (price_to) {

            $("#price_to").val(price_to)

        }

        if (own_shop) {

            $("#own_shop").addClass("current")

        }

        if (gift) {

            $("#gift").addClass("current")

        }

        if (groupbuy) {

            $("#groupbuy").addClass("current")

        }

        if (xianshi) {

            $("#xianshi").addClass("current")

        }

        // if (virtual) {

        //     $("#virtual").addClass("current")

        // }

        if (ci) {

            var i = ci.split("_");

            for (var t in i) {

                $('a[name="ci"]').each(function() {

                    if ($(this).attr("value") == i[t]) {

                        $(this).addClass("current");

                    }

                })

            }

        }

        if (tag) {

            $('a[name="cxlx"]').each(function() {

                if ($(this).attr("value") == tag) {

                    $(this).addClass("current").siblings().removeClass("current");

                }

            })

          

        }
        //石种和雕刻技法搜索
        var sel = {
            stone:"all",
            carve:"all"
        };
        $("#stone a").click(function () {
            sel["stone"] = $(this).data("id");
        });
        $("#carve a").click(function () {
            sel["carve"] = $(this).data("id");
        });

        //价格区间搜索
        var price_interval ='';

        $("#price a").click(function () {
            price_interval = $(this).data('id');
        });

        if ($('#price').find('a').className == 'current') {
            //alert(xxx);
            var price_interval = $(this).data('id');

        }

        $("#search_submit").click(function() {

            var e = "&keyword=" + keyword,

            r = "";

//            e += "&area_id=" + $("#area_id").val();
            e += "&stone="+sel['stone']+"&carve="+sel['carve'];

            e += price_interval;
/**
            switch (price_interval)
            {
                case 'a':
                    e += "&price_from=0&price_to=5000";
                    break;
                case 'b':
                    e += "&price_from=5001&price_to=10000";
                    break;
                case 'c':
                    e += "&price_from=10001&price_to=20000";
                    break;
                case 'd':
                    e += "&price_from=20001&price_to=30000";
                    break;
                case 'e':
                    e += "&price_from=30001&price_to=50000";
                    break;
                case 'f':
                    e += "&price_from=50001&price_to=100000";
                    break;
                case '':
                    e += "&price_from=100000";
                    break;
            }

**/
            if(gc_id !=""){
                e+="&gc_id="+gc_id;
            }


/**
            if ($("#own_shop")[0].className == "current") {

                e += "&own_shop=1"

            }

            if ($("#gift")[0].className == "current") {

                e += "&gift=1"

            }

            if ($("#groupbuy")[0].className == "current") {

                e += "&groupbuy=1"

            }

            if ($("#xianshi")[0].className == "current") {

                e += "&xianshi=1"

            }
            **/
            // if ($("#virtual")[0].className == "current") {

            //     e += "&virtual=1"

            // }

            $('a[name="cxlx"]').each(function() {

                if ($(this)[0].className == "current") {

                    e += "&tag="+$(this).attr("value");

                }

            });

            $('a[name="ci"]').each(function() {

                if ($(this)[0].className == "current") {

                    r += $(this).attr("value") + "_"

                }

            });



            if (r != "") {

                e += "&ci=" + r

            }

            window.location.href = ApiUrl + "/index.php?con=goods&fun=list" + e

        });

        $('a[nctype="items"]').click(function() {

            var e = new Date;

            if (e.getTime() - searchTimes > 300) {

                $(this).toggleClass("current");

                searchTimes = e.getTime()

            }

        });

         $('a[nctype="itemsone"]').click(function() {

            var e = new Date;

            if (e.getTime() - searchTimes > 300) {

                $(this).addClass("current").siblings().removeClass('current');

                searchTimes = e.getTime()

            }

        });

        $('input[nctype="price"]').on("blur",

        function() {

            if ($(this).val() != "" && !/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {

                $(this).val("")

            }

        });

        $("#reset").click(function() {

            $('a[nctype="itemsone"]').removeClass("current");
            $('#price a:eq(0)').addClass("current");
            $('#stone a:eq(0)').addClass("current");
            $('#carve a:eq(0)').addClass("current");
            sel = {
                stone:'all',
                carve:'all'
            };

            $('input[nctype="price"]').val("");

            $("#area_id").val("")

        })

    })

}

function init_get_list(e, r) {

    order = e;

    key = r;

    curpage = 1;

    hasmore = true;

    $('.pre-loading').show();

    $("#product_list .goods-secrch-list").html("");

    get_list()

}