<?php
include_once"class.php";
header('Content-Disposition: attachment; filename=prefectures.csv');//
header('Content-Type: application/force-download');
header("Content-Transfer-Encoding: Binary");
$db = new Db();
$tableName = "prefectures";
$result = $db->select($tableName);
while($row = $result->fetch_object()){
    //     echo '"'.$row->prefId . '"' . "," . '"' .$row->prefName . '"' . "\n";
    $id = $row->prefId;
    $name = $row->prefName;
    $data = sprintf('"%s","%s"', $id, $name);
    echo $data . "\n";
}


