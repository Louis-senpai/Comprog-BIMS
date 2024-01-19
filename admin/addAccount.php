<?php

require_once '../includes/components/header.php';

require_once '../includes/components/sidebar.php';



$account = new Accounts($conn);

if (isset($_POST['create_account'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $repassword = $_POST['repassword'];

    // $result = $account->registerAdmin($username, $password, $repassword, $email);
    if ($result) {
        // Handle the error, maybe display the message to the user
        echo $result;
    }
}

?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="px-4 pt-6 pr-4">
                    
            <?php 
            require_once '../includes/components/addaccountform.php';
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