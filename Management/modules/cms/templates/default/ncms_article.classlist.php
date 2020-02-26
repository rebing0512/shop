<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">
.flexigrid .hDiv .handle div, .flexigrid .bDiv .handle div {overflow: visible;min-width: 250px !important;max-width: 250px !important;}
</style>
<div class="page" style="padding:0;">


  <div id="flexigrid"></div>
    <div class="ncap-search-ban-s" id="searchBarOpen"><i class="fa fa-search-plus"></i>高级搜索</div>
  <div class="ncap-search-bar">
    <div class="handle-btn" id="searchBarClose"><i class="fa fa-search-minus"></i>收起边栏</div>
    <div class="title">
      <h3>高级搜索</h3>
    </div>
    <form method="get" name="formSearch" id="formSearch">
      <div id="searchCon" class="content">
        <div class="layout-box">
           <dl>
            <dt>搜索类型</dt>
            <dd>
              <label>
                <select name="goods_verify" class="s-select">
                  <option value="">ID</option>
                  <option value="1">标题</option>
                  <option value="2">简介</option>
               
                </select>
              </label>
            </dd>
          </dl>
          <dl>
            <dt>文章标题</dt>
            <dd>
              <label>
                <input type="text" value="" name="goods_name" id="goods_name" class="s-input-txt" placeholder="输入文章标题全称或关键字">
              </label>
            </dd>
          </dl>
        <dl>
            <dt>按时间周期筛选</dt>
            <dd>
              <label>
                <select name="search_type" id="search_type" class="s-select">
                  <option value="day" <?php echo $output['search_arr']['search_type']=='day'?'selected':''; ?>>按照天统计</option>
                  <option value="week" <?php echo $output['search_arr']['search_type']=='week'?'selected':''; ?>>按照周统计</option>
                  <option value="month" <?php echo $output['search_arr']['search_type']=='month'?'selected':''; ?>>按照月统计</option>
                </select>
              </label>
            </dd>
            <dd id="searchtype_day" style="display:none;">
              <label>
                <input class="s-input-txt" type="text" value="<?php echo @date('Y-m-d',$output['search_arr']['day']['search_time']);?>" id="search_time" name="search_time">
              </label>
            </dd>
            <dd id="searchtype_week" style="display:none;">
              <label>
                <select name="searchweek_year" class="s-select">
                  <?php foreach ($output['year_arr'] as $k => $v){?>
                  <option value="<?php echo $k;?>" <?php echo $output['search_arr']['week']['current_year'] == $k?'selected':'';?>><?php echo $v; ?>年</option>
                  <?php } ?>
                </select>
              </label>
              <label>
                <select name="searchweek_month" class="s-select">
                  <?php foreach ($output['month_arr'] as $k => $v){?>
                  <option value="<?php echo $k;?>" <?php echo $output['search_arr']['week']['current_month'] == $k?'selected':'';?>><?php echo $v; ?>月</option>
                  <?php } ?>
                </select>
              </label>
              <label>
                <select name="searchweek_week" class="s-select">
                  <?php foreach ($output['week_arr'] as $k => $v){?>
                  <option value="<?php echo $v['key'];?>" <?php echo $output['search_arr']['week']['current_week'] == $v['key']?'selected':'';?>><?php echo $v['val']; ?></option>
                  <?php } ?>
                </select>
              </label>
            </dd>
            <dd id="searchtype_month" style="display:none;">
              <label>
                <select name="searchmonth_year" class="s-select">
                  <?php foreach ($output['year_arr'] as $k => $v){?>
                  <option value="<?php echo $k;?>" <?php echo $output['search_arr']['month']['current_year'] == $k?'selected':'';?>><?php echo $v; ?>年</option>
                  <?php } ?>
                </select>
              </label>
              <label>
                <select name="searchmonth_month" class="s-select">
                  <?php foreach ($output['month_arr'] as $k => $v){?>
                  <option value="<?php echo $k;?>" <?php echo $output['search_arr']['month']['current_month'] == $k?'selected':'';?>><?php echo $v; ?>月</option>
                  <?php } ?>
                </select>
              </label>
            </dd>
          </dl>
 
         
       
        </div>
      </div>
      <div class="bottom"><a href="javascript:void(0);" id="ncsubmit" class="ncap-btn ncap-btn-green mr5">提交查询</a><a href="javascript:void(0);" id="ncreset" class="ncap-btn ncap-btn-orange" title="撤销查询结果，还原列表项所有内容"><i class="fa fa-retweet"></i><?php echo $lang['nc_cancel_search'];?></a></div>
    </form>
  </div>
  <script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
  <script type="text/javascript">
    gcategoryInit('gcategory');
    </script>

<script>

