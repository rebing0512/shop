/**
 * Created by 王健 on 2017/3/18.
 */
var __mbcore_dispatch = function (method, params, callback) {
    params = params || {};
    try {
        window.WebViewJavascriptBridge.callHandler(method, params, function (rd) {
            var data = JSON.parse(rd);
            callback(data);
        });
    } catch (e) {
        $.alert('JSB错误'.e.toString());
    }
};
window.MBC = {
    // 选择图片
    chooseImage: function (a) {
        __mbcore_dispatch('chooseImage',{
            type:a.type||'',
            count:a.count||0
        },function(rd){
            //
            var data = rd;
            var url = "";
            if (data.code == 1) {
                if (a.success && typeof a.success === 'function') {
                    a.success(data); //这里的参数是data
                    // 上傳文件全部結束
                    a.success({
                        code:4
                    });
                }
            } else if (data.code == 0) {
                if (a.success && typeof a.success === 'function') {
                    a.success({
                        code: 2,
                        msg: 'chooseImage:cancel'
                    });
                }
            }
        });
    },
    // 打开新窗口
    openNew: function (a) {
        window.WebViewJavascriptBridge.callHandler('openNew',{
            pageTitle: a.pageTitle || 'MBCORE_TITLE',
            url: a.url || 'about:blank',
            removeHeader: a.removeHeader || false
        }, function (responseData) {
            if (typeof a.success == 'function') {
                a.success(true);
            }
        });
    },
    // 返回
    back: function (a) {
        console.log('ssss')
        window.WebViewJavascriptBridge.callHandler('back', {}, function (rd) {
            if (typeof a.success == 'function') {
                a.success(true);
            }
        });
    },
    //返回首页
    to_shop_index: function () {
        window.WebViewJavascriptBridge.callHandler('to_shop_index', {}, function (rd) {});
    },
    getNetworkType: function (a) {
        window.WebViewJavascriptBridge.callHandler('getNetworkType', {}, function (rd) {
            try {
                rd = JSON.parse(rd);
            } catch (e) {
                alert(e);
                return false;
            }
            if (typeof a.success == 'function') {
                a.success({
                    networkType: rd.networkType
                });
            }
        });
    },
    getLocation: function (a) {
        __mbcore_dispatch('getLocation',{
            type:'wgs84'
        },function(rd){
            if (rd.code !=1 ) {
                $.alert('错误');
            } else {
                if (typeof(a.success) == 'function') {
                    a.success(rd);
                }
            }
        });
    },
    previewImage: function (a) {
        __mbcore_dispatch('previewImage',{
            current:a.current,
            urls:a.urls,
            index:a.index
        },function(rd){})
    },
    // 为兼容微信的一系列wx.shareXXXXX
    setShare : function(a){
        // do nothing
    },
    share: function(a){
        var params = {
            title:a.title||'',
            url:a.url||'',
            image:a.image||'',
            description:a.description||''
        };
        __mbcore_dispatch('share',params,function(rd){
            try {
                if (typeof a.success === 'function') {
                    a.success(rd);
                }
            } catch (e) {
                alert(e.toString());
                console.log(e);
            }
        });
    },
    scanQRCode:function(params){
        __mbcore_dispatch('scanQRCode',{},function(rd){
            if (typeof(params.success) === 'function')
            {
                params.success(rd);
            }
        })
    },
    openLocation:function(params){
        __mbcore_dispatch('openLocation',params,function(){
        });
    },
    payment: function (a){
        __mbcore_dispatch('payment',a,function(rd){
            try {
                if (typeof a.success == 'function')
                    a.success(rd);
            } catch (e) {
                $.alert(e.toString());
            }
        });
    }
};
