<?php
include("header.inc");

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

/* Get real total for council (for use in loop below) */
$queryStr = "SELECT id FROM wards WHERE councilID = ".$councilNumber." AND deleted = '0000-00-00'";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
while($row = $result->fetch_assoc()) {
$realTotal = $result->num_rows;
}

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
$date = date('Y.m.d', time());

/* Recalculate totals based on new data structure */
/* New figures based on cpCode field in scrape table, not just a count of scraped data */
for($i=0;$i<count($wID);$i++) {
 if($cpCode[$i] == "CON") { $con++; }
 if($cpCode[$i] == "LAB") { $lab++; }
 if($cpCode[$i] == "LD") { $ld++; }
 if($cpCode[$i] == "GRN") { $grn++; }
 if(substr($cpCode[$i],0,3) == "UKI") { $ukip++; }
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

echo "Reached end of counting";

/* Delete existing councillors (full council) */
$queryStr = "
UPDATE wcouncillors c 
SET c.deleted='{$date}'
WHERE FLOOR(c.wardID/1000) = $councilNumber AND c.deleted = '0000-00-00'";
$result = mysqli_query($mysqli, $queryStr);

echo "Reached deletion of existing councillors";

/* Get latest free ID */
$result = mysqli_query($mysqli,"SELECT MAX(id) AS newID FROM wcouncillors");
$row = mysqli_fetch_array($result);
$newID = $row["newID"]+1;
for($i=0;$i<$realTotal;$i++) {
$newID = $newID+$i;
/* Insert new councillors */
$queryStr = "
INSERT INTO wcouncillors
(id, name, partyCode, wardID, deleted)
VALUES ('{$newID}', '{$cName[$i]}', '{$cpCode[$i]}', '{$wID[$i]}', '0000-00-00');";
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));
/* Insert new ward data */
$queryStr = "
UPDATE wards w
SET w.name='{$wName[$i]}', w.defending='{$def[$i]}', w.byelection='{$bye[$i]}', w.election='{$ele[$i]}'
WHERE w.id = {$wID[$i]} AND w.deleted = '0000-00-00'";
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));
}

/* Update totals to wcouncils table */
$queryStr = "UPDATE wcouncils SET con='{$con}', lab='{$lab}', ld='{$ld}', grn='{$grn}', ukip='{$ukip}',  plaid='{$pc}', snp='{$snp}', dup='{$dup}', sf='{$sf}', uup='{$uup}', sdlp='{$sdlp}', ali='{$ali}', tuv='{$tuv}', pup='{$pup}', other='{$ind}', vacant='{$vac}', last='{$date}' WHERE wcouncils.id = ".pg_escape_string($councilNumber);
$result = mysqli_query($mysqli, $queryStr) or die(mysqli_error($mysqli));

if($councilNumber < 1000) { echo '<script>window.location.href = "processing.php";</script>'; } else { echo '<script>window.location.href = "niprocessing.php";</script>'; }

?>
