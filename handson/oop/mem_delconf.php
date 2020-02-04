<?php
include_once"includes/header.php";
include_once"class.php";
$id = $_GET['id'];
$db = new Db();
$tableName = "members";
$join = "m INNER JOIN prefectures p ON m.prefId=p.prefId WHERE m.membersId=$id";
$result = $db->select($tableName, $array=[], $join);
if($res = $result->fetch_object()){
    $name = $res->membersName;
    $gender = $res->membersGender;
    $dob = $res->membersDob;
    $email = $res->membersEmail;
    $add = $res->prefName;
} else {
    echo"empty";
}
?>
<div align="center">
   <font ></font>
    <h3 align="center"><font color="red">警告！データーを本当に消しますか！ARE YOU SURE!</font></h3><br>
    <table>
        <tr>
            <td>Id:</td>
            <td><?= $id;?> </td>
        </tr>        
        <tr>
            <td>Name:</td>
            <td><?= $name;?> </td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td><?= $gender;?> </td>
        </tr>
        <tr>
            <td>Date of Birth:</td>
            <td><?= $dob;?> </td>
        </tr>
        <tr>
            <td>Emal:</td>
            <td><?= $email;?> </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?= $add;?> </td>
        </tr>
    </table><br>
    <a  href="mem_del.php?id=<?=$id?>" button type="button" class="btn btn-danger">Yes</a>
    <a  href="home.php"button type="button" class="btn btn-success">No</a>
</div>


