<?php

	$conn = mysqli_connect("localhost", "root", "");

	if($conn)
	{
		//echo "CONNECTED!";
	}
	else
		die("Error: " . mysqli_connect_error());
?>