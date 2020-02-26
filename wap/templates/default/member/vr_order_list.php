<?php defined('TTShop') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_common.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/nctouch_cart.css">
</head>
<body>
<header id="header" class="fixed">
  <div class="header-wrap">
    <div class="header-l"> <a href="javascript:history.go(-1)"> <i class="back"></i> </a> </div>
    <span class="header-tab"><a href="<?php echo urlMobile('member_order');?>">实物订单</a><a href="javascript:void(0);" class="cur">虚拟订单</a></span>
  <div class="header-r"> <a id="header-nav" href="javascript:void(0);"><i class="more"></i><sup></sup></a> </div>
  </div>
  <?php include template('layout/toptip');?>

</header>
<div class="nctouch-main-layout">
<!--   <div class="nctouch-order-search">
    <form>
      <span>
      <input type="text" autocomplete="on" maxlength="50" placeholder="输入商品标题或订单号进行搜索" name="order_key" id="order_key" oninput="writeClear($(this));" >
      </span> <span class="input-del"></span>
      <input type="button" id="search_btn" value="&nbsp;">
    </form>
  </div> -->
  <div id="fixed_nav" class="nctouch-single-nav">
    <ul id="filtrate_ul" class="w33h">
      <li class="selected"><a href="javascript:void(0);" data-state="">全部</a></li>
      <li><a href="javascript:void(0);" data-state="state_new">待付款</a></li>
      <li><a href="javascript:void(0);" data-state="state_pay">待使用</a></li>
    </ul>
  </div>
  <div id="loding"></div>
  <div class="nctouch-order-list" id="order-list"> </div>
</div>
<!--底部总金额固定层End-->
<div class="nctouch-bottom-mask">
  <div class="nctouch-bottom-mask-bg"></div>
  <div class="nctouch-bottom-mask-block">
    <div class="nctouch-bottom-mask-tip"><i></i>点击此处返回</div>
    <div class="nctouch-bottom-mask-top">
      <p class="nctouch-cart-num">本次交易需在线支付<em id="onlineTotal">0.00</em>元</p>
      <p style="display:none" id="isPayed"></p>
      <a href="javascript:void(0);" class="nctouch-bottom-mask-close"><i></i></a> </div>
    <div class="nctouch-inp-con nctouch-inp-cart">
      <ul class="form-box" id="internalPay">
        <p class="rpt_error_tip" style="display:none;color:red;"></p>
        <li class="form-item" id="wrapperUseRCBpay">
          <div class="input-box pl5">
            <label>
              <input type="checkbox" class="checkbox" id="useRCBpay" autocomplete="off" />
              使用充值卡支付 <span class="power"><i></i></span> </label>
            <p>可用余额 ￥<em id="availableRcBalance"></em></p>
          </div>
        </li>
        <li class="form-item" id="wrapperUsePDpy">
          <div class="input-box pl5">
            <label>
              <input type="checkbox" class="checkbox" id="usePDpy" autocomplete="off" />
              使用预存款支付 <span class="power"><i></i></span> </label>
            <p>可用余额 ￥<em id="availablePredeposit"></em></p>
          </div>
        </li>
        <li class="form-item" id="wrapperPaymentPassword" style="display:none">
          <div class="input-box"> <span class="txt">输入支付密码</span>
            <input type="password" class="inp" id="paymentPassword" autocomplete="off" />
            <span class="input-del"></span></div>
          <a href="../member/member_paypwd_step1.html" class="input-box-help" style="display:none"><i>i</i>尚未设置</a> </li>
      </ul>
      <div class="nctouch-pay">
        <div class="spacing-div"><span>在线支付方式</span></div>
        <div class="pay-sel">
          <label style="display:none">
            <input type="radio" name="payment_code" class="checkbox" id="alipay" autocomplete="off" />
            <span class="alipay">支付宝</span></label>
          <label style="display:none">
            <input type="radio" name="payment_code" class="checkbox" id="wxpay_jsapi" autocomplete="off" />
            <span class="wxpay">微信</span></label>
        </div>
      </div>
      <div class="pay-btn"> <a href="javascript:void(0);" id="toPay" class="btn-l">确认支付</a> </div>
    </div>
  </div>
</div>
<div class="fix-block-r">
	<a href="javascript:void(0);" class="gotop-btn gotop hide" id="goTopBtn"><i></i></a>
</div>
<script type="text/html" id="order-list-tmpl">
<div class="order-list">
    <% if (order_list && order_list.length > 0) { %>
	<ul>
    <% for (var i = 0; i < order_list.length; i++) { var order = order_list[i]; %>
        <li class="<% if (order.if_pay) { %>gray-order-skin<% } else { %>green-order-skin<% } %> mt10">
			<div class="nctouch-order-item">
				<div class="nctouch-order-item-head">
					<%if (order.ownshop){%>
						<a class="store"><i class="icon"></i><%=order.store_name%></a>
					<%}else{%>
						<a href="<%=WapSiteUrl%>/tmpl/store.html?store_id=<%=order.store_id%>" class="store"><i class="icon"></i><%=order.store_name%><i class="arrow-r"></i></a>
					<%}%>
					<span class="state">
				     <span class="<% if (order.order_state == '0') { %>ot-cancel<% } else { %>ot-nofinish<% } %>">
                            <%= order.order_state_text %>
                        </span>
					</span>
				</div>
				<div class="nctouch-order-item-con">
					<div class="goods-block">
						<a href="<%=WapSiteUrl%>/tmpl/member/vr_order_detail.html?order_id=<%=order.order_id%>">
							<div class="goods-pic">
                            	<img src="<%=order.goods_image_url%>"/>
                        	</div>
							<dl class="goods-info">
								<dt class="goods-name"><%=order.goods_name%></dt>
								<dd class="goods-type"></dd>
							</dl>
							<div class="goods-subtotal">
								<span class="goods-price">￥<em><%=order.goods_price%></em></span>
								<span class="goods-num">x<%=order.goods_num%></span>
							</div>
						</a>
					</div>
				</div>
				<div class="nctouch-order-item-footer">
					<div class="store-totle">
						<span>合计</span><span class="sum">￥<em><%=order.order_amount%></em></span>
					</div>
					<div class="handle">
					<% if (order.if_cancel) { %>
                        <a href="javascript:void(0)" order_id="<%=order.order_id%>" class="btn cancel-order">取消订单</a>
                    <% } %>
					<% if (order.if_evaluation) { %>
                        <a href="javascript:void(0)" order_id="<%=order.order_id%>" class="btn evaluation-order">评价订单</a>
                    <% } %>
					</div>
				</div>
				</div>
				<% if (order.if_pay) { %>
            		<a href="javascript:;" data-paySn="<%=order.order_sn %>" class="btn-l check-payment">订单支付<em>（￥<%= p2f(order.order_amount) %>）</em></a>
        		<% } %>
        	</li>
		<% } %>
		<% if (hasmore) {%>
		<li class="loading"><div class="spinner"><i></i></div>订单数据读取中...</li>
		<% } %>
	</ul>
	<% } else { %>
    <div class="nctouch-norecord order">
					<div class="norecord-ico"><i></i></div>
					<dl>
                    	<dt>您还没有相关的订单</dt>
						<dd>可以去看看哪些想要买的</dd>
					</dl>
					<a href="<%=WapSiteUrl%>" class="btn">随便逛逛</a>
                </div>
	<% } %>
</div>
</script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/simple-plugin.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.waypoints.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/order_payment_common.js"></script> 
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/list/vr_order_list.js"></script>
</body>
</html>
