<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/tailwindcss.js"></script>
</head>

<body>
    <div class="flex h-screen">

    <!-- Sidebar -->
    <div class="flex w-[16rem] h-screen bg-gray-200">
        <!-- Sidebar content -->
        <div class="w-64 p-5">
            <div class="flex items-center p-2 mb-5 space-x-4">
                <img src="includes/images/logo.png" alt="Your Logo" class="w-12 h-12 rounded-full">
                <div>
                    <h4 class="text-lg font-semibold tracking-wide text-gray-700 capitalize font-poppins">Dashboard</h4>
                </div>
            </div>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="#"
                        class="flex items-center p-2 space-x-3 font-medium text-gray-700 rounded-md hover:bg-gray-300">
                        <span class="text-gray-600">
                            <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor" class="w-6 h-6">
                                <g id="Overview" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="Container" x="0" y="0" width="24" height="24"> </rect>
                                    <path
                                        d="M19,10.5714286 L19,18 C19,19.1045695 18.1045695,20 17,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,7 C4,5.8954305 4.8954305,5 6,5 L13.4285714,5 L13.4285714,5"
                                        id="shape-1" stroke="#030819" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-dasharray="0,0"> </path>
                                    <path
                                        d="M18,7 C18.5522847,7 19,6.55228475 19,6 C19,5.44771525 18.5522847,5 18,5 C17.4477153,5 17,5.44771525 17,6 C17,6.55228475 17.4477153,7 18,7 Z"
                                        id="shape-2" stroke="#030819" stroke-width="2" stroke-linecap="round"
                                        stroke-dasharray="0,0"> </path>
                                    <path d="M8,15 L11,11 L13.000781,13 L16,9" id="shape-3" stroke="#030819"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-dasharray="0,0"> </path>
                            </svg>
                        </span>
                        <span>Overview</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 space-x-3 font-medium text-gray-700 rounded-md hover:bg-gray-300">
                        <span class="text-gray-600">
                            <svg viewBox="0 -12 1048 1048" fill="currentColor" class="w-6 h-6" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M334.571747 570.128513a14.452891 14.452891 0 0 0 14.452891 14.70645h125.638727c7.987124 0 14.452891-6.592547 14.452891-14.83323V528.671536c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638727c-7.987124 0-14.452891 6.592547-14.452891 14.706451v41.583756zM474.663365 233.78185c7.987124 0 14.452891-6.592547 14.452891-14.83323V177.491643c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638727c-7.987124 0-14.452891 6.592547-14.452891 14.70645v41.456977a14.452891 14.452891 0 0 0 14.452891 14.70645h125.638727zM464.013867 985.966077c0-22.440015 2.535595-44.372911 6.972886-65.798688h-107.382444v-100.155999h-112.453634v100.155999H87.731584c-9.381701 0-16.734926-7.480005-16.734927-16.861706V87.985143c0-4.437291 1.648137-8.874582 4.81763-12.044076s7.480005-4.94441 11.917297-4.94441h439.291816c4.437291 0 8.747802 1.774916 11.917296 4.94441s4.94441 7.606785 4.81763 11.917296v347.376501a101.246304 101.246304 0 0 1 68.080723-26.243407c1.014238 0 1.901696 0 2.915934 0.12678v-50.711898a16.89974 16.89974 0 0 1 16.734927-16.861706h272.069332c4.437291 0 8.747802 1.774916 11.790517 4.94441 3.169494 3.169494 4.94441 7.480005 4.94441 11.917296v49.063761c27.891544 17.749164 52.106475 40.696298 70.996657 67.827164V305.919525c0-19.524081-15.847468-35.371549-35.244769-35.371549H614.628204V35.498329A35.498329 35.498329 0 0 0 579.256655 0H35.371549A35.574396 35.574396 0 0 0 0 35.498329v920.167388a35.498329 35.498329 0 0 0 35.371549 35.498329h428.895877c-0.12678-1.774916-0.253559-3.549833-0.253559-5.197969zM334.571747 394.665346a14.452891 14.452891 0 0 0 14.452891 14.70645h125.638727c7.987124 0 14.452891-6.592547 14.452891-14.83323v-41.456976c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638727c-7.987124 0-14.452891 6.592547-14.452891 14.70645v41.710536zM334.571747 745.71846c0 3.930172 1.521357 7.606785 4.183732 10.395939 2.662375 2.789154 6.465767 4.310511 10.269159 4.310511h125.638727c7.987124 0 14.452891-6.592547 14.452891-14.83323v-41.456977c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638727c-7.987124 0-14.452891 6.592547-14.452891 14.706451v41.710536zM280.056457 353.208369c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638728c-7.987124 0-14.452891 6.592547-14.45289 14.706451v41.456976c0 3.803392 1.521357 7.606785 4.183731 10.395939 2.662375 2.789154 6.465767 4.310511 10.269159 4.310512h125.638728c7.987124 0 14.452891-6.592547 14.452891-14.83323v-41.203418zM280.056457 528.671536c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638728c-7.987124 0-14.452891 6.592547-14.45289 14.706451v41.456976c0 3.803392 1.521357 7.606785 4.183731 10.395939 2.662375 2.789154 6.465767 4.310511 10.269159 4.310512h125.638728c7.987124 0 14.452891-6.592547 14.452891-14.83323V528.671536zM280.056457 177.618423c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638728c-7.987124 0-14.452891 6.592547-14.45289 14.83323v41.456976c0 3.803392 1.521357 7.606785 4.183731 10.395939 2.789154 2.789154 6.338987 4.310511 10.269159 4.310512h125.638728c7.987124 0 14.452891-6.592547 14.452891-14.83323v-41.330197zM139.964838 689.428253c-7.987124 0-14.452891 6.592547-14.45289 14.70645v41.456977c0 3.803392 1.521357 7.606785 4.183731 10.395939 2.662375 2.789154 6.465767 4.310511 10.269159 4.310511h125.638728c7.987124 0 14.452891-6.592547 14.452891-14.83323v-41.456976c0-8.240683-6.338987-14.83323-14.452891-14.83323h-125.638728zM787.682555 432.065371c-38.921382 0-75.180389 12.170856-104.973628 32.835954 0 0-0.12678 0-0.12678 0.126779-16.861706 10.522719-46.781726 8.621023-68.714622 7.353226-20.918658-1.141018-39.048161 14.70645-40.315959 35.625108a38.109991 38.109991 0 0 0 35.625109 40.315959l6.846106 0.380339c-8.367463 21.172217-13.185093 44.119351-13.185094 68.207503 0 55.402749 24.595271 104.973629 63.389873 138.9506-82.406834 43.612232-138.823821 130.329578-138.823821 230.105238 0 21.045438 16.988486 38.033923 38.033923 38.033923s38.033923-16.988486 38.033924-38.033923c0-101.550576 82.660394-184.210969 184.337749-184.21097 101.930915 0 184.718088-82.913953 184.718089-184.718088s-82.913953-184.971648-184.844869-184.971648z m0 293.495109c-59.966819 0-108.650241-48.810202-108.650241-108.650241s48.810202-108.650241 108.650241-108.650241 108.650241 48.810202 108.650242 108.650241-48.683422 108.650241-108.650242 108.650241zM987.867773 819.377492a38.148025 38.148025 0 0 0-53.627832-4.94441 38.148025 38.148025 0 0 0-4.94441 53.627832c27.511205 32.962734 42.597994 74.80005 42.597994 117.905163 0 21.045438 16.988486 38.033923 38.033923 38.033923s38.033923-16.988486 38.033924-38.033923c0.12678-60.854278-21.298997-119.933639-60.093599-166.588585z">
                                </path>
                            </svg>
                        </span>
                        <span>Survey Forms</span>
                        <!--  -->
                    </a>
                </li>
                <li>
                           
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 space-x-3 font-medium text-gray-700 rounded-md hover:bg-gray-300">
                        <span class="text-gray-600">
                            <svg viewBox="0 0 25.00 25.00" fill="currentColor" class="w-7 h-7" xmlns="http://www.w3.org/2000/svg"
                                stroke="#000000" stroke-width="1">
                               
                                    <path
                                        d="M11.75 9.874C11.75 10.2882 12.0858 10.624 12.5 10.624C12.9142 10.624 13.25 10.2882 13.25 9.874H11.75ZM13.25 4C13.25 3.58579 12.9142 3.25 12.5 3.25C12.0858 3.25 11.75 3.58579 11.75 4H13.25ZM9.81082 6.66156C10.1878 6.48991 10.3542 6.04515 10.1826 5.66818C10.0109 5.29121 9.56615 5.12478 9.18918 5.29644L9.81082 6.66156ZM5.5 12.16L4.7499 12.1561L4.75005 12.1687L5.5 12.16ZM12.5 19L12.5086 18.25C12.5029 18.25 12.4971 18.25 12.4914 18.25L12.5 19ZM19.5 12.16L20.2501 12.1687L20.25 12.1561L19.5 12.16ZM15.8108 5.29644C15.4338 5.12478 14.9891 5.29121 14.8174 5.66818C14.6458 6.04515 14.8122 6.48991 15.1892 6.66156L15.8108 5.29644ZM13.25 9.874V4H11.75V9.874H13.25ZM9.18918 5.29644C6.49843 6.52171 4.7655 9.19951 4.75001 12.1561L6.24999 12.1639C6.26242 9.79237 7.65246 7.6444 9.81082 6.66156L9.18918 5.29644ZM4.75005 12.1687C4.79935 16.4046 8.27278 19.7986 12.5086 19.75L12.4914 18.25C9.08384 18.2892 6.28961 15.5588 6.24995 12.1513L4.75005 12.1687ZM12.4914 19.75C16.7272 19.7986 20.2007 16.4046 20.2499 12.1687L18.7501 12.1513C18.7104 15.5588 15.9162 18.2892 12.5086 18.25L12.4914 19.75ZM20.25 12.1561C20.2345 9.19951 18.5016 6.52171 15.8108 5.29644L15.1892 6.66156C17.3475 7.6444 18.7376 9.79237 18.75 12.1639L20.25 12.1561Z"
                                        fill="#000000"></path>
  
                            </svg>
                        </span>
                        <span>Logout</span>
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
        </div>
    </div>
    <main class="flex-1">
        <!-- Main dashboard Content -->
        <div class="">
            <div class="max-w-full mx-auto overflow-hidden bg-blue-100 rounded-lg shadow-sm">
                <div class="px-4 py-2">
                    <h1 class="text-2xl font-semibold text-gray-900">Welocome to Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">
                      Admin
                    </p>

                </div>
            </div>
               
            <div class="mt-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                hello
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
</body>

</html>