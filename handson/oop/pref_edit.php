
<?php
include_once"class.php";
$id = $_GET['id'];
if ($id != 0) {
    $db = new Db();
    $array = ["prefId"=>"$id"];
    $tableName = "prefectures";
    $result = $db->select($tableName, $array);
    if ($res = $result->fetch_Object()) {
        $name = $res->prefName;
    } else {
        echo "empty";
    }
} else {
    $name = "";
}
?>

<h1><?= $id !== '0' ? "Edit" : "Add" ?></h1>
<form action="pref_update.php" method="post">
    <?= $id !== '0' ? "ID : ".$id : ""?><br>
    PREFECTURE NAME : <input type="text" name="name" value="<?= $name ?>"><br>
    <input type="hidden" name="id" value='<?= $id ?>'><br>
    <input type="submit" value="Submit">
</form>
<?php include_once"includes/footer.php";?>

