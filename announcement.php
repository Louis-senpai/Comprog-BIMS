<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <title>Barangy Dashboard | Announcement</title>

    <link rel="canonical" href="https://flowbite-admin-dashboard.vercel.app/" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" /> -->

    <link rel="stylesheet" href="css/profile.css">
    <script src="js/tailwind.config.js"></script>
    <script src="js/system.js"></script>
    <!-- Required the tailwind cli -->
    <?php require 'css/tailwindcss.php'; ?>
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    <!-- Header  -->
    <?php require_once 'components/header.php'; ?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <!-- Side Bar -->
        <?php require_once 'components/sidebar.php'; ?>

        <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <<div class="container mx-auto p-4">
                    <div class="mb-4">
                        <ul class="flex border-b">
                            <li class="-mb-px mr-1">
                                <button id="listTab"
                                    class="bg-white inline-block py-2 px-4 text-gray-900 hover:text-blue-800 font-semibold dark:bg-gray-800 dark:text-white duration-500 rounded-md"
                                    onclick="switchTab('list')">List Announcements</button>
                            </li>
                            <li class="mr-1">
                                <button id="createTab"
                                    class="bg-white inline-block py-2 px-4 text-gray-900 hover:text-blue-800 font-semibold dark:bg-gray-800 dark:text-white duration-500 rounded-md"  
                                    onclick="switchTab('create')">Create Announcement</button>
                            </li>
                        </ul>
                    </div>

                    <div id="listAnnouncements">
                        <!-- List of Announcements -->
                        <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 dark:bg-gray-800">
                            <h2 class="text-xl mb-4 dark:text-white">Announcements</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full leading-normal ">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider dark:bg-gray-700">
                                                Title
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider dark:bg-gray-700">
                                                Date
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider dark:bg-gray-700">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <!-- Repeat this block for each announcement -->
                                        <tr>
                                            <td class="px-5 py-5 bg-white text-sm dark:bg-gray-800">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap dark:text-white font-bold">
                                                            Announcement Title Here
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 bg-white text-sm dark:bg-gray-800">
                                                <p class="text-gray-900 whitespace-no-wrap dark:text-white font-bold">
                                                    Date Published
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 bg-white text-sm dark:bg-gray-800">
                                            <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</button>
                                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- End of announcement block -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="createAnnouncement" class="hidden">
                        <!-- Create Announcement Form -->
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 dark:bg-gray-800 dark:text-white">
                            <h2 class="text-xl mb-4">Create Announcement</h2>
                            <form action="/path-to-your-backend" method="POST" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="title">
                                        Title
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-600 dark:text-gray-200"
                                        id="title" type="text" placeholder="Enter announcement title" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2" for="description">
                                        Description
                                    </label>
                                    <textarea
                                        class="shadow appearance-none dark:bg-gray-600 dark:text-gray-200 border dark:text-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="description" placeholder="Enter announcement details" rows="4"
                                        required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-400" for="imageUpload">
                                        Upload Images/Files
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="imageUpload" type="file" multiple onchange="previewFiles()">
                                    <div id="preview" class="mt-4">
                                        <!-- Image preview will be displayed here -->
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        Publish Announcement
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
        </div>



        </main>

        <?php require 'components/footer.php';?>
    </div>
    </div>
    <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script>
    <script>
    function switchTab(tabName) {
        if (tabName === 'list') {
            document.getElementById('listAnnouncements').classList.remove('hidden');
            document.getElementById('createAnnouncement').classList.add('hidden');
        } else if (tabName === 'create') {
            document.getElementById('createAnnouncement').classList.remove('hidden');
            document.getElementById('listAnnouncements').classList.add('hidden');
        }
    }

    function previewFiles() {
        var preview = document.querySelector('#preview');
        var files = document.querySelector('input[type=file]').files;

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    }
    </script>
</body>

</html>