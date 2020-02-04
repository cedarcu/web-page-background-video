<?php
include_once "includes/db.php";
include_once "includes/functions.php";
$id=$_GET['id'];
$tableName = "prefectures";
$whereId = "prefId='$id'";
del($whereId, $tableName, $mysqli);
header("Location:pref.php");
?>