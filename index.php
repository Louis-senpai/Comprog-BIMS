<?php
session_start();
include "config.php";

if (isset($_SESSION['logged_in'])) {
    header("Location: /admin/home.php");
    exit();
}
require_once 'models/Components.php';
$Components = new Tailwind();
require_once 'models/settings.php';
$Settings = new Settings('settings.json');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="js/tailwindcss.js"></script>
    <script src="js/tailwind.config.js"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    </script>

</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <main class="bg-gray-100 dark:bg-gray-900">

        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">

            <!-- Login Form -->
            <section class="">
                <div class="grid grid-cols-1 rounded-lg lg:grid-cols-2 dark:border dark:border-primary-700">
                    <div
                        class="flex items-center justify-center px-4 py-10 rounded-l-lg shadow-lg bg-gray-50 dark:bg-slate-800 sm:px-6 lg:px-8 sm:py-16 lg:py-24">
                        <div class="xl:w-full xl:max-w-sm 2xl:max-w-md xl:mx-auto">
                            <?php
                        
                             if(isset($_SESSION['success_message'])){
                                 echo $Components->AlertDiv($_SESSION['success_message'], 'success');
                                 unset($_SESSION['success_message']);
                                 
                             }elseif (isset($_SESSION['error_message'])) {
                                 echo $Components->AlertDiv($_SESSION['error_message'], 'error');
                                 unset($_SESSION['error_message']);
                             }
                          
                            if(isset($_SESSION['reset_success'])){
                                echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                <span class="font-medium">Success </span> Password Has Been Reset
                              </div>';
                              session_destroy();
                            }
                            
                            ?>
                            <h2 class="text-3xl font-bold leading-tight text-text-800 sm:text-4xl dark:text-text-300">Sign in
                                to BIMS
                            </h2>
                            <p class="mt-2 text-base text-gray-600 dark:text-gray-400">Don’t have an account? <a
                                    href="signup.php" title=""
                                    class="font-medium text-blue-600 transition-all duration-200 hover:text-blue-700 hover:underline focus:text-blue-700">Create
                                    a account</a></p>

                            <form action="Authentication.php" method="POST" class="mt-8">
                                <div class="space-y-5">
                                    <div>
                                        <label for="" class="text-base font-medium text-text-900 dark:text-text-100">
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
                                                class="text-base font-medium text-text-900 dark:text-text-100"> Password
                                            </label>

                                            <a href="forgot.php" title=""
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
                                            class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 border border-transparent rounded-md bg-accent-600 focus:outline-none hover:bg-accent-700 focus:bg-accent-700">Log
                                            in</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center hidden px-4 py-10 rounded-r-lg shadow-lg lg:block bg-secondary-300 dark:bg-secondary-500 sm:py-16 lg:py-24 sm:px-6 lg:px-8">
                        <div>
                            <img class="w-[20rem] mx-auto" src="includes/images/<?php echo $Settings->getLogo();?>" alt="" />

                            <div class="w-full max-w-md mx-auto xl:max-w-xl">
                                <h3 class="text-2xl font-bold text-center text-text-900 dark:text-slate-900">
                                    Barangay Management System
                                                                </h3>
                                <p class="leading-relaxed text-center text-gray-500 dark:text-gray-400 mt-2.5">



                                </p>

                                <div class="flex items-center justify-center mt-10 space-x-3">


                                    <div class="bg-gray-200 rounded-full w-12 h-1.5"></div>
                                    <div class="bg-lime-500 rounded-full w-20 h-1.5"></div>

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