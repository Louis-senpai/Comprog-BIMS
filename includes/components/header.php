<?php
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/tailwindcss.js"></script>
    <link rel="canonical" href="https://flowbite-admin-dashboard.vercel.app/">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="../js/alpine.min.js"></script>
    <script src="../js/htmx.min.js"></script>
    <script src="../js/tailwind.config.js" > </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" /> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://flowbite-admin-dashboard.vercel.app//app.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
   
</script>


</head>
<?php 
$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);
?>