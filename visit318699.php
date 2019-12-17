<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Visit page to show and add visits
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>Subject Visit Information</title>
</head>
<body>
<div class="header">
    <h1>Subject <?php echo intval($_GET['id']) ?> Visits</h1>
</div>
<hr>
<a href="study690901.php" class="button">All Subjects</a>
<a href="comment668335.php?id=<?php echo intval($_GET['id']) ?>" class="button">Subject Comments</a>
<?php
function getSVcount($m, $usubjid)
{
    $query = new MongoDB\Driver\Query(['USUBJID' => $usubjid]);
    $rows = $m->executeQuery("tj659374.SV", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count;
}

function getSV($m, $usubjid)
{
    $query = new MongoDB\Driver\Query(['USUBJID' => $usubjid]);
    $rows = $m->executeQuery("tj659374.SV", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count + 1;
}

//init
$limit = 2;
$pageVisit = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$skip = ($pageVisit - 1) * $limit;
$next = ($pageVisit + 1);
$prev = ($pageVisit - 1);
$m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
//query
$query = new MongoDB\Driver\Query(
    ['USUBJID' => intval($_GET['id'])],
    ['skip' => $skip,
        'limit' => $limit]);
$rows = $m->executeQuery("tj659374.SV", $query);
$total = getSVcount($m, intval($_GET['id']));

echo "<table>";
echo "<tr>";
if ($pageVisit > 1) {
    echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $prev . '">Previous</a></td>';
    if ($pageVisit * $limit < $total) {
        echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $next . '">Next</a></td>';
    }
} else {
    if ($pageVisit * $limit < $total) {
        echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $next . '">Next</a></td>';
    }
}
echo "</tr>";
echo "</table>";
//show results
echo "<table>";
foreach ($rows as $r) {
    echo "<tr>
                <td align='right'>Study ID :</td>
                <td>$r->STUDYID</td>
              </tr>
              <tr>
                <td align='right'>Domain :</td>
                <td>$r->DOMAIN</td>
              </tr>
              <tr> 
                <td align='right'>Subject ID :</td>
                <td>$r->USUBJID</td>
              </tr>
              <tr>
                <td align='right'>Visit Number :</td>
                <td>$r->VISITNUM</td>
              </tr>
              <tr>
                <td align='right'>Visit Name :</td>
                <td>$r->VISIT</td>
              </tr>
              <tr>
                <td align='right'>Start Date/Time of Visit :</td>
                <td>$r->SVSTDTC</td>
              </tr>
              <tr>
                <td align='right'>End Date/Time of Visit :</td>
                <td>$r->SVENDTC</td>
              </tr>
              <tr>
                <td>---------------------------------</td>
              </tr>";
}
?>
</table>
<button class="button" onclick="goBack()">Go Back</button>
<button onclick="myFunction()" class="button">Add Visit</button>
<form id="newVisit" action="visit318699.php?id=<?php echo intval($_GET['id']) ?>" method="POST">
    <table>
        <tr>
            <td align='right'>Study ID :</td>
            <td><input type="number" name="STUDYID" value="12700"></td>
        </tr>
        <tr>
            <td align='right'>Subject ID :</td>
            <td><input type="text" name="subid" value="<?php echo intval($_GET['id']); ?>" disabled></td>
        </tr>
        <tr>
            <td align='right'>Visit Name :</td>
            <td><input type="text" name="VISIT"></td>
        </tr>
        <tr>
            <td><input class="submit" name="btnSubmit" type="submit" value="Submit"></td>
        </tr>
    </table>
</form>
<script>
    function myFunction() {
        var x = document.getElementById("newVisit");
        if (x.style.display !== "block") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function goBack() {
        window.history.back();
    }
</script>

<?php

$m = new MongoDB\Driver\Manager(
    "mongodb://tj659374:234502@localhost:27017/tj659374");
#example of inserting a new comment for the above subject
$id = intval($_GET['id']);
if (isset($_POST['btnSubmit'])) {
    $bulk = new MongoDB\Driver\BulkWrite();
    $usubjid = $id;
    $visitnum = getSV($m, $usubjid);
    $now = new DateTime(date("Y-m-d H:i:s"));
    $svendtc = new DateTime(date("Y-m-d H:i:s"));
    $svendtc->modify('+1 hour');
    $_id = $bulk->insert([
        'STUDYID' => $_POST['STUDYID'],
        'DOMAIN' => 'SV',
        'USUBJID' => $id,
        'VISITNUM' => $visitnum,
        'VISIT' => $_POST['VISIT'],
        'SVSTDTC' => $now->format(DateTime::ATOM),
        'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
    echo "<br>New visit has been added!<br>";
    $result = $m->executeBulkWrite('tj659374.SV', $bulk);
    header('Location: visit318699.php?id=' . $id . '');
}
?>

</body>
</html>
