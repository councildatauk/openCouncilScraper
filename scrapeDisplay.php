<?
/* Clean party names to tags */
for($i=0;$i<count($n);$i++) {
 if((substr($p[$i], 0, 5) != "Conwy") && (substr($p[$i], 0, 3) == "Con" or substr($p[$i], 0, 3) == "CON" or substr($p[$i], 0, 12) == "Scottish Con" or substr($p[$i], 0, 5) == "DGCon")) { $pCode[$i] = "CON"; }
 elseif(substr($p[$i], 0, 3) == "Lab" or substr($p[$i], 0, 3) == "LAB" or substr($p[$i], 0, 4) == "SLab" or substr($p[$i], 0, 12) == "Scottish Lab" or substr($p[$i], 0, 9) == "Welsh Lab") { $pCode[$i] = "LAB"; }
 elseif(!(substr($p[$i],0,9) == "Liberal P") && !($p[$i] == "Liberal") && (substr($p[$i], 0, 3) == "Lib" or substr($p[$i], 0, 3) == "LIB" or substr($p[$i], 0, 2) == "LD" or substr($p[$i], 0, 12) == "Scottish Lib" or substr($p[$i], 0, 9) == "Welsh Lib")) { $pCode[$i] = "LD"; }
 elseif(substr($p[$i], 0, 3) == "Gre" or substr($p[$i], 0, 3) == "GRE" or substr($p[$i], 0, 12) == "Scottish Gre") { $pCode[$i] = "GRN"; }
 elseif(substr($p[$i], 0, 3) == "UKI" or substr($p[$i], 0, 3) == "UK " or substr($p[$i], 0, 3) == "U.K" or substr($p[$i], 0, 10) == "United Kin"or substr($p[$i], 0, 3) == "U K") { $pCode[$i] = "UKIP"; }
 elseif(substr($p[$i], 0, 3) == "Vac" or substr($n[$i], 0, 3) == "Vac" or substr($n[$i], 0, 21) == "No elected Councillor") {$pCode[$i] = "VAC"; }
 elseif(substr($p[$i], 0, 3) == "Pla" or substr($p[$i], 0, 10) == "PartyofWal" or substr($p[$i], 0, 12) == "The Party of" or substr($p[$i], 0, 14) == "Party of Wales") {$pCode[$i] = "PC"; }
 elseif(substr($p[$i], 0, 12) == "Scottish Nat" or substr($p[$i], 0, 3) == "SNP") {$pCode[$i] = "SNP"; }
 elseif(substr($p[$i], 0, 4) == "SDLP" or substr($p[$i], 0, 6) == "Social") { $pCode[$i] = "SDLP"; }
 elseif(substr($p[$i], 0, 4) == "Sinn" or substr($p[$i], 0, 2) == "SF") { $pCode[$i] = "SF"; }
 elseif(substr($p[$i],0,3) == "DUP" or substr($p[$i],0,19) == "Democratic Unionist") { $pCode[$i] = "DUP"; }
 elseif(substr($p[$i], 0, 3) == "UUP" or substr($p[$i], 0, 15) == "Ulster Unionist") { $pCode[$i] = "UUP"; }
 elseif(substr($p[$i], 0, 3) == "All"or substr($p[$i], 0, 4) == "APNI") { $pCode[$i] = "ALI"; }
 elseif(substr($p[$i], 0, 3) == "TUV" or substr($p[$i], 0, 20) == "Traditional Unionist") { $pCode[$i] = "TUV"; }
 elseif(substr($p[$i], 0, 3) == "PUP" or substr($p[$i], 0, 20) == "Progressive Unionist") { $pCode[$i] = "PUP"; }
 else { $pCode[$i] = "IND"; }
}

/* COUNTING */
for($i=0;$i<count($n);$i++) {
 if($pCode[$i] == "CON") { $con++; }
 if($pCode[$i] == "LAB") { $lab++; }
 if($pCode[$i] == "LD") { $ld++; }
 if($pCode[$i] == "GRN") { $grn++; }
 if($pCode[$i] == "UKIP") { $ukip++; }
 if($pCode[$i] == "PC") { $pc++; }
 if($pCode[$i] == "SNP") { $snp++; }
 if($pCode[$i] == "IND") { $ind++; }
 if($pCode[$i] == "VAC") { $vac++; }
 if($pCode[$i] == "DUP") { $dup++; }
 if($pCode[$i] == "SF") { $sf++; }
 if($pCode[$i] == "UUP") { $uup++; }
 if($pCode[$i] == "SDLP") { $sdlp++; }
 if($pCode[$i] == "ALI") { $ali++; }
 if($pCode[$i] == "TUV") { $tuv++; }
 if($pCode[$i] == "PUP") { $pup++; }
}

