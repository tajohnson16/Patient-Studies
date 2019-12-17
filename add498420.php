<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Add page to add a single subject
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>Form for Adding Subjects</title>
</head>
<body>
<div class="header">
    <h1>Add Subject</h1>
</div>
<hr>
<form action="add498420.php" method="POST">
    <table>
        <tr>
            <td>StudyID:</td>
            <td><input type="number" name="STUDYID" value="12700"></td>
        </tr>
        <tr>
            <td>Domain:</td>
            <td><select name="DOMAIN">
                    <option value="DM">DM</option>
                    <option value="CO">CO</option>
                    <option value="SV">SV</option>
                </select></td>
        </tr>
        <tr>
            <td>Birth Date:</td>
            <td><input type="text" name="BRTHDTC"></td>
        </tr>
        <tr>
            <td>Sex:</td>
            <td><select name="SEX">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select></td>
        </tr>
        <tr>
            <td>Race:</td>
            <td><input type="text" name="RACE"></td>
        </tr>
        <tr>
            <td>Country:</td>
            <td><input type="text" name="COUNTRY"></td>
        </tr>
        <tr>
            <td><input class="submit" name="btnSubmit" type="submit" value="Submit"></td>
            <td><a href="study690901.php" class="button">All Subjects</a></td>
        </tr>
    </table>
</form>

<?php
function getDM($m)
{
    $query = new MongoDB\Driver\Query([]);
    $rows = $m->executeQuery("tj659374.DM", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count + 1;
}

$m = new MongoDB\Driver\Manager(
    "mongodb://tj659374:234502@localhost:27017/tj659374");
#example of inserting a new subject
$db = $m->tj659374;
if (isset($_POST['btnSubmit'])) {
    $bulk = new MongoDB\Driver\BulkWrite();
    $usubjid = getDM($m);
    $dob = $_POST['BRTHDTC'];
    $_id = $bulk->insert([
        'STUDYID' => $_POST['STUDYID'],
        'DOMAIN' => $_POST['DOMAIN'],
        'USUBJID' => $usubjid,
        'BRTHDTC' => $dob, # ISO8601
        'SEX' => $_POST['SEX'],
        'RACE' => $_POST['RACE'],
        'COUNTRY' => $_POST['COUNTRY']]);
    echo "<br>New subject has been added!<br>";
    $result = $m->executeBulkWrite('tj659374.DM', $bulk);
    header('Location: study690901.php');
}
?>

</body>
</html>
