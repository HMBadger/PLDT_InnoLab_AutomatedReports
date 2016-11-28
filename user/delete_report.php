<?php
require_once('../database/config.php');
$updateQuery = "UPDATE ict_database.tblreports SET ReportIsActive = 0 WHERE ReportID = " .$_GET['del'];
mysqli_query($conn, $updateQuery);
header('Location: view_info.php');
?>
