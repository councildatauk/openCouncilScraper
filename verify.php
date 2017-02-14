<?php
session_start();
if($_POST['password'] = "dalek") {
  $_SESSION['logged']   = TRUE;
  header("Location: processing.php");
  exit;
} else { header("Location: log.php"); exit; }
?>
