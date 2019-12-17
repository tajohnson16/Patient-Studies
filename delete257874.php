<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Runs php code to delete all documents
from DM, CO, and SV collections
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>Delete All Collections</title>
</head>
<body>
<div class="header">
    <h1>Deleting...</h1>
</div>
<hr>
<?php
$subjid = intval($_GET['id']);


if ($subjid = intval($_GET['id'])) {
    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete(['USUBJID' => $subjid]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.CO", $bulk);
    echo "Subject " . $subjid . " comments cleared.<br>";

    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete(['USUBJID' => $subjid]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.SV", $bulk);
    echo "Subject " . $subjid . " study visits cleared.<br>";

    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete(['USUBJID' => $subjid]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.DM", $bulk);
    echo "Subject " . $subjid . " demographics cleared.<br>";
} else {
    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete([]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.CO", $bulk);
    echo "All comments cleared.<br>";

    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete([]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.SV", $bulk);
    echo "All study visits cleared.<br>";

    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete([]);

    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    $m->executeBulkWrite("tj659374.DM", $bulk);
    echo "All demographics cleared.<br>";
}
?>
<a href="study690901.php" class="button">All Subjects</a>
</body>
</html>