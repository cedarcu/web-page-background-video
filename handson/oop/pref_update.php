<?php

include_once"class.php";
$id = $_POST['id'];
$name = $_POST['name'];
$array = [];
if(empty($name)=== false)
{
    $array = ["prefName"=>"$name"];
}
$tableName = "prefectures";
$db = new Db();
if($id == 0)
    {
        $result = $db->insert($array, $tableName);
    }
    else
    {
        $whereId = "prefId = $id";
        $result = $db->update($array, $tableName, $whereId);
    }
header("Location:pref.php");










