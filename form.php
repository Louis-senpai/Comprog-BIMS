<?php 
    // give a birthdate and get the age 
    
    $birthDate = '01/01/2002';
    
    $birthDate = explode("/", $birthDate);
    $birthDate = $birthDate[2]. "-". $birthDate[0]. "-". $birthDate[1];
    $birthDate = new DateTime($birthDate);
    $today = new DateTime("today");
    $age = $today->diff($birthDate)->y;
   
    $age = (int)$age;
    echo $age;

?>