<?php 
define('ROOT_DIR', realpath(__DIR__));
// $host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
// $user = "hNvMJhT21dbYAtt.root";
// $name = "test";
// $pass = "5ySvySDkJz7eBMia";
// $port = "4000";
// $ca_path = 'isrgrootx1.pem';



// $conn = mysqli_init();
// if (!$conn) {
//     die("mysqli_init failed");
// }

// // Set SSL options
// mysqli_ssl_set($conn, NULL, NULL, $ca_path, NULL, NULL);

// // Establish the connection
// if (!mysqli_real_connect($conn, $host, $user, $pass, $name, NULL, NULL, MYSQLI_CLIENT_SSL)) {
//     die("Connection failed: " . mysqli_connect_error());

// }


$host = "delta.optiklink.com";
$user = "u126067_6YObtWKgqn";
$name = "s126067_student";
$pass = "!yQ4Q2@Da6BB!8VWIhLcKKMw";
$port = "3306";

$conn = mysqli_connect($host, $user, $pass, $name, $port);






?>
