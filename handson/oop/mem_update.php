<?php
include_once"includes/db.php";
include_once"class.php";
$id = $_POST['id'];
$name = $_POST['name'];
$gender = isset($_POST['gender']) === true ? $_POST['gender'] : "";//because of radio button
$dob = $_POST['dob'];
$email = $_POST['email'];
$add = $_POST['address'];
    // checking empty fields
if (empty($name) || empty($gender) || empty($dob)) {
    if(empty($name)) {
        echo "<font color='red'>Enter Name</font><br/>";
    }
    if(empty($gender)) {
        echo "<font color='red'>Select Gender</font><br/>";
    }
    if(empty($dob)) {
        echo "<font color='red'>Enter Date of birth</font><br/>";
    }
    if(empty($email)) {
        echo "<font color='red'>Enter Email Address</font><br/>";
    }
    if(empty($add)) {
        echo "<font color='red'>Please Select Address</font><br/>";
    }
} else {
    $array = [
    "membersName"=>"$name",
    "membersGender"=>"$gender",
    "membersDob"=>"$dob",
    "membersEmail"=>"$email",
    "prefId"=>"$add"
    ];
$tableName = "members";
$whereId = "membersId='$id'";
$db = new Db();
if($id == 0) {
    $result = $db->insert($array, $tableName);
    } else {
        $result = $db->update($array, $tableName,  $whereId);
    }
    echo $result;
header ("Location:home.php");
}