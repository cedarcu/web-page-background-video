<?php

include_once"includes/header.php";
include_once"class.php";
$id = isset($_GET['prefId']) === true ? $_GET['prefId'] : "";
$name = isset($_GET['prefName']) === true ? $_GET['prefName'] : "";


    $page = isset($_GET['page']) === true ? $_GET['page'] : 1;
    
    $rpp = 5;
    $start = ($page*$rpp)-5;
    $array = [];

    if(empty($id) === false) {
        $array["prefId"] = $id;
    }
    if(empty($name) === false) {
        $array["prefName"] = $name;
    }
$tableName = "prefectures";
$limit = "LIMIT ".sprintf("%s, %s",$start, $rpp) ;
$db = new Db();

$result = $db->select($tableName, $array, $limit);


?>

<form action="pref.php" method="get">
    <input type="text" name="prefId" placeholder="Enter prefectures-Id">
    <input type="text" name="prefName" placeholder="Enter prefectures Name">
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
       <td><?= $pref->prefId ?></td>
       <td><?= $pref->prefName ?></td>
       <td><a href="pref_edit.php?id=<?= $pref->prefId ?>">Edit </a></td>
       <td><a href="pref_del.php?id=<?= $pref->prefId ?>"> Delete </a></td>
    </tr>
       <?php endwhile ?>
</table>
    <a href="pref_edit.php?id=0">Add Prefectures</a>
    <a href="pref_csv.php">Download CSV</a><br>

<?php
    $result = $db->select($tableName, $array);
    $totalrows = $result->num_rows;
    $totalpages = ceil($totalrows/$rpp);
?>
    <a href="?page=1"> Top </a>
    <?php for($i=1; $i <= $totalpages; $i++) : ?>
    <?php if($i == $page) {
        echo $i;
    } else { ?>
        <a href='?page=<?= $i ?>'> <?= $i ?> </a>
    <?php }
    endfor ?>
    <a href="?page=<?= $totalpages ?>"> Buttom </a>

<?php include_once"includes/footer.php";?>
