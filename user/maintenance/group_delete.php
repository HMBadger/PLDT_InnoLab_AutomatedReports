<?php
require_once('../../database/config.php');
// sending query
$updateQuery = "UPDATE ict_database.tblgroup SET GroupIsActive = 0 WHERE GroupID = " .$_GET['del'];
mysqli_query($conn, $updateQuery);
header('Location: vgroup.php');
?>
