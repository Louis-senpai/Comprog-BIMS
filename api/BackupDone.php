<?php session_start();
unset($_SESSION['backup_progress']);
?>

<div hx-trigger="done" hx-get="/api/BackupDone.php" hx-swap="outerHTML" hx-target="this">
    <h3 class="mb-4 text-xl font-semibold dark:text-white"> Backup is Finished</h3>

    <div class="w-full p-1 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">

        <div class="progress-bar bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
            style="width: 100%"> 100%</div>
    </div>
    <a href="Backups.php"
        class="text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        See All Backups</a>

</div>