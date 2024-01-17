<?php 
require_once 'config.php';
require_once 'vendor/autoload.php';
require_once 'models/accounts.php';
require_once 'models/userActivityLogs.php';
session_start();

$account = new Accounts($conn);
//  Signup Handler
 if (isset($_POST['create_account'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $repassword = $_POST['repassword'];

  
    $result = $account->registerUser($username, $password, $repassword, $email);
    if (is_string($result)) {
        // Handle the error, maybe display the message to the user
        echo $result;
    }
}
// Login Handler
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = $account->loginUser($email, $password);
    if (is_string($result)) {
        // Handle the error, maybe display the message to the user
     
        echo $result;
    }
}
if(isset($_GET['logout'])){
    $account->logoutUser($_SESSION['user_id']);
    

}
?>