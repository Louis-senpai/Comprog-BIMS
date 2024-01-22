<?php 
session_start();
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../models/RestoreModel.php';
require_once '../models/userActivityLogs.php';

$fileName = $_GET['file'];
$result = $restoreBackup->restoreFromFile($fileName);
echo 'Result: '.$result;
?>