<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Comment page to show and add comments
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>Subject Comments</title>
</head>
<body>
<div class="header">
    <h1>Subject <?php echo intval($_GET['id']) ?> Comments</h1>
</div>
<hr>
<a href="study690901.php" class="button">All Subjects</a>
<a href="visit318699.php?id=<?php echo intval($_GET['id']) ?>" class="button">Subject Visits</a>

<?php
function getCOcount($m, $usubjid)
{
    $query = new MongoDB\Driver\Query(['USUBJID' => $usubjid]);
    $rows = $m->executeQuery("tj659374.CO", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count;
}

function getCO($m, $usubjid)
{
    $query = new MongoDB\Driver\Query(['USUBJID' => $usubjid]);
    $rows = $m->executeQuery("tj659374.CO", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count + 1;
}

//init
$limit = 2;
$pageComment = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$skip = ($pageComment - 1) * $limit;
$next = ($pageComment + 1);
$prev = ($pageComment - 1);
$m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
//query
$query = new MongoDB\Driver\Query(
    ['USUBJID' => intval($_GET['id'])],
    ['skip' => $skip, 'limit' => $limit]);
$rows = $m->executeQuery("tj659374.CO", $query);
$total = getCOcount($m, intval($_GET['id']));
echo "<table>";
echo "<tr>";
if ($pageComment > 1) {
    echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $prev . '">Previous</a></td>';
    if ($pageComment * $limit < $total) {
        echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $next . '">Next</a></td>';
    }
} else {
    if ($pageComment * $limit < $total) {
        echo '<td><a href="?id=' . intval($_GET['id']) . '&page=' . $next . '">Next</a></td>';
    }
}
echo "</tr>";
echo "</table>";

//show results
echo "<table id=\"comTable\">";
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
                <td align='right'>Sequence Number :</td>
                <td>$r->COSEQ</td>
              </tr>
              <tr>
                <td align='right'>Comment :</td>
                <td>$r->COVAL</td>
              </tr>
              <tr>
                <td align='right'>Date/Time of Comment :</td>
                <td>$r->CODTC</td>
              </tr>
              <tr>
                <td>---------------------------------</td>
              </tr>";
}
?>
</table>
<button class="button" onclick="goBack()">Go Back</button>
<button onclick="myFunction()" class="button">Add Comment</button>
<form id="newComment" action="comment668335.php?id=<?php echo intval($_GET['id']) ?>" method="POST">
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
            <td align='right'>Comment :</td>
            <td><textarea name="COMMENT" placeholder="Enter comment here..."></textarea></td>
        </tr>
        <tr>
            <td><input class="submit" name="btnSubmit" type="submit" value="Submit"></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("newComment");
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
    $coseq = getCO($m, $usubjid);
    $now = new DateTime(date("Y-m-d H:i:s"));
    $_id = $bulk->insert([
        'STUDYID' => $_POST['STUDYID'],
        'DOMAIN' => 'CO',
        'USUBJID' => $id,
        'COSEQ' => $coseq,
        'COVAL' => $_POST['COMMENT'],
        'CODTC' => $now->format(DateTime::ATOM)]);
    echo "<br>New comment has been added!<br>";
    $result = $m->executeBulkWrite('tj659374.CO', $bulk);
    header('Location: comment668335.php?id=' . $id . '');
}
?>

</body>
</html>
