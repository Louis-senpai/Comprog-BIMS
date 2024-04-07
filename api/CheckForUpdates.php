<?php 

require_once('../config.php');

$settings = new Settings(ROOT_DIR . '\settings.json');
$version = $settings->getVersion();
require_once('../models/Github.php');

$github = new Github();
$latestRelease = json_decode($github->checkForUpdates(), true);

header('Content-Type: application/json');
$data = [
    'version' => $latestRelease['name'],
    'latestRelease' => $latestRelease  
];
echo json_encode($data);

