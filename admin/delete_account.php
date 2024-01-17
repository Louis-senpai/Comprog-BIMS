<?php

$host = "delta.optiklink.com";
$user = "u126067_6YObtWKgqn";
$name = "s126067_student";
$pass = "!yQ4Q2@Da6BB!8VWIhLcKKMw";
$port = "3306";

$conn = mysqli_connect($host, $user, $pass, $name, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user ID from the POST data
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

// Check if user_id is not null before proceeding
if ($user_id !== null) {
    // DELETE using prepared statement
    $sql = "DELETE FROM Accounts WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
       
        echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>";
        echo "<p style='padding: 1rem; margin-bottom: 1rem; color: green; background-color: #e6f4e6; border-radius: 5px; height: 3.5rem; width: 18.5rem; font-weight: bold; font-size: 1.2rem; text-align: center;'>User deleted successfully</p>";
        echo "<form method='post' action='resident.php'>";
        echo "<button type='button' onclick='goBack()' style='display: inline-flex; align-items: center; padding: 0.5rem 1rem; font-size: 0.875rem; font-weight: 500; text-align: center; text-decoration: none; white-space: nowrap; cursor: pointer; border: 1px solid transparent; border-radius: 0.375rem; background-color: blue; color: #ffffff;'>";
        echo "Go Back</button>";
        echo "</form>";
        echo "</div>";
     
        
    

    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<p class='p-4 mb-4 text-red-500 bg-red-100 rounded h-14'>User ID is not set in the POST data.</p>";
}

$conn->close(); 
?>
<script>
    function goBack() {
        window.history.back();
    }
</script>
