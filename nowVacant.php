<?php
include("header.inc");

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
