<?php

// +----------------------------------------------------------------------
//  内容字段模型
// +----------------------------------------------------------------------
//  hfine520@163.com 
// +----------------------------------------------------------------------


class ncms_model_fieldModel extends Model {
    public function __construct(){
        parent::__construct('ncms_model_field');
    }

   //字段类型存放路径
    private $fieldPath = 'Fields/';
    //不显示的字段类型（字段类型）
    public $not_allow_fields = array('catid', 'typeid', 'title', 'keyword', 'template', 'username', 'tags');
    //允许添加但必须唯一的字段（字段名）
    public $unique_fields = array('pages', 'readpoint', 'author', 'copyfrom', 'islink', 'posid');
    //禁止被禁用（隐藏）的字段列表（字段名）
    public $forbid_fields = array('catid', 'title', /* 'updatetime', 'inputtime', 'url', 'listorder', 'status', 'template', 'username', 'allow_comment', 'tags' */);
    //禁止被删除的字段列表（字段名）
    public $forbid_delete = array('catid', /* 'typeid', */ 'title', 'thumb', 'keyword', 'keywords', 'updatetime', 'tags', 'inputtime', 'posid', 'url', 'listorder', 'status', 'template', 'username', 'allow_comment');
    //可以追加 JS和CSS 的字段（字段名）
    public $att_css_js = array('text', 'textarea', 'box', 'number', 'keyword', 'typeid');

    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    // public function getNcmsModelFieldList($condition, $field = '*', $page = 10, $order = 'fieldid desc', $limit = ''){
    //     $result = $this->table('ncms_model_field')->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
    //     return $result;
    // }
     public function getNcmsModelFieldList($condition = array(), $field = '*', $page = null, $order = 'fieldid desc', $limit = '') {
       return $this->table('ncms_model_field')->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    /**
     * 删除字段
     * @param type $fieldid 字段id
     * @return boolean
     */
    public function deleteField($fieldid) {
        //原字段信息
        $infos = $this->table('ncms_model_field')->where(array("fieldid" => $fieldid))->select();
        $info = $infos[0];
        if (empty($info)) {
           showMessage('该字段不存在!','','','error');
            return false;
        }
        //模型id
        $modelid = $info['modelid'];
        //完整表名获取 判断主表 还是副表
        $tablename = $this->table('ncms_model_field')->getModelTableName($modelid, $info['issystem']);
        $tablename = 'ncms_'.$tablename;
        $this->table('ncms_model_field')->where(array("fieldid" => $fieldid, "modelid" => $modelid))->delete();

        if (!$this->table_exists($tablename)) {
            showMessage('数据表不存在!','','','error');
            return false;
        }
        //判断是否允许删除
        if (false === $this->isDelField($info['field'])) {
             showMessage('该字段不允许被删除!','','','error');
            return false;
        }
        if ($this->deleteFieldSql($info['field'], DBPRE .$tablename)) {

            $this->table('ncms_model_field')->where(array("fieldid" => $fieldid, "modelid" => $modelid))->delete();
            return true;
        } else {
            showMessage('数据库表字段删除失败!','','','error');
        }
            return false;
    }
      /**
     * 根据字段类型，删除对应的字段到相应表里面
     * @param type $filename 字段名称
     * @param type $tablename 完整表名
     */
    protected function deleteFieldSql($filename, $tablename) {
       
        //不带表前缀的表名
        $noprefixTablename = ltrim($tablename,DBPRE);
        
        if (empty($tablename) || empty($filename)) {
            showMessage('表名或者字段名不能为空!','','','error');
            return false;
        }

        if (false === $this->table_exists($noprefixTablename)) {

            showMessage('该表不存在！','','','error');
            return false;
        }
        switch ($filename) {
            case 'readpoint'://特殊字段类型
                $sql = "ALTER TABLE `{$tablename}` DROP `readpoint`;";

                if (false === $this->execute($sql)) {
                    showMessage('字段删除失败！','','','error');
                    return false;
                }
                break;
            //特殊自定义字段
            case 'pages':
                if ($this->field_exists($noprefixTablename, "paginationtype")) {
                    $this->execute("ALTER TABLE `{$tablename}` DROP `paginationtype`;");
                }
                if ($this->field_exists($noprefixTablename, "maxcharperpage")) {
                    $this->execute("ALTER TABLE `{$tablename}` DROP `maxcharperpage`;");
                }
                break;
            default:
                $sql = "ALTER TABLE `{$tablename}` DROP `{$filename}`;";
                if (false === $this->execute($sql)) {
                     showMessage('字段删除失败！','','','error');
                    return false;
                }
                break;
        }
        return true;
    }

    /**
     * 根据模型ID，返回表名
     * @param type $modelid
     * @param type $modelid
     * @return string
     */
    protected function getModelTableName($modelid, $issystem = 1) {
        $models= $this->table('ncms_model')->where(array('modelid'=>$modelid))->select();
        //表名获取
        $model_table = $models[0]['tablename'];
        //完整表名获取 判断主表 还是副表
        $tablename = $issystem ? $model_table : $model_table . "_data";
        return $tablename;
    }

    /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

        if ($condition['modelid'] != ''){
            $condition_str .= " and ncms_model_field.modelid = '". $condition['modelid'] ."'";
        }
        

        return $condition_str;
    }

