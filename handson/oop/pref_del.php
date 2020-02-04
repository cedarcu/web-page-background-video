<?php
include_once "class.php";
$id=$_GET['id'];
$tableName = "prefectures";
$whereId = "prefId='$id'";
$db = new db();
$db->del($whereId, $tableName);
header("Location:pref.php");
?>