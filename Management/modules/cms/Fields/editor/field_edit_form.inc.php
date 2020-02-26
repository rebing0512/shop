<table cellpadding="2" cellspacing="1" width="38%">
   <tr> 
        <td>编辑器类型：</td>
        <td>
            <input type="radio" name="setting[type]" value="basic" <?php if ($setting['type'] == 'basic') echo 'checked'; ?>> 基本 
            <input type="radio" name="setting[type]" value="simple" <?php if ($setting['type'] == 'simple') echo 'checked'; ?>> 简洁
            <input type="radio" name="setting[type]" value="all"  <?php if ($setting['type'] == 'all') echo 'checked'; ?>> 全部
        </td>
    </tr>
    <tr> 
        <td>默认值：</td>
        <td><textarea name="setting[defaultvalue]" rows="2" cols="20" id="defaultvalue" style="height:100px;width:99%"><?php echo forTag($setting['defaultvalue']); ?></textarea></td>
    </tr>
    <tr> 
        <td>是否允许上传：</td>
        <td><input type="radio" name="setting[upload_state]" value="true" <?php if ($setting['upload_state'] == 'true') echo 'checked'; ?>> 是 <input type="radio" name="setting[upload_state]" value="false" <?php if ($setting['upload_state'] == 'false') echo 'checked'; ?>> 否</td>
    </tr>
     <tr> 
        <td>是否开启多媒体：</td>
        <td><input type="radio" name="setting[media_open]" value="true" <?php if ($setting['media_open'] == 'true') echo 'checked'; ?>> 是 <input type="radio" name="setting[media_open]" value="false" <?php if ($setting['media_open'] == 'false') echo 'checked'; ?>> 否</td>
    </tr>
    <tr> 
        <td>编辑器默认宽度：</td>
        <td><input type="text" name="setting[width]" value="<?php echo $setting['width']; ?>" size="4" class="input"> <span>px</span></td>
    </tr>
    <tr> 
        <td>编辑器默认高度：</td>
        <td><input type="text" name="setting[height]" value="<?php echo $setting['height']; ?>" size="4" class="input"> <span>px</span></td>
    </tr>
    <td>字段类型</td>
    <td>
       <select name="setting[fieldtype]">
            <option value="text" <?php if ($setting['fieldtype'] == 'text') echo 'selected'; ?>>小型字符型(TEXT)</option>
            <option value="mediumtext" <?php if ($setting['fieldtype'] == 'mediumtext') echo 'selected'; ?><?php echo  empty($setting['fieldtype'])?'selected':'' ?>>中型字符型(MEDIUMTEXT)</option>
            <option value="longtext" <?php if ($setting['fieldtype'] == 'longtext') echo 'selected'; ?>>大型字符型(LONGTEXT)</option>
        </select> </span>
    </td>
</table>