     /**
     * 获取可用字段类型列表
     * @return array
     */
    public function getFieldTypeList() {
        $fields = include $this->fieldPath . 'fields.inc.php';
        $fields = $fields? : array();
        return $fields;
    }
    /**
     * 判断字段是否允许被编辑
     * @param type $field 字段名称
     * @return boolean
     */
    public function isEditField($field) {
        //判断是否唯一字段
        if (in_array($field, $this->unique_fields)) {
            return false;
        }
        //禁止被禁用的字段列表（字段名）
        if (in_array($field, $this->forbid_fields)) {
            return false;
        }
        //禁止被删除的字段列表（字段名）
        if (in_array($field, $this->forbid_delete)) {
            return false;
        }
        return true;
    }

     /**
     * 检查该字段是否允许添加
     * @param type $field 字段名称
     * @param type $field_type 字段类型
     * @param type $modelid 模型
     * @return boolean
     */
    public function isAddField($field, $field_type, $modelid) {
        //判断是否唯一字段
        if (in_array($field, $this->unique_fields)) {
            $f_datas = $this->where(array("modelid" => $modelid))->getField("field,field,formtype,name");
            return empty($f_datas[$field]) ? true : false;
        }
        //不显示的字段类型（字段类型）
        if (in_array($field_type, $this->not_allow_fields)) {
            return false;
        }
        //禁止被禁用的字段列表（字段名）
        if (in_array($field, $this->forbid_fields)) {
            return false;
        }
        //禁止被删除的字段列表（字段名）
        if (in_array($field, $this->forbid_delete)) {
            return false;
        }
        return true;
    }
       /**
     * 添加字段
     * @param type $data 字段相关数据
     * @return boolean
     */
    public function addField($data) {
        //保存一份原始数据
        $oldData = $data;
        //字段附加配置
        $setting = $data['setting'];
        //附加属性值
        $data['setting'] = serialize($setting);
        //模型id
        $modelid = $data['modelid'];
        //完整表名获取 判断主表 还是副表
        $tablename = $this->getModelTableName($modelid, $data['issystem']);
        $tablename = 'ncms_'.$tablename;
        if (!$this->table_exists($tablename)) {
            showMessage('数据表不存在！','','','error');
            return false;
        }
        //数据正则
        $pattern = $data['pattern'];
        //进行数据验证
       
        if ($data) {
            $data['pattern'] = $pattern;
            //检查字段是否存在
            if ($this->field_exists($tablename, $data['field'])) {
                showMessage('该字段已经存在！','','','error');
                return false;
            }


            /**
             * 对应字段配置
             * $field_type = 'varchar'; //字段数据库类型
             * $field_basic_table = 1; //是否允许作为主表字段
             * $field_allow_index = 1; //是否允许建立索引
             * $field_minlength = 0; //字符长度默认最小值
             * $field_maxlength = ''; //字符长度默认最大值
             * $field_allow_search = 1; //作为搜索条件
             * $field_allow_fulltext = 0; //作为全站搜索信息
             * $field_allow_isunique = 1; //是否允许值唯一
             */
            require $this->fieldPath . "{$data['formtype']}/config.inc.php";
            //根据字段设置临时更改字段类型，否则使用字段配置文件配置的类型
            if (isset($oldData['setting']['fieldtype'])) {
                $field_type = $oldData['setting']['fieldtype'];
            }
            //特定字段类型强制使用特定字段名，也就是字段类型等于字段名
            if (in_array($field_type, $this->forbid_delete)) {
                $data['field'] = $field_type;
            }
            //检查该字段是否允许添加
            if (false === $this->isAddField($data['field'], $data['formtype'], $modelid)) {
                showMessage('该字段名称/类型不允许添加！','','','error');
                return false;
            }
            //增加字段
            $field = array(
                'tablename' => DBPRE . $tablename,
                'fieldname' => $data['field'],
                'maxlength' => $data['maxlength'],
                'minlength' => $data['minlength'],
                'defaultvalue' => $setting['defaultvalue'],
                'minnumber' => $setting['minnumber'],
                'decimaldigits' => $setting['decimaldigits'],
            );

            if ($this->addFieldSql($field_type, $field)) {
                $fieldid = Db::insert('ncms_model_field',$data);
              
                if ($fieldid) {
                    return $fieldid;
                } else {
                    showMessage('字段信息入库失败！','','','error');
                    //回滚
                    $this->execute("ALTER TABLE  `{$field['tablename']}` DROP  `{$field['fieldname']}`");
                    return false;
                }
            } else {
                showMessage('数据库字段添加失败！','','','error');
                return false;
            }
        } else {
            return false;
        }
    }

