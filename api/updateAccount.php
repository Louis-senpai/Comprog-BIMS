<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/accounts.php';
require_once '../models/userActivityLogs.php';
$accountModel = new Accounts($conn); 
$userLog = new UserActivityLogs($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $permissions = array();
    $permissions = isset($_POST['permission']) ? $_POST['permission'] : [];
   
    $permissionsJson = json_encode($permissions);

    $accountModel->updateAccount($id, $username, $email, $permissionsJson, $role);
    $userLog->logActivity($_SESSION['user_id'], "{$_SESSION['username']} has Updated Account with ID: ". $id);
    $_SESSION['success_message'] = "Account updated successfully!";
    header("Location:../admin/accounts.php");

}



?>