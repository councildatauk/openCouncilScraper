<?php
session_start();
if(!$_SESSION['logged']) { header("Location: log.php"); exit; }
ini_set('display_errors',1);
error_reporting(E_ALL);

/* Connect to database */
$mysqli = new mysqli('10.16.16.4','counc-ky7-u-098739','petaztau','counc-ky7-u-098739');
if($mysqli->connect_errno) { echo "Conn Err"; exit; }

/* Set council number, retrieve council name and URL */
$councilNumber = $_GET['c'];
$autoFlag = $_GET['a'];
$queryStr = "SELECT name, url FROM wcouncils WHERE id = '$councilNumber'";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
$councilDataArray = $result->fetch_assoc();
$councilName = $councilDataArray['name'];
$councilURL = $councilDataArray['url'];

echo '<html><head><meta charset="utf-8" /><link rel="stylesheet" href="ukpol.css"></head><body>';
echo $councilNumber.'. <a href="'.$councilURL.'">'.$councilName.'</a><br>';

/* Setup standard arrays */
$n = array();
$p = array();
$pCode = array();
$w = array();
$con = 0;
$lab = 0;
$ld = 0;
$grn = 0;
$ukip = 0;
$pc = 0;
$snp = 0;
$ind = 0;
$vac = 0;

/* Export results as session data */
$_SESSION['councilNumber'] = $councilNumber;
$_SESSION['councilName'] = $councilName;
$_SESSION['a'] = $autoFlag;
/* Query existing data from ward and wcouncillors tables */
$queryStr = "SELECT w.id as wID, w.councilID, w.name as wName, w.byelection, w.election, w.defending, w.deleted as wDel, c.id as cID, c.name as cName, c.party, c.partyCode, c.wardID, c.deleted as cDel FROM wards w INNER JOIN wcouncillors c ON w.id = c.wardID WHERE w.councilID = " . $councilNumber . " AND c.deleted = '0000-00-00' AND w.deleted = '0000-00-00' ORDER BY w.id";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

while($row = $result->fetch_assoc()) {
/* Get existing data from ward and wcouncillor tables */
$wID[] = $row['wID'];
$wName[] = $row['wName'];
$bye[] = $row['byelection'];
$ele[] = $row['election'];
$def[] = $row['defending'];
$wDel[] = $row['wDel'];
$cID[] = $row['cID'];
$cName[] = $row['cName'];
$cParty[] = $row['party'];
$cpCode[] = $row['partyCode'];
$cDel[] = $row['cDel'];
}

