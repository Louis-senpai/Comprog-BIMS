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
<body class="bg-gray-500">
    <div class="container grid h-full grid-cols-1 m-auto mt-12 bg-gray-900 rounded-lg md:grid-cols-2">
        <!-- display the background image of the login form -->
        <div class="flex flex-col items-center justify-center hidden md:block">
        <img src="includes/images/background.png" alt="login" class="h-full cover">
        </div>  

        <!-- login form using tailwindcss -->
        <div class="flex flex-col items-center justify-center p-4">
            <div class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <!-- logo imagere here -->
                <div class="flex justify-center w-full mb-4 ">
                    <img src="includes/images/logo.png" alt="logo" class="w-auto h-32">
                
                </div>
                <!-- form  here -->
                <?php
                if(isset($_POST["submit"])){
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $passwordrepeat = $_POST["repeat_password"];

                    $passwordhash = password_hash($password , PASSWORD_DEFAULT);

                    $errors = array();
                
                    if (empty($username) OR empty($email)  OR empty($password) OR empty($passwordrepeat )){
                        array_push($errors,"All fields are required");
                    }
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        array_push($errors, "Email is not valid");
                    }
                    if(strlen($password) < 8){
                        array_push($errors, "Password must be at least 8 characters long");
                    }
                    if($password!==$passwordrepeat){
                        array_push($errors,"Password does not match");
                    }
                    
                    // same email not allowed 
                    $sql = "SELECT * FROM  users WHERE email = '$emial'";
                    $result = mysqli_query($sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount>0){
                        array_push($errors,"Email already exists");

                    }

                    if(count($errors)>0){
                        foreach($errors as $error){
                            echo "<div class='bg-red-100 text-red-500 p-4 mb-4 rounded h-14'>$error</div>";
                        }
                    }else{
                     require_once  "config.php";
                     $sql ="INSERT INTO users(username, email, password) VALUES ( ?, ?, ? )";
                     $stmt = mysqli_stmt_init($conn);
                     $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                     if($prepareStmt){
                        mysqli_stmt_bind_param($stmt,"sss",$username, $eamil, $passwordhash);
                        mysqli_stmt_execute($stmt);
                        echo"<div class='bg-green-100 text-green-500 p-4 mb-4 rounded h-14'> You are registered successfully.</div.";
                     }else{
                        die("something went wrong");
                     }

                    }
                }
                ?>
                <form action="signup.php" method="post">
        <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700"  for="username">
                            User Name
                            <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus focus:outline-none focus:shadow-outline" type="text" name="username" placeholder="UserName">
                    
                        </label>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                            Email
                            <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus focus:outline-none focus:shadow-outline"  id="email" type="text" name="email" placeholder="email">
                           
                        </label>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                            Password
                            <input class="w-full px-3 py-2 mb-3 leading-tight border border-red-500 rounded shadow appearance-none text-gray- 700 focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="********">
                          
                           
                        </label>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="repeat_password">
                           Repeat Password
                            <input class="w-full px-3 py-2 mb-3 leading-tight border border-red-500 rounded shadow appearance-none text-gray- 700 focus:outline-none focus:shadow-outline" id="repeat_password" type="password" name="repeat_password" placeholder="********">
  
                        </label>
                      </div> 
                      
                      <button type="submit" name="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                       Create Account 
                      </button> 
                     
                    </form>

                    <div>
                  <p>Already have an account? <a href="login.php" class="text-blue-500">Log in Here</a></p>
                </div>
            </div>
        </div>	
    </div>
</body>
</html>


                
