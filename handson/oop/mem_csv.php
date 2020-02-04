<?php
include_once"class.php";
header('Content-Disposition: attachment; filename=membersdata.csv');
header('Content-Type: application/force-download');
header("Content-Transfer-Encoding: Binary");
$tableName = "members";
$db = new Db();

$result = $db->select($tableName);
while ($row = $result->fetch_object()) {
    $id = $row->membersId;
    $name = $row->membersName;
    $gender = $row->membersGender;
    $dob = $row->membersDob;
    $email = $row->membersEmail;
    $prefId = $row->prefId;
    $data = sprintf(' "%s" , "%s" , "%s" , "%s" , "%s" , "%s" ', $id, $name, $gender, $dob, $email, $prefId);
    echo $data . "\n";
}