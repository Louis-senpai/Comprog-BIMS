<?php

include("config.php");


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
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    <main class="bg-gray-50 dark:bg-gray-900">

        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">

          

            <!-- Card -->
            <div class="w-full max-w-xl p-6 space-y-8 bg-white rounded-lg shadow sm:p-8 dark:bg-gray-800">
                 <!-- Logo Image -->
                 <div class="flex justify-center w-full mb-4">
                    <a href="index.php">
                      <img src="includes/images/logo1.png" alt="logo" class="w-auto h-32">
                    </a>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Sign in to  Dashboard
                </h2>
                <?php
                    if (isset($_POST["login"])){
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        require_once "config.php";
                        $sql ="SELECT * FROM Accounts WHERE  email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($user){
                            if(password_verify($password, $user["password"])){
                                header("Location: admin/home/php");
                                die();

                            }else{
                                echo "<div class='p-4 mb-4 text-red-500 bg-red-100 rounded h-14'>Password does not match</div>";
                            }

                        }else{
                            echo "<div class='p-4 mb-4 text-red-500 bg-red-100 rounded h-14'>Email does not match</div>";
                        }

                    }


                    ?>

                <!-- Login Form -->
                <form action="index.php" method="post">
                    <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@email.com"required="" >
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <button type="submit" value="login" name="login" class="my-10 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                </form>

            </div>
        </div>
    </main>
</body>

</html>
