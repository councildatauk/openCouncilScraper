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
<p>Some false positives mainly in Scotland due to IND/Other not being a party.</p>
';

/* Get data */
$queryStr = "SELECT id, name, total, control, con, lab, ld, grn, ukip, plaid, snp, other FROM wcouncils ORDER BY id";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

echo '<table border=1>';

while($row = $result->fetch_assoc()) {

$total = $row['total'];
$con = $row['con'];
$lab = $row['lab'];
$ld = trim($row['ld']);
$grn = $row['grn'];
$ukip = $row['ukip'];
$pc = $row['plaid'];
$snp = $row['snp'];
$ind = $row['other'];
$cont = $row['control'];

if($total % 2 == 0 ) { $maj = $total/2+1; }
else { $maj = $total/2+0.5; }

if($con > $lab+$ld+$grn+$ukip+$pc+$snp+$ind && $con >= $maj) { $absMaj = "CON"; }
elseif($lab > $con+$ld+$grn+$ukip+$pc+$snp+$ind && $lab >= $maj) { $absMaj = "LAB"; }
elseif($ld > $lab+$con+$grn+$ukip+$pc+$snp+$ind && $ld >= $maj) { $absMaj = "LD"; }
elseif($grn > $lab+$ld+$con+$ukip+$pc+$snp+$ind && $grn >= $maj) { $absMaj = "GRN"; }
elseif($ukip > $lab+$ld+$grn+$con+$pc+$snp+$ind && $ukip >= $maj) { $absMaj = "UKI"; }
elseif($pc > $lab+$ld+$grn+$ukip+$con+$snp+$ind && $pc >= $maj) { $absMaj = "PC"; }
elseif($snp > $lab+$ld+$grn+$ukip+$pc+$con+$ind && $snp >= $maj) { $absMaj = "SNP"; }
elseif($ind > $lab+$ld+$grn+$ukip+$pc+$snp+$con && $ind >= $maj) { $absMaj = "IND"; }
else { $absMaj = "NOC"; }

if($absMaj !== $cont) { $alert = "!!!!!! A party seems to have (or have lost) a majority"; } else { $alert = ""; }

echo '<tr><td>'.$row['name'].'</td><td>'.$total.'</td><td>'.$maj.'</td><td>'.$con.' '.$lab.' '.$ld.' '.$grn.' '.$ukip.' '.$pc.' '.$snp.' '.$ind.'</td><td>'.$absMaj.'</td><td>'.$cont.'</td><td>'.$alert.'</td></tr>';

$alert = "";

}

/* End */
echo "</table></body></html>";
?>
