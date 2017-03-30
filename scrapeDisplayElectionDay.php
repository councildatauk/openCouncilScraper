<?
/* Clean party names to tags to populate pCode array */
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

/* Export results as session data - ### Party totals here are no longer used ### These could be used to populate a new council after a May election as they come directly from the scrape. Current functionality is to provide a comparison between existing data and scraped data in a table, allow edits, then count party numbers based on the table content. In current form, ward names never get updated, even if you edit the field in the table. */
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

/* Draw raw scrape table with scraped and cleaned councillor name, party, party code, ward name */
echo '<table>';
for($i=0;$i<count($n);$i++) {
echo '<tr><td>'.$w[$i].'</td><td>'.$n[$i].'</td><td>'.$pCode[$i].'</td><td>'.$p[$i].'</td></tr>';
}
echo '</table>';

/* Query existing data from ward and wcouncillors tables */
$queryStr = "SELECT w.id as wID, w.councilID, w.name as wName, w.byelection, w.election, w.defending, w.deleted as wDel, c.id as cID, c.name as cName, c.party, c.partyCode, c.wardID, c.deleted as cDel FROM wards w INNER JOIN wcouncillors c ON w.id = c.wardID WHERE w.councilID = " . $councilNumber . " AND c.deleted = '0000-00-00' AND w.deleted = '0000-00-00' ORDER BY w.id";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

while($row = $result->fetch_assoc()) {
/* Extract into arrays */
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

/*  ###  Start of main table  ###  */
/* Pre-populate data structure with existing data: */
for($i=0;$i<count($wID);$i++) {
   $wA[0][$i] = $wID[$i];	/* ward ID */
   $wA[1][$i] = $wName[$i];	/* ward name */
   $wA[2][$i] = $bye[$i];	/* byelection date */
   $wA[3][$i] = $ele[$i];	/* next election date */
   $wA[4][$i] = $def[$i];	/* defending party in byelection */
   $wA[5][$i] = $wDel[$i];	/* ward deleted flag (0 for current, 1 for deleted) */
   $wA[6][$i] = $cID[$i];	/* councillor ID */
   $wA[7][$i] = $cName[$i];	/* councillor name */
   $wA[8][$i] = $cParty[$i];	/* party */
   $wA[9][$i] = $cpCode[$i];	/* 3 letter party code */
   $wA[10][$i] = $cDel[$i];	/* councillor deleted flag (0 for current, 1 for deleted) */
   $wA[11][$i] = $n[$i];		/* scraped councillor name */
   $wA[12][$i] = $pCode[$i];		/* scraped 3 letter party code */
   $wA[13][$i] = $p[$i];		/* scraped party */
   $wA[14][$i] = $w[$i];		/* scraped ward name */
}

/* Draw table. nowVacant button sends cID, wID, sets cDel to 1, creates new cID as VAC with wardID = wID */
echo '<br><form method="POST" action="insertElectionDay.php"><table border=1 class="sortable"><tr><td>wWard ID</td><td>wWard</td><td>wsName</td><td>wsCode</td><td>wDefending</td><td>wByelection</td><td>wElection</td></tr>';
?>
<tr><td><input type="text" name="newDate" value=""><input type="button" name="copy" value="Copy to All" onclick="copyNewElectionDate(this.form);" ></td></tr>
<?php
for($i=0;$i<count($wID);$i++) {
  echo '<tr>
<td><input type="text" name="wID'.$i.'" value="'.$wA[0][$i].'"></td>
<td><input type="text" name="wName'.$i.'" value="'.$wA[1][$i].'"></td>
<td>'.$wA[7][$i].' ('.$wA[6][$i].')<input type="text" name="cName'.$i.'" value="'.$wA[11][$i].'"></td>
<td>'.$wA[9][$i].'<input type="text" name="cpCode'.$i.'" value="'.$wA[12][$i].'"></td>
<td><input type="text" name="def'.$i.'" value="'.$wA[4][$i].'" id="defectionTo'.$i.'"></td>
<td><input type="text" name="bye'.$i.'" value="'.$wA[2][$i].'"></td>
<td><input type="text" name="ele'.$i.'" value="'.$wA[3][$i].'"></td>
</tr>';
}
echo '<tr><td><input type="submit" value="Submit" id="submit"></td></tr></table></form>';

/* End */
echo "</table></body></html>";
?>
