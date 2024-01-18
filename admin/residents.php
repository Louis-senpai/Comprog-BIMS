<?php

require_once '../includes/components/header.php';

?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <!----------------1div------------------------------------->
                <div class="px-4 pt-6 pr-4">
                    
                        <div class="w-full mb-1">

                            <!----------------nav1 home------------------------------------->
                            <div class="mb-4">
                                <nav class="flex mb-5" aria-label="Breadcrumb">
                                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                        <li class="inline-flex items-center">
                                            <a href="home.php"
                                                class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                                    </path>
                                                </svg>
                                                Home
                                            </a>
                                        </li>
                                        <li>

                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                                    aria-current="page"><?php echo $filename;?></span>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>

                                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"> Manage
                                    Residents
                                </h1>
                                <div id="alert_message"> </div>
                            </div>
                            <!---------------------------search side------------------------------------->
                            <div class="sm:flex">
                                <div
                                    class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">

                                    <form class="lg:pr-3" action="search_users.php" method="GET">
                                        <label for="users-search" class="sr-only">Search</label>
                                        <div class="relative mt-1 lg:w-64 xl:w-96">
                                            <input type="text" name="name" id="users-search"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Search for users by name">
                                        </div>
                                    </form>
                                    <div class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0">

                                        <a href="#"
                                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>

                                        <a href="#"
                                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                                    <button type="button" data-modal-toggle="add-user-modal"
                                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Add user
                                    </button>
                                    <a href="#"
                                        class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Export
                                    </a>
                                </div>
                            </div>
                            <!---------------------------search side------------------------------------->
                        </div>
                    </div>
                    <!----------------1div table------------------------------------->
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow">
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    ID
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="w-10 p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Sex
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Age
                                                </th>

                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                            <?php
                                         // Retrieve data from the database
                                                         $start = 0;
                                                         $rows_per_page = 20;

                                                         $records = $conn->query("SELECT * FROM Survey ");
                                                         $nr_of_rows = $records->num_rows;
                                                         $pages = ceil($nr_of_rows / $rows_per_page);

                                                         if(isset($_GET['page-nr'])){
                                                            $page = $_GET['page-nr'] - 1;
                                                            $start = $page * $rows_per_page;
                                                         }
                                                         
                                                         $result = $conn->query("SELECT * FROM Survey LIMIT  $start ,  $rows_per_page");
                                                       
                                                         if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
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
                                                                
                                                               
                                                                echo "<button type='submit' hx-get='/api/DeleteResidentData.php?id={$row['ID']}' hx-target='#alert_message' hx-trigger='click' class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900'>";
                                                                echo "<svg class='w-4 h-4 mr-2' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>";
                                                                echo "<path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path>";
                                                                echo "</svg>Delete user</button>";

                                                                echo "</div>";
                                                                

                                                                echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='5'>No records found</td></tr>";
                                                        }
                                                        ?>

                                                       




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                   
                        <div class ="pagination">
                               <a href="?page-nr=1">First</a>
                               <a href="">Previous</a>
  
                           <div class="page-numbers">
                            
                              <a href="">Next</a>
                              <a href="?page-nr=<?php echo $pages ?>">Last</a>
                           </div>

                       </div>

                </div>
                <!-- Included Footer.php -->
                <?php 
                    require_once "../includes/components/footer.php";
                    ?>
            </main>
        </div>
    </div>

    </div>


</body>

</html>