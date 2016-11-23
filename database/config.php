<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_innolab";
	$conn = mysqli_connect($server, $username, $password, $database);

	if($conn)
	{
		//echo "CONNECTED!";
	}
	else
		die("Error: " . mysqli_connect_error());

?>
