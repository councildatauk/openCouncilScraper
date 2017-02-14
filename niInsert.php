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

/* Get session variables */
$n = $_SESSION['n'];
$p = $_SESSION['p'];
$pCode = $_SESSION['pCode'];
$w = $_SESSION['w'];
$councilNumber = pg_escape_string($_SESSION['councilNumber']);
$councilName = $_SESSION['councilName'];
$autoFlag = $_SESSION['a'];

$dup = $_POST['DUP'];
$sf = $_POST['SF'];
$uup = $_POST['UUP'];
$sdlp = $_POST['SDLP'];
$ali = $_POST['ALI'];
$tuv = $_POST['TUV'];
$grn = $_POST['GRN'];
$pup = $_POST['PUP'];
$ind = $_POST['IND'];
$vac = $_POST['VAC'];
$def = $_POST['DEF'];
$bye = $_POST['BYE'];
$ele = $_POST['ELE'];
$not = addslashes($_POST['NOT']);
$tot = $_POST['TOT'];
$date = date('Y.m.d', time());

/* Get real total for council */
$queryStr = "SELECT id FROM wards WHERE councilID = ".$councilNumber;
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
while($row = $result->fetch_assoc()) {
$realTotal = $result->num_rows;
}

/* Move post data into arrays */
for($i=0;$i<$realTotal;$i++) {
$wIDPOST = "wID".$i;
$wNamePOST = "wName".$i;
$cNamePOST = "cName".$i;
$cpCodePOST = "cpCode".$i;
$defPOST = "def".$i;
$byePOST = "bye".$i;
$elePOST = "ele".$i;
$wID[$i] = $_POST[$wIDPOST];
$wName[$i] = $_POST[$wNamePOST];
$cName[$i] = $_POST[$cNamePOST];
$cpCode[$i] = $_POST[$cpCodePOST];
$def[$i] = $_POST[$defPOST];
$bye[$i] = $_POST[$byePOST];
$ele[$i] = $_POST[$elePOST];
}
$notes = $_POST['NOT'];
$date = date('Y.m.d', time());

/* Recalculate totals based on new data structure and check they're correct, otherwise return */
/* New figures based on cpCode field in scrape table */
for($i=0;$i<count($wID);$i++) {
 if($pCode[$i] == "DUP") { $dup++; }
 if($pCode[$i] == "SF") { $sf++; }
 if($pCode[$i] == "UUP") { $uup++; }
 if(substr($pCode[$i],0,3) == "SDL") { $sdlp++; }
 if($pCode[$i] == "ALI") { $ali++; }
 if($pCode[$i] == "TUV") { $tuv++; }
 if($pCode[$i] == "GRN") { $grn++; }
 if($pCode[$i] == "PUP") { $pup++; }
 if($pCode[$i] == "IND") { $ind++; }
 if($pCode[$i] == "VAC") { $vac++; }
}

echo $councilNumber.". ".$councilName."<br>";
echo "UPDATING FULL COUNCIL DATA...";
echo "<table>";
for($i=0;$i<$realTotal;$i++) {
/* Update data to wards and wcouncillors */
 $queryStr = "
UPDATE wards w 
INNER JOIN wcouncillors c ON w.id = c.wardID 
SET c.name='{$cName[$i]}', c.partyCode='{$cpCode[$i]}', w.defending='{$def[$i]}', w.byelection='{$bye[$i]}', w.election='{$ele[$i]}' 
WHERE w.id = {$wID[$i]}";
$result = mysqli_query($mysqli, $queryStr);
}

/* Update totals to wcouncils */
$queryStr = "UPDATE wcouncils SET dup='{$dup}', sf='{$sf}', uup='{$uup}', sdlp='{$sdlp}', ali='{$ali}',  tuv='{$tuv}', grn='{$grn}', pup='{$pup}', other='{$ind}', vacant='{$vac}', notes='{$notes}', last='{$date}' WHERE wcouncils.id = $councilNumber";
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));

echo '<script>window.location.href = "niprocessing.php";</script>';

?>
