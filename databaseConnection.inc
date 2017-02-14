<?php
/* Connect to database */
$mysqli = new mysqli('IP','USER','PASS','USER');
if($mysqli->connect_errno) { echo "Conn Err"; exit; }
if (!mysqli_set_charset($mysqli, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($mysqli));
    exit();
}
?>