/* Totals table shown for error checking only. Totals table updated in insertNew based on sum of councillors received */
$queryStr = "SELECT name, total, con, lab, ld, grn, ukip, plaid, snp, other, vacant, url, notes FROM wcouncils WHERE id = " . $councilNumber;
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }
echo '<table>';
while($row = $result->fetch_assoc()) {
    /* Grab notes for later */
$notes = $row['notes'];
    /* (Check totals are correct) */
if($con+$lab+$ld+$grn+$ukip+$pc+$snp+$ind+$vac == $row['total']) { $tC = 1; $check = '<p style="color: #000000; background-color:88ff88;">Total OK</p> '; } else { $tC = 0; $check = "Total Check NG"; }
if($con == $row['con']) {$cC = 1; $conCh = '<p style="background-color:88ff88;">OK</p>';} else {$cC = 0; $conCh = '<p style="background-color:ff8888;">NG</p>';}
if($lab == $row['lab']) {$lC = 1; $labCh = '<p style="background-color:88ff88;">OK</p>';} else {$lC = 0; $labCh = '<p style="background-color:ff8888;">NG</p>';}
if($ld == $row['ld']) {$dC = 1; $ldCh = '<p style="background-color:88ff88;">OK</p>';} else {$dC = 0; $ldCh = '<p style="background-color:ff8888;">NG</p>';}
if($grn == $row['grn']) {$gC = 1; $grnCh = '<p style="background-color:88ff88;">OK</p>';} else {$gC = 0; $grnCh = '<p style="background-color:ff8888;">NG</p>';}
if($ukip == $row['ukip']) {$uC = 1; $ukipCh = '<p style="background-color:88ff88;">OK</p>';} else {$uC = 0; $ukipCh = '<p style="background-color:ff8888;">NG</p>';}
if($pc == $row['plaid']) {$pC = 1; $pcCh = '<p style="background-color:88ff88;">OK</p>';} else {$pC = 0; $pcCh = '<p style="background-color:ff8888;">NG</p>';}
if($snp == $row['snp']) {$sC = 1; $snpCh = '<p style="background-color:88ff88;">OK</p>';} else {$sC = 0; $snpCh = '<p style="background-color:ff8888;">NG</p>';}
if($ind == $row['other']) {$iC = 1; $indCh = '<p style="background-color:88ff88;">OK</p>';} else {$iC = 0; $indCh = '<p style="background-color:ff8888;">NG</p>';}
if($vac == $row['vacant']) {$vC = 1; $vacCh = '<p style="background-color:88ff88;">OK</p>';} else {$vC = 0; $vacCh = '<p style="background-color:ff8888;">NG</p>';}
    /* (Draw table) */
echo '<tr class="ni-ass-second"><td class="ni-ass-second">' . $row['total'] . '</td><td>'.$check.$row['total'].'</td></tr>';
echo '<tr><td class="conservative-main">' . $row['con'] . '</td><td>'.$con.'</td><td>'.$conCh.'</td></tr>';
echo '<tr><td class="labour-main">' . $row['lab'] . '</td><td>'.$lab.'</td><td>'.$labCh.'</td></tr>';
echo '<tr><td class="libdem-main">' . $row['ld'] . '</td><td>'.$ld.'</td><td>'.$ldCh.'</td></tr>';
echo '<tr><td class="green-main">' . $row['grn'] . '</td><td>'.$grn.'</td><td>'.$grnCh.'</td></tr>';
echo '<tr><td class="ukip-second">' . $row['ukip'] . '</td><td>'.$ukip.'</td><td>'.$ukipCh.'</td></tr>';
echo '<tr><td class="plaid-main">' . $row['plaid'] . '</td><td>'.$pc.'</td><td>'.$pcCh.'</td></tr>';
echo '<tr><td class="snp-main">' . $row['snp'] . '</td><td>'.$snp.'</td><td>'.$snpCh.'</td></tr>';
echo '<tr><td class="ni-ass-second">' . $row['other'] . '</td><td>'.$ind.'</td><td>'.$indCh.'</td></tr>';
echo '<tr><td class="ni-ass-second">' . $row['vacant'] . '</td><td>'.$vac.'</td><td>'.$vacCh.'</td></tr>';
echo '<tr><td class="ni-ass-second" colspan=3>' . $row['notes'] . '</td></tr>';
echo '</table>';
}

/* Sort scraped data into same order as existing data 
array_multisort($cName,$wID,$wName,$bye,$ele,$def,$wDel,$cID,$cParty,$cpCode,$cDel);
array_multisort($n,$pCode,$p,$w);*/

/* New method for alloting scraped data into existing data table */
/* Pre-populate new data structure: */
for($i=0;$i<count($wID);$i++) {
   $wA[0][$i] = $wID[$i];
   $wA[1][$i] = $wName[$i];
   $wA[2][$i] = $bye[$i];
   $wA[3][$i] = $ele[$i];
   $wA[4][$i] = $def[$i];
   $wA[5][$i] = $wDel[$i];
   $wA[6][$i] = $cID[$i];
   $wA[7][$i] = $cName[$i];
   $wA[8][$i] = $cParty[$i];
   $wA[9][$i] = $cpCode[$i];
   $wA[10][$i] = $cDel[$i];
   $wA[11][$i] = "";
   $wA[12][$i] = "";
   $wA[13][$i] = "";
   $wA[14][$i] = "";
}

