<?php 
session_start();

// Assuming you store the progress in a session variable
if (isset($_SESSION['backup_progress'])) {
    $arra = array('progress' => $_SESSION['backup_progress']);
} else {
    $arra = array('progress' => 0);
}
    $name = $_GET['name'];
    
    ?>


</div>
<?php if ($arra['progress'] < 100) {?>
<div class="progress-bar bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none duration-600 rounded-full"
    style="width: <?php echo $arra['progress'];?>%"> <?php echo $arra['progress'];?>%</div>
<?php }if ($arra['progress'] == 100) {
header("Hx-Trigger: done");
    
}?>