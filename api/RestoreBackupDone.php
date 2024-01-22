<?php 
unset($_SESSION['backup_progress']);
?>

<div hx-trigger="done" hx-get="/api/RestoreBackupDone.php" hx-swap="outerHTML" hx-target="this">
    <h3 class="mb-4 text-xl font-semibold dark:text-white"> Restore is Finished</h3>

    <div class="w-full p-1 mb-4 bg-gray-200 rounded-full dark:bg-gray-700">

        <div class="progress-bar bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
            style="width: 100%"> 100%</div>
    </div>
  

</div>