/* Draw table. nowVacant button sends cID, wID, sets cDel to 1, creates new cID as VAC with wardID = wID */
echo '<br><form method="POST" action="insert.php"><table border=1 class="sortable"><tr><td>wWard ID</td><td>wWard</td><td>wsName</td><td>wsCode</td><td>wDefending</td><td>wByelection</td><td>wElection</td></tr>';
for($i=0;$i<count($wID);$i++) {
/* Check for non-matches and fill with existing */
 if($wA[11][$i] == "") { $wA[11][$i] = $wA[7][$i]; $wA[12][$i] = $wA[9][$i]; $usedExisting = ' style="background-color:#3333dd;"'; } else { $usedExisting = ''; }
/* Check for missing rows */
 if($wA[9][$i] == substr($wA[12][$i],0,3)) { $partyOK = ' style="background-color:#33dd33;"'; } else { $partyOK = ' style="background-color:#dd3333;"'; }
  echo '<tr>
<td '.$usedExisting.'><input type="text" name="wID'.$i.'" value="'.$wA[0][$i].'"></td>
<td><input type="text" name="wName'.$i.'" value="'.$wA[1][$i].'"></td>
<td>'.$wA[7][$i].' ('.$wA[6][$i].')<input type="text" name="cName'.$i.'" value="'.$wA[11][$i].'"></td>
<td'.$partyOK.'>'.$wA[9][$i].'<input type="text" name="cpCode'.$i.'" value="'.$wA[12][$i].'"></td>
<td><input type="text" name="def'.$i.'" value="'.$wA[4][$i].'"></td>
<td><input type="text" name="bye'.$i.'" value="'.$wA[2][$i].'"></td>
<td><input type="text" name="ele'.$i.'" value="'.$wA[3][$i].'"></td>
<td><input type="button" name="nowVacant'.$i.'" value="Now Vacant" onclick="window.location.href=\'nowVacant.php?wID='.$wA[0][$i].'&cID='.$wA[6][$i].'&def='.$wA[9][$i].'\';"></td>
</tr>';
}
echo '<tr><td colspan=8><label for="notes">NOT</label><input style="width:100%;" type="text" name="NOT" id="NOT" value="'.$notes.'"></td></tr>';
echo '<tr><td><input type="submit" value="Submit" id="submit"></td></tr></table></form>';

/* Draw raw scrape table */
echo '<table>';
for($i=0;$i<count($n);$i++) {
echo '<tr><td>'.$w[$i].'</td><td>'.$n[$i].'</td><td>'.$pCode[$i].'</td></tr>';
}
echo '</table>';

/* If no changes, save new date and move on */
$newCouncil = $councilNumber + 1;
if($autoFlag == "1" && $cC == 1 && $lC == 1 && $dC == 1 && $gC == 1 && $uC == 1 && $pC == 1 && $sC == 1 && $iC == 1 && $vC == 1 && $tC == 1) { echo 'SAVING...<script>window.location.href = "insert.php";</script>'; }
/* If changes, don't save, and move on */
elseif($autoFlag == "1") {
 if(in_Array($newCouncil, $manualPages)) { $newCouncil++; }
 if(in_Array($newCouncil, $uniquePages)) { echo 'SKIPPING...<script>window.location.href = "crawlScrape.php?a=1&c='.$newCouncil.'";</script>'; }
 if(in_Array($newCouncil, $loopPages)) { echo 'SKIPPING...<script>window.location.href = "loopScrape.php?a=1&c='.$newCouncil.'";</script>'; }
 else { echo 'SKIPPING...<script>window.location.href = "normalScrape.php?a=1&c='.$newCouncil.'";</script>'; }
}

/* End */
echo "</table></body></html>";
?>
