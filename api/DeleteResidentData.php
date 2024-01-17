<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/survey.php';
require_once '../models/userActivityLogs.php';
require_once '../models/Components.php';
// use get to get the id and delete it from the database

$id = $_GET['id'];
$userLog = new UserActivityLogs($conn);
$Components = new Tailwind();
$surveyModel = new Survey($conn); // Make sure $conn is your database connection instance

if ($surveyModel->deleteSurvey($id)){
    // if delete success full log it on the user activity log
    $userLog->logActivity($_SESSION['user_id'], "Deleted Survey with ID: ". $id);
    echo $Components->AlertDiv('Successfully Deleted Data '.$id, 'success');
    

}
else{
    echo $Components->AlertDiv('Failed to Delete Data '. $id, 'danger');
}

?>