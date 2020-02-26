<?php
/**
 * mysqli驱动
 *
 * @author cevin
 */


defined('TTShop') or exit('Access Invalid!');

class Db
{

    private static $link = array();

    private static $iftransacte = true;

    /**
     * @var string
     */
    private static $_lastSql = null;

    private function __construct()
    {
        if (!extension_loaded('mysqli')) {
            throw_exception("Db Error: mysqli is not install");
        }
    }

    /**
     * 取得指定host的mysqli连接对象
     * @param string $host
     * @return mysqli|mixed
     */
    private static function getLink($host = 'master')
    {
        if (!empty(self::$link[$host]))
            return self::$link[$host];
        else
            throw_exception(vsprintf('Database: link host %s does not exists', $host));
    }

    private static function connect($host = 'slave')
    {
        if (C('db.master') == C('db.slave')) {
            if (is_object(self::$link['slave'])) {
                self::$link['master'] = self::$link['slave'];
                return;
            } elseif (is_object(self::$link['master'])) {
                self::$link['slave'] = self::$link['master'];
                return;
            }
        }
        if (!in_array($host, array('master', 'slave'))) $host = 'slave';
        $conf = C('db.' . $host);
        if (is_object(self::$link[$host])) return;

        self::$link[$host] = @new mysqli($conf['dbhost'], $conf['dbuser'], $conf['dbpwd'], $conf['dbname'], $conf['dbport']);

        $link = self::getLink($host);

        if ($link->connect_errno !== 0) throw_exception("Db Error: database connect failed (" . $link->connect_error . ")");

        $query_string = '';

        switch (strtoupper($conf['dbcharset'])) {
            case 'UTF-8':
                $query_string = "
		                 SET CHARACTER_SET_CLIENT = utf8,
		                 CHARACTER_SET_CONNECTION = utf8,
		                 CHARACTER_SET_DATABASE = utf8,
		                 CHARACTER_SET_RESULTS = utf8,
		                 CHARACTER_SET_SERVER = utf8,
		                 COLLATION_CONNECTION = utf8_general_ci,
		                 COLLATION_DATABASE = utf8_general_ci,
		                 COLLATION_SERVER = utf8_general_ci,
		                 sql_mode=''";
                break;
            case 'GBK':
                $query_string = "
		   			    SET CHARACTER_SET_CLIENT = gbk,
		                 CHARACTER_SET_CONNECTION = gbk,
		                 CHARACTER_SET_DATABASE = gbk,
		                 CHARACTER_SET_RESULTS = gbk,
		                 CHARACTER_SET_SERVER = gbk,
		                 COLLATION_CONNECTION = gbk_chinese_ci,
		                 COLLATION_DATABASE = gbk_chinese_ci,
		                 COLLATION_SERVER = gbk_chinese_ci,
		                 sql_mode=''";
                break;
            default:
                $error = "Db Error: charset is Invalid";
                throw_exception($error);
        }
        //进行编码声明
        if (!self::$link[$host]->query($query_string)) {
            throw_exception("Db Error: " . mysqli_error(self::$link[$host]));
        }
    }

    public static function ping($host = 'master')
    {
        if (is_object(self::$link[$host])) {
//         if (is_object(self::$link[$host]) && !self::$link[$host]->ping()) {
            self::$link[$host]->close();
            self::$link[$host] = null;
        }
    }

    /**
     * @return string
     */
    public static function getLastSql()
    {
        return self::$_lastSql;
    }

