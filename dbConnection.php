<?php

	$conn = mysqli_connect("localhost", "root", "", "db_innolab");

	if($conn)
	{
		//echo "CONNECTED!";
	}
	else
		die("Error: " . mysqli_connect_error());
		
?>
