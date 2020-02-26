<?php defined('TTShop') or exit('Access Invalid!');?>
<link type="text/css" rel="stylesheet" href="<?php echo SHOP_SITE_URL;?>/templates/default/css/home_login.css">
<script type="text/javascript">

$(document).ready(function(){
    var is_login="<?php echo $_SESSION['is_login'];?>";
     var newsTitle = $("#newsTitle").text();
    if (newsTitle.substr(0, 1) == "【") {
        $("#newsTitle").css({ textIndent: "-12px" });
    }
    
  $(".comment-input .btn span.register").click(function () {
        window.location.href = '/index.php?con=login&fun=register';
    });
    var url_comment_list = "index.php?con=comment&fun=comment_list&comment_object_id=<?php echo $output['detail_object_id'];?>&comment_object_catid=<?php echo $output['detail_object_catid'];?>&comment_all=<?php echo $output['comment_all'];?>";
    $("#btnReview").click(function(){
        if($("#input_comment_message").val() != '') {
         
        $.post("<?php echo urlShop('comment','comment_save');?>", $("#add_form").serialize(),
            function(data){
                if(data.result == 'true') {
                    $("#input_comment_message").val("");
                    $("#comment_list").load(url_comment_list);
                    $("#comment_list dl").first().hide().fadeIn("fast");
                } else {
                    showError(data.message);
                }
            }, "json");
        }
    });

    //初始加载评论
    $("#comment_list").load(url_comment_list);

    //评论翻页
    $("#comment_list .demo").live('click',function(e){
        $("#comment_list").load($(this).attr('href'));
        return false;
    });

    //评论删除
    $("[nctype=comment_drop]").live('click',function(){
        if(confirm('<?php echo $lang['nc_ensure_del'];?>')) {
            var item = $(this).parents("dl");
            var comment_object_id = $('#input_comment_object_id').val();
            var comment_object_catid = $('#input_comment_object_catid').val();
            $.post("index.php?con=comment&fun=comment_drop", { comment_id: $(this).attr("comment_id"), comment_object_id:comment_object_id, comment_object_catid:comment_object_catid}, function(json){
                if(json.result == "true") {
                    item.remove();
                } else {
                    showError(json.message);
                }
            },'json');
        }
    });

    <?php if($_SESSION['is_login'] != '1'){?>
    //登陆窗口
    $("#ajax_login_btn").nc_login({
        nchash:'<?php echo getNchash();?>',
        formhash:'<?php echo Security::getTokenValue();?>',
        anchor:'PLmao'
    });
    <?php } ?>

    $('#comment_list').on('click', '[nctype="comment_quote"]', function() {
        <?php if($_SESSION['is_login'] != '1'){?>
        //登陆窗口
        $.show_nc_login({
            nchash:'<?php echo getNchash();?>',
            formhash:'<?php echo Security::getTokenValue();?>',
            anchor:'PLmao'
        });
        <?php } else { ?>
        var $comment = $(this).parents('p').next('.comment-quote');
        if($comment.length > 0) {
            $comment.remove();
        } else {
            $(this).parents('p').after('<p class="comment-quote">' + $('#comment_quote').html() + '<input name="comment_id" value="' + $(this).attr('comment_id') + '" type="hidden" />' + '</p>');
        }
        <?php } ?>
    });

    //回复
    $('#comment_list').on('click', '[nctype="btn_comment_quote_publish"]', function() {
        var comment_id = $(this).parents('p').find('input').val();
        var comment_object_id = $('#input_comment_object_id').val();
        var comment_object_catid = $('#input_comment_object_catid').val();

        var comment_message = $(this).parents('p').find('textarea').val();
        $.post("<?php echo urlShop('comment','comment_save');?>", {comment_id:comment_id, comment_object_id:comment_object_id, comment_object_catid:comment_object_catid,comment_message:comment_message},
            function(data){
                if(data.result == 'true') {
                    $("#input_comment_message").val("");
                    $("#comment_list").load(url_comment_list);
                    $("#comment_list dl").first().hide().fadeIn("fast");
                } else {
                    showError(data.message);
                }
            }, "json");
    });

    $('#comment_list').on('click', '[nctype="btn_comment_quote_cancel"]', function() {
        $(this).parents('p').remove();
    });

    $('#comment_list').on('click', '[nctype="comment_up"]', function() {
        <?php if($_SESSION['is_login'] != '1'){?>
        //登陆窗口
        $.show_nc_login({
            nchash:'<?php echo getNchash();?>',
            formhash:'<?php echo Security::getTokenValue();?>',
            anchor:'PLmao'
        });
        <?php } else { ?>
        var comment_id = $(this).attr('comment_id');
        var $count = $(this).find('em');
        $.post("index.php?con=comment&fun=comment_up", {comment_id:comment_id},
            function(data){
                if(data.result == 'true') {
                    var old_count = parseInt($count.text());
                    $count.text(old_count + 1);
                } else {
                    showError(data.message);
                }
         }, "json");
        <?php } ?>
    });

});
</script>


    <div class="news-comment cms_comment_flag" id="PLmao">
                <h3 class="yahei">我有话要说
                 <span><?php echo $lang['cms_comment1'];?><a href="<?php echo urlShop('cms_index', 'comment_detail', array('id'=>$vt['id'],'catid'=>$vt['catid']));?>"><em><?php echo $output['data']['comment'];?></em></a><?php echo $lang['cms_comment2'];?><em><?php echo $output['data']['views'];?></em><?php echo $lang['cms_comment3'];?></span>
                 </h3>
                 <form id="add_form" action="" class="article-comment-form">

                  <input id="input_comment_object_id" name="comment_object_id" type="hidden" value="<?php echo $output['detail_object_id'];?>" />
                <input id="input_comment_object_catid" name="comment_object_catid" type="hidden" value="<?php echo $output['detail_object_catid'];?>" />
                    <div class="comment-input">
                        <div class="head-img">
                            <img  src="<?php echo getMemberAvatar($_SESSION['avatar']);?>" />
                            <span class="arrow-1" style="top: 25px; left: 66px;">&lt;</span>
                            <textarea id="input_comment_message" name="comment_message" placeholder="说点什么吧..."></textarea>
                        </div>
                        <div class="btn">
                            <?php if(!$_SESSION['is_login']){?>
                            <span class="selected" id="ajax_login_btn">登录</span><span class="register">注册</span>
                            <?php }else{ ?>
                            <span class="user_name"><?php echo $_SESSION['member_name'];?></span>
                            <?php } ?>

                            <div class="right"  id="btnReview"></div>
                        </div>
                    </div>
                  </form>    
                    <div id="comment_list" class="article-comment-list"></div>
                    <div id="comment_quote" style="display:none;">
                        <span class="comment_box">
                        <a nctype="btn_comment_quote_cancel" href="JavaScript:;" class="cancel-btn" title="取消"></a>
                         <span class="head-img">
                                <img  src="<?php echo getMemberAvatar($_SESSION['avatar']);?>" />
                                <span class="arrow-1" style="top: 25px; left: 66px;">&lt;</span>
                                <textarea id="comment_quote" name="comment_quote" placeholder="说点什么吧..."></textarea>
                        </span>
                        <a nctype="btn_comment_quote_publish" href="JavaScript:;" class="publish-btn">发布</a>
                        </span>
                    </div>

   </div>
