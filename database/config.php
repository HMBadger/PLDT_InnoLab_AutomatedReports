<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "ict_database";
	$conn = mysqli_connect($server, $username, $password, $database);

	if($conn)
	{
		//echo "CONNECTED!";
	}
	else
		die("Error: " . mysqli_connect_error());
?>