/* Export results as session data, in preparation for sending to insert.php */
$_SESSION['n'] = $n;
$_SESSION['p'] = $p;
$_SESSION['pCode'] = $pCode;
$_SESSION['w'] = $w;
$_SESSION['councilNumber'] = $councilNumber;
$_SESSION['councilName'] = $councilName;
$_SESSION['a'] = $autoFlag;
$_SESSION['con'] = $con;
$_SESSION['lab'] = $lab;
$_SESSION['ld'] = $ld;
$_SESSION['grn'] = $grn;
$_SESSION['ukip'] = $ukip;
$_SESSION['pc'] = $pc;
$_SESSION['snp'] = $snp;
$_SESSION['ind'] = $ind;
$_SESSION['vac'] = $vac;
$_SESSION['dup'] = $dup;
$_SESSION['sf'] = $sf;
$_SESSION['uup'] = $uup;
$_SESSION['sdlp'] = $sdlp;
$_SESSION['ali'] = $ali;
$_SESSION['tuv'] = $tuv;
$_SESSION['pup'] = $pup;
if($councilNumber < 1000) { $_SESSION['total'] = $con+$lab+$ld+$grn+$ukip+$pc+$snp+$ind+$vac; } else { $_SESSION['total'] = $dup+$sf+$uup+$sdlp+$ali+$ali+$tuv+$pup+$ind+$vac; }

/* DEBUG echo $councilNumber; var_dump($n);echo"<br>"; var_dump($p);echo"<br>"; var_dump($w);echo"<br>"; */

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

/* Totals table (left column = existing database, editable column (editing does nothing) = scraped totals) */
$queryStr = "SELECT name, total, con, lab, ld, grn, ukip, plaid, snp, other, vacant, url, notes FROM wcouncils WHERE id = " . $councilNumber;
/* Overwrite with alternative query for NI councils */
if($councilNumber > 1000) {$queryStr = "SELECT name, total, dup, sf, uup, sdlp, ali, tuv, grn, pup, other, vacant, url, notes FROM wcouncils WHERE id = " . $councilNumber;}
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

