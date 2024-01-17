
<?php

require_once '../includes/components/header.php';


$host = "delta.optiklink.com";
$user = "u126067_6YObtWKgqn";
$name = "s126067_student";
$pass = "!yQ4Q2@Da6BB!8VWIhLcKKMw";
$port = "3306";

$conn = mysqli_connect($host, $user, $pass, $name, $port);



?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
            <div class="px-4 pt-6 pr-4">
                    

                  

                </div>
               
                <!-- Included Footer.php -->
                <?php 
                    require_once "../includes/components/footer.php";
                    ?>
            </main>
        </div>
    </div>

    </div>


</body>

</html>