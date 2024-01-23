<?php
define('ROOT_DIR', realpath(__DIR__));

// session_start(); // Start the session if not already started

// Set PHP to log errors to a file instead of displaying them to the screen
ini_set('display_errors', '1');
ini_set('log_errors', '1');
// ini_set('error_log', ROOT_DIR. '/error_log.txt'); // Specify where to log the errors

require_once ROOT_DIR . '\models\settings.php';
$config = new Settings(ROOT_DIR . '\settings.json');

$sql = $config->getMysql();
$host = $sql['host'];
$user = $sql['user'];
$name = $sql['database'];
$pass = $sql['password'];
$port = "3306";
$charset = 'utf8';

$conn = mysqli_connect($host, $user, $pass, $name, $port);
// Check the connection
if (!$conn) {
    error_log("Failed to connect to MySQL: " . mysqli_connect_error());
    terminateScript();
}else{
    echo "Connected to MySQL successfully";
}

function checkForSuperadmin($conn) {
    $query = "SELECT * FROM `Accounts` WHERE `role` = 'superadmin'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        error_log("Error checking for superadmin: " . mysqli_error($conn));
        terminateScriptWithError("Error checking for superadmin account. Please check your database and try again.");
    }
    if (mysqli_num_rows($result) == 0) {
        // No superadmin account found
        return true;
    } else {
        // Superadmin account exists
        return false;
    }
}function createTableIfNotExists($conn, $tableName, $createQuery) {
    $checkTable = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
    if (mysqli_num_rows($checkTable) == 0) {
        if (!mysqli_query($conn, $createQuery)) {
            error_log("Error creating table $tableName: " . mysqli_error($conn));
            terminateScriptWithError("Error creating the $tableName table. Please check your database and try again.");
        }
    }
}




function terminateScript() {
    $_SESSION = array(); // Unset all session variables
    session_destroy(); // Destroy the session
    session_start(); // Start a new session to pass the error message
    $_SESSION['error_message'] = 'Please check your database credentials in settings.json and try again';
    header("Location: " . ROOT_DIR . "\index.php");
    exit();
}
function terminateScriptWithError($errorMessage) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['error_message'] = $errorMessage;
    header("Location: " . ROOT_DIR . "\index.php");
    exit();
}