     /**
     *  编辑字段
     * @param type $data 编辑字段数据
     * @param type $fieldid 字段id
     * @return boolean
     */
    public function editField($data, $fieldid = 0) {
        if (!$fieldid && !isset($data['fieldid'])) {
            showMessage('缺少字段id！','','','error');
            return false;
        } else {
            $fieldid = $fieldid ? $fieldid : (int) $data['fieldid'];
        }
        //原字段信息
        $info = Model('ncms_model_field')->where(array("fieldid" => $fieldid))->find();
        if (empty($info)) {
            showMessage('该字段不存在！','','','error');
            return false;
        }
        //字段主表副表不能修改
        unset($data['issystem']);
        //字段类型
        if (empty($data['formtype'])) {
            $data['formtype'] = $info['formtype'];
        }
        //模型id
        $modelid = $info['modelid'];
        //完整表名获取 判断主表 还是副表
        $tablename = $this->getModelTableName($modelid, $info['issystem']);
        $tablename = 'ncms_'.$tablename;
        if (!$this->table_exists($tablename)) {
            showMessage('数据表不存在！','','','error');
            return false;
        }
        //保存一份原始数据
        $oldData = $data;
        //字段附加配置
        $setting = $data['setting'];
        /**
         * 对应字段配置
         * $field_type = 'varchar'; //字段数据库类型
         * $field_basic_table = 1; //是否允许作为主表字段
         * $field_allow_index = 1; //是否允许建立索引
         * $field_minlength = 0; //字符长度默认最小值
         * $field_maxlength = ''; //字符长度默认最大值
         * $field_allow_search = 1; //作为搜索条件
         * $field_allow_fulltext = 0; //作为全站搜索信息
         * $field_allow_isunique = 1; //是否允许值唯一
         */
        require $this->fieldPath . "{$data['formtype']}/config.inc.php";
        //根据字段设置临时更改字段类型，否则使用字段配置文件配置的类型
        if (isset($oldData['setting']['fieldtype'])) {
            $field_type = $oldData['setting']['fieldtype'];
        }
        //附加属性值
        $data['setting'] = serialize($setting);
        //数据正则
        $pattern = $data['pattern'];

        if ($data) {
            $data['pattern'] = $pattern;
            $this->table('ncms_model_field')->where(array("fieldid" => $fieldid))->update($data);
    
            if (false !==  $this->table('ncms_model_field')->where(array("fieldid" => $fieldid))->update($data)) {
             
                //如果字段名变更
                if ($data['field'] && $info['field']) {
                    //检查字段是否存在，只有当字段名改变才检测
                    if ($data['field'] != $info['field'] && $this->field_exists($tablename, $data['field'])) {
                        showMessage('该字段已经存在！','','','error');
                        //回滚
                        $this->table('ncms_model_field')->where(array("fieldid" => $fieldid))->update($info);
                        return false;
                    }
                    //合并字段更改后的
                    $newInfo = array_merge($info, $data);
                    $newInfo['setting'] = unserialize($newInfo['setting']);
                    $field = array(
                        'tablename' => DBPRE . $tablename,
                        'newfilename' => $data['field'],
                        'oldfilename' => $info['field'],
                        'maxlength' => $newInfo['maxlength'],
                        'minlength' => $newInfo['minlength'],
                        'defaultvalue' => $newInfo['setting']['defaultvalue'],
                        'minnumber' => $newInfo['setting']['minnumber'],
                        'decimaldigits' => $newInfo['setting']['decimaldigits'],
                    );
                    if (false === $this->editFieldSql($field_type, $field)) {
                         showMessage('数据库字段结构更改失败！','','','error');
                        //回滚
                         $this->table('ncms_model_field')->where(array("fieldid" => $fieldid))->update($info);
                        return false;
                    }
                }
                return true;
            } else {
                showMessage('数据库更新失败！','','','error');
                return false;
            }
        } else {
            return false;
        }
    }

