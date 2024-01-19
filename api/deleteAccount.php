<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/accounts.php';
require_once '../models/userActivityLogs.php';
require_once '../models/Components.php';


$id = $_GET['id'];
$userLog = new UserActivityLogs($conn);
$Components = new Tailwind();
$AccountModel = new Accounts($conn); 

if ($AccountModel->deleteAccount($id)){
    // if delete success full log it on the user activity log
    $userLog->logActivity($_SESSION['user_id'], "Deleted Account with ID: ". $id);
    $_SESSION['success_message'] = "Survey Deleted Successfully! ID= ". $id;
   header("Location:../admin/accounts.php");
    

}
else{
    echo "error deleing data";
}

?>