<!--
Tim Johnson
CSC 353 - IAD (Grevera)
Final Project

Insert page that runs php code to insert into MongoDB
-->
<html>
<head><title>Subject inserts</title></head>
<body><pre>

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

$m = new MongoDB\Driver\Manager(
    "mongodb://tj659374:234502@localhost:27017/tj659374");
#example of inserting a new subject
$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2010-12-30 23:21:46');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'm',
    'RACE' => 'caucasian',
    'COUNTRY' => 'USA']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for MRI study',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for sleep study',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for broken hip',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for nausea',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for a routine checkup',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'this is my comment',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'this is my second comment',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Needs more fluids',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Checkup with specialist needed',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Dehydrated!',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2008-07-29 20:18:40');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'F',
    'RACE' => 'Asian',
    'COUNTRY' => 'China']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for blood work',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'visit for tonsillitis',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Swollen tonsils',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Need tonsil removal',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2006-12-01 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'African American',
    'COUNTRY' => 'USA']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for case study',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for broken arm',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Given placebo pills',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Cast required for broken arm',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2002-08-01 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'F',
    'RACE' => 'Native American',
    'COUNTRY' => 'USA']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for broken leg',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for broken wrist',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Low blood pressure',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Need ibuprofen for swelling',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2004-12-18 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'Hispanic',
    'COUNTRY' => 'Guatemala']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for high fever',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for upset stomach',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'May have the flu',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Need special medicine',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('1998-06-23 06:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'F',
    'RACE' => 'African',
    'COUNTRY' => 'Sierra Leone']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for sleep study',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for syncope',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Has sleep apnea',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Re-evaluate your diet and get good sleep',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2002-03-01 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'Caucasian',
    'COUNTRY' => 'USA']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for deep cut on face',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for broken toe nail',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Needs stitches for face',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('1997-12-01 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'F',
    'RACE' => 'African American',
    'COUNTRY' => 'USA']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for abnormal heart beat',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for athletes foot',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Foot looks gross!',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2000-06-18 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'Asian',
    'COUNTRY' => 'Korea']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for pink eye',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);

#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Lots of itching and drainage from the eye',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2003-07-04 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'F',
    'RACE' => 'Native Hawaiian',
    'COUNTRY' => 'Hawaii']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for numbness and tingling in the right arm',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Follow up with a cardiac and EKG testing',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('2005-02-14 15:30:49');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'Asian',
    'COUNTRY' => 'Japan']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for broken toe',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Need boot for left foot',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);

#example of inserting a new subject
$bulk = new MongoDB\Driver\BulkWrite();
$usubjid = getDM($m);
$dob = new DateTime('1996-09-03 23:21:46');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'DM',
    'USUBJID' => $usubjid,
    'BRTHDTC' => $dob->format(DateTime::ATOM), # ISO8601
    'SEX' => 'M',
    'RACE' => 'Caucasian',
    'COUNTRY' => 'Canada']);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.DM', $bulk);

#example of inserting subject visit for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$visitnum = getSV($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$svendtc = new DateTime(date("Y-m-d H:i:s"));
$svendtc->modify('+1 hour');
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'SV',
    'USUBJID' => $usubjid,
    'VISITNUM' => $visitnum,
    'VISIT' => 'Visit for burns on right arm',
    'SVSTDTC' => $now->format(DateTime::ATOM),
    'SVENDTC' => $svendtc->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.SV', $bulk);


#example of inserting a new comment for the above subject
$bulk = new MongoDB\Driver\BulkWrite();
$coseq = getCO($m, $usubjid);
$now = new DateTime(date("Y-m-d H:i:s"));
$_id = $bulk->insert([
    'STUDYID' => '12700',
    'DOMAIN' => 'CO',
    'USUBJID' => $usubjid,
    'COSEQ' => $coseq,
    'COVAL' => 'Need a skin graft',
    'CODTC' => $now->format(DateTime::ATOM)]);
echo "$_id \n";
$result = $m->executeBulkWrite('tj659374.CO', $bulk);
echo "\nDone. \n";
?>

</pre>
</body>
</html>
