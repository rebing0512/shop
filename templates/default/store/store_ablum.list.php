<?php defined('TTShop') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/layer/layer.js"></script> 
<style type="text/css">
  .ncs-main{
    width: 1200px;
    min-height: 700px;
  }
</style>
<div class="wrapper mt10">
  <div class="ncs-main">

    <div class="ncs-main-container">
      <div class="title"> 
        <h4>相册列表</h4>
      </div>
        <?php if(!empty($output['aclass_info'])){?>
        <div class="content ncs-pic-list">
                  <ul>
                 <?php foreach ($output['aclass_info'] as $v){?>

                      <li class="pic_list" li_id = "<?php echo $v['aclass_id'];?>" store_id="<?php echo $v['store_id'];?>">
                      <dl>
                        <a href="javascript:void(0)">
                          <dt><img id="aclass_cover" src="<?php echo athumb($v['aclass_cover'], 240, $v['store_id']);?>"></dt>
                          <dd class="pic-name"><?php echo $v['aclass_name'];?>(共<?php echo $v['count']?>张)</dd>
                          <dd class="pic-info"><?php echo $v['aclass_des'];?></dd>
                         </a>
                      </dl>
                    
                    </li>
                  <?php }?>
                    </ul>
                </div>
        <?php }?>
    </div>

  </div>

</div>

<script>
  $(function(){
    $('.pic_list').click(function(){
     var index = layer.load(1);
      var id = $(this).attr('li_id') ;
      var store_id = $(this).attr('store_id') ;
      var url ='index.php?con=show_store&fun=ablum_details&id='+ id + '&store_id='+store_id;
      $.getJSON(url, function(json){
        layer.close('index');
      layer.photos({
          photos: json
        });
      }); 
    })

  })
</script>