<?php
require_once('../../database/config.php');
// sending query
mysqli_query($conn, "DELETE FROM tbllocation WHERE Location_ID = " .$_GET['del']);
header('Location: location.php');
?>
