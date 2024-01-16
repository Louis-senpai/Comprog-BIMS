jQuery(document).ready(function($) {
    $('#SurveyData').DataTable({
        "processing": true, // Show processing indicator
        "ajax": {
            // "url": "../cache/surveys.json"
            "url": "../api/showAllData.php",


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
        //    Default order on the first column
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50]
        ], // Length menu options
        "pageLength": 50, // Default number of rows to display
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
        dom: 'Bfrtip',
        // This parameter ensures the buttons are displayed
        buttons: [{
                extend: 'csvHtml5',
                text: 'Export to CSV',
                titleAttr: 'CSV export',
                className: 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'
            },
          
            {
                extend: 'print',
                text: 'Print selected',
                className: 'text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 me-2 mb-2',
            },
            {
                extend: 'searchBuilder',
                text: 'Filters',
                config: {
                    depthLimit: 2
                },
                className: "focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-80"
            }
        ],

        search: {
            regex: true,
            smart: true,
            caseInsensitive: true,
            show: true,
            placeholder: "Search...",
            return: true

        },
        select: true,

        deferRender: true, // This parameter ensures the table is redrawn when the user scrolls
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
                'flex justify-end col-span-2 bg-white border-b border-gray-200 lg:mt-1.5 dark:bg-gray-700 dark:border-gray-600 rounded-r-lg p-4'
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
            // Export and print buttons
            $('.dt-buttons').addClass(
                'flex items-center col-span-2 dark:text-white gap-2 p-4 rounded-l-lg bg-white border-b border-gray-200 lg:mt-1.5 dark:bg-gray-700 dark:border-gray-600'
            );

        },
    });


});