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

/* Get NI data */
$queryStr = "SELECT id, name, total, dup, sf, uup, sdlp, ali, tuv, grn, pup, other, vacant, last, notes, url FROM wcouncils WHERE id > 1000 ORDER BY id";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

$check = "";

/* Draw table */
echo '<html><head><link rel="stylesheet" href="ukpol.css"><style></style><script src="sorttable.js"></script></head><body>';
echo '<a href="majorityUpdater.php">Majority Updater</a><br>';
echo '<table class="sortable" style="width: 100%;">';
echo '<tr class="scottish-gov-second"><td>Name</td><td>Scrape</td><td>Total</td><td>DUP</td><td>SF</td><td>UUP</td><td>SDLP</td><td>ALI</td><td>TUV</td><td>GRN</td><td>PUP</td><td>IND/OTH</td><td>Vacant</td><td>Last Updated</td><td>Notes</td></tr>';

while($row = $result->fetch_assoc()) {
echo '<tr class="scottish-gov-second">';
/* Name column */
echo '<td style="width:1px;white-space:nowrap;"><a href="'.$row['url'].'">'.$row['name'].'</a></td>';
/* Links columns */
$filename1 = "scrape.php?a=0&c=" . $row['id']; /* non-auto, non-election day (allows manual editing of table, then updates table contents) */
$filename2 = "scrape.php?a=1&c=" . $row['id']; /* auto (checks that there are no changes, then updates 'last updated' field) */
$filename3 = "scrape.php?a=2&c=" . $row['id']; /* election day (not written yet - needs to match by ward name (and select those wards up for election in cases thirds/halves cases)) */
echo '<td style="width:1px;white-space:nowrap;"><a href="'. $filename1 . '">Scrape</a> / <a href="'.$filename2.'">Auto</a> / <a href="'.$filename3.'">eDay</a></td>';
/* Total column */
if($row['total'] != $row['dup']+$row['sf']+$row['uup']+$row['sdlp']+$row['ali']+$row['tuv']+$row['grn']+$row['pup']+$row['other']+$row['vacant']) { $check = "*"; } 
echo '<td class="ni-ass-second" style="width: 10%;">' . $check . $row['total'] . $check . '</td>';
/* Party columns */
echo '<td class="dup" style="width: 10%;">' . $row['dup'] . '</td>';
echo '<td class="sf" style="width: 10%;">' . $row['sf'] . '</td>';
echo '<td class="uup" style="width: 10%;">' . $row['uup'] . '</td>';
echo '<td class="sdlp" style="width: 10%;">' . $row['sdlp'] . '</td>';
echo '<td class="ali" style="width: 10%;">' . $row['ali'] . '</td>';
echo '<td class="tuv" style="width: 10%;">' . $row['tuv'] . '</td>';
echo '<td class="green-main" style="width: 10%;">' . $row['grn'] . '</td>';
echo '<td class="pup" style="width: 10%;">' . $row['pup'] . '</td>';
echo '<td class="ni-ass-second" style="width: 10%;">' . $row['other'] . '</td>';
/* Vacant column */
echo '<td class="ni-ass-second" style="width: 10%;';
if($row['vacant'] != "0") { echo 'border-top: 1px solid black; border-bottom: 1px solid black;'; } echo '">' . $row['vacant'] . '</td>';
/* Last updated column */
$last = (new DateTime($row['last']))->format('d.m.Y');
if($last == "30.11.-0001") { $last = ""; }
echo '<td style="width: 15%;">' . $last . '</td>';
/* Notes column */
echo '<td style="white-space:nowrap;">' . $row['notes'] . '</td>';
echo '</tr>';
$check = "";
}
echo '</table></body></html>';
?>
