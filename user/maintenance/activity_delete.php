<?php
require_once('../../database/config.php');
// sending query
mysqli_query($conn, "DELETE FROM tblactivity WHERE Activity_ID = " .$_GET['del']);
header('Location: activity.php');
?>
