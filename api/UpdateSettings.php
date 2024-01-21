<?php 
session_start();
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../models/userActivityLogs.php';
require_once '../models/settings.php';
$Settings = new Settings('../settings.json');
$Logs = new UserActivityLogs($conn);


if (isset($_POST['updateTitle'])){
    $title = $_POST['title'];
    $webEmail = $_POST['webEmail'];

    $Settings->updateTitle($title);
    $Settings->updateWebsiteEmail($webEmail);
    $Logs->logActivity($_SESSION['user_id'], " {$_SESSION['username']} Updated website title and email");
    $_SESSION['success_message'] = "Website title and email updated successfully!";
    header("Location:../admin/settings.php");

}
if(isset($_POST['updateSMTP'])){
    $host = $_POST['host'];
    $port = $_POST['port'];
    $username = $_POST['email'];
    $password = $_POST['password'];

    $Settings->updateSMTP($host, $port, $username, $password);
    $Logs->logActivity($_SESSION['user_id'], " {$_SESSION['username']} Updated SMTP settings");
    $_SESSION['success_message'] = "SMTP settings updated successfully!";
    header("Location:../admin/settings.php");
}
if(isset($_POST['updateFacebookAPI'])){
    $fbAppId = $_POST['fbAppId'];
    $fbAppSecret = $_POST['fbAppSecret'];

    $Settings->updateFacebookAPI($fbAppId, $fbAppSecret);
    $Logs->logActivity($_SESSION['user_id'], " {$_SESSION['username']} Updated Facebook API settings");
    $_SESSION['success_message'] = "Facebook API settings updated successfully!";
    header("Location:../admin/settings.php");
}
if (isset($_POST['updateGoogleAPI'])){
    $googleClientId = $_POST['googleClientId'];
    $googleClientSecret = $_POST['googleClientSecret'];

    $Settings->updateGoogleAPI($googleClientId, $googleClientSecret);
    $Logs->logActivity($_SESSION['user_id'], " {$_SESSION['username']} Updated Google API settings");
    $_SESSION['success_message'] = "Google API settings updated successfully!";
    header("Location:../admin/settings.php");
}


