<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Subject page to show and update a subject's demographics,
also provides button to delete subject and their comments/visits
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="formatting.css">
    <meta charset="UTF-8">
    <title>Subject Info</title>
</head>
<body>
<div class="header">
    <h1>Subject <?php echo intval($_GET['id']) ?> Info</h1>
</div>
<hr>
<button onclick="myFunction()" class="button">Edit Subject</button>
<a href="delete257874.php?id=<?php echo intval($_GET['id']) ?>" class="delete">Delete Subject</a>
<a href="study690901.php" class="button">All Subjects</a>
<table id="subTable">
    <?php
    //init
    $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
    //query
    $query = new MongoDB\Driver\Query(
        ['USUBJID' => intval($_GET['id'])]);
    $rows = $m->executeQuery("tj659374.DM", $query);
    //show results
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
                <td align='right'>Birth Date :</td>
                <td>$r->BRTHDTC</td>
              </tr>
              <tr>
                <td align='right'>Sex :</td>
                <td>$r->SEX</td>
              </tr>
              <tr>
                <td align='right'>Race :</td>
                <td>$r->RACE</td>
              </tr>
              <tr>
                <td align='right'>Country :</td>
                <td>$r->COUNTRY</td>
              </tr>";
    }
    ?>
</table>
<form id="editSub" action="subject960427.php?id=<?php echo intval($_GET['id']) ?>" method="POST">
    <table>
        <tr>
            <td align='right'>Study ID :</td>
            <td><input type="number" name="STUDYID" value="12700"></td>
        </tr>
        <tr>
            <td align='right'>Domain :</td>
            <td><input type="text" name="DOMAIN" value="<?php
                $m = new MongoDB\Driver\Manager("mongodb://tj659374:234502@localhost:27017/tj659374");
                //query
                $query = new MongoDB\Driver\Query(
                    ['USUBJID' => intval($_GET['id'])]);
                $rows = $m->executeQuery("tj659374.DM", $query);
                //show results
                foreach ($rows

                as $r) {
                echo "$r->DOMAIN"; ?>" disabled></td>
        </tr>
        <tr>
            <td align='right'>Subject ID :</td>
            <td><input type="text" name="subid" value="<?php echo intval($_GET['id']); ?>" disabled></td>
        </tr>
        <tr>
            <td align='right'>Birth Date :</td>
            <td><input type="text" name="BRTHDTC" value="<?php echo "$r->BRTHDTC"; ?>"></td>
        </tr>
        <tr>
            <td align='right'>Sex :</td>
            <td><select name="SEX">
                    <option value="<?php echo "$r->SEX"; ?>"><?php echo "$r->SEX"; ?></option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select></td>
        </tr>
        <tr>
            <td align='right'>Race :</td>
            <td><input type="text" name="RACE" value="<?php echo "$r->RACE"; ?>"></td>
        </tr>
        <tr>
            <td align='right'>Country :</td>
            <td><input type="text" name="COUNTRY" value="<?php echo "$r->COUNTRY";
                } ?>"></td>
        </tr>
        <tr>
            <td><input class="submit" name="btnSubmit" type="submit" value="Submit"></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("editSub");
        var y = document.getElementById("subTable");
        if (y.style.display !== "none" && x.style.display !== "block") {
            y.style.display = "none";
            x.style.display = "block";
        } else {
            y.style.display = "block";
            x.style.display = "none";
        }
    }

    function goBack() {
        window.history.back();
    }
</script>
<button class="button" onclick="goBack()">Go Back</button>
<a href="visit318699.php?id=<?php echo intval($_GET['id']) ?>" class="button">Visits</a>
<a href="comment668335.php?id=<?php echo intval($_GET['id']) ?>" class="button">Comments</a>
<?php
$m = new MongoDB\Driver\Manager(
    "mongodb://tj659374:234502@localhost:27017/tj659374");
#example of inserting a new subject
$db = $m->tj659374;
$id = intval($_GET['id']);
if (isset($_POST['btnSubmit'])) {
    $bulk = new MongoDB\Driver\BulkWrite();
    $dob = $_POST['BRTHDTC'];
    $_id = $bulk->update(array('USUBJID' => intval($_GET['id'])),
        array('$set' => array('STUDYID' => $_POST['STUDYID'],
            'BRTHDTC' => $dob, # ISO8601
            'SEX' => $_POST['SEX'],
            'RACE' => $_POST['RACE'],
            'COUNTRY' => $_POST['COUNTRY'])),
        ['multi' => false,
            'upsert' => false]);
    echo "<br>Subject has been updated!<br>";
    $result = $m->executeBulkWrite('tj659374.DM', $bulk);
    header('Location: subject960427.php?id=' . $id . '');
}
?>

</body>
</html>
