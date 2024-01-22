<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/accounts.php';
require_once '../models/userActivityLogs.php';

$accountModel = new Accounts($conn); 
$userLog = new UserActivityLogs($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';
    $permissions = $_POST['permission'] ?? [];

    $permissionsJson = json_encode($permissions);

    // Check if passwords match
    if ($password !== $repassword) {
        $_SESSION['error_message'] = 'Passwords do not match.';
        header('Location: /admin/accounts.php');
        exit();
    }

    // Additional validation can be added here (e.g., check if username or email already exists)

    // Attempt to register the account
    $id = $accountModel->registerWithAdmin($username, $password, $repassword, $permissionsJson, $email, $role);

    if ($id) {
        // Log the activity
        $userLog->logActivity($_SESSION['user_id'], "{$_SESSION['username']} has Created Account with ID: " . $id);
        $_SESSION['success_message'] = 'Account Created!';
    } else {
        // Handle account creation failure
        $_SESSION['error_message'] = 'Failed to create account. Please try again.';
    }

    // Redirect to the accounts page with either a success or error message
    header('Location: /admin/accounts.php');
    exit();
}

// If the script is accessed without a POST request, redirect to the accounts page
header('Location: /admin/accounts.php');
exit();
?>