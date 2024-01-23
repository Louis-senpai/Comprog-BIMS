<?php 
session_start();
require_once('../config.php');
require('../vendor/autoload.php');
require '../models/accounts.php';
require_once '../models/userActivityLogs.php';

$account = new Accounts($conn);

$id = $_GET['id'];
$result = $account->verifyAccount($id);
if ($result === true) {
    $userLog = new UserActivityLogs($conn);
    $userLog->logActivity($_SESSION['user_id'], "Verified Account with ID: ". $id);
    $_SESSION['success_message'] = "Account Verified Successfully! ID = ". $id;


    header("Location:../admin/accounts.php");
    exit();
    
} else {
    $_SESSION['error_message'] = "Account Verification Failed! ID = ". $id;
    header("Location:../admin/accounts.php");
    exit();

}

?>