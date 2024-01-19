<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/accounts.php';
require_once '../models/userActivityLogs.php';
$accountModel = new Accounts($conn); 
$userLog = new UserActivityLogs($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $permissions = array();
    $permissions = isset($_POST['permission']) ? $_POST['permission'] : [];
   
    $permissionsJson = json_encode($permissions);

    $id = $accountModel->registerWithAdmin($username,$password, $repassword, $permissionsJson, $email, $role);
    $userLog->logActivity($_SESSION['user_id'], "{$_SESSION['username']} has Created Account with ID: ". $id);
    header('hx-Refresh: true');
}


?>