echo '<table>';
while($row = $result->fetch_assoc()) {
    /* Grab notes for later */
$notes = $row['notes'];
    /* (Check totals are correct) GB */
if($councilNumber < 1000) {
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
} else { /* Check totals are correct - NI */
if($dup+$sf+$uup+$sdlp+$ali+$tuv+$grn+$pup+$ind+$vac == $row['total']) { $tC = 1; $check = '<p style="color: #000000; background-color:88ff88;">Total OK</p> '; } else { $tC = 0; $check = "Total Check NG"; }
if($dup == $row['dup']) {$dC = 1; $dupCh = '<p style="background-color:88ff88;">OK</p>';} else {$dC = 0; $dupCh = '<p style="background-color:ff8888;">NG</p>';}
if($sf == $row['sf']) {$fC = 1; $sfCh = '<p style="background-color:88ff88;">OK</p>';} else {$fC = 0; $sfCh = '<p style="background-color:ff8888;">NG</p>';}
if($uup == $row['uup']) {$uC = 1; $uupCh = '<p style="background-color:88ff88;">OK</p>';} else {$uC = 0; $uupCh = '<p style="background-color:ff8888;">NG</p>';}
if($sdlp == $row['sdlp']) {$sC = 1; $sdlpCh = '<p style="background-color:88ff88;">OK</p>';} else {$sC = 0; $sdlpCh = '<p style="background-color:ff8888;">NG</p>';}
if($ali == $row['ali']) {$aC = 1; $aliCh = '<p style="background-color:88ff88;">OK</p>';} else {$aC = 0; $aliCh = '<p style="background-color:ff8888;">NG</p>';}
if($tuv == $row['tuv']) {$tC = 1; $tuvCh = '<p style="background-color:88ff88;">OK</p>';} else {$tC = 0; $tuvCh = '<p style="background-color:ff8888;">NG</p>';}
if($grn == $row['grn']) {$gC = 1; $grnCh = '<p style="background-color:88ff88;">OK</p>';} else {$gC = 0; $grnCh = '<p style="background-color:ff8888;">NG</p>';}
if($pup == $row['pup']) {$pC = 1; $pupCh = '<p style="background-color:88ff88;">OK</p>';} else {$pC = 0; $pupCh = '<p style="background-color:ff8888;">NG</p>';}
if($ind == $row['other']) {$iC = 1; $indCh = '<p style="background-color:88ff88;">OK</p>';} else {$iC = 0; $indCh = '<p style="background-color:ff8888;">NG</p>';}
if($vac == $row['vacant']) {$vC = 1; $vacCh = '<p style="background-color:88ff88;">OK</p>';} else {$vC = 0; $vacCh = '<p style="background-color:ff8888;">NG</p>';}
    /* (Draw table) */
echo '<tr class="ni-ass-second"><td class="ni-ass-second">' . $row['total'] . '</td><td>'.$check.'<label for="name">TOT</label><input type="text" name="TOT" id="TOT" value="'.$row['total'].'"></td></tr>';
echo '<tr><td class="dup">' . $row['dup'] . '</td><td><label for="name">DUP</label><input type="text" name="DUP" id="DUP" value="'.$dup.'"></td><td>'.$dupCh.'</td></tr>';
echo '<tr><td class="sf">' . $row['sf'] . '</td><td><label for="name">SF</label><input type="text" name="SF" id="SF" value="'.$sf.'"></td><td>'.$sfCh.'</td></tr>';
echo '<tr><td class="uup">' . $row['uup'] . '</td><td><label for="name">UUP</label><input type="text" name="UUP" id="UUP" value="'.$uup.'"></td><td>'.$uupCh.'</td></tr>';
echo '<tr><td class="sdlp">' . $row['sdlp'] . '</td><td><label for="name">SDLP</label><input type="text" name="SDLP" id="SDLP" value="'.$sdlp.'"></td><td>'.$sdlpCh.'</td></tr>';
echo '<tr><td class="ali">' . $row['ali'] . '</td><td><label for="name">ALI</label><input type="text" name="ALI" id="ALI" value="'.$ali.'"></td><td>'.$aliCh.'</td></tr>';
echo '<tr><td class="tuv">' . $row['tuv'] . '</td><td><label for="name">TUV</label><input type="text" name="TUV" id="TUV" value="'.$tuv.'"></td><td>'.$tuvCh.'</td></tr>';
echo '<tr><td class="green-main">' . $row['grn'] . '</td><td><label for="name">GRN</label><input type="text" name="GRN" id="GRN" value="'.$grn.'"></td><td>'.$grnCh.'</td></tr>';
echo '<tr><td class="pup">' . $row['pup'] . '</td><td><label for="name">PUP</label><input type="text" name="PUP" id="PUP" value="'.$pup.'"></td><td>'.$pupCh.'</td></tr>';
echo '<tr><td class="ni-ass-second">' . $row['other'] . '</td><td><label for="name">IND</label><input type="text" name="IND" id="IND" value="'.$ind.'"></td><td>'.$indCh.'</td></tr>';
echo '<tr><td class="ni-ass-second">' . $row['vacant'] . '</td><td><label for="name">VAC</label><input type="text" name="VAC" id="VAC" value="'.$vac.'"></td><td>'.$vacCh.'</td></tr>';
echo '<tr><td class="ni-ass-second">' . $row['notes'] . '</td><td><label for="notes">NOT</label><input type="text" name="NOT" id="NOT" value="'.$row['notes'].'"></td></tr>';
echo '</table>';
} /* End bracket for NI totals check */
} /* End bracket for if(not NI) then else */

/* Pre-populate data structure with existing data: */
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

