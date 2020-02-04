<?php
include_once"includes/db.php";
include_once"includes/header.php";
$id = $_GET['id'];
$result = $mysqli->query("SELECT * FROM members m INNER JOIN prefectures p ON m.prefId=p.prefId WHERE m.membersId=$id");
$prefresult = $mysqli->query("SELECT * FROM prefectures");
if ($id != 0) 
{
    if($res = $result->fetch_object()) {
        $name = $res->membersName;
        $gender = $res->membersGender;
        $dob = $res->membersDob;
        $email = $res->membersEmail;
        $prefId = $res->prefId;
       } else {
            echo"empty";
       }
} else {
    $name = "";
    $gender = "";
    $dob = "";
    $email = "";
    $prefId = "";
}
?>

<h1><?= $id !== '0' ? "Edit Member" : "Add Member"?></h1><br>
<form name="form1" method="post" action='mem_update.php'?>
    <?= $id !== '0' ? "ID : ".$id : ""?><br>
    NAME: <input type="text" name="name" value="<?= $name;?>"><br>
    GENDER: <input type="radio" name="gender" value="Male"<?= $gender=='Male'?"checked":""?>>Male
           <input type="radio" name="gender" value="Female"<?= $gender=='Female'?"checked":""?>>Female
           <input type="radio" name="gender" value="Other"<?= $gender=='Other'?"checked":""?>> Other<br><br>
    DATE OF BIRTH: <input type="text" name="dob" value="<?= $dob;?>"><br><br>
    Email Address: <input type="email" name="email" value="<?= $email;?>"><br><br>
    Address : <select name="address">
               <option value="" selected disabled hidden>Select prefecture</option>
                <?php while ($row = $prefresult->fetch_object()) : ?>
                 <?php $s = ($prefId == $row->prefId)===true ? "selected" : ""; ?>
                 <option value ="<?= $row->prefId; ?>"  <?= $s ?>> <?= $row->prefName; ?> </option>
                <?php endwhile ?>
              </select>
    <input type="hidden" name="id" value =" <?= $_GET[ 'id']; ?> " ><br>
    <input type="submit" value="submit"><br>
</form>

















