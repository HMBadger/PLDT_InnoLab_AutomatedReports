<?php
require_once('../database/config.php');
//sending query
mysqli_query($conn, "DELETE FROM tblreport WHERE ReportID = " .$_GET['del']);
header('Location: view_info.php');
 ?>
