<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Page provides links to all subjects in database, as well
as add subject and delete all subject links
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>All Subjects</title>
</head>
<body>
<div class="header">
    <h1>List of All Subjects</h1>
</div>
<hr>
<a href="add498420.php" class="button">Add Subject</a>
<?php
function getDMcount($m)
{
    $query = new MongoDB\Driver\Query([]);
    $rows = $m->executeQuery("tj659374.DM", $query);
    $count = 0;
    foreach ($rows as $r) {
        ++$count;
    }
    return $count;
}

//init
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$skip = ($page - 1) * $limit;
$next = ($page + 1);
$prev = ($page - 1);
$m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
//query
$query = new MongoDB\Driver\Query(
    [],
    ['sort' => ['USUBJID' => 1],
        'skip' => $skip,
        'limit' => $limit]);
$rows = $m->executeQuery("tj659374.DM", $query);
$total = getDMcount($m);
//show results
echo "<table>";
echo "<tr>";
if ($page > 1) {
    echo '<td><a href="?page=' . $prev . '">Previous</a></td>';
    if ($page * $limit < $total) {
        echo '<td><a href="?page=' . $next . '">Next</a></td>';
    }
} else {
    if ($page * $limit < $total) {
        echo '<td><a href="?page=' . $next . '">Next</a></td>';
    }
}
echo "</tr>";
echo "</table>";
echo "<ul>";
foreach ($rows as $r) {
    echo "<li>"; ?>
    <a href="subject960427.php?id=<?php echo "$r->USUBJID" ?>">Subject: <?php echo "$r->USUBJID" ?></a>
    <?php echo "</li>";
}
echo "</ul>";
?>
<a href="delete257874.php" class="delete">Delete All Subjects</a>

</body>
</html>