/* Take each scraped result */
for($i=0;$i<count($wID);$i++) {
 /* Check if the name matches an existing name */
 for($j=0;$j<count($cID);$j++) {
   if(stripslashes($n[$i]) == htmlentities(stripslashes($cName[$j]))) { /* echo $i.": ".$wA[7][$j]." matches to scraped ".$n[$i]."<br>"; */
    /* Finish building new data structure:
      $cName,$wID,$wName,$bye,$ele,$def,$wDel,$cID,$cParty,$cpCode,$cDel and $n,$pCode,$p,$w */
    $wA[11][$j] = $n[$i]; 
    $wA[12][$j] = $pCode[$i]; 
    $wA[13][$j] = $p[$i]; 
    $wA[14][$j] = $w[$i]; 
  }
    /* If existing is Vacant, fill with vacant 
   if($wA[7][$i] == "Vacancy" or $wA[7][$i] == "zzz") { $wA[11][$i] = "Vacancy"; }
   if($wA[9][$i] == "VAC") { $wA[12][$i] = "VAC"; }*/
 }
}

/* Check for correct scraped total */
if(sizeof($cName) != sizeof($n)) {
 echo 'EXPECTING '.sizeof($cName).', RECIEVED '.sizeof($n);
}

/* Draw table. nowVacant button sends cID, wID, sets cDel to 1, creates new cID as VAC with wardID = wID */
echo '<br><form method="POST" action="insert.php"><table border=1 class="sortable"><tr><td>wWard ID</td><td>wWard</td><td>wsName</td><td>wsCode</td><td>wDefending</td><td>wByelection</td><td>wElection</td></tr>';
/* Set change var to 0, if there are any blues (use of existing data due to no match) or reds (change of party), it'll get set to 1 */
$change = 0;
for($i=0;$i<count($wID);$i++) {
/* Check for non-matches and fill with existing */
 if($wA[11][$i] == "") { echo "missing: ".$n[$i]." # "; $wA[11][$i] = $wA[7][$i]; $wA[12][$i] = $wA[9][$i]; $usedExisting = ' style="background-color:#3333dd;"'; $change = 1; } else { $usedExisting = ''; }
/* Check for party changes or potential errors */
 if($wA[9][$i] == substr($wA[12][$i],0,3)) { $partyOK = ' style="background-color:#33dd33;"'; } else { $partyOK = ' style="background-color:#dd3333;"'; $change = 1; }
  echo '<tr>
<td '.$usedExisting.'><input type="text" name="wID'.$i.'" value="'.$wA[0][$i].'"></td>
<td><input type="text" name="wName'.$i.'" value="'.$wA[1][$i].'"></td>
<td>'.$wA[7][$i].' ('.$wA[6][$i].')<input type="text" name="cName'.$i.'" value="'.$wA[11][$i].'"></td>
<td'.$partyOK.'>'.$wA[9][$i].'<input type="text" name="cpCode'.$i.'" value="'.$wA[12][$i].'"></td>
<td><input type="text" name="def'.$i.'" value="'.$wA[4][$i].'" id="defectionTo'.$i.'"></td>
<td><input type="text" name="bye'.$i.'" value="'.$wA[2][$i].'"></td>
<td><input type="text" name="ele'.$i.'" value="'.$wA[3][$i].'"></td>
<td><input type="button" name="nowVacant'.$i.'" value="Now Vacant" onclick="window.location.href=\'nowVacant.php?wID='.$wA[0][$i].'&cID='.$wA[6][$i].'&def='.$wA[9][$i].'\';"></td>
<td><input type="button" name="defection'.$i.'" value="Defection" onclick="newParty=document.getElementById(\'defectionTo'.$i.'\').value; window.location.href=\'defection.php?wID='.$wA[0][$i].'&cID='.$wA[6][$i].'&to=\'+newParty+\'&name='.$wA[11][$i].'\';"></td>
</tr>';
}
echo '<tr><td colspan=8><label for="notes">NOT</label><input style="width:100%;" type="text" name="NOT" id="NOT" value="'.$notes.'"></td></tr>';
echo '<tr><td><input type="submit" value="Submit" id="submit"></td></tr></table></form>';

/* Draw raw scrape table */
echo '<table>';
for($i=0;$i<count($n);$i++) {
echo '<tr><td>'.$w[$i].'</td><td>'.$n[$i].'</td><td>'.$pCode[$i].'</td><td>'.$p[$i].'</td></tr>';
}
echo '</table>';

/* If no changes, save new date and move on */
$newCouncil = $councilNumber + 1;
if($autoFlag == "1" && $change == 0) { echo 'SAVING...<script>window.location.href = "insert.php";</script>'; }
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
