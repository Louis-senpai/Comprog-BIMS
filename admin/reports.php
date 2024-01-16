<?php 
require_once '../includes/components/header.php';


?>


<body>


    <!-- sidebar -->
    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden h-screen bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>


        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    <div class="mb-4">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                <li class="inline-flex items-center">
                                    <a href="home.php"
                                        class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
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
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="#"
                                            class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Admin</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                            aria-current="page"><?php echo $filename; ?></span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All Residents
                        </h1>
                    </div>



                    <div class="relative shadow-md sm:rounded-lg h-[70rem]">
                        <button id="exportButton"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Export to CSV
                        </button>
                        <table id="SurveyData"
                            class="w-full overflow-x-auto text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="text-left">

                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            ID
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Lastname
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            FirstName
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            MiddleInitial
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            BirthPlace
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            BirthDate
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Age
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Gender
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            CivilStatus
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Religion
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Dialect
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Education
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Job

                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            MonthLyIncome
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            PhoneNumber
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Email
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Year
                                        </label>
                                    </th>
                                    <th class="sticky top-0 px-3 py-2 bg-gray-100 border-b border-gray-200">
                                        <label>
                                            Action
                                        </label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>
                    </div>

                </div>
            </main>
            <!-- report title -->



        </div>

    </div>
    <!-- loading indicator svg -->
    </div>

    <div x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- ... modal background overlay ... -->
            <div class="fixed inset-0 transition-opacity" @click="isModalOpen = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- ... modal content ... -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- ... modal details ... -->
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                User Details
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500"
                                    x-text="selectedUser.FirstName + ' ' + selectedUser.LastName"></p>
                                <!-- ... more user details ... -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse">
                    <button @click="isModalOpen = false" type="button"
                        class="w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
        $('#SurveyData').DataTable({
            "processing": true, // Show processing indicator
            "serverSide": true, // Enable server-side processing
            "select": true,
            "ajax": {
                "url": "../api/showAllData.php", // URL of the server-side processing script
                "type": "GET" // HTTP method to use for the AJAX call
            },
            "columns": [{
                    "data": "ID",
                    "class": "font-bold"
                }, // Column for first name
                {
                    "data": "FirstName"
                }, // Column for first name
                {
                    "data": "LastName"
                }, // Column for last name
                {
                    "data": "MiddleInitial",
                    "class": "uppercase"
                }, // Column for last name
                {
                    "data": "BirthPLace"
                }, // Column for last name
                {
                    "data": "BirthDate"
                }, // Column for last name
                {
                    "data": "Age"
                }, // Column for last name
                {
                    "data": "Gender"
                }, // Column for last name
                {
                    "data": "CivilStatus"
                }, // Column for last name
                {
                    "data": "Religion"
                }, // Column for last name
                {
                    "data": "Dialect"
                }, // Column for last name
                {
                    "data": "Education"
                }, // Column for last name
                {
                    "data": "Job"
                }, // Column for last name
                {
                    "data": "MonthLyIncome"
                }, // Column for last name
                {
                    "data": "PhoneNumber"
                }, // Column for last name
                {
                    "data": "Email"
                }, // Column for last name
                {
                    "data": "year_added"
                }, // Column for age

                // Add more columns as needed, matching the data returned from the server
            ],
            // Optionally, you can add additional DataTables options here, such as:
            "order": [
                [0, 'asc']
            ], // Default order on the first column
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, 100, 150, 300]
            ], // Length menu options
            "pageLength": 20, // Default number of rows to display
            "language": {
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "drawCallback": function(settings) {
                // Apply Tailwind CSS styles to the DataTable elements

                // Style the DataTable container
                $('.dataTables_wrapper').addClass(
                    'p-4 border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700" rounded-lg shadow grid grid-cols-2 overflow-auto'
                );

                // Style the DataTable
                $('#SurveyData').addClass('col-span-2 min-w-full mt-5');

                // Style the DataTable header
                $('#SurveyData thead').addClass(
                    'text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'
                );
                $('#SurveyData thead th').addClass(
                    'bg-gray-300 dark:bg-gray-700 px-6 py-3 text-md font-bold text-gray-900 dark:text-gray-200 uppercase tracking-wider'
                );

                // Style the DataTable body
                $('#SurveyData tbody').addClass(
                    'bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900');
                $('#SurveyData tbody td').addClass(
                    'px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100');

                // Style the DataTable pagination
                $('.dataTables_paginate').addClass('flex justify-between pt-4 ');
                $('.paginate_button').addClass(
                    'px-4 py-2 mx-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'
                );

                // Style the DataTable length menu and search input
                $('.dataTables_length select').addClass(
                    'block w-full px-3 py-1.5 w-10 font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                );
                $('.dataTables_filter input').addClass(
                    'form-input rounded-md shadow-sm mt-1 block w-full bg-gray-100');

                // Style the DataTable processing indicator
                $('.dataTables_info').addClass('text-sm text-gray-700 dark:text-gray-200');
                $('#SurveyData_processing').addClass(
                    'flex items-center font-medium col-span-2 p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800'
                    );

                // Style the DataTable length menu and search input
                $('.dataTables_length').addClass(
                    'flex items-center dark:text-white gap-2 p-4 rounded-l-lg bg-white border-b border-gray-200 lg:mt-1.5 dark:bg-gray-700 dark:border-gray-600'
                );
                $('.dataTables_length label').addClass('flex items-center gap-1');
                $('.dataTables_length select').addClass(
                    'form-select w-[10rem] bg-white text-black dark:text-white lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700" px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                );
                $('.dataTables_filter').addClass(
                    'flex justify-end bg-white border-b border-gray-200 lg:mt-1.5 dark:bg-gray-700 dark:border-gray-600 rounded-r-lg p-4'
                );
                $('.dataTables_filter label').addClass('flex dark:text-white items-center gap-1');
                $('.dataTables_filter input').addClass(
                    'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'
                );

                // Responsive adjustments
                $('.dataTables_length select, .dataTables_filter input').addClass(
                    'text-sm dark:text-gray-300');
                $('.dataTables_length, .dataTables_filter').addClass(
                    'flex-col md:flex-row md:items-center');
// Pangination div
                $('#SurveyData_paginate').addClass(
                    'inline-flex -space-x-px text-sm');
                // Add any additional styling as needed
            },
        });
    });
    </script>



</body>

</html>