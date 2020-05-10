<?php
defined('_ZERO_PATH_') OR exit('You shall not pass!');


class Z_Model
{


    protected $table;

    /**
     * Z_Model constructor.
     *
     * @param $table string table name
     */
    public function __construct($table = '')
    {
        if (!empty($table)) {
            $this->table = $table;
        } else {
            $this->table = strtolower(str_ireplace('model', '', get_called_class()));
        }
    }


    public function get_by_id($id)
    {
        $sql = "select * from " . $this->table . " where id=?";
        return $this->_get($sql, array($id));
    }


    /**
     * 查询获取一行记录
     *
     * @param $sql string SQL语句
     * @param $params array 查询参数
     * @return array 查询结果
     */
    protected function _get($sql, $params)
    {

        $dbh = $this->_conn();
        $stmt = $dbh->prepare($sql);
        $result = array();
        if ($stmt->execute($params)) {
            if ($row = $stmt->fetch()) {
                $result = $row;
            }
        }
        $dbh = null;
        return $result;
    }

    /**
     * 查询获取多行记录
     *
     * @param $sql string SQL语句
     * @param $params array 查询参数
     * @return array 查询结果
     */
    protected function _find($sql, $params)
    {
        $dbh = $this->_conn();
        $stmt = $dbh->prepare($sql);
        $result = array();
        if ($stmt->execute($params)) {
            while ($row = $stmt->fetch()) {
                array_push($result, $row);
            }
        }
        $dbh = null;
        return $result;
    }


    /**
     * 执行replace操作
     *
     * @param $params array 字段名和字段值的键值对
     * @return bool 是否执行成功
     */
    public function replace($params)
    {
        $keys = array_keys($params);
        $values = array_values($params);
        $place_holder = array_fill(0, sizeof($values), '?');
        $sql = 'replace into ' . $this->table . ' (' . implode(',', $keys) . ') values (' . implode(',', $place_holder) . ')';
        return $this->_execute($sql, $values);
    }


    /**
     * 执行delete操作
     *
     * @param $params array 字段名和字段值的键值对
     * @return bool 是否执行成功
     */
    protected function delete($params)
    {
        $sql = 'delete from ' . $this->table . ' where ';
        $first = true;
        foreach ($params as $k => $v) {
            if (!$first) {
                $sql = $sql . 'and ';
            } else {
                $first = false;
            }
            $sql = $sql . $k . '=? ';
        }
        $values = array_values($params);
        return $this->_execute($sql, $values);
    }


    /**
     * 执行sql语句
     *
     * @param $sql string SQL语句
     * @param $params array SQL参数
     * @return bool 是否执行成功
     */
    protected function _execute($sql, $params)
    {
        $dbh = $this->_conn();
        $stmt = $dbh->prepare($sql);
        $r = $stmt->execute($params);
        $dbh = null;
        return $r;
    }


    /**
     * 创建连接
     *
     * @return PDO PDO对象
     */
    private function _conn()
    {
        extract(_DB_);
        $dsn = "$dbsystem:host=$hostname;dbname=$database";
        return new PDO($dsn, $username, $password, $options);
    }

}