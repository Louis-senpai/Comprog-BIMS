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

$surveyModel = new Survey($conn);
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <title>BIMS | <?php echo $filename;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/tailwindcss.js"></script>
    <link rel="canonical" href="https://flowbite-admin-dashboard.vercel.app/">
    <script src="../js/alpine.min.js"></script>
    <script src="../js/htmx.min.js"></script>
    <script src="../js/tailwind.config.js" > </script>
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
<style type="text/tailwindcss">

@layer components{
    .dt-button-collection {
   @apply p-4 rounded-lg h-full;
    }
    .dtb-popover-close{
        @apply inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300;
    }
    .selected{
        @apply bg-blue-400 dark:bg-blue-500 duration-500 ease-in-out;
    }
    .apexcharts-legend-text{
        @apply dark:text-gray-300;
    }
}
@layer base {
  :root {
    --text-50: #eae9fc;
    --text-100: #d4d2f9;
    --text-200: #a9a5f3;
    --text-300: #7e78ed;
    --text-400: #534be7;
    --text-500: #281fe0;
    --text-600: #2018b4;
    --text-700: #181287;
    --text-800: #100c5a;
    --text-900: #08062d;
    --text-950: #040316;
    
    --background-50: #ebebfa;
    --background-100: #d6d6f5;
    --background-200: #adadeb;
    --background-300: #8585e0;
    --background-400: #5c5cd6;
    --background-500: #3333cc;
    --background-600: #2929a3;
    --background-700: #1f1f7a;
    --background-800: #141452;
    --background-900: #0a0a29;
    --background-950: #050514;
    
    --primary-50: #eaeafb;
    --primary-100: #d6d4f7;
    --primary-200: #ada9ef;
    --primary-300: #847ee7;
    --primary-400: #5b54de;
    --primary-500: #3129d6;
    --primary-600: #2821ab;
    --primary-700: #1e1881;
    --primary-800: #141056;
    --primary-900: #0a082b;
    --primary-950: #050415;
    
    --secondary-50: #e7e5ff;
    --secondary-100: #cfccff;
    --secondary-200: #9e99ff;
    --secondary-300: #6e66ff;
    --secondary-400: #3d33ff;
    --secondary-500: #0d00ff;
    --secondary-600: #0a00cc;
    --secondary-700: #080099;
    --secondary-800: #050066;
    --secondary-900: #030033;
    --secondary-950: #01001a;
    
    --accent-50: #e6e5ff;
    --accent-100: #ceccff;
    --accent-200: #9c99ff;
    --accent-300: #6b66ff;
    --accent-400: #3a33ff;
    --accent-500: #0800ff;
    --accent-600: #0700cc;
    --accent-700: #050099;
    --accent-800: #030066;
    --accent-900: #020033;
    --accent-950: #01001a;
    
  }
  .dark {
    --text-50: #040316;
    --text-100: #08062d;
    --text-200: #100c5a;
    --text-300: #181287;
    --text-400: #2018b4;
    --text-500: #281fe0;
    --text-600: #534be7;
    --text-700: #7e78ed;
    --text-800: #a9a5f3;
    --text-900: #d4d2f9;
    --text-950: #eae9fc;
    
    --background-50: #050514;
    --background-100: #0a0a29;
    --background-200: #141452;
    --background-300: #1f1f7a;
    --background-400: #2929a3;
    --background-500: #3333cc;
    --background-600: #5c5cd6;
    --background-700: #8585e0;
    --background-800: #adadeb;
    --background-900: #d6d6f5;
    --background-950: #ebebfa;
    
    --primary-50: #050415;
    --primary-100: #0a082b;
    --primary-200: #141056;
    --primary-300: #1e1881;
    --primary-400: #2821ab;
    --primary-500: #3129d6;
    --primary-600: #5b54de;
    --primary-700: #847ee7;
    --primary-800: #ada9ef;
    --primary-900: #d6d4f7;
    --primary-950: #eaeafb;
    
    --secondary-50: #01001a;
    --secondary-100: #030033;
    --secondary-200: #050066;
    --secondary-300: #080099;
    --secondary-400: #0a00cc;
    --secondary-500: #0d00ff;
    --secondary-600: #3d33ff;
    --secondary-700: #6e66ff;
    --secondary-800: #9e99ff;
    --secondary-900: #cfccff;
    --secondary-950: #e7e5ff;
    
    --accent-50: #01001a;
    --accent-100: #020033;
    --accent-200: #030066;
    --accent-300: #050099;
    --accent-400: #0700cc;
    --accent-500: #0800ff;
    --accent-600: #3a33ff;
    --accent-700: #6b66ff;
    --accent-800: #9c99ff;
    --accent-900: #ceccff;
    --accent-950: #e6e5ff;
    
  }
}



                </style>



</head>