       /**
     * 执行数据库表结构更改
     * @param type $field_type 字段类型
     * @param type $field 相关配置
     * $field = array(
     *      'tablename' 表名(完整表名)
     *      'newfilename' 新字段名
     *      'oldfilename' 原字段名
     *      'maxlength' 最大长度
     *      'minlength' 最小值
     *      'defaultvalue' 默认值
     *      'minnumber' 是否正整数 和整数 1为正整数，-1是为整数
     *      'decimaldigits' 小数位数
     * )
     */
    protected function editFieldSql($field_type, $field) {
        //表名
        $tablename = $field['tablename'];
        //原字段名
        $oldfilename = $field['oldfilename'];
        //新字段名
        $newfilename = $field['newfilename'] ? $field['newfilename'] : $oldfilename;
        //最大长度
        $maxlength = $field['maxlength'];
        //最小值
        $minlength = $field['minlength'];
        //默认值
        $defaultvalue = isset($field['defaultvalue']) ? $field['defaultvalue'] : '';
        //是否正整数 和整数 1为正整数，-1是为整数
        $minnumber = isset($field['minnumber']) ? $field['minnumber'] : 1;
        //小数位数
        $decimaldigits = isset($field['decimaldigits']) ? $field['decimaldigits'] : '';

        if (empty($tablename) || empty($newfilename)) {
            showMessage('表名或者字段名不能为空！','','','error');
            return false;
        }

        switch ($field_type) {
            case 'varchar':
                //最大值
                if (!$maxlength) {
                    $maxlength = 255;
                }
                $maxlength = min($maxlength, 255);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` VARCHAR( {$maxlength} ) NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'tinyint':
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` TINYINT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'number'://特殊字段类型，数字类型，如果小数位是0字段类型为 INT,否则是FLOAT
                $minnumber = intval($minnumber);
                $defaultvalue = $decimaldigits == 0 ? intval($defaultvalue) : floatval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` " . ($decimaldigits == 0 ? 'INT' : 'FLOAT') . " " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'smallint':
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` SMALLINT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'mediumint':
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` MEDIUMINT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'int':
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` INT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'mediumtext':
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` MEDIUMTEXT";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'text':
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` TEXT";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'date':
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` DATE";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'datetime':
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'timestamp':
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'readpoint'://特殊字段类型
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `readpoint` SMALLINT(5) unsigned NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "double":
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` DOUBLE NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "float":
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}` FLOAT NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "bigint":
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}`  BIGINT NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "longtext":
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}`  LONGTEXT";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "char":
                $sql = "ALTER TABLE `{$tablename}` CHANGE `{$oldfilename}` `{$newfilename}`  CHAR(255) NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                   showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            //特殊自定义字段
            case 'pages':
                break;
            default:
                showMessage("字段类型" . $field_type . "不存在相应信息",'','','error');
                return false;
                break;
        }
        return true;
    }

      /**
     * 根据字段类型，增加对应的字段到相应表里面
     * @param type $field_type 字段类型
     * @param type $field 相关配置
     * $field = array(
     *      'tablename' 表名(完整表名)
     *      'fieldname' 字段名
     *      'maxlength' 最大长度
     *      'minlength' 最小值
     *      'defaultvalue' 默认值
     *      'minnumber' 是否正整数 和整数 1为正整数，-1是为整数
     *      'decimaldigits' 小数位数
     * )
     */
    protected function addFieldSql($field_type, $field) {
        //表名
        $tablename = $field['tablename'];
        //字段名
        $fieldname = $field['fieldname'];
        //最大长度
        $maxlength = $field['maxlength'];
        //最小值
        $minlength = $field['minlength'];
        //默认值
        $defaultvalue = isset($field['defaultvalue']) ? $field['defaultvalue'] : '';
        //是否正整数 和整数 1为正整数，-1是为整数
        $minnumber = isset($field['minnumber']) ? $field['minnumber'] : 1;
        //小数位数
        $decimaldigits = isset($field['decimaldigits']) ? $field['decimaldigits'] : '';

        switch ($field_type) {
            case "varchar":
                if (!$maxlength) {
                    $maxlength = 255;
                }
                $maxlength = min($maxlength, 255);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` VARCHAR( {$maxlength} ) NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "tinyint":
                if (!$maxlength) {
                    $maxlength = 3;
                }
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` TINYINT( {$maxlength} ) " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "number"://特殊字段类型，数字类型，如果小数位是0字段类型为 INT,否则是FLOAT
                $minnumber = intval($minnumber);
                $defaultvalue = $decimaldigits == 0 ? intval($defaultvalue) : floatval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` " . ($decimaldigits == 0 ? 'INT' : 'FLOAT') . " " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "smallint":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` SMALLINT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "mediumint":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` INT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "int":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` INT " . ($minnumber >= 0 ? 'UNSIGNED' : '') . " NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "mediumtext":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` MEDIUMTEXT";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "text":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` TEXT";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "date":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` DATE";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "datetime":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "timestamp":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case 'readpoint'://特殊字段类型
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD  `readpoint` SMALLINT(5) unsigned NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "double":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` DOUBLE NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "float":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` FLOAT NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "bigint":
                $minnumber = intval($minnumber);
                $defaultvalue = intval($defaultvalue);
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}` BIGINT NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "longtext":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}`  LONGTEXT ";
                if (false === $this->execute($sql)) {
                    showMessage('数据库字段添加失败！','','','error');
                    return false;
                }
                break;
            case "char":
                $sql = "ALTER TABLE `{$tablename}` ADD `{$fieldname}`  CHAR(255) NOT NULL DEFAULT '{$defaultvalue}'";
                if (false === $this->execute($sql)) {
                    showMessage('字段结构更改失败！','','','error');
                    return false;
                }
                break;
            case "pages"://特殊字段类型
                $this->execute("ALTER TABLE `{$tablename}` ADD `paginationtype` TINYINT( 1 ) NOT NULL DEFAULT '0'");
                $this->execute("ALTER TABLE `{$tablename}` ADD `maxcharperpage` MEDIUMINT( 6 ) NOT NULL DEFAULT '0'");
                return true;
                break;
            default:
                return false;
                break;
        }
        return true;
    }



    /**
     *  读取全部表名
     * @return type
     */
    public function list_tables() {
        $tables = array();
        $data = Db::showTables();
        foreach ($data as $k => $v) {
            $tables[] = $v['Tables_in_' . DBNAME];

        }
    
        return $tables;
    }

    /**
     * 检查表是否存在
     * $table 不带表前缀
     */
    public function table_exists($table) {
        $tables = $this->list_tables();

        return in_array(DBPRE . $table, $tables) ? true : false;
    }

    /**
     * 删除表
     * $table 不带表前缀
     */
    public function deleteTable($table) {
        if ($this->table_exists($table)) {
            $this->drop_table($table);
        }
        return true;
    }

     /**
     * 删除表
     * @param string $tablename 不带表前缀的表名
     * @return type
     */
    public function drop_table($tablename) {
        $tablename = DBPRE . $tablename;
         
        return @Db::query("DROP TABLE $tablename");
    }

    /**
     * 判断字段是否允许删除
     * @param type $field 字段名称
     * @return boolean
     */
    public function isDelField($field) {
        //禁止被删除的字段列表（字段名）
        if (in_array($field, $this->forbid_delete)) {
            return false;
        }
        return true;
    }

    /**
     * 获取表字段
     * $table 不带表前缀
     */
    public function get_fields($table) {
        $fields = array();
        $table = DBPRE . $table;
        $data = $this->query("SHOW COLUMNS FROM $table");
        foreach ($data as $v) {
            $fields[$v['field']] = $v['type'];
        }
        return $fields;
    }

    /**
     * 检查字段是否存在
     * $table 不带表前缀
     */
    public function field_exists($table, $field) {
        $fields = $this->get_fields($table);
        return array_key_exists($field, $fields);
    }



}
