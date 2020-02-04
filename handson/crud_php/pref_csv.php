<?php
include_once"includes/db.php";
header('Content-Disposition: attachment; filename=prefectures.csv');//
header('Content-Type: application/force-download');
header("Content-Transfer-Encoding: Binary");
$sql = "SELECT * from prefectures";
$result = $mysqli->query($sql);
while($row = $result->fetch_object()){
    //     echo '"'.$row->prefId . '"' . "," . '"' .$row->prefName . '"' . "\n";
    $id = $row->prefId;
    $name = $row->prefName;
    $data = sprintf('"%s","%s"', $id, $name);
    echo $data . "\n";
}


