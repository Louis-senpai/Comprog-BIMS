<?php 
$name = $_POST['name'];

?>

<div hx-trigger="done" hx-get="/api/BackupDone.php" hx-swap="outerHTML" hx-target="this">
    <h3 class="mb-4 text-xl font-semibold dark:text-white"> <?php echo $name;?> Backup In Progress</h3>
    <div hx-post="/models/Backup.php?name=<?php echo $name;?>" hx-trigger="load" hx-swap="innerHTML" hx-target="this" hx-include>
</div>
    <div class="w-full p-1 mb-4 bg-gray-200 rounded-full dark:bg-gray-700" 
    hx-get="/api/BackupProgress.php?name=<?php echo $name;?>"
    hx-trigger="every 200ms"
    hx-target="this"
    hx-swap="innerHTML">

        <div class="progress-bar bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
            style="width: 0%"> 0%</div>
    </div>

</div>