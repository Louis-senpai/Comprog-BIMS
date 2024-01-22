<?php
// deleteBackup.php

// Start the session
session_start();

// Include your configuration file
require_once('../config.php');

// Check if the user is authenticated and authorized
// You should implement your own authentication and authorization check here
if (!isset($_SESSION['user_id']) || !$_SESSION['user_id']) {
    die('Access denied');
}

// Get the filename from the query parameter and sanitize it
$filename = isset($_GET['file']) ? $_GET['file'] : '';
$filename = basename($filename); // Prevent directory traversal attacks

// Define the path to the backup directory
$backupDir = '../backups/';

// Create the full path to the file
$filePath = $backupDir . $filename;

// Check if the file exists and is writable
if (file_exists($filePath) && is_writable($filePath)) {
    // Attempt to delete the file
    if (unlink($filePath)) {
        // If the file is successfully deleted, redirect back with a success message
        $_SESSION['message'] = 'Backup file deleted successfully.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // If the file could not be deleted, redirect back with an error message
        $_SESSION['error'] = 'Error: Could not delete the backup file.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    // If the file doesn't exist or is not writable, redirect back with an error message
    $_SESSION['error'] = 'Error: The requested file could not be found or is not available for deletion.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

exit;
?>