    /**
     * 执行查询
     *
     * @param string $sql
     * @return mysqli_result|boolean
     */
    public static function query($sql, $host = 'master')
    {
        self::connect($host);
        if (C('debug')) addUpTime('queryStartTime');
        $link = self::getLink($host);
        $query = $link->query($sql);
        if (strtolower(substr($sql, 0, 5)) == 'delete'){
            file_put_contents(BASE_PATH.'/log', $sql.'\n', FILE_APPEND);
        }
        self::$_lastSql = $sql;

        if (C('debug')) addUpTime('queryEndTime');
        if ($query === false || $link->errno !== 0) {
            $error = 'Db Error: ' . $link->error;
            if (C('debug')) {
                throw_exception($error . '<br/>' . $sql);
            } else {
                Log::record($error . "\r\n" . $sql, Log::ERR);
                Log::record($sql, Log::SQL);
                throw_exception($error . '<br/>' . $sql);
                return false;
            }
        } else {
            Log::record($sql . " [ RunTime:" . addUpTime('queryStartTime', 'queryEndTime', 6) . "s ]", Log::SQL);
            return $query;
        }
    }

    /**
     * @param string $host
     * @return mixed
     */
    public static function getError($host = 'master')
    {
        return self::$link[$host]->error;
    }

    /**
     * 取得数组
     *
     * @param string $sql
     * @return array
     */
    public static function getAll($sql, $host = 'slave')
    {
        self::connect($host);
        $result = self::query($sql, $host);

        $rows = array();
//        while ($row = $result->fetch_assoc()) {
//            $rows[] = $row;
//        }

        return $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    /**
     * SELECT查询
     *
     * @param array $param 参数
     * @param Page|string|null $obj_page 分类对象
     * @param string $host
     * @return array
     */
    public static function select($param, $obj_page = '', $host = 'slave')
    {
        self::connect($host);
        static $_cache = array();

        if (empty($param)) throw_exception('Db Error: select param is empty!');

        if (empty($param['field'])) {
            $param['field'] = '*';
        }
        if (empty($param['count'])) {
            $param['count'] = 'count(*)';
        }

        if (isset($param['index'])) {
            $param['index'] = 'USE INDEX (' . $param['index'] . ')';
        }

        if (trim($param['where']) != '') {
            if (strtoupper(substr(trim($param['where']), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($param['where']), 0, 3)) == 'AND') {
                    $param['where'] = substr(trim($param['where']), 3);
                }
                $param['where'] = 'WHERE ' . $param['where'];
            }
        } else {
            $param['where'] = '';
        }
        $param['where_group'] = '';
        if (!empty($param['group'])) {
            $param['where_group'] .= ' group by ' . $param['group'];
        }
        $param['where_order'] = '';
        if (!empty($param['order'])) {
            $param['where_order'] .= ' order by ' . $param['order'];
        }

        //判断是否是联表
        $tmp_table = explode(',', $param['table']);
        if (!empty($tmp_table) && count($tmp_table) > 1) {
            //判断join表数量和join条件是否一致
            if ((count($tmp_table) - 1) != count($param['join_on'])) {
                throw_exception('Db Error: join number is wrong!');
            }

            //trim 掉空白字符
            foreach ($tmp_table as $key => $val) {
                $tmp_table[$key] = trim($val);
            }

            // 初始化变量
            $tmp_sql = '';

            //拼join on 语句
            for ($i = 1; $i < count($tmp_table); $i++) {
                $tmp_sql .= $param['join_type'] . ' `' . DBPRE . $tmp_table[$i] . '` as `' . $tmp_table[$i] . '` ON ' . $param['join_on'][$i - 1] . ' ';
            }
            $sql = 'SELECT ' . $param['field'] . ' FROM `' . DBPRE . $tmp_table[0] . '` as `' . $tmp_table[0] . '` ' . $tmp_sql . ' ' . $param['where'] . $param['where_group'] . $param['where_order'];

            //如果有分页，那么计算信息总数
            $count_sql = 'SELECT ' . $param['count'] . ' as count FROM `' . DBPRE . $tmp_table[0] . '` as `' . $tmp_table[0] . '` ' . $tmp_sql . ' ' . $param['where'] . $param['where_group'];
        } else {
            $sql = 'SELECT ' . $param['field'] . ' FROM `' . DBPRE . $param['table'] . '` as `' . $param['table'] . '` ' . $param['index'] . ' ' . $param['where'] . $param['where_group'] . $param['where_order'];
            $count_sql = 'SELECT ' . $param['count'] . ' as count FROM `' . DBPRE . $param['table'] . '` as `' . $param['table'] . '` ' . $param['index'] . ' ' . $param['where'];
        }
        //limit ，如果有分页对象的话，那么优先分页对象
        if ($obj_page instanceof Page) {
            $count_query = self::query($count_sql, $host);
            $result = $count_query->fetch_assoc();
            $obj_page->setTotalNum($result['count']);
            $param['limit'] = $obj_page->getLimitStart() . "," . $obj_page->getEachNum();
        }
        if ($param['limit'] != '') {
            $sql .= ' limit ' . $param['limit'];
        }
        // 缓存
        $key = null;
        if ($param['cache'] !== false) {
            $key = is_string($param['cache_key']) ? $param['cache_key'] : md5($sql);
            if (isset($_cache[$key])) return $_cache[$key];
        }
        $result = self::query($sql, $host);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        if ($param['cache'] !== false && !isset($_cache[$key])) {
            $_cache[$key] = $rows;
        }
        return $rows;
    }

