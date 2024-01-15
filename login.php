<?php
	session_start();
	include("config.php");


	$user = $_POST['username']; 
	$pass = $_POST['password']; 

	$sql_login = "SELECT * FROM Accounts WHERE Username = '$username' AND Password = '$password' ";
	$result = mysqli_query($conn, $sql_login);

	if(mysqli_num_rows($result)<1){
		header("location:index.php");
	}
	else{
		while ($row = mysqli_fetch_array($result)) {
			$_SESSION['USER'] = $row['Username'];


			header("location: admin/home.php");
		}
	}

?>