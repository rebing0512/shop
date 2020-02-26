<table cellpadding="2" cellspacing="1" width="38%">
   <tr> 
        <td>编辑器类型：</td>
        <td>
            <input type="radio" name="setting[type]" value="basic" checked> 基本 
            <input type="radio" name="setting[type]" value="simple" > 简洁
            <input type="radio" name="setting[type]" value="all" > 全部
        </td>
    </tr>
    <tr> 
        <td>默认值：</td>
        <td><textarea name="setting[defaultvalue]" rows="2" cols="20" id="defaultvalue" style="height:100px;width:99%"></textarea></td>
    </tr>
    <tr> 
        <td>是否允许上传：</td>
        <td><input type="radio" name="setting[upload_state]" value="true"> 是 <input type="radio" name="setting[upload_state]" value="false" checked> 否</td>
    </tr>
     <tr> 
        <td>是否开启多媒体：</td>
        <td><input type="radio" name="setting[media_open]" value="true"> 是 <input type="radio" name="setting[media_open]" value="false" checked> 否</td>
    </tr>
    <tr> 
        <td>编辑器默认宽度：</td>
        <td><input type="text" name="setting[width]" value="200" size="4" class="input"> <span>px</span></td>
    </tr>
    <tr> 
        <td>编辑器默认高度：</td>
        <td><input type="text" name="setting[height]" value="200" size="4" class="input"> <span>px</span></td>
    </tr>
    <td>字段类型</td>
    <td>
        <select name="setting[fieldtype]">
            <option value="text">小型字符型(TEXT)</option>
            <option value="mediumtext" selected>中型字符型(MEDIUMTEXT)</option>
            <option value="longtext">大型字符型(LONGTEXT)</option>
        </select> </span>
    </td>
</table>