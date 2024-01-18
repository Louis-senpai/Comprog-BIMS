<?php 
require_once '../config.php';
require_once '../vendor/autoload.php';
require_once '../models/Components.php';
require_once '../models/survey.php';

$Components = new Tailwind();
$surveyModel = new Survey($conn);

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    

}



?>