<?php
session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";
require_once "../models/userActivityLogs.php";
require_once "../models/accounts.php";
require_once "../models/survey.php";

if(!isset($_SESSION['logged_in'])){
    $_SESSION['error_message'] = "You must be logged in to view this page!";
    header("Location:../index.php");
    exit();
}

$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);

$logs = new UserActivityLogs($conn);
?>
<!DOCTYPE html>
<html lang="en" class="dark">

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
<!--  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://flowbite-admin-dashboard.vercel.app//app.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css">
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>



</head>
