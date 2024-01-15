<?php
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/tailwindcss.js"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="../js/alpine.min.js"></script>
    <script src="../js/htmx.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">


</head>
<?php 
$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);
?>