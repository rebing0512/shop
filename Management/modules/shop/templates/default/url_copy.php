<?php defined('TTShop') or exit('Access Invalid!');?>
<dl style="padding:10px 30px;line-height:30px">
    <dd>店铺URL:</dd>
    <dd >
        <input type="text" style=" width:400px;" value='<?=urlMobile('store','index',array('store_id'=>$_GET['store_id']))?>' />
    </dd>
    <dd style="border-top: dotted 1px #E7E7E7; color: #F60;">请将URL地址复制并粘贴到对应的调用位置！</dd>
</dl>