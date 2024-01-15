<?php
session_start();
include("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign POST variables and escape them to prevent SQL injection
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $sql_login = "SELECT * FROM Accounts WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql_login);

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, 's', $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) < 1) {
        // No user found, set error message and redirect to login page
        $_SESSION['error'] = 'No user found with that username.';
        header("Location: index.php");
        exit();
    } else {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($pass, $row['password'])) {
            // Password is correct, set the session variable
            $_SESSION['USER'] = $row['username'];

            // Redirect to the admin home page
            header("Location: admin/home.php");
            exit();
        } else {
            // Password is incorrect, set error message and redirect to login page
            $_SESSION['error'] = 'Incorrect password.';
            header("Location: index.php");
            exit();
        }
    }
} else {
    // Not a POST request, redirect to login page
    header("Location: index.php");
    exit();
}
?>