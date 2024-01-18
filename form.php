<?php 
// json header
header('Content-Type: application/json');
require 'vendor/autoload.php';
require 'models/Components.php';
require 'models/Survey.php';
require 'config.php';

$survey = new Survey($conn);
$result = $survey->getYearAddedDistribution();

$lastData = end($result);
$responseCount = $lastData['response_count'];
echo json_encode($responseCount);
?>

