<?php 
session_start();
require_once '../config.php';

require_once '../models/RestoreModel.php';
$name = $_GET['name'];
$result = $restoreBackup->restoreFromFile($name);




?>