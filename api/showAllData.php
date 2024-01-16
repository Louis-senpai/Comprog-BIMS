<?php 
header('Content-Type: application/json');

require_once('../config.php');
require(ROOT_DIR . '/vendor/autoload.php');
require(ROOT_DIR . '/models/survey.php');

$Survey = new Survey($conn);

// Check if the cache file exists and is recent enough
$cacheFile = '../cache/surveys.json';
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 60 * 60) { // Cache is valid for 1 hour
    // Serve the cached response
    $jsonData = file_get_contents($cacheFile);
} else {
    // Get the data from the database and cache it
    $Survey->cacheSurveys();
    // Serve the new cached response
    $jsonData = file_get_contents($cacheFile);
}

// Serve the response
echo $jsonData;
?>