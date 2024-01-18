
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
                    <!-- ... Other existing content ... -->

                   
                    <?php


                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
                            $user_id = $_POST['user_id'];

                            // Retrieve the user data based on the ID
                            $stmt = $conn->prepare("SELECT * FROM Survey WHERE ID = ?");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $user_data = $result->fetch_assoc();
                            
                                // Display the edit form with existing user data
                                echo "<form method='post' action='update_user.php'>";
                                echo "<input type='hidden' name='user_id' value='" . $user_data['ID'] . "'>";
                            
                                // Form fields for editing user data
                                echo "<div class='flex items-center mb-4'>";
                                echo "<label for='first_name' class='mr-2'>First Name:</label>";
                                echo "<input type='text' name='first_name' id='first_name' value='" . $user_data['FirstName'] . "' class='border p-2'>";
                                
                                echo "<label for='last_name' class='ml-4 mr-2'>Last Name:</label>";
                                echo "<input type='text' name='last_name' id='last_name' value='" . $user_data['LastName'] . "' class='border p-2'>";
                                
                                echo "<label for='middle_name' class='ml-4'>Middle Name:</label>";
                                echo "<input type='text' name='middle_name' id='middle_name' value='" . $user_data['MiddleName'] . "' class='border p-2'>";
                                echo "</div>";
                            
                                echo "<div class='flex items-center mb-4'>";
                                echo "<label for='birthplace' class='mr-2'>Birthplace:</label>";
                                echo "<input type='text' name='birthplace' id='birthplace' value='" . $user_data['Birthplace'] . "' class='border p-2'>";
                                
                                echo "<label for='birthdate' class='ml-4 mr-2'>Birthdate:</label>";
                                echo "<input type='date' name='birthdate' id='birthdate' value='" . $user_data['Birthdate'] . "' class='border p-2'>";
                                
                                echo "<label for='age' class='ml-4'>Age:</label>";
                                echo "<input type='text' name='age' id='age' value='" . $user_data['Age'] . "' class='border p-2'>";
                                echo "</div>";
                            
                                // Repeat similar lines for other fields
                            
                                echo "<button type='submit'>Update user</button>";
                                echo "</form>";
                            } else {
                                echo "User not found";
                            }

                            $stmt->close();
                        } else {
                            echo "Invalid request";
                        }
                            
               
                        ?>

                   

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