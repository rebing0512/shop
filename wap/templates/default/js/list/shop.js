var page = pagesize;

var curpage = 1;

var hasmore = true;

var footer = false;

var keyword = decodeURIComponent(getQueryString("keyword")) || '';

var key = getQueryString("key");

var order = getQueryString("order") || '';

var sc_id = getQueryString("sc_id") || '';
var area_id = decodeURIComponent(getQueryString("area_info"));
var myDate = new Date;
var searchTimes = myDate.getTime();
var category = getQueryString("category") || '';

$(function() {

    if (keyword.length>=1)
    {
        $('#keyword_shop').val(keyword);
        $('#keyword_a').addClass('write');
    }

    $("#area_info").on("click",function() {
        $.areaSelected({
            success: function(a) {

                $('.pre-loading').show();

                $("#area_info").val(a.area_info).attr({
                    "data-areaid": a.area_id,
                    "data-areaid2": a.area_id_2 == 0 ? a.area_id_1: a.area_id_2
                });

                $('#ykt_stores').html('');
                $('#wkt_stores').html('');


                $('.pre-loading').hide();

                curpage=1;

                get_list('0');
                get_list('1');
            }
        })
    });


    get_category_list(function(){
        if (!category || category == '')
        {
            var _cate = $("#category_list_container").find('.store_category').eq(0);
            _cate.addClass('active');
            category = _cate.attr('value');
        }

        get_list('0');
        get_list('1');

        $(window).scroll(function() {

            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1) {

                get_list('0');

            }

        });
    });

    $('#serach_store').click(function(){
        var keyword =$('#keyword_shop').val();
        var area_info = $('#area_info').val();
        location.href = ApiUrl+'/index.php?con=shop&keyword='+keyword+'&area_info='+area_info+'&category='+category;
    });

	$("#keyword_a").click(function(){
	   $("#keyword_a").find("input").focus();
	});

});

function get_list(type) {

    type = type||'';

    param = {};

    if (type == 0) {
        if(!hasmore)
            return false;
        param.page = page;
        param.curpage = curpage;
    } else {
        param.page = 1000;
        param.curpage = 1;
    }

    param.store_state = type;

    if (keyword != "") {
        param.keyword = keyword
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

     if (sc_id != "") {
        param.sc_id  = sc_id
     }

     if (category!='')
     {
         param.category = category;
     }


    $.getJSON(ApiUrl + "/index.php?con=shop&fun=shop_list", param, function(e) {

        if (!e) {
            e = [];
            e.datas = [];
            e.datas.store_list = [];
            e.datas.search_list_goods = [];
        }


        if (type == 0) {
            curpage++;
            hasmore = e.hasmore;
        }

        template.helper('formatnum', function(str) {
            return parseInt(str);
        });

        $('.pre-loading').hide();

        e.datas.ApiUrl = ApiUrl;

        var html = template.render('store_item',e.datas);


        if (type == '1') {
            $('#ykt_stores').append(html);
        } else if (type == '0') {
            $('#wkt_stores').append(html);
        }

    })

}

function get_category_list(callback)
{
    $.getJSON(ApiUrl + "/index.php?con=shop&fun=category", function(data){
        if (data.code != 200)
        {
            alert('店铺分类加载失败');
        } else {
            var html = template.render('category_list',data.datas);
            $('#category_list_container').html(html);
            $('#category_list_container').find('.store_category').each(function(i,v){
                var _v = $(v);
                if (_v.attr('value')==category) {
                    _v.addClass('active');
                }
            });
            callback();
        }
    });
}


function zhencu(a,b){
    var z=a%b;
    if(z == 0){
        return true;
    }else{
        return false;
    }
}
$(function(){
    $('.index_taocan').find('dl').each(function(i){
        var inx = i+1;
        if(zhencu(inx,3)){
            $('.index_taocan').find('dl').eq(i).css('border-right','none');
        }
    })
});

$('#category_list_container').on('click','.store_category',function(){
    $('.pre-loading').show();
    window.location.href = 'index.php?con=shop&category='+$(this).attr('value')+'&keyword='+keyword+'&order='+order;
    return false;
});