//展示搜索时间框
function show_searchtime(){
    s_type = $("#search_type").val();
    $("[id^='searchtype_']").hide();
    $("#searchtype_"+s_type).show();
}
$(function(){
    //统计数据类型
    var s_type = $("#search_type").val();
    $('#search_time').datepicker({dateFormat: 'yy-mm-dd'});
    show_searchtime();
    $("#search_type").change(function(){
        show_searchtime();
    });
    //更新周数组
    $("[name='searchweek_month']").change(function(){
        var year = $("[name='searchweek_year']").val();
        var month = $("[name='searchweek_month']").val();
        $("[name='searchweek_week']").html('');
        $.getJSON('<?php echo ADMIN_SITE_URL?>/index.php?con=common&fun=getweekofmonth',{y:year,m:month},function(data){
            if(data != null){
                for(var i = 0; i < data.length; i++) {
                    $("[name='searchweek_week']").append('<option value="'+data[i].key+'">'+data[i].val+'</option>');
                }
            }
        });
    });
    $('#btn_verify_submit').on('click', function() {
        $('#verify_form').submit();
    });

    var flexUrl = 'index.php?con=ncms_article&fun=ncms_article_list_xml&catid=<?php echo $output['catid']; ?>';

    $("#flexigrid").flexigrid({
        url: flexUrl,
        colModel: [
            {display: '操作', name: 'operation', width: 300, sortable: false, align: 'center', className: 'handle'},
            {display: 'id', name: 'id', width: 60, sortable: false, align: 'left'},
            {display: '标题', name: 'title', width: 150, sortable: false, align: 'left'},
            {display: '点击量', name: 'views', width: 150, sortable: false, align: 'left'},
            {display: '发布人', name: 'username', width: 150, sortable: false, align: 'left'},
            {display: '发布时间', name: 'inputtime', width: 150, sortable: false, align: 'left'},
            {display: '更新时间', name: 'updatetime', width: 150, sortable: false, align: 'left'},
            {display: '排序', name: 'listorder', width: 150, sortable: false, align: 'left'},
            {display: '状态', name: 'status', width: 60, sortable: false, align: 'left'},
        
        ],
        buttons: [
           
               {display: '<i class="fa fa-plus"></i>新增文章', name : 'add', bclass : 'add', title : '新增分类', onpress : fg_operation },
               {display: '<i class="fa fa-trash"></i>批量删除', name : 'del', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operation }

        ],
      
  
        title: '文章列表'
    });

    // 高级搜索提交
    $('#ncsubmit').click(function(){
        $("#flexigrid").flexOptions({url: flexUrl + '&' + $("#formSearch").serialize(),query:'',qtype:''}).flexReload();
    });

    // 高级搜索重置
    $('#ncreset').click(function(){
        $("#flexigrid").flexOptions({url: flexUrl}).flexReload();
        $("#formSearch")[0].reset();
    });

});

$("a[data-j='drop']").live('click', function() {
    if (!confirm('确定删除?')) {
        return false;
    }
    var catid = $(this).attr('data-catid');
    var id = $(this).parents('tr[data-id]').attr('data-id');
    location.href = 'index.php?con=ncms_article&fun=ncms_article_drop&id='+id+'&catid='+catid;
});

$("a[data-j='edit']").live('click', function() {
    var id = $(this).parents('tr[data-id]').attr('data-id');
    var catid = $(this).attr('data-catid');
    location.href = 'index.php?con=ncms_article&fun=ncms_article_edit&id='+id+'&catid='+catid;
});




  $('body').on('click','span[nc_type="inline_edit"]',function(){

         var span = $(this);
           var old_value = $(this).html();
           var fieldid = $(this).attr("fieldid");
           var catid = $(this).attr("fieldcateid");
           $('<input type="text">')
           .insertAfter($(this))
           .focus()
           .select()
           .val(old_value)
           .blur(function(){
               var new_value = $(this).attr("value");
               if(new_value != '') {
                   $.get('index.php?con=ncms_article&fun=ajax',{id:fieldid,catid:catid,column:'listorder',value:new_value},function(data){
                       data = $.parseJSON(data);
                       if(data) {
                           span.show().text(new_value);
                           $("#flexigrid").flexReload();
                       } else {
                           span.show().text(old_value);
                           alert(data.message);
                       }
                   });
               } else {
                   span.show().text(old_value);
               }
               $(this).remove();
           })
           $(this).hide();
     })



function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = 'index.php?con=ncms_article&fun=ncms_article_add&catid=<?php echo $output['catid']; ?>';
    }else if (name == 'del') {
        if($('.trSelected',bDiv).length>0){
            var itemlist = new Array();
      $('.trSelected',bDiv).each(function(){
        itemlist.push($(this).attr('data-id'));
      });
            fg_delete(itemlist);
        } else {
            return false;
        }
    } 
   

}



function fg_delete(id) {
  if (typeof id == 'number') {
      var id = new Array(id.toString());
  };
  if(confirm('删除后将不能恢复，确认删除这 ' + id.length + ' 项吗？')){
    id = id.join(',');
  } else {
        return false;
    }
  $.ajax({
        type: "GET",
        dataType: "json",
        url: "index.php?con=ncms_article&fun=delete",
        data: "del_id="+id+"&catid=<?php echo $_GET['catid'];?>",
        success: function(data){
            if (data.state){
                $("#flexigrid").flexReload();
            } else {
              alert(data.msg);
            }
        }
    });
}
</script>
