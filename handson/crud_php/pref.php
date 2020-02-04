<?php
include_once"includes/db.php";
include_once"includes/header.php";
include_once"includes/functions.php";
$id = isset($_GET['prefId']) === true ? $_GET['prefId'] : "";
$name = isset($_GET['prefName']) === true ? $_GET['prefName'] : "";
$array = [];
    if(empty($id) === false) {
        $array["prefId"] = $id;
    }
    if(empty($name) === false) {
        $array["prefName"] = $name;
    }
$tableName = "prefectures";
$join = "";
$limit = "";
$result = search($array, $tableName, $mysqli, $join, $limit); ?>
<form action="pref.php" method="get">
    <input type="text" name = "prefId" placeholder = "Enter prefectures-Id">
    <input type="text" name = "prefName" placeholder = "Enter prefectures Name">
    <input type="submit" value="Search">
</form>
<h1>Prefecture View</h1>
<table border="2">
    <tr>
       <th>PrefId</th>
       <th>PrefectureName</th>
       <th colspan="2">update</th>
    </tr>
    <?php while ($pref = $result->fetch_object()) : ?>
    <tr>
       <td><?=$pref->prefId?></td>
       <td><?=$pref->prefName?></td>
       <td><a href="editpref.php?id=<?=$prefs->prefId?>">Edit </a></td>
       <td><a href="delpref.php?id=<?= $pref->prefId?>"> Delete </a></td>
    </tr>
       <?php endwhile ?>
</table>
    <a href="pref_edit.php?id=0">Add Prefectures</a>
    <a href="pref_csv.php">Download CSV</a><br>
<?php include_once"includes/footer.php";?>
