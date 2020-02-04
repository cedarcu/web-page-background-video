<?php
include_once"includes/db.php";
class Db
{
    private $_mysqli;//"_"for private.

    public function __construct()//constructorName always starts with__ //every time when class is called constructor will run .
    {
        $this->connect();
    }

    public function connect($host = HOST_DB, $dbName = DB_NAME, $pass = DB_PASS, $user = USER_NAME)
    {
        $this->_mysqli = mysqli_connect($host, $dbName, $pass, $user);
    }
    //select
    public function select($tableName, $array=[], $limit='', $join='')
    {

        $update = [];
        foreach ($array as $key => $value)
        {
            $update[] = sprintf("%s = '%s'",$key, $value);
        }
        $hoge = implode("AND ", $update);
        if (empty ($array)) {
            $where = "";
        } else {
            $where = "WHERE ". sprintf("%s",$hoge);
        }
        $sql = sprintf("SELECT * FROM %s %s %s %s", $tableName, $join, $where, $limit);
//        echo $sql;
//        exit;
        $result = $this->_mysqli->query($sql);
        return $result;
    }
    
    //members add edit
    private function save($array, $tableName, $mode, $where='')
    {
        $update = [];
        foreach ($array as $key => $value) {
        $update[] = sprintf("%s = '%s' ", $key, $value);
        $koge = implode(",", $update);
        }
        $sql = sprintf("%s %s SET %s %s", $mode, $tableName, $koge, $where);
//        echo $sql;
//        exit;
        $result = $this->_mysqli->query($sql);
        return $result;
    }
    
    public function insert($array, $tableName)
    {
        $mode = "INSERT INTO";
        $this->save($array, $tableName, $mode);
    }
    
    public function update ($array, $tableName, $whereId)
    {
        $mode = "UPDATE";
        $where = "WHERE ". sprintf("%s", $whereId);
        $this->save($array, $tableName, $mode, $where);
    }
    
    // delete
    public function del($whereId, $tableName)
    {
        $sql = sprintf("DELETE FROM %s WHERE %s", $tableName, $whereId);
        $result = $this->_mysqli->query($sql);
        return $result;
    }
}
    


