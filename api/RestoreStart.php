<?php 
session_start();
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../models/RestoreModel.php';
require_once '../models/userActivityLogs.php';

$name = $_GET['file'];

?>

<div hx-trigger="done" hx-get="/api/RestoreBackupDone.php" hx-swap="outerHTML" hx-target="this">
    <h3 class="mb-4 text-xl font-semibold dark:text-white"> <?php echo $name;?> Restore In Progress</h3>
    <div hx-post="/api/RestoreBackup.php?name=<?php echo $name;?>" hx-trigger="load" hx-swap="innerHTML" hx-target="this" hx-include> </div>
</div>
    <div class="w-full p-1 mb-4 bg-gray-200 rounded-full dark:bg-gray-700" 
    hx-get="/api/restoreBackupProgress.php"
    hx-trigger="every 100ms"
    hx-target="this"
    hx-swap="innerHTML">

    </div>

</div>