    /**
     * 插入操作
     *
     * @param string $table_name 表名
     * @param array $insert_array 待插入数据
     * @return mixed
     */
    public static function insert($table_name, $insert_array = array(), $host = 'master')
    {
        self::connect($host);
        if (!is_array($insert_array)) return false;
        $fields = array();
        $value = array();
        foreach ($insert_array as $key => $val) {
            $fields[] = self::parseKey($key);
            $value[] = self::parseValue($val);
        }
        $sql = 'INSERT INTO `' . DBPRE . $table_name . '` (' . implode(',', $fields) . ') VALUES(' . implode(',', $value) . ')';

        //当数据库没有自增ID的情况下，返回 是否成功
        $result = self::query($sql, $host);
        $insert_id = self::getLastId($host);
        return $insert_id ? $insert_id : $result;
    }

    /**
     * 批量插入
     *
     * @param string $table_name 表名
     * @param array $insert_array 待插入数据
     * @param string $host
     * @return mysqli_result|int|mixed
     */
    public static function insertAll($table_name, $insert_array = array(), $host = 'master')
    {
        self::connect($host);
        if (!is_array($insert_array[0])) return false;
        $fields = array_keys($insert_array[0]);
        array_walk($fields, array(self, 'parseKey'));
        $values = array();
        foreach ($insert_array as $data) {
            $value = array();
            foreach ($data as $key => $val) {
                $val = self::parseValue($val);
                if (is_scalar($val)) {
                    $value[] = $val;
                }
            }
            $values[] = '(' . implode(',', $value) . ')';
        }
        $sql = 'INSERT INTO `' . DBPRE . $table_name . '` (' . implode(',', $fields) . ') VALUES ' . implode(',', $values);
        $result = self::query($sql, $host);
        $insert_id = self::getLastId($host);
        return $insert_id ? $insert_id : $result;
    }

    /**
     * 更新操作
     *
     * @param string $table_name 表名
     * @param array $update_array 待更新数据
     * @param string $where 执行条件
     * @param string $host 主机
     * @return bool|mysqli_result
     */
    public static function update($table_name, $update_array = array(), $where = '', $host = 'master')
    {
        self::connect($host);
        if (!is_array($update_array)) return false;
        $string_value = '';
        foreach ($update_array as $k => $v) {
            if (is_array($v)) {
                switch ($v['sign']) {
                    case 'increase':
                        $string_value .= " $k = $k + " . $v['value'] . ",";
                        break;
                    case 'decrease':
                        $string_value .= " $k = $k - " . $v['value'] . ",";
                        break;
                    case 'calc':
                        $string_value .= " $k = " . $v['value'] . ",";
                        break;
                    default:
                        $string_value .= " $k = " . self::parseValue($v['value']) . ",";
                }
            } else {
                $string_value .= " $k = " . self::parseValue($v) . ",";
            }
        }

        $string_value = trim(trim($string_value), ',');
        if (trim($where) != '') {
            if (strtoupper(substr(trim($where), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($where), 0, 3)) == 'AND') {
                    $where = substr(trim($where), 3);
                }
                $where = ' WHERE ' . $where;
            }
        }
        $sql = 'UPDATE `' . DBPRE . $table_name . '` AS `' . $table_name . '` SET ' . $string_value . ' ' . $where;

