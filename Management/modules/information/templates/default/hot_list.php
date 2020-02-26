<?php defined('TTShop') or exit('Access Invalid!');?>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>热门<?=$output['sb_type']?></h3>
                <h5>黄页热门<?=$output['sb_type']?>配置</h5>
            </div>
            <?php echo $output['link'];?>
        </div>
    </div>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
            <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
            <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    </div>
    <table class="flex-table">
        <thead>
        <tr>
            <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
            <th width="60" class="handle-s" align="center">操作</th>
            <th width="300" align="left">关联核心分类</th>
            <th>推荐数量</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($output['doc_list']) && is_array($output['doc_list'])){ ?>
            <?php foreach($output['doc_list'] as $k => $v){ ?>
                <tr>
                    <td class="sign"><i class="ico-check"></i></td>
                    <td class="handle-s"><a class="btn blue" href="index.php?con=mb_yellowpage&fun=hot_edit&sb_type=<?php echo $_GET['sb_type'];?>&id=<?php echo $v['id']; ?>"><i class="fa fa-pencil-square-o"></i><?php echo $lang['nc_edit'];?></a></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['count'];?></td>
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