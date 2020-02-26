<?php defined('TTShop') or exit('Access Invalid!');?>

<style type="text/css">
iframe {
  height: 100%;
  width: 100%;
  background:#f3f3f3
}
td, 
th, 
div {
  word-break:break-all;
  word-wrap:break-word;
}
table {
  border-collapse: collapse;
  border-spacing:0;
}
th {
  text-align: left;
  font-weight:100;
}
body{
  overflow-x:auto;
  overflow-y:auto;
}
.toposition{
 position: absolute;
top: 10px;
}
</style>
<div class="page" style="padding:0;">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180">
   


    <div class="toposition">
      <ul class="ztree" style="padding:0px;">
        <li> <a title="全部展开、折叠 "><span class="button ico_open" style="background:url({$config_siteurl}statics/images/application_side_expand.png) 0 0 no-repeat;"></span><span id="ztree_expandAll" data-open="false">全部展开、折叠 </span></a> </li>
      </ul>
      <ul id="treeDemo" class="ztree">
      </ul>
    </div>


    </td>
    <td>
    <iframe name="right" id="iframe_categorys_list" src="index.php?con=ncms_article"   style="height: 100%; width:100%;border:none;"   frameborder="0" scrolling="auto"></iframe></td>
  </tr>
</table>


</div>
<script type="text/javascript">


 
$(document).ready(function(){
  $("#file_adv_pic").change(function(){
      $("#textfield1").val($("#file_adv_pic").val());
    });
      $("#submit").click(function(){

      if($("#add_form").valid()){
        $("#add_form").submit();
      }
  });
      $('#add_form').validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            'info[modelid]': {
                required : true,
               
            },
         
            'info[catname]':{
              required:true,
            }
        },
        messages : {
            'info[modelid]': {
                required : "<i class='fa fa-exclamation-circle'></i>请选择模型!" ,
                
            },
         
             'info[catname]': {
                required : "<i class='fa fa-exclamation-circle'></i>请填写栏目名称!" ,
                
            }
        }
    });
 });
    

 
</script>
<script type="text/javascript">
//打开新窗口
function openwinx(url,name,w,h) {
    window.open(url);
}
//配置
var setting = {
    data: {
        key: {
            name: "catname"
        },
        simpleData: {
            enable: true,
            idKey: "catid",
            pIdKey: "parentid",
        }
    },
    callback: {
        beforeClick: function (treeId, treeNode) {
            if (treeNode.isParent) {
                zTree.expandNode(treeNode);
                return false;
            } else {
                return true;
            }
        },
    onClick:function(event, treeId, treeNode){
      //栏目ID
      var catid = treeNode.catid;
      //保存当前点击的栏目ID
      setCookie('tree_catid',catid,1);
    }
    }
};
//节点数据
var zNodes =<?php echo $output['json'];?>
//zTree对象
var zTree = null;
Wind.css('zTree');
$(function(){
  Wind.use('cookie','zTree', function(){
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    zTree = $.fn.zTree.getZTreeObj("treeDemo");
    $("#ztree_expandAll").click(function(){
      if($(this).data("open")){
        zTree.expandAll(false);
        $(this).data("open",false);
      }else{
        zTree.expandAll(true);
        $(this).data("open",true);
      }
    });
    //定位到上次打开的栏目，进行展开tree_catid
    var tree_catid = getCookie('tree_catid');
    if(tree_catid){
      var nodes = zTree.getNodesByParam("catid", tree_catid, null);
      zTree.selectNode(nodes[0]);
    }
  });
});
var B_frame_height = parent.$(".admincp-container-left").height()-8;
$(window).on('resize', function () {
    setTimeout(function () {
    B_frame_height = parent.$(".admincp-container-left").height()-8;
        frameheight();
    }, 100);
});
function frameheight(){
  $("#iframe_categorys").height(B_frame_height);
  $("#iframe_categorys_list").height(B_frame_height);
}
(function (){
  frameheight();
})();
</script>