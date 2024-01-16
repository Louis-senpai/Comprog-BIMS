<?php

include("config.php");





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <script src="js/tailwind.config.js"></script>
    <script src="js/tailwindcss.js"></script>
</head>


<body class="bg-gray-50 dark:bg-gray-800">
    
<main class="bg-gray-50 dark:bg-gray-900">
  
<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="includes/images/logo1.png" class="mr-4 h-11 " alt="FlowBite Logo">
        <span>Barangay</span>  
    </a>
    <!-- Card -->
    <div class="w-full max-w-xl p-6 space-y-8 bg-white rounded-lg shadow sm:p-8 dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            Create a  Account
        </h2>
    
                <?php
                if(isset($_POST["submit"])){
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $passwordrepeat = $_POST["repeat_password"];

                    echo "Entered Password: $password<br>";

                    $passwordhash = password_hash($password , PASSWORD_DEFAULT);

                    $errors = array();
               
                    if(strlen($password) < 5){
                        array_push($errors, "Password must be at least 8 characters long");
                    }
                    if($password!=$passwordrepeat){
                        array_push($errors,"Password does not match");
                    }
                    

                    if(count($errors)>0){
                        foreach($errors as $error){
                            echo "<div class='p-4 mb-4 text-red-500 bg-red-100 rounded h-14'>$error</div>";
                        }
                    }else{
                     require_once  "config.php";
                     $sql ="INSERT INTO Accounts(username, email, password) VALUES ( ?, ?, ? )";
                     $stmt = mysqli_stmt_init($conn);
                     $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                     if($prepareStmt){
                        mysqli_stmt_bind_param($stmt,"sss",$username, $email, $passwordhash);
                        mysqli_stmt_execute($stmt);
                        header("location: index.php");
                     }else{
                        die("something went wrong");
                     }

                    }
                }
                ?>
                <form action="signup.php" method="post">
                    <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="username" required="">
                    </div>
                    <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@email.com"required="" >
                    </div>
                    <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                   </div>
                    <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" name="repeat_password" id="repeat_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                    </div>
            
                    <button type="submit" name="submit" class="px-4 py-2 my-10 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline ">
                       Create Account 
                    </button> 
                     <div>
                            <p>Already have an account? <a href="index.php" class="text-blue-500">Log in Here</a></p>
                    </div>
             </form>

                   
            </div>
        </div>	
    </div>
  </main>
</body>
</html>
