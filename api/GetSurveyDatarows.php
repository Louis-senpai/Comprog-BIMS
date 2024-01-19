<?php 

require_once('../config.php');
require('../vendor/autoload.php');
require('../models/survey.php');



// Get the search term from the query parameters
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Define the limit and offset for pagination
$limit = 50; // Number of results per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Create an instance of the Survey class
$survey = new Survey($conn);

// Get the paginated survey results
$paginatedResults = $survey->getPaginatedSurveys($limit, $offset, $searchTerm);


$results = json_encode($paginatedResults);

foreach ($paginatedResults['results'] as $row) {
    echo "<tr class='hover:bg-gray-100 dark:hover:bg-gray-700'>";
    echo "<td class='p-4 text-base font-semibold text-gray-900 dark:text-white'>" . $row['ID'] . "</td>";
    echo "<td class='p-4 text-base font-semibold text-gray-900 dark:text-white'>" . $row['FirstName'] . ' ' . $row['LastName'] . "</td>";
    echo "<td class='w-10 p-4 text-base font-medium text-gray-500 whitespace-nowrap dark:text-white'>" . $row['Gender'] . "</td>";
    echo "<td class='p-4 text-base font-medium text-gray-500 whitespace-nowrap dark:text-white'>" . $row['Age'] . "</td>";
    echo "<td class='p-4 text-base font-medium text-gray-500 whitespace-nowrap dark:text-white'>" . $row['Email'] . "</td>";
    echo "<td class='p-4 pr-4 space-x-2 whitespace-nowrap'>"; // Add padding to the right

    echo "<div style='display: flex; gap: 10px;'>";
    // Edit button
    echo "";
    echo "<a href='updateResidents.php?edit={$row['ID']}' data-modal-toggle='edit-user-modal' class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>";
    echo "<svg class='w-4 h-4 mr-2' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>";
    echo "<path d='M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z'></path>";
    echo "<path fill-rule='evenodd' d='M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z' clip-rule='evenodd'></path>";
    echo "</svg>Edit user</a>";
    echo "";
    
   
    echo "<button type='submit' hx-get='/api/DeleteResidentData.php?id={$row['ID']}' hx-target='#alert_message' hx-trigger='click' hx-confirm='do you want to delete this?' class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900'>";
    echo "<svg class='w-4 h-4 mr-2' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>";
    echo "<path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path>";
    echo "</svg>Delete user</button>";

    echo "</div>";
    

    echo "</td>";
    echo "</tr>";
}



?>