<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL; ?>/js/jquery.js"></script>
<style>
    html,body{ height:100%;}
    .msg{ width:100%; height:100%;text-align:center; padding-top:160px;}
    .msg{ color:#333; font-size:14px;}
    .header{
        height: 50px;
        line-height: 50px;
        background-color: #c40035;
        text-align: center;
        font-size: 16px;
        color: #fff;
        position: relative;
    }
</style>
<div class="header">
    消息提醒
</div>
<div class="msg">
<span>
<?php echo $output['msg']; ?>(<span id="second">5</span>后跳转)
</span>
</div>

<script>
    $(function(){
        var i = 5;
        var timer = setInterval(function () {
            i--;
            $("#second").html(i);
            if(i==1){
                window.location.href="<?php echo $output['href']; ?>";
            }
        },1000);


    });
</script>