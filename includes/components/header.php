<?php
session_start();
require_once "../config.php";

if(!isset($_SESSION['logged_in'])){
    $_SESSION['error_message'] = "You must be logged in to view this page!";
    header("Location:../index.php");
    exit();
}

$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);


?>
<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>BIMS | <?php echo $filename;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/tailwindcss.js"></script>
    <link rel="canonical" href="https://flowbite-admin-dashboard.vercel.app/">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="../js/alpine.min.js"></script>
    <script src="../js/htmx.min.js"></script>
    <script src="../js/tailwind.config.js" > </script>
  
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" /> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://flowbite-admin-dashboard.vercel.app//app.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css">
    <script>
   
</script>


</head>
