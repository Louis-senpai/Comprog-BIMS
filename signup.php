<?php
session_start();
include("config.php");
require_once 'vendor/autoload.php';
require_once 'models/settings.php';

$Settings = new Settings('settings.json');

?>

<?php 
require_once 'models/Components.php';
$Components = new Tailwind();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add any additional head elements if needed -->

    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="js/tailwind.config.js"></script>
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

<body class="bg-background-100 dark:bg-gray-950">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto shadow-lg md:h-screen lg:py-0">
        <a href="index.php" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-[5rem] mr-2" src="includes/images/<?php echo $Settings->getLogo();?>" alt="logo">
            <?php echo $Settings->getName();?>
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-primary-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create An Account
                </h1>
                <?php 
                            if(isset($_SESSION['success_message'])){
                                echo $Components->AlertDiv($_SESSION['success_message'], 'success');
                                unset($_SESSION['success_message']);
                                
                            }elseif (isset($_SESSION['error_message'])) {
                                echo $Components->AlertDiv($_SESSION['error_message'], 'error');
                                unset($_SESSION['error_message']);
                            }
                            ?>
                <form class="space-y-4 md:space-y-6" action="Authentication.php" method="POST">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            username</label>
                        <input type="username" name="username" id="username"
                            class="bg-gray-50 border border-primary-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-accent-600 block w-full p-2.5 dark:bg-gray-700 dark:border-primary-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-accent-500"
                            placeholder="username" required="">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-primary-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-accent-600 block w-full p-2.5 dark:bg-gray-700 dark:border-primary-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-accent-500"
                            placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-primary-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-accent-600 block w-full p-2.5 dark:bg-gray-700 dark:border-primary-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-accent-500"
                            required="">
                    </div>
                    <div>
                        <label for="repassword"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Re-password</label>
                        <input type="password" name="repassword" id="repassword" placeholder="••••••••"
                            class="bg-gray-50 border border-primary-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-accent-600 block w-full p-2.5 dark:bg-gray-700 dark:border-primary-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-accent-500"
                            required="">
                    </div>

                    <button type="submit" name="create_account"
                        class="w-full text-white bg-accent-600 hover:bg-accent-700 focus:ring-4 focus:outline-none focus:ring-accent-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-accent-600 dark:hover:bg-accent-700 dark:focus:ring-accent-800">Sign
                        Up</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have An Account? <a href="/"
                            class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign
                            in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>


</body>

</html>