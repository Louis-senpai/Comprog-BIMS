<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/userActivityLogs.php';
require_once '../models/officers.php';
$officer = new officers($conn);


$id = $_GET['id'];

if($result = $officer->deleteOfficer($id)){
    // if delete success full log it on the user activity log
    $userLog->logActivity($_SESSION['user_id'], "Deleted Officer with ID: ". $id);
    $_SESSION['success_message'] = "Officer Deleted Successfully! ID= ". $id;
    header("Location:../admin/settings.php");
}

