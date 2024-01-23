<?php 

session_start();
require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/survey.php';

if (isset($_POST['Add_resident'])) {
    // get the year today
    $year_added = date("Y");

    // based on the birthdate, calculate the age
    $birthDate = $_POST['BirthDate'];
    $birthDate = new DateTime($birthDate);
    $today = new DateTime("today");
    $age = $today->diff($birthDate)->y;
    $age = (int)$age;

    // Retrieve form data
    $surveyData = [
        'LastName' => $_POST['LastName'],
        'FirstName' => $_POST['FirstName'],
        'MiddleInitial' => $_POST['MiddleInitial'],
        'BirthPlace' => $_POST['BirthPlace'],
        'BirthDate' => $_POST['BirthDate'],
        'Age' => $age,
        'Gender' => $_POST['Gender'],
        'CivilStatus' => $_POST['CivilStatus'],
        'Religion' => $_POST['Religion'],
        'Dialect' => $_POST['Dialect'],
        'Education' => $_POST['Education'],
        'Job' => $_POST['Job'],
        'MonthLyIncome' => $_POST['MonthLyIncome'],
        'PhoneNumber' => $_POST['PhoneNumber'],
        'Email' => $_POST['Email'],
        'Remarks' => $_POST['Remarks'],
        'year_added' => $year_added
    ];

    // Create an instance of the Survey class
    $surveyModel = new Survey($conn);

    // Insert the data
    $result = $surveyModel->addSurvey($surveyData);

    if ($result) {
        $_SESSION['success_message'] = 'Resident '.$result.' data added successfully.';
        header('Location: ../admin/residents.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Failed to add Resident data.';
        header('Location: ../admin/residents.php');
        exit();
    }
}

// If the script is accessed without a POST request, redirect to the form page
$_SESSION['error_message']  = 'sorry resident didnt add';
header('Location: ../admin/addResidents.php');
exit();
?>