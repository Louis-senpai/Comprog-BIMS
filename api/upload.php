<?php

session_start();
require_once "../config.php";
require_once "../vendor/autoload.php";
require_once "../models/userActivityLogs.php";
require_once "../models/accounts.php";
$account = new Accounts($conn);
$userLogs = new UserActivityLogs($conn);

if (isset($_POST['submit_image']) && isset($_FILES['profile_image'])) {
    $userId = $_SESSION['user_id'];
    $image = $_FILES['profile_image'];
    $imageName = $userId . '_' . basename($image['name']);
    $uploadDir = '../includes/images/';
    $uploadFile = $uploadDir . $imageName;

    // Check if the file type is an image
    $check = getimagesize($image['tmp_name']);
    if($check !== false) {
        // Attempt to upload the file
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // update the accounts table
            $account->updateProfileImage($userId, $imageName);
            // Update session variable and database if needed
            $_SESSION['image_url'] = $imageName;
            
            $_SESSION['success_message'] = "Image Updated successfully!";
            
            $userLogs->logActivity($userId, "Updated profile image");
            header("Location:../admin/settings.php");
        } else {
            
            $_SESSION['error_message'] = "Image Update failed!";
            header("Location:../admin/settings.php");
        }
    } else {
      
        $_SESSION['error_message'] = "File is not an image.";
        header("Location:../admin/settings.php");
    }
}
if (isset($_POST['submit_logo']) && isset($_FILES['system_logo'])) {
    // upload the photo then update the ../settings.json instead of the database
    $image = $_FILES['system_logo'];
    // make the uploaded image be a radom number
    $imageName = rand(100000, 999999). '_'. basename($image['name']);
    $uploadDir = '../includes/images/';
    $uploadFile = $uploadDir . $imageName;
    $check = getimagesize($image['tmp_name']);
    if($check !== false) {
        // Attempt to upload the file
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            $settings = file_get_contents('../settings.json');
            $settings = json_decode($settings, true);
            $settings['Logo'] = $imageName;
            $settings = json_encode($settings);
            file_put_contents('../settings.json', $settings, true);

           
            $_SESSION['success_message'] = "Logo Updated successfully!";
            header("Location:../admin/settings.php");
        } else {
            $_SESSION['error_message'] = "Logo Update failed!";
            header("Location:../admin/settings.php");
        }
    } else {
        $_SESSION['error_message'] = "File is not an image.";
        header("Location:../admin/settings.php");
    }
}
