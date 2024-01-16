<?php
session_start();
include "config.php";

if (isset($_SESSION['logged_in'])) {
    header("Location: /admin/home.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add any additional head elements if needed -->

    <!-- Include Tailwind CSS -->
    <script src="js/tailwind.config.js"></script>
    <script src="js/tailwindcss.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-gray-50 dark:bg-gray-800">

    <main class="bg-gray-50 dark:bg-gray-900">

        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">

            <!-- Login Form -->
            <section class="">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div
                        class="flex items-center justify-center px-4 py-10 bg-gray-100 rounded-l-lg dark:bg-slate-800 sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                        <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                            <?php
                            if (isset($_SESSION['error_message'])) {
                                echo '<div id="toast-danger" class="flex items-center w-[30rem] max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only"></span>
        </div>
        <div class="ms-3 text-sm font-normal">' . $_SESSION['error_message'] . '</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>';
                                unset($_SESSION['error_message']);
                            }
                            ?>
                            <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl dark:text-white">Sign in
                                to BIMS
                            </h2>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">Don’t have an account? <a
                                    href="signup.php" title=""
                                    class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">Create
                                    a account</a></p>

                            <form action="Authentication.php" method="POST" class="mt-8">
                                <div class="space-y-5">
                                    <div>
                                        <label for="" class="text-base font-medium text-gray-900 dark:text-gray-100">
                                            Email address
                                        </label>
                                        <div class="mt-2.5">
                                            <input type="email" name="email" id=""
                                                placeholder="Enter email to get started"
                                                class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md dark:bg-gray-700 dark:text-white bg-gray-50 focus:outline-none focus:border-blue-600 caret-blue-600" />
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between">
                                            <label for=""
                                                class="text-base font-medium text-gray-900 dark:text-gray-100"> Password
                                            </label>

                                            <a href="#" title=""
                                                class="text-sm font-medium text-blue-600 hover:underline hover:text-blue-700 focus:text-blue-700">
                                                Forgot password? </a>
                                        </div>
                                        <div class="mt-2.5">
                                            <input type="password" name="password" id=""
                                                placeholder="Enter your password"
                                                class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 border border-gray-200 rounded-md dark:bg-gray-700 dark:text-white bg-gray-50 focus:outline-none focus:border-blue-600 caret-blue-600" />
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" name="login"
                                            class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">Log
                                            in</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center px-4 py-10 rounded-r-lg dark:bg-slate-800 sm:py-16 lg:py-24 bg-gray-50 sm:px-6 lg:px-8">
                        <div>
                            <img class="w-[20rem] mx-auto" src="includes/images/logo1.png" alt="" />

                            <div class="w-full max-w-md mx-auto xl:max-w-xl">
                                <h3 class="text-2xl font-bold text-center text-black dark:text-white">Barangy
                                    Information Management System</h3>
                                <p class="leading-relaxed text-center text-gray-500 dark:text-gray-400 mt-2.5">



                                </p>

                                <div class="flex items-center justify-center mt-10 space-x-3">
                                    <div class="bg-orange-500 rounded-full w-20 h-1.5"></div>

                                    <div class="bg-gray-200 rounded-full w-12 h-1.5"></div>

                                    <div class="bg-gray-200 rounded-full w-12 h-1.5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</body>

</html>