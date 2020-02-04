<?php
//search
function search($array, $tableName, $mysqli, $join, $limit) {
    $update = [];
    foreach ($array as $key => $value) 
    {
    $update[] = sprintf("%s = '%s' ",$key, $value);
    }
    $hoge = implode("AND ", $update);
    if (empty ($array)) {
        $where = "";
    } else {
        $where = "WHERE ". sprintf("%s",$hoge);
    }
    $sql = sprintf("SELECT * FROM %s %s %s %s", $tableName, $join, $where, $limit);
//    echo $sql;
    $result = $mysqli->query($sql);
    return $result;
    }

//members add edit
function input($id, $array, $tableName, $mysqli, $whereId) {    //the parameter must be same as where it will be called
    $update = [];
    foreach ($array as $key => $value) {
        $update[] = sprintf("%s = '%s' ", $key, $value);
    }
    $koge = implode(",", $update);

    if ($id == 0) {
        $mode = "INSERT INTO";
        $where = "";
    } else {
        $mode = "UPDATE";
        $where = "WHERE ". sprintf("%s", $whereId);
    }
    $sql = sprintf("%s %s SET %s %s", $mode, $tableName, $koge, $where);
//    echo $sql;
    $result = $mysqli->query($sql);
}

// delete
function del($whereId, $tableName, $mysqli) {
    $sql = sprintf("DELETE FROM %s WHERE %s", $tableName, $whereId);
    $result = $mysqli->query($sql);
}




