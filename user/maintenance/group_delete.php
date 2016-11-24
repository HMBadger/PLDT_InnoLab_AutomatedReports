<?php
require_once('../../database/config.php');
// sending query
mysqli_query($conn, "DELETE FROM tblgroup WHERE Group_ID = " .$_GET['del']);
header('Location: vgroup.php');
?>
