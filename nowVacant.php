<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if(!$_SESSION['logged']) { header("Location: log.php"); exit; }
ini_set('display_errors',1);
ini_set("default_charset", 'utf-8');
error_reporting(E_ALL);

require_once("databaseConnection.inc");

echo '
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci"/> <meta http-equiv="Content-Language" content="en" />
<link rel="stylesheet" href="ukpol.css">
<script src="sorttable.js"></script>
</head>
<body>
';

/* Move get data into arrays */
$wID = $_GET['wID'];
$cID = $_GET['cID'];
$def = $_GET['def'];
$date = date('Y.m.d', time());

/* Set councillor to deleted */
$queryStr = "
UPDATE wcouncillors c 
SET c.deleted='{$date}'
WHERE c.id = $cID";
$result = mysqli_query($mysqli, $queryStr);

/* Set ward to byelection mode */
$queryStr = "UPDATE wards w SET w.defending = '".$def."' WHERE w.id = ".$wID;
$result = mysqli_query($mysqli, $queryStr);

/* Get new ID and insert new vacant seat */
$result = mysqli_query($mysqli,"SELECT MAX(id) AS newID FROM wcouncillors");
$row = mysqli_fetch_array($result);
$newID = $row["newID"]+1;
$queryStr = "
INSERT INTO wcouncillors
(id, name, partyCode, wardID, deleted)
VALUES ('{$newID}', 'Vacancy', 'VAC', '{$wID}', '0');";
echo "NEWID=".$newID;
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));

echo "Updated record ".$cID." to deleted as of ".$date." and inserted new record as Vacant seat for ward ".$wID;

echo '<script>history.go(-1);</script>';

?>
