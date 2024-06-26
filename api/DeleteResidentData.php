<?php 
session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/survey.php';
require_once '../models/userActivityLogs.php';
require_once '../models/Components.php';


$id = $_GET['id'];
$userLog = new UserActivityLogs($conn);
$Components = new Tailwind();
$surveyModel = new Survey($conn); 

if ($surveyModel->deleteSurvey($id)){
    // if delete success full log it on the user activity log
    $userLog->logActivity($_SESSION['user_id'], "Deleted Survey with ID: ". $id);
    $_SESSION['success_message'] = "Survey Deleted Successfully! ID = ". $id;
   header("Location:../admin/residents.php");
    

}
else{
    
    echo "error deleing data";
}

?>