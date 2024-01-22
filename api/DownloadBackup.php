<?php
// downloadBackup.php

// Start the session
session_start();

// Include your configuration file
require_once('../config.php');

// Check if the user is authenticated
// You should implement your own authentication check here
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

// Check if the file exists and is readable
if (file_exists($filePath) && is_readable($filePath)) {
    // Set headers to force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));

    // Clear output buffer
    ob_clean();
    flush();

    // Read the file and output its contents
    readfile($filePath);

    // Terminate the script
    exit;
} else {
    // If the file doesn't exist or is not readable, display an error message
    echo 'Error: The requested file could not be found or is not available for download.';
}
?>
