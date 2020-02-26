<?php defined('TTShop') or exit('Access Invalid!');?>
<script type="text/javascript">
    <?php if (is_array($output['pic']) && !empty($output['pic'])) { ?>
	parent.screen_pic("<?php echo $output['pic']['pic_id'];?>","<?php echo $output['pic']['pic_img'];?>");
	<?php } ?>
	 <?php if (is_array($output['zom_pic']) && !empty($output['zom_pic'])) { ?>
	parent.zomslide_pic("<?php echo $output['zom_pic']['pic_id'];?>","<?php echo $output['zom_pic']['pic_img'];?>");
	<?php } ?>

    <?php if (!empty($output['ap_pic_id'])) { ?>
	parent.screen_ap("<?php echo $output['ap_pic_id'];?>","<?php echo $output['ap_color'];?>");
	<?php } ?>

</script>