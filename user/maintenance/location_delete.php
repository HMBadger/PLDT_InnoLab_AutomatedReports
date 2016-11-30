<?php
require_once('../../database/config.php');
// sending query
$status = 0;
$updateQuery = "UPDATE ict_database.tbllocation SET LocationIsActive = '$status' WHERE LocationID = " .$_GET['del'];
mysqli_query($conn, $updateQuery);
header('Location: location.php');
?>
