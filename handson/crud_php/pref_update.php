<?php
include_once"includes/db.php";
include_once"includes/functions.php";
$id = $_POST['id'];
$name = $_POST['name'];
$array = ["prefName"=>"$name"];
$whereId = "prefId='$id'";
$tableName = "prefectures";
input($id,$array,$tableName,$mysqli,$whereId);
header("Location:pref.php");










