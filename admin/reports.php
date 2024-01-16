<?php 
require_once '../includes/components/header.php';


?>


<body>


    <!-- sidebar -->
    <?php require_once "../includes/components/nav.php";?>
    <div class="flex h-screen pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <style type="text/tailwindcss">

            @layer components{
                .dt-button-collection {
               @apply p-4 rounded-lg h-full;
                }
                .dtb-popover-close{
                    @apply inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300;
                }
                .selected{
                    @apply bg-blue-400 dark:bg-blue-500 duration-500 ease-in-out;
                }
            }
            /* @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
   
  
            .dt-button-collection {
                background-color: #200E3A;
                    color: white;
                    border: 1px solid #200E3A;
                }
            .dt-button-collection:hover {
                background-color: #38419D;
                    color: white;
                    border: 1px solid #38419D;
                }
            .dt-button-collection:focus {
                background-color: #38419D;
                    color: white;
                    border: 1px solid #38419D;
                }
           .dt-button-collection:active {
                background-color: #38419D;
                    color: white;
                    border: 1px solid #38419D;
                }
           .dt-button-collection.dt-button-background {
                background-color: #200E3A;
                    color: white;
                    border: 1px solid #200E3A;
                }
           .dt-button-collection.dt-button-background:hover {
                background-color: #38419D;
                    color: white;
                    border: 1px solid #38419D;
                }
                    } */
                            </style>

        <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 mb-10 dark:bg-gray-900">
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
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
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

    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/sb-1.6.0/sp-2.2.0/sl-1.7.0/datatables.min.js">
    </script>
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.tailwindcss.min.js"></script>
   <script src="../js/datatable.js"></script>


</body>

</html>