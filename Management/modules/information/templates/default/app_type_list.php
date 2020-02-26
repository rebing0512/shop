<?php defined('TTShop') or exit('Access Invalid!');?>
<style type="text/css">
    .flexigrid .bDiv tr:nth-last-child(2) span.btn ul { bottom: 0; top: auto}
</style>


<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>信息模式推荐分类管理</h3>
                <h5>横图和圆图的信息模式下进行分类的管理，以便组合成可以需要的列表。</h5>
            </div>
        </div>
    </div>
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
            <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
            <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span>
        </div>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <form method='post'>
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="submit_type" id="submit_type" value="" />
        <table class="flex-table">
            <thead>
            <tr>
                <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
                <th width="150" class="handle" align="center">操作</th>
                <th width="60" align="center">ID</th>
                <th width="60" align="center">排序</th>
                <th width="80" align="center">分类名称</th>
                <th width="80" align="center">核心分类</th>
                <th width="80" align="center">关联信息模型</th>
                <th width="80" align="center"></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($output['type']) && is_array($output['type'])){ ?>
                <?php foreach($output['type'] as $k => $v){ ?>
                    <tr data-id="<?php echo $v['id'];?>">
                        <td class="sign"><i class="ico-check"></i></td>
                        <td class="handle">
                            <a class="btn red" href="javascript:void(0);" onclick="fg_del(<?php echo $v['id'];?>);">
                                <i class="fa fa-trash-o"></i>
                                删除
                            </a>
                            <span class="btn">
                                <em>
                                    <i class="fa fa-cog">

                                    </i>
                                    操作
                                    <i class="arrow">

                                    </i>
                                </em>
            <ul>
              <li><a href="index.php?con=mb_app_type&fun=type_edit&id=<?php echo $v['id'];?>">编辑分类信息</a></li>
              <li><a target="_blank" href="<?php echo SHOP_SITE_URL;?>/wap/index.php?con=index&fun=<?php echo $output['info_fenlei'][$v['info_type']]['opname'];?>&type_id=<?php echo $v['id'];?>&__ccid=<?php echo $v['h_type'];?>">查看绑定专题</a></li>
            </ul>
            </span></td>
                        <td><?php echo $v['info_type'].'-'.$v['id'].'-'.$v['h_type'];?></td>
                        <td><?php echo $v['sort'];?></td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php echo $output['category_name'][$v['h_type']];?></td>
                        <td><?php echo $output['info_fenlei'][$v['info_type']]['name'];?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            <?php }else { ?>
                <tr>
                    <td class="no-data" colspan="100"><i class="fa fa-exclamation-circle"></i><?php echo $lang['nc_no_record'];?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
    $(function(){
        $('.flex-table').flexigrid({
            height:'auto',// 高度自动
            usepager: false,// 不翻页
            striped:false,// 不使用斑马线
            resizable: false,// 不调节大小
            title: '信息模式推荐分类',// 表格标题
            reload: false,// 不使用刷新
            columnControl: false,// 不使用列控制
            buttons : [
                {display: '<i class="fa fa-plus"></i>新增数据', name : 'add', bclass : 'add', onpress : fg_operation }/*,
                {display: '<i class="fa fa-trash"></i>批量删除', name : 'del', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operation }*/
            ]
        });

        $('span[nc_type="inline_edit"]').inline_edit({act: 'goods_class',op: 'ajax'});
    });

    function fg_operation(name, bDiv) {
        if (name == 'add') {
            window.location.href = 'index.php?con=mb_app_type&fun=type_add';
        } else if (name == 'del') {
            if ($('.trSelected', bDiv).length == 0) {
                showError('请选择要操作的数据项！');
            }
            var itemids = new Array();
            $('.trSelected', bDiv).each(function(i){
                itemids[i] = $(this).attr('data-id');
            });
            fg_del(itemids);
        } else if (name = 'csv') {
            window.location.href = 'index.php?con=mb_app_type&fun=goods_class_export';
        }
    }
    function fg_del(ids) {
        if (typeof ids == 'number') {
            var ids = new Array(ids.toString());
        };
        id = ids.join(',');
        if(confirm('删除后将不能恢复，确认删除这项吗？')){
            $.getJSON('index.php?con=mb_app_type&fun=type_del', {id:id}, function(data){
                if (data.state) {
                    location.reload();
                } else {
                    showError(data.msg)
                }
            });
        }
    }
</script>