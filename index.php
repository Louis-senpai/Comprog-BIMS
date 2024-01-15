<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="js/tailwind.config.js"></script>
    <script src="js/tailwindcss.js"></script>
</head>
<body class="bg-gray-500 ">
    <div class="container grid h-full grid-cols-1 m-auto mt-20 bg-gray-900 rounded-lg md:grid-cols-2">
        <!-- display the background image of the login form -->
        <div class="flex flex-col items-center justify-center hidden md:block">
        <img src="includes/images/background.png" alt="login" class="h-full cover">
        </div>  

        <!-- login form using tailwindcss -->
        <div class="flex flex-col items-center justify-center p-4">
            <div class="px-10 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
                <!-- logo imagere here -->
                <div class="flex justify-center w-full mb-4 ">
                    <img src="includes/images/logo1.png" alt="logo" class="w-auto h-32">
                
                </div>
                <form action="login.php" method="post">
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                            Username
                            <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Username">
                            <p class="text-xs itaÉlic text-red-500">Please choose a username.</p>
                        </label>
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                            PASSWORD
                            <input class="w-full px-3 py-2 mb-3 leading-tight border border-red-500 rounded shadow appearance-none text-gray- 700 focus:outline-none focus:shadow-outline" id="password" type="password" name="
                            password" placeholder="********">
                        
                           
                        </label>
                        <a href="" ><p class="text-xs itaÉlic text-blue-700">Forget password?.</p></a>
                    </div>
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Login
                </button>
                </form>
                <div>
                  <p>Don't have account? <a href="signup.php" class="text-blue-500">Create Here</a></p>
                </div>
            </div>
        </div>	
    </div>
</body>
</html>