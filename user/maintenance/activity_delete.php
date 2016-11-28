<?php
require_once('../../database/config.php');
// sending query
$updateQuery = "UPDATE ict_database.tblactivity SET ActivityIsActive = 0 WHERE ActivityID =" .$_GET['del'];
mysqli_query($conn, $updateQuery);
header('Location: activity.php');
?>