        $result = self::query($sql, $host);
        return $result;
    }

    /**
     * 删除操作
     *
     * @param string $table_name 表名
     * @param string $where 执行条件
     * @param string $host
     * @return mysqli_result|mixed
     */
    public static function delete($table_name, $where = '', $host = 'master')
    {
        self::connect($host);
        if (trim($where) != '') {
            if (strtoupper(substr(trim($where), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($where), 0, 3)) == 'AND') {
                    $where = substr(trim($where), 3);
                }
                $where = ' WHERE ' . $where;
            }
            $sql = 'DELETE FROM `' . DBPRE . $table_name . '` ' . $where;
            return self::query($sql, $host);
        } else {
            throw_exception('Db Error: the condition of delete is empty!');
        }
    }

    /**
     * 取得上一步插入产生的ID
     *
     * @param string $host 主机
     * @return int
     */
    public static function getLastId($host = 'master')
    {
        self::connect($host);
        $link = self::getLink($host);
        $id = $link->insert_id;
        if (!$id) {
            $result = self::query('SELECT last_insert_id() as id', $host);
            $result = $result->fetch_assoc();
            return $result['id'];
        }
        return $id;
    }

    /**
     * 取得一行信息
     *
     * @param array $param
     * @param string $fields
     * @param string $host
     * @return array
     */
    public static function getRow($param, $fields = '*', $host = 'slave')
    {
        self::connect($host);
        $table = $param['table'];
        $wfield = $param['field'];
        $value = $param['value'];

        if (is_array($wfield)) {
            $where = array();
            foreach ($wfield as $k => $v) {
                $where[] = $v . "='" . $value[$k] . "'";
            }
            $where = implode(' and ', $where);
        } else {
            $where = $wfield . "='" . $value . "'";
        }

        $sql = "SELECT " . $fields . " FROM `" . DBPRE . $table . "` WHERE " . $where;
        $result = self::query($sql, $host);
        return $result->fetch_assoc();
    }

    /**
     * 执行REPLACE操作
     *
     * @param string $table_name 表名
     * @param array $replace_array 待更新的数据
     * @param string $host
     * @return mysqli_result|mixed
     */
    public static function replace($table_name, $replace_array = array(), $host = 'master')
    {
        self::connect($host);
        if (!empty($replace_array)) {
            $string_field = $string_value = '';
            foreach ($replace_array as $k => $v) {
                $string_field .= " $k ,";
                $string_value .= " '" . $v . "',";
            }
            $sql = 'REPLACE INTO `' . DBPRE . $table_name . '` (' . trim($string_field, ', ') . ') VALUES(' . trim($string_value, ', ') . ')';
            return self::query($sql, $host);
        } else {
            return false;
        }
    }

    /**
     * 返回单表查询记录数量
     *
     * @param string $table 表名
     * @param $condition mixed 查询条件，可以为空，也可以为数组或字符串
     * @param string $host
     * @return int
     */
    public static function getCount($table, $condition = null, $host = 'slave')
    {
        self::connect($host);

        if (!empty($condition) && is_array($condition)) {
            $where = '';
            foreach ($condition as $key => $val) {
                self::parseKey($key);
                $val = self::parseValue($val);
                $where .= ' AND ' . $key . '=' . $val;
            }
            $where = ' WHERE ' . substr($where, 4);
        } elseif (is_string($condition)) {
            if (strtoupper(substr(trim($condition), 0, 3)) == 'AND') {
                $where = ' WHERE ' . substr(trim($condition), 4);
            } else {
                $where = ' WHERE ' . $condition;
            }
        }
        $sql = 'SELECT COUNT(*) as `count` FROM `' . DBPRE . $table . '` as `' . $table . '` ' . (isset($where) ? $where : '');
        $result = self::query($sql, $host);
        $result = $result->fetch_assoc();
        return $result['count'];
    }

    /**
     * 执行SQL语句
     *
     * @param string $sql 待执行的SQL
     * @param string $host
     * @return mysqli_result|mixed
     */
    public static function execute($sql, $host = 'master')
    {
        self::connect($host);
        $result = self::query($sql, $host);
        return $result;
    }

    /**
     * 列出所有表
     *
     * @param string $host
     * @return array
     */
    public static function showTables($host = 'slave')
    {
        self::connect($host);
        $sql = 'SHOW TABLES';
        $result = self::query($sql, $host);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        unset($row);
        return $rows;
    }

    /**
     * 显示建表语句
     *
     * @param string $table
     * @param string $host
     * @return string
     */
    public static function showCreateTable($table, $host = 'slave')
    {
        self::connect($host);
        $sql = 'SHOW CREATE TABLE `' . DBPRE . $table . '`';
        $result = self::query($sql, $host);
        $result = $result->fetch_assoc();
        return $result['Create Table'];
    }

    /**
     * 显示表结构信息
     *
     * @param string $table
     * @param string $host
     * @return array
     */
    public static function showColumns($table, $host = 'slave')
    {
        self::connect($host);
        $sql = 'SHOW COLUMNS FROM `' . DBPRE . $table . '`';
        $result = self::query($sql, $host);
        $array = array();
        while ($tmp = $result->fetch_assoc()) {
            $array[$tmp['Field']] = array(
                'name' => $tmp['Field'],
                'type' => $tmp['Type'],
                'null' => $tmp['Null'],
                'default' => $tmp['Default'],
                'primary' => (strtolower($tmp['Key']) == 'pri'),
                'autoinc' => (strtolower($tmp['Extra']) == 'auto_increment'),
            );
        }
        return $array;
    }

    /**
     * 取得服务器信息
     *
     * @param string $host
     * @return string
     */
    public static function getServerInfo($host = 'slave')
    {
        self::connect($host);
        $link = self::getLink($host);
        $result = $link->get_server_info();
        return $result;
    }

    /**
     * 格式化字段
     *
     * @param string $key 字段名
     * @return string
     */
    public static function parseKey($key)
    {
        $key = trim($key);
        if (!preg_match('/[,\'\"\*\(\)`.\s]/', $key)) {
            $key = '`' . $key . '`';
        }
        return $key;
    }

    /**
     * 格式化值
     *
     * @param mixed $value
     * @return mixed
     */
    public static function parseValue($value)
    {
        $value = addslashes(stripslashes($value));//重新加斜线，防止从数据库直接读取出错
        return "'" . $value . "'";
    }

    public static function beginTransaction($host = 'master')
    {
        self::connect($host);
        if (self::$iftransacte) {
            self::$link[$host]->autocommit(false);//关闭自动提交
        }
        self::$iftransacte = false;
    }

    public static function commit($host = 'master')
    {
        if (!self::$iftransacte) {
            $result = self::$link[$host]->commit();
            self::$link[$host]->autocommit(true);//开启自动提交
            self::$iftransacte = true;
            if (!$result) throw_exception("Db Error: " . mysqli_error(self::$link[$host]));
        }
    }

    public static function rollback($host = 'master')
    {
        if (!self::$iftransacte) {
            $result = self::$link[$host]->rollback();
            self::$link[$host]->autocommit(true);
            self::$iftransacte = true;
            if (!$result) throw_exception("Db Error: " . mysqli_error(self::$link[$host]));
        }
    }
}
