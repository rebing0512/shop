<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>首页配置</h3>
                <h5>首页信息自定义配置</h5>
            </div>
            <?php echo $output['top_link'];?>
        </div>
    </div>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
            <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
            <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
<!--        <ul>-->
<!--            <li><img src="--><?php //echo RESOURCE_SITE_URL;?><!--/images/index_icon/shuoming.jpg" style="max-width: 500px;"></li>-->
<!--        </ul>-->
    </div>
    <table class="flex-table">
        <thead>
        <tr>
            <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
            <th width="60" class="handle-s" align="center">操作</th>
            <th width="300" align="left">位置</th>
            <th>按钮</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($output['doc_list']) && is_array($output['doc_list'])){ ?>
            <?php foreach($output['doc_list'] as $k => $v){ ?>
                <tr>
                    <td class="sign"><i class="ico-check"></i></td>
                    <td class="handle-s"><a class="btn blue" href="index.php?con=mb_indexconfig&fun=edit&doc_id=<?php echo $v['id']; ?>&h_type=<?php echo intval($_GET['h_type']); ?>"><i class="fa fa-pencil-square-o"></i><?php echo $lang['nc_edit'];?></a></td>
                    <td><?php echo $v['parent']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td></td>
                </tr>
            <?php } ?>
        <?php }else { ?>
            <tr class="no-data">
                <td colspan="100" class="no-data"><i class="fa fa-lightbulb-o"></i><?php echo $lang['nc_no_record'];?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    var h_type = '<?=$_GET['h_type']?>';
    $(function(){
        $('.flex-table').flexigrid({
            height:'auto',// 高度自动
            usepager: false,// 不翻页
            striped: true,// 使用斑马线
            resizable: false,// 不调节大小
            title: '<?php echo $lang['nc_list'];?>',// 表格标题
            reload: false,// 不使用刷新
            columnControl: false// 不使用列控制
        });
    });
</script>