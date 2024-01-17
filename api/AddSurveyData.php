<?php 

require_once '../config.php';
require_once '../vendor/autoload.php';  
require_once '../models/survey.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        'MonthLyIncome' => $_POST['d'],
        'PhoneNumber' => $_POST['PhoneNumber'],
        'Email' => $_POST['Email'],
        'Remarks' => $_POST['Remarks'],
        'year_added' => $year_added

    ];

    // Create an instance of the Survey class
    $surveyModel = new Survey($conn); // Make sure $conn is your database connection instance

    // Insert the data
    $result = $surveyModel->addSurvey($surveyData);

    if ($result) {
        echo '<div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Success!</span> Resident '.$_POST['LastName'].' has Been Added
        </div>
      </div>';
    } else {
        echo '<div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
        </div>
      </div>';
    }
}

?>