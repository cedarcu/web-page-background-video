<?php
include_once"class.php";
include_once"includes/functions.php";
$id = $_GET['id'];
$whereId = "membersId='$id'";
$tableName = "members";
$db = new db();
$db->del($whereId, $tableName, $mysqli);
header("Location:home.php");






