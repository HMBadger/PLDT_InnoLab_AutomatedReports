<?php
require 'dbConnection.php';
include 'vgroup.php';

$id = $_GET['Group_ID'];
if (isset($id)){
	$sql = "delete * from db_innolab.tblgroup where Group_ID='$id'";
	$query = mysqli_query($conn,$sql);
		header(' location: vgroup.php');
}
?>
