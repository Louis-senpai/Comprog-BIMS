<?php
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en" class="dark">

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
    <link rel="stylesheet" href="https://flowbite-admin-dashboard.vercel.app//app.css">
    <script>
    
    // if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    //     document.documentElement.classList.add('dark');
    // } else {
    //     document.documentElement.classList.remove('dark')
    // }
</script>

</head>
<?php 
$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);
?>