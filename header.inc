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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <meta http-equiv="Content-Language" content="en" />
<link rel="stylesheet" href="ukpol.css">
<script src="sorttable.js"></script>
</head>
<body>
';
?>
