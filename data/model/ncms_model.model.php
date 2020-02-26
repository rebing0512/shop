<?php

// +----------------------------------------------------------------------
//  内容模型
// +----------------------------------------------------------------------
//  hfine520@163.com 
// +----------------------------------------------------------------------

class ncms_modelModel extends Model {
    public function __construct(){
        parent::__construct('ncms_model');
    }

    private $libPath = BASE_SITE_URL; //当前模块路径

    const mainTableSql = '/data/sql/s_zhubiao.sql'; //模型主表SQL模板文件
    const sideTablesSql = '/data/sql/s_zhubiao_data.sql'; //模型副表SQL模板文件
    const modelTablesInsert = '/data/sql/s_insert.sql'; //可用默认模型字段
    const membershipModelSql = '/data/sql/s_member.sql'; //会员模型


    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getNcmsModelList($condition, $field = '*', $page = 10, $order = 'modelid desc', $limit = ''){
        return $this->table('ncms_model')->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
    }

    /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

        if ($condition['type'] != ''){
            $condition_str .= " and ncms_model.type = '". $condition['type'] ."'";
        }
        if ($condition['modelid'] != ''){
            $condition_str .= " and ncms_model.modelid = '". $condition['modelid'] ."'";
        }
        

        return $condition_str;
    }

     /**
     * 创建模型
     * @param type $data 提交数据
     * @return boolean
     */
    public function addModel($data) {
        if (empty($data)) {
            return false;
        }
   
        //强制表名为小写
        $data['tablename'] = strtolower($data['tablename']);
        //添加模型记录
        $modelid =Db::insert('ncms_model',$data);
        
        if ($modelid) {
            //创建数据表
            if ($this->createModel($data['tablename'], $modelid)) {
          
                return $modelid;
            } else {
                //表创建失败
               
                 $condition_str =" modelid = {$modelid}";
                Db::delete('ncms_model',$condition_str);
                // $this->error = '数据表创建失败！';
                return false;
            }
        } else {
            return false;
        }
    
    }

        /**
     * 编辑模型
     * @param type $data 提交数据
     * @return boolean
     */
    public function editModel($data, $modelid = 0) {
        if (empty($data)) {
            return false;
        }
        //模型ID
        $modelid = $modelid ? $modelid : (int) $data['modelid'];
        if (!$modelid) {
           
            showMessage('模型ID不能为空！','index.php?con=ncms_model&fun=cncms_model_list');
            return false;
        }
        //查询模型数据
        $condition_str =$this->_condition(array('modelid'=>$modelid));
        $condition_str1 = " modelid = {$modelid}";
        $param['table'] = 'ncms_model';
        $param['where'] = $condition_str;
        $infos =Db::select($param);

        $info =$infos[0];
        
        if (empty($info)) {
          
            showMessage('该模型不存在！','index.php?con=ncms_model&fun=cncms_model_list');
            return false;
        }
        $data['modelid'] = $modelid;

        //强制表名为小写
        $data['tablename'] = strtolower($data['tablename']);

        //是否更改表名
        if ($info['tablename'] != $data['tablename'] && !empty($data['tablename'])) {
            //检查新表名是否存在
            if ($this->table_exists($data['tablename']) || $this->table_exists($data['tablename'] . '_data')) {
              
                showMessage('该表名已经存在！','index.php?con=ncms_model&fun=cncms_model_list');
                return false;
            }
            if (false !== Db::update('ncms_model',$data,$condition_str1)) {
                //表前缀
                $dbPrefix = DBPRE;
                //表名更改
                if (!$this->sql_execute("RENAME TABLE  `{$dbPrefix}ncms_{$info['tablename']}` TO  `{$dbPrefix}ncms_{$data['tablename']}` ;")) {
                    showMessage('数据库修改表名失败！','index.php?con=ncms_model&fun=cncms_model_list');
                    return false;
                }
                //修改副表
                if (!$this->sql_execute("RENAME TABLE  `{$dbPrefix}ncms_{$info['tablename']}_data` TO  `{$dbPrefix}ncms_{$data['tablename']}_data` ;")) {
                    //主表已经修改，进行回滚
                    $this->sql_execute("RENAME TABLE  `{$dbPrefix}ncms_{$data['tablename']}` TO  `{$dbPrefix}ncms_{$info['tablename']}` ;");
    
                     showMessage('数据库修改副表表名失败！','index.php?con=ncms_model&fun=cncms_model_list');
                    return false;
                }
          
                return true;
            } else {

                showMessage('模型更新失败！1','index.php?con=ncms_model&fun=cncms_model_list');
                return false;
            }
        } else {
            if (false !== Db::update('ncms_model',$condition_str1,$data)) {
                return true;
            } else {
                showMessage('模型更新失败！2','index.php?con=ncms_model&fun=cncms_model_list');
                return false;
            }
        }
      
    }

      /**
     * 创建内容模型
     * @param type $tableName 模型主表名称（不包含表前缀）
     * @param type $modelId 模型id
     * @return boolean
     */
    protected function createModel($tableName, $modelId) {
        if (empty($tableName) || $modelId < 1) {
            return false;
        }
        //表前缀
        $dbPrefix = DBPRE;
        //读取模型主表SQL模板
        $mainTableSqll = file_get_contents($this->libPath . self::mainTableSql);
        //副表
        $sideTablesSql = file_get_contents($this->libPath . self::sideTablesSql);
        //字段数据
        $modelTablesInsert = file_get_contents($this->libPath . self::modelTablesInsert);
        //表前缀，表名，模型id替换
        $sqlSplit = str_replace(array('@ncms@', '@zhubiao@', '@modelid@'), array($dbPrefix, $tableName, $modelId), $mainTableSqll . "\n" . $sideTablesSql . "\n" . $modelTablesInsert);

        return $this->sql_execute($sqlSplit);
    }

     /**
     * 执行SQL
     * @param type $sqls SQL语句
     * @return boolean
     */
    protected function sql_execute($sqls) {
        $sqls = $this->sql_split($sqls);
        if (is_array($sqls)) {
            foreach ($sqls as $sql) {
    
                if (trim($sql) != '') {
                    Db::execute($sql);
                }
            }
        } else {
           Db::execute($sqls);
        }
        return true;
    }

    /**
     * SQL语句预处理
     * @param type $sql
     * @return type
     */
    public function sql_split($sql) {
        if (mysql_get_server_info() > '4.1' && C('DB_CHARSET')) {
            $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=" . C('DB_CHARSET'), $sql);
        }
        if (DBPRE != "s_") {
            $sql = str_replace("s_",DBPRE, $sql);
        }
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

      /**
     * 根据模型ID删除模型
     * @param type $modelid 模型id
     * @return boolean
     */
    public function deleteModel($modelid) {
        if (empty($modelid)) {
            return false;
        }
        $condition_str =$this->_condition(array('modelid'=>$modelid));
        $condition_str1 = " modelid = {$modelid}";
        //这里可以根据缓存获取表名
        $where['table'] = 'ncms_model';
        $where['where'] = $condition_str;
        $modeldata = Db::select($where);
       
        if (!$modeldata) {
            return false;
        }
        //表名
        $model_table = 'ncms_'.$modeldata[0]['tablename'];
        //删除模型数据
        Db::delete('ncms_model',$condition_str1);
        
  
        //删除所有和这个模型相关的字段
       
         Db::delete('ncms_model_field',$condition_str1);
     
        //删除主表
        $this->deleteTable($model_table);
        if ((int) $modeldata[0]['type'] == 0) {
            //删除副表
            $this->DeleteTable($model_table . "_data");
        }
        return true;
    }

        /**
     * 模型导入
     * @param type $data 数据
     * @param type $tablename 导入的模型表名
     * @param type $name 模型名称
     * @return int|boolean
     */
    public function import($data, $tablename = '', $name = '') {
        if (empty($data)) {
            showMessage(Language::get('ncms_model_import_fail_no'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            return false;
        }
        //解析
        $data = json_decode(base64_decode($data), true);
        if (empty($data)) {
            showMessage(Language::get('ncms_model_import_fail_jx'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            return false;
        }
        //取得模型数据
        $model = $data['model'];
        if (empty($model)) {
            showMessage(Language::get('ncms_model_import_fail_jx'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            return false;
        }

        if ($name) {
            $model['name'] = $name;
        }
        if ($tablename) {
            $model['tablename'] = $tablename;
        }
        //导入
        $modelid = $this->addModel($model);
        if ($modelid) {
            if (!empty($data['field'])) {
                foreach ($data['field'] as $value) {
                    $value['modelid'] = $modelid;
                    if ($value['setting']) {
                        $value['setting'] = unserialize($value['setting']);
                    }
                    $model = Model();
                    if ($model->table('ncms_model_field')->addField($value) == false) {
                        $value['setting'] = serialize($value['setting']);
                        $model->table('ncms_model_field')->where(array('modelid' => $modelid, 'field' => $value['field'], 'name' => $value['name']))->update($value);
                    }
                    unset($model);
                }
            }
            return $modelid;
        } else {
            return false;
        }
    }

    /**
     * 模型导出
     * @param type $modelid 模型ID
     * @return boolean
     */
    public function export($modelid) {
        if (empty($modelid)) {
            showMessage(Language::get('ncms_model_zd_export_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            return false;
        }
        //取得模型信息
        $condition_str =$this->_condition(array('modelid'=>$modelid,'type'=>0));
        $where['table'] = 'ncms_model';
        $where['where'] = $condition_str;
        $infos = Db::select($where,$condition_str);
        $info = $infos[0];
        if (empty($info)) {
             showMessage(Language::get('ncms_model_no_export_fail'),'index.php?con=ncms_model&fun=ncms_model_list','','error');
            return false;
        }
        unset($info['modelid']);
        //数据
        $data = array();
        $data['model'] = $info;
        //取得对应模型字段
        $condition_str1 = $this->_condition(array('modelid'=>$modelid));
        $where1['table'] = 'ncms_model_field';
        $where1['where'] = $condition_str1;
        $fieldLists = Db::select($where1,$condition_str1);
        $fieldList = $fieldLists[0];
        if (empty($fieldList)) {
            $fieldList = array();
        }
        //去除fieldid，modelid字段内容
        foreach ($fieldList as $k => $v) {
            unset($fieldList[$k]['fieldid'], $fieldList[$k]['modelid']);
        }
        $data['field'] = $fieldList;
        return base64_encode(json_encode($data));
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
     * 文章列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getNcmsList($table,$condition,$page=''){
        $condition_str = $this->_condition_cms($table,$condition);
        $param = array();
        $param['table'] = $table;
        $param['where'] = $condition_str;
        $param['field'] = empty($condition['field'])?'*':$condition['field'];;
        $param['limit'] = $condition['limit'];
        $param['order'] = (empty($condition['order'])?'listorder asc,id desc':$condition['order']);
        $result = Db::select($param,$page);
        return $result;
    }

        /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition_cms($table,$condition){
        $condition_str = '';

        if ($condition['status'] != ''){
            $condition_str .= " and {$table}.status = '". $condition['status'] ."'";
        }
        if ($condition['ac_ids'] != ''){
            $condition_str .= " and {$table}.catid  IN(". $condition['ac_ids'] ." )";
        }
        
        return $condition_str;
    }



}
