<?php
require('../../database/config.php');

$repYear = $_POST['yearActivity'];
$branName = $_POST['branchActivity'];

$getAct = "SELECT COUNT(ReportActivity) AS RepAct, ActivityName, ReportDate
FROM ict_database.tblreports r LEFT JOIN ict_database.tblactivity a
ON r.ReportActivity = a.ActivityID
LEFT JOIN ict_database.tbllocation l
ON r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND
ReportLoc = '$branName' AND LocationIsActive = 1 AND ReportIsActive = 1 AND ActivityIsActive = 1 GROUP BY ReportActivity";

$execVisitors = mysqli_query($conn, $getAct);

if (!$execVisitors) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}

while($row = mysqli_fetch_assoc($execVisitors)){
  $array[] = array($row['ActivityName'], (float)$row['RepAct']);
}

echo json_encode($array);
?>
