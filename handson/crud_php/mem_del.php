<?php
include_once"includes/db.php";
include_once"includes/functions.php";
$id = $_GET['id'];
$whereId = "membersId='$id'";
$tableName = "members";
del($whereId, $tableName, $mysqli);
header("Location:home.php");






