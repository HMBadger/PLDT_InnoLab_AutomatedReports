<?php
require 'dbConnection.php';
include 'location.php';

$id = $_GET['id'];
if (isset($id)){
	$sql = "delete * from db_innolab.tbllocation where Location_ID='$id'";
	$query = mysqli_query($conn,$sql);
	if ($sql){
		echo "<script>alert('Delete Data?');location.href='location.php';</script>";
	}	else{
		header(' location: location.php');
	}
}
?>
