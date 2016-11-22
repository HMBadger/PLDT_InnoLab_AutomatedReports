<?php
require 'dbConnection.php';
include 'location.php';

$id = $_GET['btnDelete'];
if (isset($id)){
	$query = "delete * from db_innolab.tbllocation where Location_ID='$id'";
	if ($query){
		echo "<script>alert('Delete Data?');location.href='location.php';</script>";
}	else{
		header(' location: location.php');
}

}

?>
