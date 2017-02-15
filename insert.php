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
$councilNumber = $_SESSION['councilNumber'];
$councilName = $_SESSION['councilName'];
$autoFlag = $_SESSION['a'];
$con = 0;
$lab = 0;
$ld = 0;
$grn = 0;
$ukip = 0;
$pc = 0;
$snp = 0;
$dup = 0;
$sf = 0;
$uup = 0;
$sdlp = 0;
$ali = 0;
$tuv = 0;
$pup = 0;
$ind = 0;
$vac = 0;
$total = 0;

/* Ensure names can be unicode */
for($i=0;$i<count($n[$i]);$i++) { $n[$i] = htmlentities($n[$i]); }

/* Get real total for council */
$queryStr = "SELECT id FROM wards WHERE councilID = ".$councilNumber;
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
while($row = $result->fetch_assoc()) {
$realTotal = $result->num_rows;
}

if(isset($_POST['wName0'])) {     /* i.e. if the form was submitted on the last page, run this loop (end of loop ~line 105) */
/* Move post data into arrays (first need to generate post names in format cName1, cName2, etc.) */
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
$notes = addslashes($_POST['NOT']);
$date = date('Y.m.d', time());

/* Recalculate totals based on new data structure and check they're correct, otherwise return */
/* New figures based on cpCode field in scrape table */
for($i=0;$i<count($wID);$i++) {
 if($cpCode[$i] == "CON") { $con++; }
 if($cpCode[$i] == "LAB") { $lab++; }
 if($cpCode[$i] == "LD") { $ld++; }
 if($cpCode[$i] == "GRN") { $grn++; }
 if(substr($cpCode[$i],0,3) == "UKI") { $ukip++; } /* Just first 3 because some fields were/are limited to 3 chars */
 if($cpCode[$i] == "PC") { $pc++; }
 if($cpCode[$i] == "SNP") { $snp++; }
 if($cpCode[$i] == "DUP") { $dup++; }
 if($cpCode[$i] == "SF") { $sf++; }
 if($cpCode[$i] == "UUP") { $uup++; }
 if(substr($cpCode[$i],0,3) == "SDL") { $sdlp++; }
 if($cpCode[$i] == "ALI") { $ali++; }
 if($cpCode[$i] == "TUV") { $tuv++; }
 if($cpCode[$i] == "PUP") { $pup++; }
 if($cpCode[$i] == "IND") { $ind++; }
 if($cpCode[$i] == "VAC") { $vac++; }
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
$queryStr = "UPDATE wcouncils SET con='{$con}', lab='{$lab}', ld='{$ld}', grn='{$grn}', ukip='{$ukip}',  plaid='{$pc}', snp='{$snp}', dup='{$dup}', sf='{$sf}', uup='{$uup}', sdlp='{$sdlp}', ali='{$ali}', tuv='{$tuv}', pup='{$pup}', other='{$ind}', vacant='{$vac}', notes='{$notes}', last='{$date}' WHERE wcouncils.id = ".pg_escape_string($councilNumber);
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));
}

/* Else insert new date only (triggered in auto mode (a=1)) */
else {
echo "UPDATING LAST CHECKED DATE...";
$date = date('Y.m.d', time());
$queryStr = "UPDATE wcouncils SET last='{$date}' WHERE wcouncils.id = ".pg_escape_string($councilNumber);
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));
}

/* Check for end of list */
if($autoFlag == "1" && $councilNumber == "406") { echo '<script>window.location.href = "processing.php";</script>'; }

/* If in auto mode, move to next (skipping manual pages), if in a=0 return to processing */
$manual = array (81,106,131,170,173,270);
if($autoFlag == "1") {
 $newCouncil = $councilNumber + 1;
 if(in_Array($newCouncil, $manual)) { $newCouncil++; }
 echo 'SKIPPING...<script>window.location.href = "scrape.php?a=1&c='.$newCouncil.'";</script>'; }
else { 
 if($councilNumber < 1000) { echo '<script>window.location.href = "processing.php";</script>'; } else { echo '<script>window.location.href = "niprocessing.php";</script>'; }
}

?>
