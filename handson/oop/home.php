<?php
include_once "includes/header.php";
require_once"class.php";
//for prefecture select options
$prefresult = $mysqli->query("SELECT * FROM prefectures");
//check get set & preparing parameter for function
$id = isset($_GET['id']) === true ? $_GET['id'] : "";
$name = isset($_GET['name'])  === true ? $_GET['name'] : "";
$gender = isset($_GET['gender']) === true ? $_GET['gender'] : "";
$dob = isset($_GET['dob']) === true ? $_GET['dob'] : "";
$email = isset($_GET['email']) === true ? $_GET['email'] : "";
$prefId = isset($_GET['address']) === true ? $_GET['address'] : "";
$page = isset($_GET['page']) === true ? $_GET['page'] : 1;
//passing to array
$array = [];
if (empty($id) === false) {
    $array["membersId"] = $id;
}
if (empty($name) === false) {
    $array["membersName"] = $name;
}
if (empty($gender) === false) {
    $array["membersGender"] = $gender;
}
if (empty($dob) === false) {
    $array["membersDob"] = $dob;
}
if (empty($email) === false) {
    $array["membersEmail"] = $email;
}
if (empty($prefId) === false) {
    $array["m.prefId"] = $prefId;
}
// defining parameters
$tableName = "members";
$join = "m INNER JOIN prefectures p ON m.prefId=p.prefId";
//paging. rpp-row per page.
$rpp = 5;
if ($page > 1) {
        $start = ($page*$rpp)-$rpp;
      } else {
        $start = 0;
      }
//get result without limit
$limit = "";
$db = new Db();
$result = $db->select($tableName,$array, $limit, $join);
$numRows = $result->num_rows;
$totalPages = ceil($numRows/$rpp);
$fill = "id=$id&name=$name&gender=$gender&dob=$dob&email=$email&address=$prefId";
//filter result by limit
$limit = "LIMIT ". sprintf("%s, %s", $start, $rpp);

$result = $db->select($tableName,$array, $limit, $join); ?>

<h1 align="center">MEMBERS MANAGEMENT</h1>
<form method="get">
    <table align="left" border="1">
        <tr>
            <td>Id</td>
            <td><input type="text" name="id" value="<?= $id; ?>"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="<?= $name; ?>"></td>
        </tr>
        <tr>
            <td>Gender</td> 
            <td><input type="radio" name="gender" value="Male"<?= $gender=='Male'?"checked":"" ?>>Male
               <input type="radio" name="gender" value="Female"<?= $gender=='Female'?"checked":"" ?>>Female
               <input type="radio" name="gender" value="Others"<?= $gender=='Others'?"checked":"" ?>>Others
            </td>
        </tr>
        <tr> 
            <td>Dob</td>
            <td><input type="text" name="dob" value="<?= $dob; ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="email" value="<?= $email; ?>"></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <select name="address">
                     <option value=""  >Select prefecture</option>
                     <?php while ($row = $prefresult->fetch_object()) : ?>
                     <?php $s = ($prefId == $row->prefId) === true ? "selected" : ""; ?>
                     <option value ="<?= $row->prefId; ?>"  <?= $s ?>> <?= $row->prefName; ?> </option>
                     <?php endwhile ?>
                  </select>
            </td>
        </tr>
        <tr>
            <td align="left" colspan="2"><input type="submit" value="Search"></td>
        </tr>
    </table>
</form><br>
<table align="center" border=2 class="table table-hover">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Dob</th>
        <th>Email</th>
        <th>Address</th>
        <th colspan="2">Update</th>
    </tr>
    <?php while($members = $result->fetch_object()): ?>
    <tr>
        <td><?=$members->membersId?></td>
        <td><?="$members->membersName"?></td>
        <td><?="$members->membersGender"?></td>
        <td><?="$members->membersDob"?></td>
        <td><?="$members->membersEmail"?></td>
        <td><?="$members->prefName"?></td>
        <td><a href="mem_edit.php?id=<?= $members->membersId ?>">Edit</a></td>
        <td><a href="mem_delconf.php?id=<?= $members->membersId ?>">Delete</a></td>
    </tr>
    <?php endwhile ?>
</table>
<a href="mem_edit.php?id=0" button type="button" class="btn btn-success">Add Member</a>
<a href="mem_csv.php" button type="button" class="btn btn-success">Download Csv</a>

<?php if ($totalPages!=0) : ?>
    <a href="?page=1<?= $fill ?>">first page</a>
    <?php for ($x = 1; $x <= $totalPages; $x++) : ?>
        <?= $x==$page ? "$x" : "<a href='?page=$x&$fill '> $x </a>"; ?>
        <?php endfor ?>
    <a href='?page=<?= $totalPages ?>&<?= $fill ?> '>last page</a>
<?php endif ?>

<?php include_once"includes/footer.php" ?>