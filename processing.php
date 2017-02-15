<?php
include("header.inc");

/* Get GB data */
$queryStr = "SELECT id, name, total, con, lab, ld, grn, ukip, plaid, snp, other, vacant, last, notes, url FROM wcouncils WHERE id < 1000 ORDER BY id";
if(!$result = $mysqli->query($queryStr)) { echo "Query Err"; exit; }
if($result->num_rows === 0) { echo "No matched rows"; exit; }

$check = "";

/* Draw table */
echo '<a href="majorityUpdater.php">Majority Checker</a><br>';
echo '<table class="sortable" style="width: 100%;">';
echo '<tr class="scottish-gov-second"><td>Name</td><td>Scrape</td><td>Total</td><td>CON</td><td>LAB</td><td>LD</td><td>GRN</td><td>UKIP</td><td>PC</td><td>SNP</td><td>IND/OTH</td><td>Vacant</td><td>Last Updated</td><td>Notes</td></tr>';

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
if($row['total'] != $row['con']+$row['lab']+$row['ld']+$row['grn']+$row['ukip']+$row['plaid']+$row['snp']+$row['other']+$row['vacant']) { $check = "*"; } 
echo '<td class="ni-ass-second" style="width: 10%;">' . $check . $row['total'] . $check . '</td>';
/* Party columns */
echo '<td class="conservative-main" style="width: 10%;">' . $row['con'] . '</td>';
echo '<td class="labour-main" style="width: 10%;">' . $row['lab'] . '</td>';
echo '<td class="libdem-main" style="width: 10%;">' . $row['ld'] . '</td>';
echo '<td class="green-main" style="width: 10%;">' . $row['grn'] . '</td>';
echo '<td class="ukip-second" style="width: 10%;">' . $row['ukip'] . '</td>';
echo '<td class="plaid-main" style="width: 10%;">' . $row['plaid'] . '</td>';
echo '<td class="snp-main" style="width: 10%;">' . $row['snp'] . '</td>';
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
